<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Atividade extends AbstractModel implements DefaultModel
{

    protected     $table            = 'atividade';
    public static $base_name_route  = 'atividade';
    public static $verbose_name     = 'atividade';
    public static $verbose_plural   = 'atividades';
    public static $verbose_genre    = 'M';
    public static $controller       = 'AtividadeController';
    

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

        $query =  DB::table('atividade')
           ->select([
                'atividade.id as id',
                'atividade.identificador as identificador',
                'atividade.titulo as titulo',
                 DB::raw('CONCAT(DATE_FORMAT(atividade.hora_inicio,"%H:%i"), " - ", DATE_FORMAT(atividade.hora_fim,"%H:%i")) AS horario'),
                 DB::raw('DATE_FORMAT(atividade.data_inicio,"%d/%m/%Y") as  data_do_curso'),
                'atividade.data_inicio as data_inicio',
                'atividade.hora_inicio as hora_inicio',
                'atividade.data_fim as data_fim',
                'atividade.hora_fim as hora_fim',
                'atividade.carga_horaria as carga_horaria',
                'atividade.maximo_participantes as maximo_participantes',
                'atividade.preco as preco',
                'atividade.tipo as tipo',
                'atividade.local_id as local_id',
                'local.descricao as local_descricao',

                DB::raw('DATE_FORMAT(atividade.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(atividade.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

        $query->join('local', 'local.id', '=', 'atividade.local_id');
        $query->join('evento', 'evento.id', '=', 'atividade.evento_id');

        if(isset($request_query['descricao'])){
            if(!empty($request_query['descricao'])){
                $query->where('atividade.descricao', 'like', '%'.$request_query['descricao'].'%');
            }
        }

        if(isset($request_query['titulo'])){
            if(!empty($request_query['titulo'])){
                $query->where('atividade.titulo', 'like', '%'.$request_query['titulo'].'%');
            }
        }

        if(isset($request_query['identificador'])){
            if(!empty($request_query['identificador'])){
                $query->where('atividade.identificador', 'like', '%'.$request_query['identificador'].'%');
            }
        }

        if(isset($request_query['local_id'])){
            if(!empty($request_query['local_id'])){
                $query->where('atividade.local_id', '=', $request_query['local_id']);
            }
        }

        if(isset($request_query['data_inicio'])){
            if(!empty($request_query['data_inicio'])){
                $query->where('atividade.data_inicio', '=', $request_query['data_inicio']);
            }
        }

        if(isset($request_query['data_fim'])){
            if(!empty($request_query['data_fim'])){
                $query->where('atividade.data_fim', '=', $request_query['data_fim']);
            }
        }

        $query->where('atividade.evento_id', '=', Evento::eventoPadrao());

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
            ],[
                'field' => 'local_descricao',
                'title' => 'Local',
            ],
        ];

        return response()->json($columns);
    }

    public static function dataTablesSearchForm(){

        return  [
            'fields' =>[
                'identificador' => [
                    'type'          => 'text',
                    'placeholder'   => 'Identificador',
                ],
                'titulo' => [
                    'type'          => 'text',
                    'placeholder'   => 'Título',
                ],
                'data_inicio' => [
                    'type'          => 'date',
                    'placeholder'   => 'Data',
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
