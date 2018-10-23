
    @if(session()->has('success'))
    <div class="form-group m-form__group m--margin-top-10">
       <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible fade show" role="alert">
            <div class="m-alert__icon" style="padding: 4px 10px;">
                <i class="flaticon-plus" style="font-size: 1.3rem;"></i>
                <span></span>
            </div>
            <div class="m-alert__text" style="padding: 4px 20px;">
                <?php  echo html_entity_decode(session()->get('success')) ?>
            </div>
            <div class="m-alert__close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    @if(session()->has('error'))
        @if(is_array(session()->get('error')))
            @foreach(session()->get('error') as $error)
                <div class="form-group m-form__group m--margin-top-10">
                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="m-alert__icon" style="padding: 4px 10px;">
                            <i class="flaticon-exclamation-1" style="font-size: 1.3rem;"></i>
                            <span></span>
                        </div>
                        <div class="m-alert__text" style="padding: 4px 20px;">
                            <?php  echo html_entity_decode($error); ?>
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="form-group m-form__group m--margin-top-10">
                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-exclamation-1"></i>
                        <span></span>
                    </div>
                    <div class="m-alert__text">
                        {{ html_entity_decode(session()->get('error')) }}
                    </div>
                    <div class="m-alert__close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <?php  request()->session()->remove('error'); ?>
    @endif

    @if(session()->has('info'))
        @if(is_array(session()->get('info')))
            @foreach(session()->get('info') as $info)
                <div class="form-group m-form__group m--margin-top-10">
                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-info alert-dismissible fade show" role="alert">
                        <div class="m-alert__icon" style="padding: 4px 10px;">
                            <i class="flaticon-info" style="font-size: 1.3rem;"></i>
                            <span></span>
                        </div>
                        <div class="m-alert__text" style="padding: 14px 20px;">
                            <?php  echo html_entity_decode($info); ?>
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="form-group m-form__group m--margin-top-10">
                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-info alert-dismissible fade show" role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-info"></i>
                        <span></span>
                    </div>
                    <div class="m-alert__text">
                        {{ html_entity_decode(session()->get('info')) }}
                    </div>
                    <div class="m-alert__close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <?php  request()->session()->remove('info'); ?>
    @endif


    @if(session()->has('warning'))
        @if(is_array(session()->get('warning')))
            @foreach(session()->get('warning') as $warning)
                <div class="form-group m-form__group m--margin-top-10">
                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-warning alert-dismissible fade show" role="alert">
                        <div class="m-alert__icon" style="padding: 4px 10px;">
                            <i class="flaticon-warning-2" style="font-size: 1.3rem;"></i>
                            <span></span>
                        </div>
                        <div class="m-alert__text" style="padding: 14px 20px;">
                            <?php  echo html_entity_decode($warning); ?>
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="form-group m-form__group m--margin-top-10">
                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-warning alert-dismissible fade show" role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-warning-2"></i>
                        <span></span>
                    </div>
                    <div class="m-alert__text">
                        {{ html_entity_decode(session()->get('warning')) }}
                    </div>
                    <div class="m-alert__close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <?php  request()->session()->remove('warning'); ?>
    @endif

    @foreach ($errors->all() as $error)
        <div class="form-group m-form__group m--margin-top-10">
            <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                <div class="m-alert__icon">
                        <i class="flaticon-exclamation-1"></i>
                        <span></span>
                </div>
                <div class="m-alert__text">
                    <?php echo html_entity_decode($error); ?>
                </div>
                <div class="m-alert__close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endforeach


