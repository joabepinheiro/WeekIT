<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourceController extends AbstractController
{

    /** @var $model Resource */
    protected $model            = '\App\Resource';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resource = Resource::insert($request->all());

        if(!is_null($resource)){
            return redirect()->route('resource.index')->with('success', $resource->nome. ' cadastrado com sucesso');
        }

        return redirect()->route('resource.index')->with('error', 'Ops algo deu errado');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $entity = $this->model::find($request->input('id'));
        $route  = redirect()->route($this->model::$base_name_route.'.edit', ['id' => $request->input('id')] );

        if($entity->update($request->all()))
            return $route->with('success', $entity.'  atualizado com sucesso');

        return $route->with('warning', 'Ops, algo deu errado');
    }


}
