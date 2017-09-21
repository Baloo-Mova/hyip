<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar tree">
        <li class="@if( $current_uri == 'admin' ) active @endif"><a href='{{ route('admin-dashboard') }}'>Главная</a>
        </li>
        <li class="@if( preg_match('/^admin\/subscriptions/i', $current_uri) ) active @endif"><a
                    href='{{ route('admin-subscriptions-list') }}'>Тарифы</a></li>
        <li class="@if( preg_match('/^admin\/users/i', $current_uri) ) active @endif"><a href='{{ route('admin-users-list') }}'>Пользователи @if (\App\Models\UserConfirm::hasUnread()) <span class="title_unread" style="background: red">new</span>@endif</a></li>
        <li class="@if( preg_match('/^admin\/withdraws/i', $current_uri) ) active @endif"><a href='{{ route('admin.withdraws', ['status' => 0]) }}'>Заявки на вывод @if (\App\Models\WalletProcesses::hasWithdraws()) <span class="title_unread" style="background: red">new</span>@endif</a></li>
        <li class="@if( preg_match('/^admin\/sending-messages/i', $current_uri) ) active @endif"><a href='{{ route('admin.sending-messages') }}'>Сообщения</a></li>
        <li class="@if( preg_match('/^admin\/feedback/i', $current_uri) ) active @endif"><a href='{{ route('admin-feedback-list', ['type' => 'users']) }}'>Обратная связь @if (\App\Models\Feedback::hasUnreadFeedback()) <span class="title_unread" style="background: red">new</span>@endif</a></li>
        <li class="@if( preg_match('/^admin\/blacklist/i', $current_uri) ) active @endif"><a href='{{ route('admin.blacklist') }}'>Черный список</a></li>
        <li class="treeview menu-open @if( Route::currentRouteName() == 'admin.carousel.list') active @endif">
            <a href="#">
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                <span>Контент</span>
            </a>
            <ul class="treeview-menu menu-open">
                <li class="@if( Route::currentRouteName() == 'admin.carousel.list') active @endif">
                    <a href='{{ route('admin.carousel.list') }}'>Карусель</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.social-networks.list') active @endif">
                    <a href='{{ route('admin.social-networks.list') }}'>Ссылки соц. сетей</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.social-networks.shares') active @endif">
                    <a href='{{ route('admin.social-networks.shares') }}'>Ссылки поделиться соц. сетей</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.faq.list') active @endif">
                    <a href='{{ route('admin.faq.list') }}'>FAQ</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.articles.list') active @endif">
                    <a href='{{ route('admin.articles.list') }}'>Новости и акции</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.contacts.list') active @endif">
                    <a href='{{ route('admin.contacts.list') }}'>Контакты</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.about-notations.list') active @endif">
                    <a href='{{ route('admin.about-notations.list') }}'>О компании</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.regulations.get') active @endif">
                    <a href='{{ route('admin.regulations.list') }}'>Нормативно-правовые акты</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.input-output.index') active @endif">
                    <a href='{{ route('admin.input-output.index') }}'>Ввод/вывод</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.three-steps.index') active @endif">
                    <a href='{{ route('admin.three-steps.index') }}'>3 шага</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.greetings.index') active @endif">
                    <a href='{{ route('admin.greetings.index') }}'>Приветствие</a></li>
                <li class="@if( Route::currentRouteName() == 'admin.about.project.index') active @endif">
                    <a href='{{ route('admin.about.project.index') }}'>О проэкте</a></li>
            </ul>
        </li>
    </ul>
</div>