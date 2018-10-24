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
                'evento.nome as nome',
                'evento.sigla as sigla',
                'evento.ano as ano',
                'evento.edicao as edicao',
                'evento.data_inicio as data_inicio',
                'evento.data_fim as data_fim',
                'evento.data_inicio_inscricao as data_inicio_inscricao',
                'evento.data_fim_inscricao as data_fim_inscricao',

                DB::raw('DATE_FORMAT(evento.data_inicio,"%d/%m/%Y %H:%i:%s") as data_inicio_br'),
                DB::raw('DATE_FORMAT(evento.data_fim,"%d/%m/%Y %H:%i:%s") as data_fim_br'),
                DB::raw('DATE_FORMAT(evento.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(evento.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);


        if(isset($request_query['nome'])){
            if(!empty($request_query['nome'])){
                $query->where('evento.nome', 'like', '%'.$request_query['nome'].'%');
            }
        }

        if(isset($request_query['edicao'])){
            if(!empty($request_query['edicao'])){
                $query->where('evento.edicao', 'like', '%'.$request_query['edicao'].'%');
            }
        }

        if(isset($request_query['sigla'])){
            if(!empty($request_query['sigla'])){
                $query->where('evento.sigla', 'like', '%'.$request_query['sigla'].'%');
            }
        }

        if(isset($request_query['data_inicio'])){
            if(!empty($request_query['data_inicio'])){
                $query->where('evento.data_inicio', '=', $request_query['data_inicio']);
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
                'field' => 'nome',
                'title' => 'Nome',
            ],[
                'field' => 'sigla',
                'title' => 'Sigla',
            ],[
                'field' => 'ano',
                'title' => 'Ano',
            ],[
                'field' => 'edicao',
                'title' => 'Edição',
            ],
            [
                'field' => 'data_inicio_br',
                'title' => 'Início',
            ], [
                'field' => 'data_fim_br',
                'title' => 'Fim',
            ],
            [
                'field' => 'data_inicio_br',
                'title' => 'Inicio das inscrições',
            ], [
                'field' => 'data_fim_br',
                'title' => 'Fim das inscrições',
            ],
        ];

        return response()->json($columns);
    }

    public static function dataTablesSearchForm(){

        return  [
            'fields' =>[


                'nome' => [
                    'type'          => 'text',
                    'placeholder'   => 'Nome',
                ],
                'data_inicio' => [
                    'type'          => 'date',
                    'placeholder'   => 'Inicio',
                ],
                'data_fim' => [
                    'type'          => 'date',
                    'placeholder'   => 'Fim',
                ],

            ]
        ];
    }

    public static function fieldsFormCreate(){

        return  [
            'fields' =>[

                [
                    'nome' => [
                        'type'          => 'text',
                        'label'         => 'Nome',
                        'placeholder'   => 'Nome',
                        'required'      => 'required',
                    ],

                    'sigla' => [
                        'type'          => 'text',
                        'label'         => 'Sigla',
                        'placeholder'   => 'Sigla',
                        'required'      => 'required',
                    ],
                ],   
                [
                    'ano' => [
                        'type'          => 'number',
                        'label'         => 'Ano',
                        'placeholder'   => 'Ano',
                        'required'      => 'required',
                    ],
                    'edicao' => [
                        'type'          => 'number',
                        'label'         => 'Edição',
                        'placeholder'   => 'Edição',
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
                    'data_inicio_inscricao' => [
                        'type'          => 'date',
                        'label'         => 'Início da inscrição',
                        'placeholder'   => 'Início  da inscrição',
                        'required'      => 'required',
                    ],
                    'hora_inicio_inscricao' => [
                        'type'          => 'time',
                        'label'         => 'Hora início da inscrição',
                        'placeholder'   => 'Hora Início da inscrição',
                        'required'      => 'required',
                    ],
                ],
                [
                    'data_fim_inscricao' => [
                        'type'          =>  'date',
                        'label'         => 'Fim da inscrição',
                        'placeholder'   => 'Fim da inscrição',
                        'required'      => 'required',
                    ],
                    'hora_fim_inscricao' => [
                        'type'          => 'time',
                        'label'         => 'Hora fim da inscrição',
                        'placeholder'   => 'Hora fim da inscrição',
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
        return $this->nome;
    }

    public static function  eventoPadrao(){

        return session()->get('evento_id');
    }

}
