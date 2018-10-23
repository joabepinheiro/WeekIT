@extends('layouts.app')

@section('content')
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Detalhes do {{ucfirst($model::$verbose_name)}}
                            <small>
                                informaçoes detalhadas  {{$model::$verbose_genre == 'M' ? 'do' : 'da'}} {{strtolower($model::$verbose_name)}}
                            </small>
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                            <a href="{{route($model::$base_name_route.'.edit', ['id' => $entity->id])}}" class="btn btn-primary m-btn--wide">
                                <span>
                                   <i class="la la-edit"></i>
                                    <span>
                                       Editar {{strtolower($model::$verbose_name)}}
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

                <table class="table m-table m-table--head-bg-success table-striped">
                    <thead>
                                <tr>
                                    <th>Campo</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                    <tbody>
                
                    @foreach($entity->getAttributes() as $key => $value)
                        <tr>
                            <td><b>{{strtoupper(str_replace('_', ' ', $key))}}</b></td>
                            <td>{{html_entity_decode($value)}}</td>
                        </tr>
                    @endforeach
                     </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
