<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Inscricao extends AbstractModel implements DefaultModel
{

    protected     $table            = 'inscricao';
    public static $base_name_route  = 'inscricao';
    public static $verbose_name     = 'inscrição';
    public static $verbose_plural   = 'Inscrições';
    public static $verbose_genre    = 'F';
    public static $controller       = 'InscricaoController';
    

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

        $query =  DB::table('inscricao')
           ->select([
                'inscricao.id as id',
                'inscricao.data as data',
                'inscricao.status as status',
                'inscricao.presente as presente',
                'inscricao.participante_id as participante_id',
                'inscricao.atividade_id as atividade_id',
                'atividade.titulo as atividade_titulo',
                'participante.nome as participante_nome',
                DB::raw('DATE_FORMAT(inscricao.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(inscricao.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

        $query->join('atividade', 'atividade.id','=', 'inscricao.atividade_id');
        $query->join('evento', 'evento.id','=', 'atividade.evento_id');
        $query->join('participante', 'participante.id','=', 'inscricao.participante_id');


        $query->where('evento.id', '=', Evento::eventoPadrao());

        if(isset($request_query['descricao'])){
            if(!empty($request_query['descricao'])){
                $query->where('inscricao.descricao', 'like', '%'.$request_query['descricao'].'%');
            }
        }

        if(isset($request_query['participante_nome'])){
            if(!empty($request_query['participante_nome'])){
                $query->where('participante.nome', 'like', '%'.$request_query['participante_nome'].'%');
            }
        }

        if(isset($request_query['atividade_id'])){
            if(!empty($request_query['atividade_id'])){
                $query->where('inscricao.atividade_id', '=', $request_query['atividade_id']);
            }
        }

        if(isset($request_query['participante_id'])){
            if(!empty($request_query['participante_id'])){
                $query->where('inscricao.participante_id', '=', $request_query['participante_id']);
            }
        }

        if(isset($request_query['status'])){
            if(!empty($request_query['status'])){
                $query->where('inscricao.status', '=', $request_query['status']);
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
                'field' => 'atividade_titulo',
                'title' => 'Atividade',
            ],
            [
                'field' => 'participante_nome',
                'title' => 'Participante',
            ],
            [
                'field' => 'created_at',
                'title' => 'Data',
            ],
            [
                'field' => 'status',
                'title' => 'Status',
            ],
        ];

        return response()->json($columns);
    }

    public static function dataTablesSearchForm(){

        return  [
            'fields' =>[

                'participante_nome' => [
                    'type'          => 'text',
                    'placeholder'   => 'Participante',
                ],


                'status' => [
                    'type'          => 'select',
                    'placeholder'   => 'Status',
                    'options' => [
                        'pago' => 'pago',
                        'cancelado'=> 'cancelado',
                        'andamento'=> 'andamento',
                    ]
                ],
            ]
        ];
    }

    public static function fieldsFormCreate(){

        return  [
            'fields' =>[
                [
                    'participante_id' => [
                        'type'          => 'select',
                        'options'       => Participante::pluck('nome', 'id'),
                        'label'         => 'Participante',
                        'placeholder'   => 'Participante',
                        'required'      => 'required',
                    ],
                ],
                [
                    'atividade_id' => [
                        'type'          => 'select',
                        'options'       => Atividade::select(DB::raw('CONCAT(identificador, " - ", titulo) AS titulo'), 'id')->pluck('titulo', 'id'),
                        'label'         => 'Atividade',
                        'placeholder'   => 'Atividade',
                        'required'      => 'required',
                    ],
                    'status' => [
                        'type'          => 'select',
                        'options'       => [
                            'andamento','pago','cancelado'
                        ],
                        'label'         => 'Status',
                        'placeholder'   => 'Status',
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
        return Carbon::parse($this->data)->format('d/m/Y'). ' '. $this->inicio;
    }

}
