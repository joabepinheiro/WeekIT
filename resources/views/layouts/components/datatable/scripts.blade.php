<script type="text/javascript">

    var DatatableRemoteAjax = function() {

        var demo = function() {

            var columns = <?php echo json_encode($model::dataTablesColumns()->getData()); ?>;

            columns.push(  {
                field: "acoes",
                width: 90,
                title: "Ações",
                sortable: false,
                overflow: 'visible',
                template: function (row) {
                    var url_show = '{{route($model::$base_name_route.'.show')}}/' + row.id;
                    var url_edit = '{{route($model::$base_name_route.'.edit')}}/' + row.id;
                    var url_delete = '{{route($model::$base_name_route.'.delete')}}/' + row.id;

                return '<div class="dropdown"><button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button> <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="'+url_show+'" title="Exibe detalhes do registro">Detalhes</a> <a class="dropdown-item" href="'+url_edit+'" title="Altere dados desse registro">Editar</a> <a class="dropdown-item" href="'+url_delete+'" title="Clique aqui para excluir esse registro">Excluir</a> </div></div>';
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
                            url: '{{ url(route($model::$base_name_route.'.search')) }}',
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