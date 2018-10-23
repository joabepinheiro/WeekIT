@extends('layouts.app')

@section('content')

    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ucfirst($model::$verbose_plural)}}
                            <small>
                                lista {{$model::$verbose_genre == 'M' ? 'dos' : 'das'}} {{$model::$verbose_plural}} {{$model::$verbose_genre == 'M' ? 'cadastrados' : 'cadastradas'}}
                            </small>
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                            <a href="{{route($model::$base_name_route.'.create')}}" class="btn btn-sm btn-success m-btn--wide">
                                <span>
                                   <i class="la la-plus"></i>
                                    <span>
                                       Cadastrar {{$model::$verbose_name}}
                                    </span>
                                </span>
                            </a>
                        </div>
                    </li>

                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">

                @include('layouts.partial.message')

                @include('layouts.components.form.form-search',$model::dataTablesSearchForm())
                <div class="m_datatable" id="json_data"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('layouts.components.datatable.scripts', ['model' => $model])
@endsection