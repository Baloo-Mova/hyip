<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="@if( $current_uri == 'admin/dashboard' ) active @endif"><a href='{{ route('admin-dashboard') }}'>Dashboard</a></li>
        <li class="@if( preg_match('/^admin\/subscription/i', $current_uri) ) active @endif"><a href='{{ route('admin-subscriptions-list') }}'>Subscriptions</a></li>
        <li class="@if( preg_match('/^admin\/blog/i', $current_uri) ) active @endif"><a href='{{ route('admin-blog-list') }}'>Blog</a></li>
        <li class="@if( preg_match('/^admin\/contacts/i', $current_uri) ) active @endif"><a href='{{ route('admin-contacts-list') }}'>Contacts</a></li>
    </ul>
</div>