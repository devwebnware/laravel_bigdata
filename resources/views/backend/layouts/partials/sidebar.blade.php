<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="javascript:void(0)" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/admin-dashboard-logo.png') }}"
                    class="w-75" alt="Admin Dashboard"></a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    @hasrole('admin')
                            <li class="nk-menu-item has-sub">
                                <a href="{{ route('categories.index') }}" class="nk-menu-link"><span
                                        class="nk-menu-icon"><em class="icon ni ni-book"></em></span>
                                    <span class="nk-menu-text">Category</span>
                                </a>
                            </li>
                            <li class="nk-menu-item has-sub">
                                <a href="{{ route('tags.index') }}" class="nk-menu-link"><span
                                        class="nk-menu-icon"><em class="icon ni ni-book"></em></span>
                                    <span class="nk-menu-text">Tag</span>
                                </a>
                            </li>
                            <li class="nk-menu-item has-sub">
                                <a href="{{ route('listings.index') }}" class="nk-menu-link"><span
                                        class="nk-menu-icon"><em class="icon ni ni-book"></em></span>
                                    <span class="nk-menu-text">Listing</span>
                                </a>
                            </li>
                    @endcan
            </div>
        </div>
    </div>
</div>
