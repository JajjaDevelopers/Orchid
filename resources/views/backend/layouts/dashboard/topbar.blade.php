<div class="az-header az-header-dashboard-six" style="background-color:#f5f5f5">
    <div class="container-fluid">
        <div class="az-header-left">
            <a href="" id="azIconbarShow" class="az-header-menu-icon"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-center">

        </div><!-- az-header-center -->
        @php
            $profilePicture = Auth::user()->profile_picture;
        @endphp
        <div class="az-header-right">
            <div class="az-header-message">
                {{-- <a href="#app-chat"><i class="typcn typcn-messages"></i></a> --}}
            </div><!-- az-header-message -->
            <div class="dropdown az-header-notification">
                <a href="" class="new"><i class="typcn typcn-bell"></i></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header mg-b-20 d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <h6 class="az-notification-title">Notifications</h6>
                </div><!-- dropdown-menu -->
            </div><!-- az-header-notification -->
            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user"><img src="{{ $profilePicture ? asset($profilePicture) : asset('images/profile/profile_dummy.png') }}" alt=""></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="az-header-profile">
                        <div class="az-img-user">
                            <img class="rounded-circle header-profile-user"
                                src="{{ $profilePicture ? asset($profilePicture) : asset('images/profile/profile_dummy.png') }}"
                                alt="Admin Picture">
                        </div><!-- az-img-user -->
                        <h6>{{ Auth::user()->first_name }}</h6>
                        <span>{{ Auth::user()->is_admin ? 'Admin' : 'User' }}</span>
                        <!-- Adjust role display as needed -->
                    </div><!-- az-header-profile -->

                    <a href="{{ route('prbc.profile.edit') }}#" class="dropdown-item"><i
                            class="typcn typcn-user-outline"></i> My Profile</a>
                    <a href="#" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account
                        Settings</a>
                    <!-- Sign Out Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="typcn typcn-power-outline"></i> Sign Out
                    </a>
                </div><!-- dropdown-menu -->
            </div>
        </div><!-- az-header-right -->
    </div><!-- container -->
</div><!-- az-header -->
