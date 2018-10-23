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
                    {"field":"evento_titulo","title":"Evento"},
                    {"field":"participante_nome","title":"Participante"},
                    {
                        "field":"status",
                        "title":"Status",
                        width: 95,
                        template: function(row){

                            if(row.status == 'cancelado'){
                                return '<span class="m-badge m-badge--danger m-badge--wide" id="status-'+row.id+'" >cancelado</span>';
                            }

                            if(row.status == 'andamento'){
                                return '<span class="m-badge m-badge--warning m-badge--wide" id="status-'+row.id+'" >em andamento<span>';
                            }

                            if(row.status == 'pago'){
                                return '<span class="m-badge m-badge--success m-badge--wide" id="status-'+row.id+'" >pago</span>';
                            }



                        }
                    },
                    {
                        field: "alterar_para",
                        width: 250,
                        title: "Alterar para",
                        sortable: false,
                        overflow: 'visible',
                        template: function (row) {

                            return '<div class="btn-group m-btn-group" id="alterar-status" role="group" aria-label="..."> ' +
                                    '<button type="button" class="btn btn-sm  btn-success" onclick="alterarStatus('+row.id+',\'pago\')">Pago</button> ' +
                                    '<button type="button" class="btn btn-sm btn-danger"  onclick="alterarStatus('+row.id+', \'cancelado\')">Cancelado</button> ' +
                                    '<button type="button" class="btn btn-sm btn-warning"  onclick="alterarStatus('+row.id+', \'andamento\')">Em andamento</button> ' +
                                    '</div>';
                        }
                    },
                    {"field":"created_at","title":"Data"},
                ];




                columns.push(  {
                    field: "acoes",
                    width: 90,
                    title: "Ações",
                    sortable: false,
                    overflow: 'visible',
                    template: function (row) {
                        var url_show = '/inscricao/show/' + row.id;
                        var url_edit = '/inscricao/edit/' + row.id;
                        var url_delete = '/inscricao/delete/' + row.id;

                        return '<div class="dropdown">' +
                                '<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button> ' +
                                '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> ' +
                                '<a class="dropdown-item" href="'+url_show+'" title="Exibe detalhes do registro">Detalhes</a> ' +
                                '<a class="dropdown-item" href="'+url_edit+'" title="Altere dados desse registro">Editar</a> ' +
                                '<a class="dropdown-item" href="'+url_delete+'" title="Clique aqui para excluir esse registro">Excluir</a> ' +
                                '</div>' +
                                '</div>';
                    }
                });

                var datatable = $('.m_datatable').mDatatable({
                    // datasource
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                // sample GET method
                                method: 'GET',
                                url: '/inscricao/search',
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

        function alterarStatus(id, status){
            $.ajax({
                url: '/inscricao/alterar-status',
                type: 'GET',
                data: "id="+id+"&status="+status,
                success: function(data) {
                    $('#status-'+data.data.id).text(data.data.status);
                    $('#status-'+data.data.id).attr('class', 'm-badge m-badge--wide ' + data.data.status);
                }
            });
        }
    </script>
@endsection