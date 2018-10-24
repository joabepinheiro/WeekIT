@extends('layouts.publico')

@section('content')
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <h2 class=" text-center" style="border-bottom: 2px solid #ddd; padding-bottom: 22px;">
                    Cadastrar participante
                </h2>

                <div class="alert m-alert--default" style="font-weight: 400;" role="alert">
                    <h2 style="text-align: center; font-size: 18px; margin-top: 30px;">Leia antes de se cadastrar</h2>
                    <ol style="font-size: 14px; font-weight: 400;">
                        <li> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum varius scelerisque lacus, quis volutpat nisi dictum id.  </li>
                        <li>Nunc faucibus massa non tortor molestie, eu dictum ex lobortis. Etiam viverra, neque quis imperdiet aliquam, nisi urna cursus lacus</li>
                        <li>Sed tristique massa sit amet purus euismod fermentum. Proin ac ipsum et velit porttitor facilisis.</li>
                        <li>Morbi eu euismod est. non semper nisl ligula cursus neque. Sed sed porta turpis.</li>
                    </ol>
                </div>

                @include('layouts.partial.message')

                {!! Form::open(['method' => 'POST', 'action' => '\App\Http\Controllers\Publico\ParticipanteController@store', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state block_form_submit']) !!}

                <div class="m-form__section m-form__section--first">

                    @foreach( $model::fieldsFormCreatePublico()['fields'] as $index =>  $row)
                        <?php
                        $count = count($row);

                        if($count == 1){
                            $class_row = [
                                    'col-lg-2',
                                    'col-lg-10',
                            ];
                        }elseif($count == 2){
                            $class_row = [
                                    'col-lg-2',
                                    'col-lg-4',
                            ];
                        }elseif($count == 3){
                            $class_row = [
                                    'col-lg-2',
                                    'col-lg-2',
                            ];
                        }
                        ?>

                        <div class="form-group m-form__group row">
                            <?php
                            /** @var $value array() */
                            ?>
                            @foreach($row as $key => $value)
                                <?php
                                $class= $errors->has($key) ? "form-control m-input form-control-danger  ": 'form-control m-input ';
                                $class.= array_key_exists('class', $value) ? $value['class'] : '';
                                ?>
                                @if($value['type'] == 'form__heading')
                                    <div class="m-form__heading">
                                        <h3 class="m-form__heading-title">
                                            {{ $value['label'] }}
                                        </h3>
                                    </div>
                                    @continue
                                @else
                                    <label for="example-text-input" class="{{$class_row[0]}} col-form-label">
                                        {{$value['label'] ?? ''}}
                                    </label>
                                    <div class="{{$class_row[1]}} {{ $errors->has($key) ? 'has-danger' : '' }}">

                                        @if($value['type'] == 'date')
                                            {{ Form::date($key, old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? '', 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                        @elseif($value['type'] == 'text')
                                            {{ Form::text($key, old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? '', 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                        @elseif($value['type'] == 'number')
                                            {{ Form::number($key, old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? '', 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                        @elseif($value['type'] == 'select')
                                            {{ Form::select($key, $value['options'], old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? '', 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                        @elseif($value['type'] == 'email')
                                            {{ Form::email($key, old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? '', 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                        @elseif($value['type'] == 'time')
                                            <input type="time" name="{{$key}}" class="{{ $class}}" id="{{$value['id'] ?? ''}}" placeholder="{{$value['placeholder'] ?? '' }}" {{$value['attr'] ?? ''}}  {{$value['required'] ?? '' }}>@elseif($value['type'] == 'time')
                                        @elseif($value['type'] == 'datetime-local')
                                            <input type="datetime-local"  class="{{ $class}}" name="{{$key}}" id="{{$value['id'] ?? ''}}" {{$value['attr'] ?? ''}}  {{$value['required'] ?? '' }}/>
                                        @elseif($value['type'] == 'password')
                                            {{ Form::password($key, ['name' => $key,'class' => $class, 'id' => $value['id'] ?? '', 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                        @elseif($value['type'] == 'textarea')
                                            <textarea name="{{$key}}" class="{{$class}}" id="{{ $value['id'] ?? ''}}" placeholder="{{$value['placeholder'] ?? ''}}" {{$value['required'] ?? ''}} {{$value['attr'] ?? ''}}></textarea>
                                        @endif
                                        @if(isset($value['description']))
                                            <span class="m-form__help">
                                                {{$value['description']}}
                                            </span>
                                        @endif
                                        @endif
                                        @if($errors->has($key))
                                            <div class="form-control-feedback">
                                                {{$errors->first($key)}}
                                            </div>
                                        @endif
                                    </div>
                                    @endforeach
                        </div>
                    @endforeach
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-10">
                                <button type="submit" class="btn btn-success">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                </div>


                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
