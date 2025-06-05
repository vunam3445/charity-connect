<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">
            Xin chào, {{(Auth('admin')->user()->username)}}

        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ request()->is('admin/organizations/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/organizations/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Quản lý tổ chức
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/organizations/approved"
                                class="nav-link {{ request()->is('admin/organizations/approved') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tổ chức đã được duyệt</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/organizations/pending"
                                class="nav-link {{ request()->is('admin/organizations/pending') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tổ chức chưa được duyệt</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/organizations/rejected"
                                class="nav-link {{ request()->is('admin/organizations/rejected') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tổ chức bị từ chối</p>
                            </a>
                        </li>
                    </ul>

                </li>
                <li class="nav-item {{ request()->is('admin/events/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/events/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Quản lý sự kiện
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/events/approved"
                                class="nav-link {{ request()->is('admin/events/approved') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sự kiện đã được duyệt</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/events/pending"
                                class="nav-link {{ request()->is('admin/events/pending') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sự kiện chưa được duyệt</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/events/rejected"
                                class="nav-link {{ request()->is('admin/events/rejected') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sự kiện bị từ chối</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ request()->is('admin/notifications*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/notifications*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Quản lý thông báo
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <!-- Tạo thông báo -->
                        <li class="nav-item">
                            <a href="/admin/notifications/send"
                                class="nav-link {{ request()->is('admin/notifications/send') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tạo thông báo</p>
                            </a>
                        </li>

                        <!-- Nhóm thông báo đã gửi -->
                        <li
                            class="nav-item has-treeview {{ request()->is('admin/notifications/system') ||
                            request()->is('admin/notifications/organization-*') ||
                            request()->is('admin/notifications/event-specific')
                                ? 'menu-open'
                                : '' }}">
                            <a href="#"
                                class="nav-link {{ request()->is('admin/notifications/system') ||
                                request()->is('admin/notifications/organization-*') ||
                                request()->is('admin/notifications/event-specific')
                                    ? 'active'
                                    : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Thông báo đã gửi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="/admin/notifications/system"
                                        class="nav-link {{ request()->is('admin/notifications/system') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Toàn hệ thống (TNV)</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/notifications/organization-all"
                                        class="nav-link {{ request()->is('admin/notifications/organization-all') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Toàn bộ tổ chức</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/notifications/organization-specific"
                                        class="nav-link {{ request()->is('admin/notifications/organization-specific') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Tổ chức cụ thể</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/notifications/event-specific"
                                        class="nav-link {{ request()->is('admin/notifications/event-specific') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Sự kiện cụ thể</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
