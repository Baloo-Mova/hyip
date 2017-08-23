<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar tree">
        <li class="@if( $current_uri == 'admin/dashboard' ) active @endif"><a href='{{ route('admin-dashboard') }}'>Dashboard</a>
        </li>
        <li class="@if( preg_match('/^admin\/subscription/i', $current_uri) ) active @endif"><a
                    href='{{ route('admin-subscriptions-list') }}'>Subscriptions</a></li>
        <li class="@if( preg_match('/^admin\/users/i', $current_uri) ) active @endif"><a href='{{ route('admin-users-list') }}'>Users</a></li>
        <li class="@if( preg_match('/^admin\/blog/i', $current_uri) ) active @endif"><a
                    href='{{ route('admin-blog-list') }}'>Blog</a></li>
        <li class="@if( preg_match('/^admin\/contacts/i', $current_uri) ) active @endif"><a
                    href='{{ route('admin-contacts-list') }}'>Contacts</a></li>
        <li class="treeview menu-open @if( Route::currentRouteName() == 'mainheader.list') active @endif">
            <a href="#">
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                <span>Content</span>
            </a>
            <ul class="treeview-menu menu-open">
                <li class="@if( Route::currentRouteName() == 'mainheader.list') active @endif">
                    <a href='{{ route('mainheader.list') }}'>Main Header</a></li>
            </ul>
        </li>
    </ul>
</div>