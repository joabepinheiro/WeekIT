<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonitorRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitorController extends AbstractController
{
    /**
     * @var $model \App\Monitor
     */
    protected $model            = '\App\Monitor';
    protected $base_name_route  = 'monitor';

    /**
     * @param MonitorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MonitorRequest $request)
    {
        $input = $request->all();
        $ip = $request->ip();
        $user_agent = $request->server('HTTP_USER_AGENT');

        $entity = $this->model::insert($input, $ip, $user_agent);


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
    public function update(MonitorRequest $request)
    {
        $entity = $this->model::find($request->input('id'));
        $route  = redirect()->route($this->model::$base_name_route.'.edit', ['id' => $request->input('id')] );

        if($entity->update($request->all()))
            return $route->with('success', $entity.'  atualizado com sucesso');

        return $route->with('warning', 'Ops, algo deu errado');
    }
}
