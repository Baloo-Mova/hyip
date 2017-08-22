@forelse( \App\Models\User::dialogs() as $dialog )
    @if( (!$dialog_user = $dialog->dialog_user))
        @continue
    @endif
    <a href="/cabinet/dialogs/{{ Auth::id() == $dialog->from_user ? $dialog->to_user : $dialog->from_user }}" class="list-group-item @if( $dialog->hasUnreadMessages() ) active @endif">
        <h4 class="list-group-item-heading">{{ $dialog_user->login }}</h4>
        <span class="date">{{ $dialog->created_at->format('d.m.Y H:i') }}</span>
        <p class="list-group-item-text">{{ $dialog->message }}</p>
    </a>
@empty
    <div class="cab__title">Нет сообщений</div>
@endforelse