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
            <li><a href="{{ route('index') }}">Главная</a></li>
            <li class="dropdown">
                <a href="{{ route('about') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">О проекте <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                </ul>
            </li>
            <li><a href="{{ route('about') }}">Акции</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Партнерам <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Пополнить счет</a></li>
                    <li><a href="#">Вывести средства</a></li>
                    <li><a href="#">Тарифы</a></li>
                </ul>
            </li>
            <li><a href="{{ route('news') }}">Новости</a></li>
            <li><a href="{{ route('questions') }}">Вопрос-ответ</a></li>
            <li>
                <a href="{{ url('/login') }}" class="main-menu__register-link">Войти/</a>
                <a href="{{ url('/register') }}" class="main-menu__register-link">регистрация</a>
            </li>
        </ul>
    </div><!--/.nav-collapse -->
</div>