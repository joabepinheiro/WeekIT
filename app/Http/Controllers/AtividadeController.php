<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtividadeRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtividadeController extends AbstractController
{
    /**
     * @var $model \App\Atividade
     */
    protected $model            = '\App\Atividade';
    protected $base_name_route  = 'atividade';

    /**
     * @param AtividadeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AtividadeRequest $request)
    {
        $input = $request->all();
        $entity = $this->model::insert($input);
        $route = redirect()->route($this->base_name_route.'.show', ['id' => $entity->id]);

        if(!is_null($entity)){
            return $route->with('success', $entity. ' cadastrado com sucesso');
        }

        return $route->with('error', 'Ops algo deu errado');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
    */
    public function update(AtividadeRequest $request)
    {
        $entity = $this->model::find($request->input('id'));
        $route  = redirect()->route($this->model::$base_name_route.'.edit', ['id' => $request->input('id')] );

        if($entity->update($request->all()))
            return $route->with('success', $entity.'  atualizado com sucesso');

        return $route->with('warning', 'Ops, algo deu errado');
    }
}
