<!DOCTYPE html>
<html lang="pt-BR" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        WeekIt 2018 - IFBA - Campus Vitória da Conquis
    </title>
    <meta name="description" content="Sistema de gerenciamento Cootraseoba">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="{{ asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/demo/demo5/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />


</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- begin::Header -->
    <header class="m-grid__item		m-header "  data-minimize="minimize" data-minimize-offset="200" data-minimize-mobile-offset="200" >
        <div class="m-header__top">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- begin::Brand -->
                    <div class="m-stack__item m-brand">
                        <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="/" class="m-brand__logo-wrapper">
                                    <img alt="" src="{{ asset('img/logo-sys.png')}}" style="max-width: 210px;"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end::Brand -->
                    <!-- begin::Topbar -->
                    <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline">

                                    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
                                            <span class="m-topbar__welcome">Olá,&nbsp;</span>
                                            <span class="m-topbar__username">{{ Auth::user()->nome }}</span>
		<span class="m-topbar__userpic">
			<img src="./assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt="">
		</span>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__header m--align-center" style="background: url(./assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                                    <div class="m-card-user m-card-user--skin-dark">
                                                        <div class="m-card-user__pic">
                                                            <img src="./assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt="">
                                                        </div>
                                                        <div class="m-card-user__details">
                                                            <span class="m-card-user__name m--font-weight-500">{{ Auth::user()->nome }}</span>
                                                            <a href="" class="m-card-user__email m--font-weight-300 m-link">{{ Auth::user()->email }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-dropdown__body">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav m-nav--skin-light">
                                                           
            
                                                            <li class="m-nav__item">
                                                                <a href="#" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-share"></i>
                                                                    <span class="m-nav__link-text">Perfil</span>
                                                                </a>
                                                            </li>
                                                            
                                                            <li class="m-nav__separator m-nav__separator--fit">
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="{{route('logout')}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Sair</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- end::Topbar -->
                </div>
            </div>
        </div>
        <div class="m-header__bottom">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- begin::Horizontal Menu -->
                    @include('layouts.partial.m-aside-menu-'. Auth::user()->role->slug)
                    <!-- end::Horizontal Menu -->

                    <div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable m-header-search--skin-" id="m_quicksearch" m-quicksearch-mode="default" style="padding-left: 33px; padding-right:33px;background: #032f18;">
                        <span style="font-size: 13px; color: #fff;"> Evento selecionado<br/></span>
                        <span style="font-size: 14px; color: #fff; margin-top: 3px; display: block;">
                        {{ Form::select('evento_id', \App\Evento::pluck('nome', 'id'), old('evento_id', \App\Evento::find(\App\Evento::eventoPadrao())->id), ['name' => 'evento_id', 'onchange="alterarEventoPadrao(this)"']) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end::Header -->
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop 	m-container m-container--responsive m-container--xxl m-page__container m-body">
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- end::Body -->
    <!-- begin::Footer -->
    <footer class="m-grid__item m-footer ">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-footer__wrapper">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
						<span class="m-footer__copyright text-center">
							{{date('Y')}} &copy; Av. Sérgio Vieira de Mello, 3150 - Zabelê, Vitória da Conquista - BA
						</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end::Footer -->
</div>
<!-- end:: Page -->

<!-- begin::Scroll Top -->
<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->
<!-- begin::Quick Nav -->

<!-- begin::Quick Nav -->
<!--begin::Base Scripts -->
<script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/demo/demo5/base/scripts.bundle.js') }}" type="text/javascript"></script>


<!--end::Base Scripts -->
<!--begin::Page Resources -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<!--end::Page Resources -->
@yield('scripts')

<script type="text/javascript">

    function alterarEventoPadrao(obj){
        var id = obj.value;
        $.ajax({
            type: "GET",
            url: "/evento/alterar-evento-padrao/"+id,
            success: function(){
                location.reload();
            },
        });
    }

    var Inputmask={
        init:function(){
            $(".m_inputmask_data").inputmask("dd/mm/yyyy",{autoUnmask:!0}),$(".m_inputmask_datetime").inputmask("ddmm/yyyy",{placeholder:"*"}),$(".m_inputmask_3").inputmask("mask",{mask:"(999) 999-9999"}),$(".m_inputmask_4").inputmask({mask:"99-9999999",placeholder:""}),$(".m_inputmask_5").inputmask({mask:"9",repeat:10,greedy:!1}),$(".m_inputmask_6").inputmask("decimal",{rightAlignNumerics:!1}),$(".m_inputmask_7").inputmask("â‚¬ 999.999.999,99",{numericInput:!0}),$(".m_inputmask_8").inputmask({mask:"999.999.999.999"}),$("#m_inputmask_9").inputmask({mask:"*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",greedy:!1,onBeforePaste:function(m,a){return(m=m.toLowerCase()).replace("mailto:","")},definitions:{"*":{validator:"[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",cardinality:1,casing:"lower"}}})}};jQuery(document).ready(function(){Inputmask.init()});
</script>
</body>
<!-- end::Body -->
</html>
