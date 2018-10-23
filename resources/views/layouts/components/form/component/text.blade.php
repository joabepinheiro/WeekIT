<label for="example-text-input" class="{{$class_row[0]}} col-form-label">
    {{$value['label']}}
</label>
<div class="{{$class_row[1]}} {{ $errors->has($key) ? 'has-danger' : '' }}">
    {{ Form::text($key, old($key), ['name' => $key,'class' => $class, 'id' => $value['id'] ?? '', 'placeholder'   => $value['placeholder'] ?? '', $value['attr'] ?? '', $value['required'] ?? '']) }}

    @if($errors->has($key))
        <div class="form-control-feedback">
            {{$errors->first($key)}}
        </div>
    @endif
</div>