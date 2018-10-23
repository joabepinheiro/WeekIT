<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipanteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends AbstractController
{
    /**
     * @var $model \App\User
     */
    protected $model            = '\App\Log';
    protected $base_name_route  = 'log';

    public function index()
    {

        return view('log.index', ['model' => $this->model]);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $entity = $this->model::insert($request->all());
        $route = redirect()->route($this->base_name_route.'.index');

        if(!is_null($entity)){
            return $route->with('success', $entity->razao_social. ' cadastrado com sucesso');
        }

        return $route->with('error', 'Ops algo deu errado');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $entity = $this->model::find($request->input('id'));
        $route  = redirect()->route($this->base_name_route.'.edit', ['id' => $request->input('id')] );

        if($entity->update($request->all()))
            return $route->with('success', $entity.'  atualizado com sucesso');

        return $route->with('warning', 'Ops, algo deu errado');
    }

    
}
