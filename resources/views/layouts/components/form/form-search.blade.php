<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30 form-search">
    <div class="row align-items-center">
        <div class="col-xl-10 order-2 order-xl-1">
            <div class="row">

                    @foreach($fields as $key => $value)
                        <?php
                            $class = 'form-control search_field  ';
                            $class.= $value['class'] ?? '';
                        ?>
                        <div class="m-form__group m-form__group--inline">
                            <div class="m-form__control p-2">
                                @if($value['type'] == 'text')
                                    {{ Form::text($key, old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? 'm_form_'.$key, 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                @elseif($value['type'] == 'number')
                                    {{ Form::number($key, old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? 'm_form_'.$key, 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                @elseif($value['type'] == 'select')
                                    {{ Form::select($key, $value['options'], old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? 'm_form_'.$key, 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                @elseif($value['type'] == 'email')
                                    {{ Form::email($key, old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? 'm_form_'.$key, 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                @elseif($value['type'] == 'password')
                                    {{ Form::password($key, ['name' => $key,'class' => $class, 'id' => $value['id'] ?? 'm_form_'.$key, 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                              @elseif($value['type'] == 'date')
                                   {{ Form::date($key, old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? 'm_form_'.$key, 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}
                                @elseif($value['type'] == 'textarea')
                                    <textarea name="{{$key}}" class="{{$class}}" id="{{ $value['id'] ?? 'm_form_'.$key}}" placeholder="{{$value['placeholder'] ?? ''}}" {{$value['required'] ?? ''}} {{$value['attr'] ?? ''}}></textarea>
                                @endif
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
        <div class="col-xl-2 order-1 order-xl-2 m--align-right">
            <button  class="btn btn-info btn-buscar" id="btn-buscar">
                <span>
                    <i class="la la-search"></i>
                    <span>
                        Buscar
                    </span>
                </span>
            </button>
            <div class="m-separator m-separator--dashed d-xl-none"></div>
        </div>
    </div>
</div>