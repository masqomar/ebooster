<div class="top-navbar flex-between gap-16">

            <div class="flex-align gap-16">
                <!-- Toggle Button Start -->
                <button type="button" class="toggle-btn d-xl-none d-flex text-26 text-gray-500"><i class="ph ph-list"></i></button>
                <!-- Toggle Button End -->

                <form action="#" class="w-350 d-sm-block d-none">
                    <div class="position-relative">
                        <button type="submit" class="input-icon text-xl d-flex text-gray-100 pointer-event-none"><i class="ph ph-magnifying-glass"></i></button>
                        <input type="text" class="form-control ps-40 h-40 border-transparent focus-border-main-600 bg-main-50 rounded-pill placeholder-15" placeholder="Search...">
                    </div>
                </form>
            </div>

            <div class="flex-align gap-16">
               


                <!-- User Profile Start -->
                <div class="dropdown">
                    <button class="users arrow-down-icon border border-gray-200 rounded-pill p-4 d-inline-block pe-40 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="position-relative">
                            <img src="{{ asset('assets') }}/images/thumbs/user-img.png" alt="Image" class="h-32 w-32 rounded-circle">
                            <span class="activation-badge w-8 h-8 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                        <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                            <div class="card-body">
                                <div class="flex-align gap-8 mb-20 pb-20 border-bottom border-gray-100">
                                    <img src="{{ asset('assets') }}/images/thumbs/user-img.png" alt="Kampung Inggris Booster" class="w-54 h-54 rounded-circle">
                                    <div class="">
                                        <h4 class="mb-0">{{ auth()->user()->name }}</h4>
                                        <p class="fw-medium text-13 text-gray-200">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                                <ul class="max-h-270 overflow-y-auto scroll-sm pe-4">
                                    
                                    <li class="pt-8 border-top border-gray-100">
                                        <a href="{{ route('logout') }}" class="py-12 text-15 px-20 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium text-15" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <span class="text-2xl text-danger-600 d-flex"><i class="ph ph-sign-out"></i></span>
                                            <span class="text">Log Out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Profile Start -->

            </div>
        </div>