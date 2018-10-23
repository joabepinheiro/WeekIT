@extends('layouts.app')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--mobile">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Últimas inscrições cadastradas
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            @include('layouts.components.form.form-search',\App\Inscricao::dataTablesSearchForm())
                            <div class="m_datatable" id="json_data"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @include('layouts.components.datatable.scripts', ['model' => \App\Inscricao::class])
@endsection