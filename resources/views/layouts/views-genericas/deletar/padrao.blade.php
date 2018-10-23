@extends('layouts.app')

@section('content')
    <div class="m-content " >
        <div class="m-portlet m-portlet--mobile">
        	<div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Deletar registro
                            <small>
                                excluir registro permanetemente
                            </small>
                        </h3>
                    </div>
                </div>                
            </div>
            <div class="m-portlet__body">
                @include('layouts.components.form.deletar', ['model' => $model])
            </div>
        </div>
    </div>
@endsection
