<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-green navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img alt="Brand" src="{{ asset('img/logo.png') }}">
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse top-main-menu__wrap ">
            <ul class="nav navbar-nav top-main-menu__menu_left new_nav hidden-sm hidden-xs" id="menu">
                <li>
                    @foreach($data['contacts']['social']['links'] as $soc)
                        <a href="{{ $soc->link }}" class="main-menu__social-link">
                            <i class="{{ $soc->icon }} main-menu__social-link__icon"></i>
                        </a>
                    @endforeach
                </li>
            </ul>
            <ul class="nav navbar-nav hidden-md hidden-lg top_hidden_menu" id="menu">
                <li><a href="{{ route('index') }}">@lang('messages.home')</a></li>
                <li class="dropdown">
                    <a href="{{ route('about') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        @lang('messages.about_company') <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('about', ['#what']) }}" data-anchor="what" class="about_menu_a">@lang('messages.what_is_white_coin')</a></li>
                        <li><a href="{{ route('about', ['#how_we_work']) }}" data-anchor="how_we_work" class="about_menu_a">@lang('messages.how_we_are_working')</a></li>
                        <li><a href="{{ route('about', ['#our_targets']) }}" data-anchor="our_targets" class="about_menu_a">@lang('messages.our_goals')</a></li>
                        <li><a href="{{ route('about', ['#why_we']) }}" data-anchor="why_we" class="about_menu_a">@lang('messages.why_we')</a></li>
                        <li><a href="{{ route('about', ['#how_earn']) }}" data-anchor="how_earn" class="about_menu_a">@lang('messages.how_to_earn')</a></li>
                        <li><a href="{{ route('about', ['#documents']) }}" data-anchor="documents" class="about_menu_a">@lang('messages.documents')</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('stock') }}">@lang('messages.stocks')</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('messages.partners') <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ Auth::check() ? route('facilities', ['type' => 'input']) : route('input.output', ['type' => 'input']) }}">@lang('messages.replenish_an_account')</a></li>
                        <li><a href="{{ Auth::check() ? route('facilities', ['type' => 'output']) : route('input.output', ['type' => 'output']) }}">@lang('messages.withdraw_funds')</a></li>
                        <li><a href="{{ Auth::check() ? route('tariff', ['id' => -1]) : route('about.tariffs', ['id' => -1]) }}">@lang('messages.tariffs')</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('news') }}">@lang('messages.news')</a></li>
                <li><a href="{{ route('questions') }}">@lang('messages.question_answer')</a></li>
                <li><a href="{{ route('contacts', ['#feedback']) }}">@lang('messages.feedback')</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->login }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('cabinet') }}">@lang('messages.personal_area')</a></li>
                        <li><a href="{{ route('logout') }}">@lang('messages.exit')</a></li>
                    </ul>
                </li>
                <li class="text-center pb20">
                    @foreach($data['contacts']['social']['links'] as $soc)
                        <a href="{{ $soc['link'] }}" class="main-menu__social-link"><img src="{{ asset($soc['img'].".svg") }}" alt="" class="main-menu__social-link__img"></a>
                    @endforeach
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('img/flags').'/'.Session::get('applocale').'.svg' }}" alt="" class="countries_flag_header">
                        {{ config('languages.'.Session::get('applocale')) }}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('lang', ['lang' => 'en']) }}">
                                <img src="{{ asset('img/flags').'/en.svg' }}" alt="" class="countries_flag_header">
                                English
                            </a>
                        </li>
                        <li><a href="{{ route('lang', ['lang' => 'ru']) }}">
                                <img src="{{ asset('img/flags').'/ru.svg' }}" alt="" class="countries_flag_header">
                                Русский
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div><!--/.nav-collapse -->
        <ul class="nav navbar-nav navbar-right top-main-menu__menu_right hidden-xs" >
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    {!! Auth::user()->login !!} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu pb0 nb">
                    <li><a href="{{ url('/logout') }}">@lang('messages.exit')</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('img/flags').'/'.Session::get('applocale').'.svg' }}" alt="" class="countries_flag_header">
                    {{ config('languages.'.Session::get('applocale')) }}
                </a>
                <ul class="dropdown-menu pb0 nb">
                    <li>
                        <a href="{{ route('lang', ['lang' => 'en']) }}">
                            <img src="{{ asset('img/flags').'/en.svg' }}" alt="" class="countries_flag_header">
                            English
                        </a>
                    </li>
                    <li><a href="{{ route('lang', ['lang' => 'ru']) }}">
                            <img src="{{ asset('img/flags').'/ru.svg' }}" alt="" class="countries_flag_header">
                            Русский
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-default navbar-fixed-top hidden-xs navbar__black  z100 navbar-fixed-top--new">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse main-menu__wrap">
            <ul class="nav navbar-nav main-menu__menu_center" id="menu">
                <li><a href="{{ route('index') }}">@lang('messages.home')</a></li>
                <li class="dropdown">
                    <a href="{{ route('about') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('messages.about_company') <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('about', ['#what']) }}" data-anchor="what" class="about_menu_a">@lang('messages.what_is_white_coin')</a></li>
                        <li><a href="{{ route('about', ['#how_we_work']) }}" data-anchor="how_we_work" class="about_menu_a">@lang('messages.how_we_are_working')</a></li>
                        <li><a href="{{ route('about', ['#our_targets']) }}" data-anchor="our_targets" class="about_menu_a">@lang('messages.our_goals')</a></li>
                        <li><a href="{{ route('about', ['#why_we']) }}" data-anchor="why_we" class="about_menu_a">@lang('messages.why_we')</a></li>
                        <li><a href="{{ route('about', ['#how_earn']) }}" data-anchor="how_earn" class="about_menu_a">@lang('messages.how_to_earn')</a></li>
                        <li><a href="{{ route('about', ['#documents']) }}" data-anchor="documents" class="about_menu_a">@lang('messages.documents')</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('stock') }}">@lang('messages.home')</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('messages.partners') <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ Auth::check() ? route('facilities', ['type' => 'input']) : route('input.output', ['type' => 'input']) }}">@lang('messages.replenish_an_account')</a></li>
                        <li><a href="{{ Auth::check() ? route('facilities', ['type' => 'output']) : route('input.output', ['type' => 'output']) }}">@lang('messages.withdraw_funds')</a></li>
                        <li><a href="{{ Auth::check() ? route('tariff', ['id' => -1]) : route('about.tariffs', ['id' => -1]) }}">@lang('messages.tariffs')</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('news') }}">@lang('messages.news')</a></li>
                <li><a href="{{ route('questions') }}">@lang('messages.question_answer')</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>