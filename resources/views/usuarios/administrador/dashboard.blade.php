@extends('layouts.app')

@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">
                        <li class="m-widget28__nav-item nav-item" title="Listar todas as agendas marcadas para hoje">
                            <div class="nav-link bg-success text-white p-4" data-toggle="pill">
                                <div>
                                    <h3>{{\App\Inscricao::all()->count()}}</h3>
                                </div>
                                <div>
                                    <span>Total de inscritos</span>
                                </div>

                            </div>
                        </li>
                        <li class="m-widget28__nav-item nav-item" title="Listar todas as agendas cadastradas">
                            <div class="nav-link bg-info text-white p-4" data-toggle="pill">
                                <div>
                                    <h3>{{\App\Participante::all()->count()}}</h3>
                                </div>
                                <div>
                                    <span>Total de participantes</span>
                                </div>

                            </div>
                        </li>
                        <li class="m-widget28__nav-item nav-item" title="Listar horários disponíveis para agendamento hoje">
                            <div class="nav-link bg-danger text-white p-4" data-toggle="pill">
                                <div>
                                    <h3>{{\App\Atividade::all()->count()}}</h3>
                                </div>
                                <div>
                                    <span>Total de atividades</span>
                                </div>

                            </div>
                        </li>

                        <li class="m-widget28__nav-item nav-item" title="Listar horários disponíveis para agendamento">
                            <div class="nav-link bg-warning text-white p-4" data-toggle="pill">
                                <div>
                                    <h3>{{\App\Inscricao::where('status', 'pago')->get()->count()}}</h3>
                                </div>
                                <div>
                                    <span>Inscrições pagas</span>
                                </div>

                            </div>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>


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