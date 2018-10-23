{!! Form::open(['method' => 'DELETE', 'action' => $model::$controller.'@destroy', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state block_form_submit']) !!}

<div class="m-form__section m-form__section--first ">
        <div class="form-group m-form__group row">
            <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                <div class="m-alert__icon">
                    <i class="flaticon-danger"></i>
                </div>
                <div class="m-alert__text">
                    <strong>Atenção !</strong>
                    Você está prestes a excluir definitivamente ! <b>{{html_entity_decode($entity)}}</b>.
                </div>
                <div class="m-alert__actions" style="width: 220px;">
                    @csrf
                    <input type="hidden" name="id" value="{{$entity->id}}">
                    <button type="submit" class="btn btn-danger btn-sm m-btn  m-btn--wide" data-dismiss="alert1" aria-label="Close">Confirmar exclusão
                    </button>
                </div>
            </div>
        </div>
</div>


{!! Form::close() !!}

