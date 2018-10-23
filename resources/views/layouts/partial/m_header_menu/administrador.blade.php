<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                            <li class="m-menu__item m-menu__item--submenu m-menu__item--rel m-menu__item--open-dropdown {{ request()->is('home') ? ' m-menu__item--active' : '' }}" m-menu-submenu-toggle="click" aria-haspopup="true">
                                                <a href="/" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon flaticon-analytics"></i>
                                                    <span class="m-menu__link-text">
                                                        Dashboard
                                                    </span>
    
                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                            </li>
                                            <li class="m-menu__item m-menu__item--submenu m-menu__item--rel m-menu__item--open-dropdown {{ request()->is('agenda') ? ' m-menu__item--active' : '' }}" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="{{route('agenda.index')}}" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon    flaticon-calendar-1"></i>
                                                    <span class="m-menu__link-text">
                                                        Agendas
                                                    </span>
                                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px">
                                                    <span class="m-menu__arrow m-menu__arrow--adjust" style="left: 65px;"></span>
                                                    <div class="m-menu__subnav">
                                                        <ul class="m-menu__content">
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Gerenciar agendas
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a href="{{route('agenda.index')}}" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-list-1"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Listar agendas
                                                                            </span>
                                                                        </a>
                                                                    </li>

                                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a href="{{route('agenda.create')}}" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon la  flaticon-event-calendar-symbol"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Cadastrar agenda
                                                                            </span>
                                                                        </a>
                                                                    </li>

                                                                
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Últimos agendas cadastrados
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    @foreach(\App\Agenda::all() as $agenda)
                                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                               {{$agenda->nome}}
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    @endforeach 
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="m-menu__item m-menu__item--submenu m-menu__item--rel m-menu__item--open-dropdown {{ request()->is('agenda') ? ' m-menu__item--active' : '' }}" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="{{route('agenda.index')}}" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon flaticon-clock-2"></i>
                                                    <span class="m-menu__link-text">
                                                        Horários
                                                    </span>
                                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px">
                                                    <span class="m-menu__arrow m-menu__arrow--adjust" style="left: 65px;"></span>
                                                    <div class="m-menu__subnav">
                                                        <ul class="m-menu__content">
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Gerenciar horários
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a href="{{route('horario.index')}}" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-list-1"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Listar horários
                                                                            </span>
                                                                        </a>
                                                                    </li>

                                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a href="{{route('horario.create')}}" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon la      la-calendar-plus-o"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Cadastrar horário
                                                                            </span>
                                                                        </a>
                                                                    </li>

                                                                
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                       Horários disponíveis para hoje
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    @foreach(\App\Horario::horarios_disponiveis_hoje() as $horario)
                                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                              {{\Carbon\Carbon::parse($horario->data)->format('d/m/Y')}} {{\Carbon\Carbon::parse($horario->inicio)->format('H:i')}}
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    @endforeach 
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                        </ul>
                                    </div>