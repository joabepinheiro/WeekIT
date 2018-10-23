<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable implements DefaultModel
{
    use Notifiable;

    protected     $table            = 'participante';
    public static $base_name_route  = 'user';
    public static $verbose_name     = 'Usuário';
    public static $verbose_plural   = 'Usuários';
    public static $verbose_genre    = 'M';
    public static $controller       = 'UserController';

    //protected $hidden   = ['password', 'remember_token'];
    public $timestamps  = true;

    public function __construct(array $attributes = [])
    {
        $this->fillable = Schema::getColumnListing('participante');
        parent::__construct($attributes);
    }

    public static function insert($attributes){

        unset($attributes['_token']);
        unset($attributes['password_confirmed']);

        $attributes['password']   = Hash::make($attributes['password']);

        return self::create($attributes);
    }

    public function update(array $attributes = [], array $options = []){

        unset($attributes['_token']);
        unset($attributes['password_confirmed']);

        if(empty($attributes['password'])){
            unset($attributes['password']);
        }else{
            $attributes['password']   = Hash::make($attributes['password']);
        }

        return parent::update($attributes);
    }



    public function papel()
    {
        return $this->hasOne('App\Roles', 'roles_id', 'id');
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
        $excluded           = $request->input('excluded',  NULL);
        
        $query =  DB::table('participante')
            ->select([
                'participante.id as id',
                'participante.name as name',
                'participante.email as email',
                'roles.nome as roles_nome',
                'participante.telefone1 as telefone1',
                'participante.telefone2 as telefone2',
                DB::raw('DATE_FORMAT(participante.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(participante.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

        $query->join('roles', 'roles.id', '=', 'participante.roles_id');

        if(isset($request_query['name'])){
            if(!empty($request_query['name'])){
                $query->where('participante.name', 'like', '%'.$request_query['name'].'%');
            }
        }

        if(isset($request_query['email'])){
            if(!empty($request_query['email'])){
                $query->where('participante.email', 'like',  '%'.$request_query['email'].'%');
            }
        }

        if(is_null($excluded)){
            $query->whereNull('participante.deleted_at');
        }

        if(isset($sort)){
            $query->orderBy($sort['field'],$sort['sort']);
        }

        if(is_null($excluded)){
            $query->whereNull('participante.deleted_at');
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
                'field' => 'name',
                'title' => 'Nome',
            ],
            [
                'field' => 'email',
                'title' => 'Email',
                'width' => 270
            ],
            [
                'field' => 'roles_nome',
                'title' => 'Tipo de usuário',
                'width' => 270
            ],
            [
                'field' => 'created_at',
                'title' => 'Criado em',
            ],

        ];

        return response()->json($columns);
    }

    /**
     * Retorna os campos usados na geração do formulário de busca na tela de listagem dos registros
     * @return array
     */
    public static function dataTablesSearchForm(){

        return  [
            'fields' =>[
                'name' => [
                    'type'          => 'text',
                    'placeholder'  => 'Nome',
                ],
                'email' => [
                    'type'          => 'text',
                    'placeholder'  => 'Email',
                ],
            ]
        ];
    }

    /**
     * Retorna um array com os campos utilizados para geração do formulário de cadastro dos registros
     *
     * @return array
     */
    public static function fieldsFormCreate(){

        return  [
            'fields' => [
                [
                    'label_dados_pessoais' => [
                        'type'          => 'form__heading',
                        'label'         => '1. Dados pessoais',
                    ],

                ],
                [
                    'name' => [
                        'type'          => 'text',
                        'label'         => 'Nome *',
                        'placeholder'   => 'Nome',
                    ],
                ],
                [
                    'telefone1' => [
                        'type'          => 'text',
                        'label'         => 'Telefone 1 *',
                        'placeholder'   => 'Telefone 1',
                        'class'         => 'telefone_inputmask',
                    ],

                    'telefone2' => [
                        'type'          => 'text',
                        'label'         => 'Telefone 2 *',
                        'placeholder'   => 'Telefone 2',
                        'class'         => 'telefone_inputmask',
                    ],
                ],
                [
                    'roles_id' => [
                        'type'          => 'select',
                        'label'         => 'Tipo de usuário',
                        'placeholder'   => 'Tipo de usuário',
                        'options'       => Role::pluck('nome', 'id'),
                        'required'      => 'required',
                    ],
                ],
                [
                    'email' => [
                        'type'          => 'email',
                        'label'         => 'Email ',
                        'placeholder'   => 'Email',
                    ],
                ],
                [
                    'password' => [
                        'type'          => 'password',
                        'label'         => 'Senha  ',
                        'placeholder'   => 'Senha',
                        'required'      => 'required',
                        'min'           => 6
                    ],
                ],
                [
                    'password_confirmed' => [
                        'type'          => 'password',
                        'label'         => 'Confirmar senha ',
                        'placeholder'   => 'Confirmar senha',
                        'required'      => 'required',
                        'min'           => 6
                    ],
                ],
            ]

        ];
    }


    /**
     * Retorna um array com os campos utilizados para geração do formulário de edição dos registros
     *
     * @return array
     */
    public static function fieldsFormEdit(){

        return  [
            'fields' => [
                [
                    'label_dados_pessoais' => [
                        'type'          => 'form__heading',
                        'label'         => '1. Dados pessoais',
                    ],

                ],
                [
                    'name' => [
                        'type'          => 'text',
                        'label'         => 'Nome *',
                        'placeholder'   => 'Nome',
                    ],
                ],
                [
                    'telefone1' => [
                        'type'          => 'text',
                        'label'         => 'Telefone 1 *',
                        'placeholder'   => 'Telefone 1',
                        'class'         => '',
                    ],

                    'telefone2' => [
                        'type'          => 'text',
                        'label'         => 'Telefone 2 *',
                        'placeholder'   => 'Telefone 2',
                        'class'         => '',
                    ],
                ],
                [
                    'roles_id' => [
                        'type'          => 'select',
                        'label'         => 'Tipo de usuário',
                        'placeholder'   => 'Tipo de usuário',
                        'options'       => Role::pluck('nome', 'id'),
                        'required'      => 'required'

                    ],
                ],
                [
                    'email' => [
                        'type'          => 'email',
                        'label'         => 'Email ',
                        'placeholder'   => 'Email',
                    ],
                ],
                [
                    'password' => [
                        'type'          => 'password',
                        'label'         => 'Senha * ',
                        'placeholder'   => 'Senha',
                        'description'   => 'Deixe esse campo em branco para manter a senha atual'
                    ],
                ],
                [
                    'password_confirmed' => [
                        'type'          => 'password',
                        'label'         => 'Confirmar senha *',
                        'placeholder'   => 'Confirmar senha',

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

    public function role()
    {
        return $this->belongsTo('App\Role', 'roles_id');
    }

    public static function destroy($ids)
    {
        return parent::destroy($ids); // TODO: Change the autogenerated stub
    }

    public function __toString()
    {
        return $this->email;
    }

}
