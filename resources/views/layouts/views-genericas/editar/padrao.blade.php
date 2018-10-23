<?php /** @var  $entity \Illuminate\Database\Eloquent\Model */?>

@extends('layouts.app')

@section('content')
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Editar {{$model::$verbose_name}}
                            <small>
                                alterar  {{$model::$verbose_name}}
                            </small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                @include('layouts.partial.message')

                @include('layouts.components.form.editar', ['model' => $model, 'entity' => $entity])
            </div>
        </div>
    </div>
@endsection
