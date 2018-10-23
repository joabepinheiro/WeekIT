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
    <script type="text/javascript">

    var DatatableRemoteAjax = function() {

        
        var demo = function() {

            var columns = [
             {
                    "field":"id",
                    "title":"id",
                },
            {
                    "field":"tipo",
                    "title":"Tipo",
                    template: function(row){
                        if(row.tipo == 'insert'){
                            return '<span class="m-badge m-badge--success m-badge--wide">CADASTRADO</span>';
                        }

                        if(row.tipo == 'update'){
                            return '<span class="m-badge m-badge--primary m-badge--wide">ATUALIZADO</span>';
                        }


                        if(row.tipo == 'delete'){
                            return '<span class="m-badge m-badge--danger m-badge--wide">EXCLUIDO</span>';
                        }

                   }
                },
                 {
                    "field":"tabela",
                    "title":"Tabela",
                },
                {
                    "field":"novo",
                    "title":"Novo",
                    template: function(row){
                        if(row.novo == null){
                            return '';
                        }
                        return '<textarea>'+row.novo+'</textarea>'               
                    }
                },
                  {
                    "field":"antigo",
                    "title":"Antigo",
                    template: function(row){
                        if(row.antigo == null){
                            return '';
                        }
                        return '<textarea>'+row.antigo+'</textarea>'                   
                    }
                },
                {
                    "field":"ip",
                    "title":"ip",
                }, {
                    "field":"user_agent",
                    "title":"User agent",
                },
                {
                    "field":"cadastrado_por",
                    "title":"Cadastrado por",
                },
                {
                    "field":"created_at",
                    "title":"Cadastrado em",
                },
                {
                    "field":"updated_at",
                    "title":"Atualizado em",
                    template: function(row){
                        if(row.updated_at == row.created_at){
                            return '';
                        }

                       return row.row.updated_at;

                   }
                },
            ];
            
            var datatable = $('.m_datatable').mDatatable({
                // datasource
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            // sample GET method
                            method: 'GET',
                            url: '/log/search',
                            map: function(raw) {
                                // sample data mapping
                                var dataSet = raw;
                                if (typeof raw.data !== 'undefined') {
                                    dataSet = raw.data;
                                }
                                return dataSet;
                            }
                        }
                    },
                    pageSize: 10,
                    saveState: {
                        cookie: false,
                        webstorage: false
                    },
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true,
                },

                // column sorting
                sortable: true,
                pagination: true,
                toolbar: {
                    // toolbar items
                    items: {
                        info: true,
                        // pagination
                        pagination: {
                            navigation: {
                                prev: true,
                                next: true,
                                first: true,
                                last: true
                            },
                            // page size select
                            pageSizeSelect: [10, 20, 30, 50, 100, 200, 300],
                        }
                    }
                },

                rows: {
                    // auto hide columns, if rows overflow
                    autoHide: false,
                },

                // columns definition
                columns: columns
            });

            var query = datatable.getDataSourceQuery();
            var $_search_field = $(".search_field");

            $_search_field.each(function( index ) {
                $('#'+$(this).attr('id')).on('change', function (){
                    datatable.setDataSourceParam('query['+$(this).attr('name')+']', $(this).val());
                    datatable.load();
                });
            });

            $('.btn-buscar').on('click', function () {
                $_search_field.each(function( index ) {

                    if($(this).val().length < 0 ){
                        datatable.setDataSourceParam('query['+$(this).attr('name')+']', $(this).val());
                    }
                });
                datatable.load();
            });
        };

        return {
            // public functions
            init: function() {
                demo();
            }
        };
    }();

    jQuery(document).ready(function() {
        DatatableRemoteAjax.init();
    });
</script>
@endsection