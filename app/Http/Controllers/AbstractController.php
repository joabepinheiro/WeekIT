<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbstractController extends Controller
{
    protected  $model = NULL;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('layouts.views-genericas.listar.padrao', ['model' => $this->model]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.views-genericas.cadastrar.padrao', ['model' => $this->model]);
    }

    public function edit($id = null)
    {

        $entity = $this->model::find($id);

        return view('layouts.views-genericas.editar.padrao', [
            'model' => $this->model,
            'entity'    => $entity
        ]);
    }

    public function search(Request $request)
    {
        return $this->model::search($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $entity = $this->model::find($id);

        return view('layouts.views-genericas.detalhes.padrao', [
            'model'     => $this->model,
            'entity'    => $entity
        ]);
    }

    public function delete($id)
    {
        $entity = $this->model::find($id);

        return view('layouts.views-genericas.deletar.padrao', [
            'model'     => $this->model,
            'entity'    => $entity
        ]);
    }

    /**
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $entity = $this->model::find($id);
        $route  = redirect()->route($this->base_name_route.'.index');


        if($this->model::destroy($id)){
            return $route->with('success', $entity. ' excluído com sucesso');
        }

        return $route->with('warning', $entity. ' não pode ser excluído');
    }


}
