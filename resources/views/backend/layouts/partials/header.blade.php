<!-- main header @s -->
<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ml-n1">
                <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none" style="flex-shrink:1 !important;">
                <a href="{{ route('dashboard') }}" class="logo-link">
                    <img class="logo-dark logo-img" src="{{ asset('assets/img/ad-favicon.png') }}" srcset="{{ asset('assets/img/ad-favicon.png') }}" alt="logo">
                    <img class="logo-light logo-img" src="{{ asset('assets/img/logo-loader.png') }}" srcset="{{ asset('assets/img/logo-loader.png') }}" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <!-- .nk-header-news -->
            <div class="nk-header-tools p-0">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="user-toggle">
                                @if (auth()->user())
                                <div class="user-avatar sm">
                                    {{ ucfirst(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="user-info d-none d-md-block">
                                    @if (auth()->user()->roles())
                                    @if (auth()->user()->roles()->first())
                                    <div class="user-status">
                                        {{ ucFirst(auth()->user()->roles()->first()->name) }}
                                    </div>
                                    @endif
                                    @endif
                                    <div class="user-name dropdown-indicator">{{ auth()->user()->name }}</div>
                                </div>
                                @else
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                @endif
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    @if (auth()->user())
                                    <div class="user-info">
                                        <span class="lead-text">{{ auth()->user()->name }}</span>
                                        <span class="sub-text">{{ auth()->user()->email }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a class="dark-switch active" href="javascript:void(0)"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                    <li><a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                </ul>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                            </form>
                    </li><!-- .dropdown -->
                    <!-- .dropdown -->
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
<!-- main header @e -->
@push('custom-js')
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert-dismissible").fadeTo(2000, 0).slideUp(2000, function() {});
        });
    }, 5000);
</script>
@endpush