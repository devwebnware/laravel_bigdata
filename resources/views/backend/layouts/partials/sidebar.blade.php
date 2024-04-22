<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="javascript:void(0)" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{ route('dashboard') }}"><em class="icon ni ni-linux" style="color: white; font-size: 30px"></em></a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('dashboard') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('categories.index') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-book"></em></span>
                            <span class="nk-menu-text">Category</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('tags.index') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-tag-alt"></em></span>
                            <span class="nk-menu-text">Tag</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('field.index') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-property-add"></em></span>
                            <span class="nk-menu-text">Listing Custom Field</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('listing.export.group.index') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-property-add"></em></span>
                            <span class="nk-menu-text">Export Groups</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('listings.import.data.status') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-download-cloud"></em></span>
                            <span class="nk-menu-text">Import Status</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub active current-page"><a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-icon"><em class="icon ni ni-list-thumb-alt"></em></span><span class="nk-menu-text">Listing</span></a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="{{ route('listings.index') }}" class="nk-menu-link"><span class="nk-menu-text">View Listings</span></a></li>
                            <li class="nk-menu-item active current-page"><a href="{{ route('listings.data.import') }}" class="nk-menu-link"><span class="nk-menu-text">Import</span></a></li>
                            <li class="nk-menu-item active current-page"><a href="{{ route('listings.data.export') }}" class="nk-menu-link"><span class="nk-menu-text">Export</span></a></li>
                        </ul>
                    </li>
                    @hasrole('admin')
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('listings.user.import.export.logs') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-view-list-fill"></em></span>
                            <span class="nk-menu-text">Logs</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </div>
    </div>
</div>