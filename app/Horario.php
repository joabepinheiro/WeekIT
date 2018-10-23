<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Horario extends AbstractModel implements DefaultModel
{

    protected     $table            = 'horarios';
    public static $base_name_route  = 'horario';
    public static $verbose_name     = 'horário';
    public static $verbose_plural   = 'horários';
    public static $verbose_genre    = 'M';
    public static $controller       = 'HorarioController';
    
    
    public static function insert($attributes){
        
        unset($attributes['_token']);
        
        $dias_da_semana_excluidos = array('7', '6');


        
        $hora_inicio   = new \DateTime($attributes['inicio']);
        $hora_fim  = new \DateTime($attributes['fim']);
        $hora_fim->modify('-19 minutes');

        $begin = new \DateTime($attributes['data_inicio'] . ' '. $hora_inicio->format("H:i"));
        $end   = new \DateTime($attributes['data_fim'] . ' '. $hora_fim->format("H:i"));

        $array = array();

        $feriados = array(
            "01-01",
            "05-03",
            "30-03",
            "21-04",
            "01-05",
            "20-06",
            "24-06",
            "08-07",
            "11-08",
            "15-08",
            "07-09",
            "11-10",
            "12-10",
            "13-10",
            "14-10",
            "15-10",
            "16-10",
            "15-10",
            "02-11",
            "09-11",
            "16-11",
            "15-11",
            "08-12",
            "25-12",
        );

        for($i = $begin; $i <= $end; $i){
  
            if(in_array($i->format("d-m"), $feriados)){
                $i->modify('+20 minutes');        
                continue;
            }

            if(in_array($i->format('N'), $dias_da_semana_excluidos)){
                $i->modify('+20 minutes');        
                continue;
            }

            if((($i->format("H:i") >= '10:41') && ($i->format("H:i") <= '12:59'))){
                $i->modify('+20 minutes');        
                continue;
            }

            // 7:30 - 11:00
            // 13:00 - 16:30
            if((($i->format("H:i") >= $hora_inicio->format("H:i")) &&($i->format("H:i") < $hora_fim->format("H:i")))){
                //Remove os dias da semana (SEG a SEX) que não devem ter horários
                $final =  clone  $i;
                $final->modify('+20 minutes');
         
                $entity =  self::create([
                    'data'   => $i->format("Y-m-d"),
                    'inicio' => $i->format("H:i"),
                    'fim'    => $final->format("H:i")
                ]);

                if(!is_null($entity)){
                    Log::insert([
                        'antigo'          => null,
                        'novo'            => json_encode($entity),
                        'tipo'            => 'insert',
                        'tabela'          => $entity->getTable(),
                        'pk_tabela'       => $entity->id,
                        'cadastrado_por'  =>  Auth::user()->id
                    ]); 
                }
            }  

             $i->modify('+20 minutes');        

              
        }
     
        return true;
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

        $query =  DB::table('horarios')
           ->select([
                'horarios.id as id',
                'horarios.data as data',
                'horarios.inicio as inicio',
                'horarios.fim as fim',
                'agenda.id as agenda_id',
                'agenda.nome_do_responsavel as agenda_nome_responsavel',
                DB::raw('CONCAT(horarios.data, "-", horarios.inicio) AS data_completa'),
                DB::raw('DATE_FORMAT(horarios.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(horarios.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

           $query->leftJoin('agenda', 'agenda.horarios_id', '=', 'horarios.id');

        if(isset($request_query['horarios_disponiveis'])){
            if(!empty($request_query['horarios_disponiveis'])){
                $agendas =  DB::table('agenda')
                    ->select([
                        'horarios_id',
                    ]);

            $query->whereNotIn('horarios.id', $agendas->get()->pluck('horarios_id')->toArray());

            }
        }

        //Não exibir os horários já passados

       
        $query->where('horarios.data', '>=', date('Y-m-d'));


        if(isset($request_query['data'])){

            $data = $request_query['data'];

            if(count(explode("/",$data)) > 1){
                $data =  implode("-",array_reverse(explode("/",$data)));
            }

            if(!empty($request_query['data'])){
                $query->where('horarios.data', '=', $data);
            }
        }

        if(isset($request_query['inicio'])){
            if(!empty($request_query['inicio'])){
                $query->where('horarios.inicio', '=', $request_query['inicio']);
            }
        }


        if(isset($sort)){
            $query->orderBy($sort['field'],$sort['sort']);
        }else{
             $query->orderBy('data', 'asc');
             $query->orderBy('inicio', 'asc');
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function agenda(Request $request){

        $request_query      = $request->input('query');
        $page               = $request->input('pagination.page', 1);
        $perpage            = $request->input('pagination.perpage', 10000);
        $columns            = $request->input('columns',  ['*']);
        $sort               = $request->input('sort',  NULL);
        $excluded           = $request->input('excluded',  NULL);

        $query =  DB::table('horarios')
           ->select([
                'horarios.id as id',
                'horarios.data as title',
                DB::raw('CONCAT(horarios.data, "T", horarios.inicio) AS start'),
                DB::raw('CONCAT(horarios.data, "T", horarios.fim) AS end'),
                DB::raw('DATE_FORMAT(horarios.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(horarios.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

        return response()->json($query->get());
    }

    /**
     * Colunas a serem exibidas na tabela que lista os registros
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function dataTablesColumns(){

        $columns = [
           [
                'field' => 'data_completa',
                'title' => 'Horários',
            ],
        ];

        return response()->json($columns);
    }

    public static function dataTablesSearchForm(){

        return  [
            'fields' =>[
                'data' => [
                    'type'          => 'text',
                    'placeholder'   => 'Data',
                    'class'         => 'data_1'
                ],
                'inicio' => [
                    'type'          => 'text',
                    'placeholder'   => 'Horário',
                    'class'         => 'time_inputmask'
                ],
                
            ]
        ];
    }

    public static function fieldsFormCreate(){

        return  [
            'fields' =>[
                [
                    'data_inicio' => [
                        'type'          => 'date',
                        'label'         => 'Data início',
                        'placeholder'   => 'Data início',
                        'required'      => 'required',
                    ],
                    
                    'data_fim' => [
                        'type'          => 'date',
                        'label'         => 'Data fim',
                        'placeholder'   => 'Data fim',
                        'required'      => 'required',
                    ],
                ],   
                [
                    'inicio' => [
                        'type'          => 'text',
                        'label'         => 'Início',
                        'placeholder'   => 'Início',
                        'class'         => 'time_inputmask',
                        'required'      => 'required',
                    ],
                    
                    'fim' => [
                        'type'          => 'text',
                        'label'         => 'Fim',
                        'placeholder'   => 'Fim',
                        'class'         => 'time_inputmask',
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


    public static function horarios_disponiveis($input = null, $incluir_dia_vigente = false)
    {

      
        $query =  DB::table('horarios')
           ->select([
                'horarios.id as id',
                'horarios.data as data',
                'horarios.inicio as inicio',
                'horarios.fim as fim',
                DB::raw('DATE_FORMAT(horarios.inicio,"%H:%i") as inicio'),
                DB::raw('DATE_FORMAT(horarios.fim,"%H:%i") as fim'),
                DB::raw('CONCAT(horarios.data, "-", horarios.inicio) AS data_completa'),
                DB::raw('DATE_FORMAT(horarios.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(horarios.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

    

       if(!$incluir_dia_vigente){
            $query->where('horarios.data','>=', date('Y-m-d'));
       }
       //$query->where('horarios.fim','>', date('H:i:s'));

        $agendas =  DB::table('agenda')
           ->select([
                'horarios_id',
            ]);

        $data  = $input['data'];

       if(!is_null($data)){
            if(isset($data)){

                if(count(explode("/",$data)) > 1){
                    $data =  implode("-",array_reverse(explode("/",$data)));
                }

                $query->where('horarios.data', '=', $data); 
            }
       }

        $query->whereNotIn('horarios.id', $agendas->get()->pluck('horarios_id')->toArray());
        return $query->get();
    }
    
    public static function horarios_disponiveis_hoje()
    {
        $query =  DB::table('horarios')
           ->select([
                'horarios.id as id',
                'horarios.data as data',
                'horarios.inicio as inicio',
                'horarios.fim as fim',
                DB::raw('CONCAT(horarios.data, "-", horarios.inicio) AS data_completa'),
                DB::raw('DATE_FORMAT(horarios.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(horarios.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);
        $query->where('horarios.data', '=', date('Y-m-d'));

        $agendas =  DB::table('agenda')
           ->select([
                'horarios_id',
            ]);

        $query->whereNotIn('horarios.id', $agendas->get()->pluck('horarios_id')->toArray());
        return $query->get();
    }

    public function estaDisponivel()
    {
        dd(DB::table('agenda')->where('horarios_id', $this->id)); 
    }

    public static function fieldsFormEdit(){

        return  self::fieldsFormCreate();

    }

    public function agenda_bt()
    {
        return Agenda::where('horarios_id', '=', $this->horarios_id)->get();
    }



    public function __toString()
    {
        return Carbon::parse($this->data)->format('d/m/Y'). ' '. $this->inicio;
    }

}
