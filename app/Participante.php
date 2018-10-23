<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Participante extends AbstractModel implements DefaultModel
{

    protected     $table            = 'participante';
    public static $base_name_route  = 'participante';
    public static $verbose_name     = 'participante';
    public static $verbose_plural   = 'locais';
    public static $verbose_genre    = 'M';
    public static $controller       = 'ParticipanteController';
    

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

        $query =  DB::table('participante')
           ->select([
                'participante.id as id',
                'participante.nome as nome',
                'participante.cpf as cpf',
                'participante.instituicao as instituicao',
                'participante.sexo as sexo',
                'participante.telefone1 as telefone1',
                'participante.telefone2 as telefone2',
                'participante.campus as campus',
                'participante.curso as curso',
                'participante.tipo as tipo',
                'participante.email as email',
                DB::raw('DATE_FORMAT(participante.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(participante.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

        if(isset($request_query['cpf'])){
            if(!empty($request_query['cpf'])){
                $query->where('participante.cpf', 'like', '%'.$request_query['cpf'].'%');
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
                'field' => 'cpf',
                'title' => 'CPF',
            ],
            [
                'field' => 'nome_completo',
                'title' => 'Nome',
            ],
            [
                'field' => 'email',
                'title' => 'Email',
            ],

        ];

        return response()->json($columns);
    }

    public static function dataTablesSearchForm(){

        return  [
            'fields' =>[
                'data' => [
                    'type'          => 'text',
                    'placeholder'   => 'CPF',
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

                ],   
                [
                    'cpf' => [
                        'type'          => 'text',
                        'label'         => 'CPF',
                        'placeholder'   => 'CPF',
                        'class'         => 'cpf_inputmask',
                        'required'      => 'required',
                    ],
                    
                    'sexo' => [
                        'type'          => 'select',
                        'label'         => 'Sexo',
                        'placeholder'   => 'Sexo',
                        'options' => [
                            'masculino',
                            'feminino'
                        ],
                        'required'      => 'required',
                    ],
                ],
                [
                    'telefone1' => [
                        'type'          => 'text',
                        'label'         => 'Telefone 1',
                        'placeholder'   => 'Telefone 1',
                        'required'      => 'required',
                    ],

                    'telefone2' => [
                        'type'          => 'text',
                        'label'         => 'Telefone 2',
                        'placeholder'   => 'Telefone 2',
                    ],
                ],

                [
                    'instituicao' => [
                        'type'          => 'text',
                        'label'         => 'Instituição',
                        'placeholder'   => 'Instituição',
                    ],

                    'campus' => [
                        'type'          => 'text',
                        'label'         => 'Campus',
                        'placeholder'   => 'Campus',
                    ],
                ],

                [
                    'curso' => [
                        'type'          => 'text',
                        'label'         => 'Curso',
                        'placeholder'   => 'Curso',
                    ],
                ],

                [
                    'email' => [
                        'type'          => 'text',
                        'label'         => 'Email',
                        'placeholder'   => 'Email',
                    ],

                    'senha' => [
                        'type'          => 'password',
                        'label'         => 'Senha',
                        'placeholder'   => 'Senha',
                    ],
                ],

                [
                    'tipo' => [
                        'type'          => 'select',
                        'label'         => 'Tipo',
                        'placeholder'   => 'Tipo',
                        'options' => [
                            'aluno',
                            'professor',
                            'coordenador',
                            'monitor'
                        ],
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

    public static function fieldsFormCreatePublico(){

        return  [
            'fields' =>[
                [
                    'nome' => [
                        'type'          => 'text',
                        'label'         => 'Nome',
                        'placeholder'   => 'Nome',
                        'required'      => 'required',
                    ],

                ],
                [
                    'cpf' => [
                        'type'          => 'text',
                        'label'         => 'CPF',
                        'placeholder'   => 'CPF',
                        'class'         => 'cpf_inputmask',
                        'required'      => 'required',
                    ],

                    'sexo' => [
                        'type'          => 'select',
                        'label'         => 'Sexo',
                        'placeholder'   => 'Sexo',
                        'options' => [
                            'masculino',
                            'feminino'
                        ],
                        'required'      => 'required',
                    ],
                ],
                [
                    'telefone1' => [
                        'type'          => 'text',
                        'label'         => 'Telefone 1',
                        'placeholder'   => 'Telefone 1',
                        'required'      => 'required',
                    ],

                    'telefone2' => [
                        'type'          => 'text',
                        'label'         => 'Telefone 2',
                        'placeholder'   => 'Telefone 2',
                    ],
                ],

                [
                    'instituicao' => [
                        'type'          => 'text',
                        'label'         => 'Instituição',
                        'placeholder'   => 'Instituição',
                    ],

                    'campus' => [
                        'type'          => 'text',
                        'label'         => 'Campus',
                        'placeholder'   => 'Campus',
                    ],
                ],

                [
                    'curso' => [
                        'type'          => 'text',
                        'label'         => 'Curso',
                        'placeholder'   => 'Curso',
                    ],
                ],

                [
                    'email' => [
                        'type'          => 'text',
                        'label'         => 'Email',
                        'placeholder'   => 'Email',
                    ],

                    'senha' => [
                        'type'          => 'password',
                        'label'         => 'Senha',
                        'placeholder'   => 'Senha',
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

}
