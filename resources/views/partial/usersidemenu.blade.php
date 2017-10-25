<ul class="nav nav-sidebar user-sidebar">
    <li class="{{ Request::path() == 'cabinet' ? 'active' : ''}}"><a href="{{ route('cabinet') }}">@lang("messages.home") <span class="sr-only">(current)</span></a></li>
    <li class="{{ Request::path() == 'cabinet/referrals' ? 'active' : ''}}"><a href="{{ route('referrals') }}">@lang("messages.referrals")</a></li>
    <li class="{{ \Request::is('cabinet/facilities/*') && Request::path() != 'cabinet/facilities/operations'  ? 'active' : ''}}"><a href="{{ route('facilities', ['type' => 'input']) }}">@lang("messages.input_output")</a></li>
    <li class="{{ Request::path() == 'cabinet/profile' ? 'active' : ''}}"><a href="{{ route('profile') }}">@lang("messages.profile")</a></li>
    <li class="{{ \Request::is('cabinet/tariff/*') ? 'active' : ''}}"><a href="{{ route('tariff', ['id' => -1]) }}">@lang("messages.tariff")</a></li>
    <li class="{{ Request::path() == 'cabinet/dialogs' ? 'active' : ''}}"><a href="{{ route('dialogs') }}">@lang("messages.messages") <?php $messages = \Auth::user()->hasMessages; $mc = count($messages); ?> <span class="{{ $mc > 0 ? "badge alert-danger" : "" }}">{{ $mc > 0 ? $mc : "" }}</span></a></li>
    <li class="{{ \Request::is('cabinet/facilities/operations') ? 'active' : ''}}"><a href="{{ route('facilities.operations') }}">@lang("messages.history_operations")</a></li>
    <li class="{{ \Request::is('cabinet/support/*') ? 'active' : ''}}"><a href="{{ route('support.chat') }}">@lang("messages.support") <?php $messages = \Auth::user()->hasFeedbackAnswer->where('is_reply', 1)->count(); ?><span class="{{ $messages > 0 ? "badge alert-danger" : "" }}">{{ $messages > 0 ? $messages : "" }}</span></a></li>
</ul>