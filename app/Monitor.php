<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Monitor extends AbstractModel implements DefaultModel
{

    protected     $table            = 'monitor';
    public static $base_name_route  = 'monitor';
    public static $verbose_name     = 'monitor';
    public static $verbose_plural   = 'locais';
    public static $verbose_genre    = 'M';
    public static $controller       = 'MonitorController';
    

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

        $query =  DB::table('monitor')
           ->select([
                'monitor.id as id',
                'monitor.descricao as descricao',
                DB::raw('DATE_FORMAT(monitor.created_at,"%d/%m/%Y %H:%i:%s") as created_at'),
                DB::raw('DATE_FORMAT(monitor.updated_at,"%d/%m/%Y %H:%i:%s") as updated_at'),
            ]);

        if(isset($request_query['descricao'])){
            if(!empty($request_query['descricao'])){
                $query->where('monitor.descricao', 'like', '%'.$request_query['descricao'].'%');
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
                'field' => 'id',
                'title' => 'ID',
            ],
        ];

        return response()->json($columns);
    }

    public static function dataTablesSearchForm(){

        return  [
            'fields' =>[
                'data' => [
                    'type'          => 'text',
                    'placeholder'   => 'Descrição',
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

    public static function fieldsFormEdit(){
        return  self::fieldsFormCreate();
    }

    public function __toString()
    {
        return Carbon::parse($this->data)->format('d/m/Y'). ' '. $this->inicio;
    }

}
