<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Evento extends AbstractModel implements DefaultModel
{

    protected     $table            = 'evento';
    public static $base_name_route  = 'evento';
    public static $verbose_name     = 'evento';
    public static $verbose_plural   = 'eventos';
    public static $verbose_genre    = 'M';
    public static $controller       = 'EventoController';
    

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
        $excluded           = $request->input('excluded',  NULL);

        $query =  DB::table('evento')
           ->select([
                'evento.id as id',
                'evento.identificador as identificador',
                'evento.titulo as titulo',
                 DB::raw('CONCAT(DATE_FORMAT(evento.hora_inicio,"%H:%i"), " - ", DATE_FORMAT(evento.hora_fim,"%H:%i")) AS horario'),
                 DB::raw('DATE_FORMAT(evento.data_inicio,"%d/%m/%Y") as  data_do_curso'),
                'evento.data_inicio as data_inicio',
                'evento.hora_inicio as hora_inicio',
                'evento.data_fim as data_fim',
                'evento.hora_fim as hora_fim',
                'evento.carga_horaria as carga_horaria',
                'evento.maximo_participantes as maximo_participantes',
                'evento.preco as preco',
                'evento.tipo as tipo',
                'evento.local_id as local_id',

                DB::raw('DATE_FORMAT(evento.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(evento.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

        $query->join('local', 'local.id', '=', 'evento.local_id');

        if(isset($request_query['descricao'])){
            if(!empty($request_query['descricao'])){
                $query->where('evento.descricao', 'like', '%'.$request_query['descricao'].'%');
            }
        }

        if(isset($request_query['titulo'])){
            if(!empty($request_query['titulo'])){
                $query->where('evento.titulo', 'like', '%'.$request_query['titulo'].'%');
            }
        }

        if(isset($request_query['identificador'])){
            if(!empty($request_query['identificador'])){
                $query->where('evento.identificador', 'like', '%'.$request_query['identificador'].'%');
            }
        }

        if(isset($request_query['local_id'])){
            if(!empty($request_query['local_id'])){
                $query->where('evento.local_id', '=', $request_query['local_id']);
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
                'field' => 'identificador',
                'title' => 'Identificador',
            ],[
                'field' => 'titulo',
                'title' => 'Título',
            ],[
                'field' => 'data_do_curso',
                'title' => 'Data',
            ],[
                'field' => 'horario',
                'title' => 'Horário',
            ],
            [
                'field' => 'carga_horaria',
                'title' => 'Carga horária',
            ], [
                'field' => 'maximo_participantes',
                'title' => 'Max. Participantes',
            ],
        ];

        return response()->json($columns);
    }

    public static function dataTablesSearchForm(){

        return  [
            'fields' =>[
                'titulo' => [
                    'type'          => 'text',
                    'placeholder'   => 'Título',
                ],
                'local_id' => [
                    'type'          => 'select',
                    'options'       => Local::select('descricao', 'id')->pluck('descricao', 'id'),
                    'label'         => 'Local',
                    'placeholder'   => 'Local',
                    'required'      => 'required',
                ],
            ]
        ];
    }

    public static function fieldsFormCreate(){

        return  [
            'fields' =>[
                [
                    'local_id' => [
                        'type'          =>  'select',
                        'options' => Local::pluck('descricao', 'id'),
                        'label'         => 'Local',
                        'placeholder'   => 'Local',
                        'required'      => 'required',
                    ],
                ],
                [
                    'identificador' => [
                        'type'          => 'text',
                        'label'         => 'Identificador',
                        'placeholder'   => 'Identificador',
                        'required'      => 'required',
                    ],

                    'titulo' => [
                        'type'          => 'text',
                        'label'         => 'Título',
                        'placeholder'   => 'Título',
                        'required'      => 'required',
                    ],
                ],   
                [
                    'data_inicio' => [
                        'type'          => 'date',
                        'label'         => 'Data início',
                        'placeholder'   => 'Início',
                        'required'      => 'required',
                    ],
                    'hora_inicio' => [
                        'type'          => 'time',
                        'label'         => 'Hora início',
                        'placeholder'   => 'Hora Início',
                        'required'      => 'required',
                    ],
                ],
                [
                    'data_fim' => [
                        'type'          =>  'date',
                        'label'         => 'Data fim',
                        'placeholder'   => 'Data fim',
                        'required'      => 'required',
                    ],
                    'hora_fim' => [
                        'type'          => 'time',
                        'label'         => 'Hora fim',
                        'placeholder'   => 'Hora fim',
                        'required'      => 'required',
                    ],
                ],
                [
                    'carga_horaria' => [
                        'type'          => 'number',
                        'label'         => 'Carga horária',
                        'placeholder'   => 'Carga horária',
                        'required'      => 'required',
                    ],

                    'maximo_participantes' => [
                        'type'          =>  'number',
                        'label'         => 'Max. de participantes',
                        'placeholder'   => 'Max. de participantes',
                        'required'      => 'required',
                    ],


                ],
                [
                    'preco' => [
                        'type'          =>  'number',
                        'label'         => 'Preço',
                        'placeholder'   => 'Preço',
                        'required'      => 'required',
                        'attr' => 'step=".01"'
                    ],
                    'tipo' => [
                        'type'          =>  'select',
                        'options' => [
                            'palestra' => 'palestra',
                            'minicurso' => 'minicurso'
                        ],
                        'label'         => 'Tipo',
                        'placeholder'   => 'Tipo',
                        'required'      => 'required',
                    ],
                ],
                [
                    'id' => [
                        'type'          => 'hidden',
                    ],
                ],
            ]

        ];
    }

    public static function fieldsFormEdit(){
        return  self::fieldsFormCreate();
    }

    public function __toString()
    {
        return $this->titulo;
    }

}
