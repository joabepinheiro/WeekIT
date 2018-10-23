<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class Resource extends AbstractModel implements DefaultModel
{
    protected     $table            = 'resources';
    public static $base_name_route  = 'resource';
    public static $verbose_name     = 'Recurso';
    public static $verbose_plural   = 'Recursos';
    public static $verbose_genre    = 'M';
    public static $controller       = 'ResourceController';

    protected $fillable = [
        'id', 'nome', 'descricao', 'uri', 'controller', 'action', 'method'
    ];


    public static function insert($data){

        return Resource::create([
            'nome'         => $data['nome'],
            'descricao'    => $data['descricao'] ?? NULL,
            'uri'          => $data['uri'],
            'controller'   => $data['controller'],
            'action'       => $data['action'],
            'method'       => $data['method'],
            'middleware'   => $data['middleware'],

        ]);
    }

    public static function search(Request $request){

        $request_query      = $request->input('query');
        $page               = $request->input('pagination.page', 1);
        $perpage            = $request->input('pagination.perpage', 10000);
        $columns            = $request->input('columns',  ['*']);
        $sort               = $request->input('sort',  NULL);
        $excluded           = $request->input('excluded',  NULL);

        $query =  DB::table('resources')
            ->select([
                'resources.id as id',
                'resources.nome as nome',
                'resources.descricao as descricao',
                'resources.uri as uri',
                'resources.controller as controller',
                'resources.action as action',
                'resources.middleware as middleware',
                'resources.method as method',
                DB::raw('DATE_FORMAT(resources.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(resources.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

        if(isset($request_query['nome'])){
            if(!empty($request_query['nome'])){
                $query->where('resources.nome', 'like', '%'.$request_query['nome'].'%');
            }
        }

        if(isset($request_query['method'])){
            if(!empty($request_query['method'])){
                $query->where('resources.method', 'like',  $request_query['method']);
            }
        }

        if(isset($request_query['uri'])){
            if(!empty($request_query['uri'])){
                $query->where('resources.uri', 'like',  $request_query['uri']);
            }
        }

        if(is_null($excluded)){
            $query->whereNull('resources.deleted_at');
        }

        if(isset($sort)){
            $query->orderBy($sort['field'],$sort['sort']);
        }

        $paginator  = $query->paginate($perpage, $columns, 'page', $page);

        return response()->json([
            'meta' => [
                'page'      =>  $paginator->currentPage(),
                'pages'     => $paginator->lastPage(),
                'perpage'   => $paginator->perPage(),
                'total'     => $paginator->total(),
            ],
            'data' => $paginator->items()
        ]);
    }

    /**
     * Colunas a serem exibidas na tabela que lista os registros
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function dataTablesColumns(){

        $columns = [
            [
                'field' => 'nome',
                'title' => 'Nome',
                'width' => 210
            ],
            [
                'field' => 'uri',
                'title' => 'uri',
                'width' => 270
            ],[
                'field' => 'controller',
                'title' => 'controller',
                'width' => 270
            ],[
                'field' => 'action',
                'title' => 'action',
            ],[
                'field' => 'method',
                'title' => 'method',
            ],[
                'field' => 'middleware',
                'title' => 'middleware',
            ],[
                'field' => 'created_at',
                'title' => 'Criado em',
            ],

        ];

        return response()->json($columns);
    }

    public static function dataTablesSearchForm(){

        return  [
            'fields' =>[
                'nome' => [
                    'type'         => 'text',
                    'placeholder'  => 'Nome',
                ],
                'uri' => [
                    'type'          => 'text',
                    'placeholder'  => 'URI',
                ],

                'method' => [
                    'type'          => 'select',
                    'label'         => 'Método',
                    'placeholder'   => 'Método',
                    'options'       => [
                        'GET'      => 'GET',
                        'POST'     => 'POST',
                        'PUT'      => 'PUT',
                        'DELETE'   => 'DELETE',
                    ],
                    'required'      => 'required'
                ],
            ]
        ];
    }

    public static function fieldsFormCreate(){

        return  [
            'fields' => [
                [
                    'nome' => [
                        'type'          => 'text',
                        'label'         => 'Nome *',
                        'placeholder'   => 'Nome',
                        'required'      => 'required'
                    ],
                ],
                [
                    'uri' => [
                        'type'          => 'text',
                        'label'         => 'URI *',
                        'placeholder'   => 'URI',
                        'required'      => 'required'
                    ],
                ],
                [
                    'descricao' => [
                        'type'          => 'textarea',
                        'label'         => 'Descrição',
                        'placeholder'   => 'Descrição',
                    ],
                ],
                [
                    'controller' => [
                        'type'          => 'text',
                        'label'         => 'Controller *',
                        'placeholder'   => 'Controller',
                        'required'      => 'required'
                    ],
                ],
                [
                    'action' => [
                        'type'          => 'text',
                        'label'         => 'Action *',
                        'placeholder'   => 'Action',
                        'required'      => 'required'
                    ],

                    'method' => [
                        'type'          => 'select',
                        'label'         => 'Método',
                        'placeholder'   => 'Método',
                        'options'       => [
                            'GET'      => 'GET',
                            'POST'     => 'POST',
                            'PUT'      => 'PUT',
                            'DELETE'   => 'DELETE',
                        ],
                        'required'      => 'required'
                    ],
                ],
                [
                    'middleware' => [
                        'type'          => 'text',
                        'label'         => 'Middleware *',
                        'placeholder'   => 'Middleware',
                        'description'   => 'Informe cada middleware separado por vírgula'
                    ],
                ],
            ]
        ];
    }

    public static function fieldsFormEdit(){

        return  [
            'fields' => [
                [
                    'id' => [
                        'type'          => 'hidden',
                        'required'      => 'required'
                    ],
                ],

                [
                    'nome' => [
                        'type'          => 'text',
                        'label'         => 'Nome *',
                        'placeholder'   => 'Nome',
                        'required'      => 'required'
                    ],
                ],
                [
                    'uri' => [
                        'type'          => 'text',
                        'label'         => 'URI *',
                        'placeholder'   => 'URI',
                        'required'      => 'required'
                    ],
                ],
                [
                    'descricao' => [
                        'type'          => 'textarea',
                        'label'         => 'Descrição',
                        'placeholder'   => 'Descrição',
                    ],
                ],
                [
                    'controller' => [
                        'type'          => 'text',
                        'label'         => 'Controller *',
                        'placeholder'   => 'Controller',
                        'required'      => 'required'
                    ],
                ],
                [
                    'action' => [
                        'type'          => 'text',
                        'label'         => 'Action *',
                        'placeholder'   => 'Action',
                        'required'      => 'required'
                    ],

                    'method' => [
                        'type'          => 'select',
                        'label'         => 'Método',
                        'placeholder'   => 'Método',
                        'options'       => [
                            'GET'      => 'GET',
                            'POST'     => 'POST',
                            'PUT'      => 'PUT',
                            'DELETE'   => 'DELETE',
                        ],
                        'required'      => 'required'
                    ],

                ],
                [
                    'middleware' => [
                        'type'          => 'text',
                        'label'         => 'Middleware *',
                        'placeholder'   => 'Middleware',
                        'description'   => 'Informe cada middleware separado por vírgula'
                    ],
                ],
            ]
        ];
    }

    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return $this->nome;
    }
}
