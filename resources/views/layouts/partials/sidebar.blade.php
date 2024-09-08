    <!-- ============================ Sidebar Start ============================ -->
    <aside class="sidebar">
        <!-- sidebar close btn -->
        <button type="button" class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i class="ph ph-x"></i></button>
        <!-- sidebar close btn -->

        <a href="index.html" class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
            <img src="{{ asset('assets') }}/images/logo/Kampung-inggris-booster-logo-landscape.png" alt="Kampung Inggris Booster Logo">
        </a>

        <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
            <div class="p-20 pt-10">
                <ul class="sidebar-menu">
                    <li class="sidebar-menu__item">
                        <a href="/dashboard" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-squares-four"></i></span>
                            <span class="{{ request()->is('/dashboard') || request()->is('dashboard') ? 'activePage' : '' }}">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-menu__item">
                        <a href="/my-commissions" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-gear"></i></span>
                            <span class="{{ request()->is('/my-commissions') || request()->is('my-commissions') ? 'activePage' : '' }}">Rekap Lead</span>
                        </a>
                    </li>

                </ul>
            </div>

        </div>

    </aside>
    <!-- ============================ Sidebar End  ============================ -->