<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipanteRequest;

class UserController extends AbstractController
{
    /**
     * @var $model \App\User
     */
    protected $model            = '\App\User';
    protected $base_name_route  = 'user';

    /**
     * @param ParticipanteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ParticipanteRequest $request)
    {
        $entity = $this->model::insert($request->all());
        $route = redirect()->route($this->base_name_route.'.create');

        if(!is_null($entity)){
            return $route->with('success', $entity. ' cadastrado com sucesso');
        }

        return $route->with('error', 'Ops algo deu errado');
    }

    /**
     * @param ParticipanteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ParticipanteRequest $request)
    {
        $entity = $this->model::find($request->input('id'));
        $route  = redirect()->route($this->base_name_route.'.edit', ['id' => $request->input('id')] );

        if($entity->update($request->all()))
            return $route->with('success', $entity.'  atualizado com sucesso');

        return $route->with('warning', 'Ops, algo deu errado');
    }
}
