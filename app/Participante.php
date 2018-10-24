<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Participante extends AbstractModel implements DefaultModel
{

    protected     $table            = 'participante';
    public static $base_name_route  = 'participante';
    public static $verbose_name     = 'participante';
    public static $verbose_plural   = 'Participantes';
    public static $verbose_genre    = 'M';
    public static $controller       = 'ParticipanteController';


    public static function insert($attributes){
        unset($attributes['password_confirmed']);
        $attributes['password'] = bcrypt($attributes['password']);
       return parent::insert($attributes);
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
                'participante.nome as nome',
                'participante.cpf as cpf',
                'participante.instituicao as instituicao',
                'participante.sexo as sexo',
                'participante.telefone1 as telefone1',
                'participante.telefone2 as telefone2',
                'participante.campus as campus',
                'participante.curso as curso',
                'participante.email as email',
                DB::raw('DATE_FORMAT(participante.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(participante.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

        if(isset($request_query['cpf'])){
            if(!empty($request_query['cpf'])){
                $query->where('participante.cpf', '=', $request_query['cpf']);
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
                'field' => 'nome',
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
                'cpf' => [
                    'type'          => 'text',
                    'class'          => 'cpf_inputmask',
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
                    'nascimento' => [
                        'type'          => 'date',
                        'label'         => 'Nascimento',
                        'placeholder'   => 'Nascimento',
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
                ],
                [
                    'password' => [
                        'type'          => 'password',
                        'label'         => 'Senha',
                        'placeholder'   => 'Senha',
                    ],
                    'password_confirmation' => [
                        'type'          => 'password',
                        'label'         => 'Confirmar Senha',
                        'placeholder'   => 'Confirmar Senha',
                     ],
                ],
                [
                    'roles_id' => [
                        'type'          => 'select',
                        'label'         => 'Tipo',
                        'placeholder'   => 'Tipo',
                        'options' => \App\Role::pluck('nome', 'id'),
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
                    'nascimento' => [
                        'type'          => 'date',
                        'label'         => 'Nascimento',
                        'placeholder'   => 'Nascimento',
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
                ],
                [
                    'password' => [
                        'type'          => 'password',
                        'label'         => 'Senha',
                        'placeholder'   => 'Senha',
                    ],
                    'password_confirmation' => [
                        'type'          => 'password',
                        'label'         => 'Confirmar Senha',
                        'placeholder'   => 'Confirmar Senha',
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

    public static function enviarEmailRecuperacao($email){

            $participante = \App\Participante::where('email', $email)->first();
            $participante->remember_token = bcrypt(rand(12, 6).$email);
            $participante->save();

            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'user@example.com';                 // SMTP username
                $mail->Password = 'secret';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom($email, $participante->nome);
                //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }

    }

    public function __toString()
    {
        return $this->nome;
    }

}
