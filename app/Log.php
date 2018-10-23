<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Cliente;

class Log extends AbstractModel implements DefaultModel
{
    use Notifiable;

    protected     $table            = 'log';
    public static $base_name_route  = 'log';
    public static $verbose_name     = 'log';
    public static $verbose_plural   = 'logs';
    public static $verbose_genre    = 'M';
    public static $controller       = 'LogController';


    public static function insert($attributes){

        unset($attributes['_token']);

        return  self::create($attributes);

    }

    public function update(array $attributes = [], array $options = []){
        unset($attributes['_token']);

        return  parent::update($attributes);

    }

    public static function destroy($ids)
    {
        return parent::destroy($ids); // TODO: Change the autogenerated stub
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function search(Request $request){

        $request_query      = $request->input('query');
        $page               = $request->input('pagination.page', 1);
        $perpage            = $request->input('pagination.perpage', 10000);
        $columns            = $request->input('columns',  ['*']);
        $sort               = $request->input('sort',  NULL);

        $query =  DB::table('log')
           ->select([
                'log.id as id',
                'log.antigo as antigo',
                'log.novo as novo',
                'log.tipo as tipo',
                'log.tabela as tabela',
                'log.cadastrado_por as cadastrado_por',
                DB::raw('DATE_FORMAT(log.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(log.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);


        if(isset($request_query['tipo'])){
            if(!empty($request_query['tipo'])){
                $query->where('log.tipo', '=', $request_query['tipo']);
            }
        }

        if(isset($request_query['tabela'])){
            if(!empty($request_query['tabela'])){
                $query->where('log.tabela', '=',  $request_query['tabela']);
            }
        }

        if(isset($request_query['cadastrado_por'])){
            if(!empty($request_query['cadastrado_por'])){
                $query->where('log.cadastrado_por', '=',  $request_query['cadastrado_por']);
            }
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
                'field' => 'novo',
                'title' => 'Novo',
            ], [
                'field' => 'antigo',
                'title' => 'Antigo',
            ],
            [
                'field' => 'tipo',
                'title' => 'tipo',
            ],[
                'field' => 'tabela',
                'title' => 'tabela',
            ],[
                'field' => 'cadastrado_por',
                'title' => 'cadastrado_por',
            ],[
                'field' => 'created_at',
                'title' => 'created_at',
            ],[
                'field' => 'updated_at',
                'title' => 'updated_at',
            ]


        ];

        return response()->json($columns);
    }

    public static function dataTablesSearchForm(){

        return  [
            'fields' =>[
                'tipo' => [
                    'type'          => 'number',
                    'placeholder'   => 'Tipo',
                ],
                'tipo' => [
                    'type'          => 'select',
                    'label'         => 'Status *',
                    'placeholder'   => 'Status',
                    'options'      => [
                        'insert' => 'Cadastrados',
                        'update' => 'Atualizados',
                        'delete'    => 'Exluidos'
                    ],
                    'required'      => 'required'
                ],
                'tabela' => [
                    'type'          => 'select',
                    'label'         => 'Tabela *',
                    'placeholder'   => 'Tabela',
                    'options'      => [
                        'agenda' => 'Agendas',
                        'candidato' => 'Candidatos',
                        'horarios'    => 'Horários',
                    ],
                    'required'      => 'required'
                ],
                'cadastrado_por' => [
                    'type'          => 'select',
                    'label'         => 'Status *',
                    'placeholder'   => 'Status',
                    'options'      => \App\User::pluck('name', 'id'),
                    'required'      => 'required'
                ],
            ]
        ];
    }

    public function tabela(){
        return $this->belongsTo($this->tabela, $this->pk_tabela);
    }

  

    public function __toString()
    {
        return $this->tabela. ' - '. $this->tipo;
    }
}
