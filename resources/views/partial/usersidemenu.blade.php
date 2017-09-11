<ul class="nav nav-sidebar user-sidebar">
    <li class="{{ Request::path() == 'cabinet' ? 'active' : ''}}"><a href="{{ route('cabinet') }}">Главная <span class="sr-only">(current)</span></a></li>
    <li class="{{ Request::path() == 'cabinet/referrals' ? 'active' : ''}}"><a href="{{ route('referrals') }}">Рефералы</a></li>
    <li class="{{ Request::path() == 'cabinet/facilities' ? 'active' : ''}}"><a href="{{ route('facilities', ['type' => 'input']) }}">Ввод/вывод</a></li>
    <li class="{{ Request::path() == 'cabinet/profile' ? 'active' : ''}}"><a href="{{ route('profile') }}">Профиль</a></li>
    <li class="{{ Request::path() == 'cabinet/tariff' ? 'active' : ''}}"><a href="{{ route('tariff') }}">Тариф</a></li>
    <li class="{{ Request::path() == 'cabinet/dialogs' ? 'active' : ''}}"><a href="{{ route('dialogs') }}">Сообщения</a></li>
    <li class="{{ Request::path() == 'cabinet/facilities/operations' ? 'active' : ''}}"><a href="{{ route('facilities.operations') }}">Операции</a></li>
    <li class="{{ Request::path() == 'cabinet/support' ? 'active' : ''}}"><a href="{{ route('support') }}">Поддержка</a></li>
</ul>