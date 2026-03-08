<div class="az-header">
    <div class="container-fluid" style="background-color:purple">
        <div class="az-header-left">
            <a href="" id="azSidebarToggle" class="az-header-menu-icon" title="Access Menu"><span></span></a>
        </div><!-- az-header-left -->

        <div class="az-header-center">
            <h1 style="color: white;"><strong>ORCHID USHERS & HOSPITALITY AGENCY</strong></h1>
        </div><!-- az-header-center -->

        <div class="az-header-right d-flex align-items-center">
            <!-- Clock -->
            <div id="liveTime" style="color:white; margin-right:20px; font-weight:bold;"></div>

            <!-- Calculator Button -->
            <!-- <button id="openCalculator" class="btn btn-light btn-sm" title="Open Calculator">
                <i class="typcn typcn-calculator"></i>
            </button> -->

            <div class="az-header-message"></div>

            <div class="dropdown az-header-notification">
                <a href="" class="news"><i class="typcn typcn-bell"></i></a>
            </div><!-- az-header-notification -->

            <div class="dropdown az-profile-menu">
                <?php
                $initials = strtoupper(substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1));
                ?>
                <a href="" class="az-img-user metric-card-value text-white"><?= $initials ?></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="az-header-profile">
                        <div class="az-img-user  metric-card-value">
                            <?= $initials ?>
                        </div><!-- az-img-user -->
                        <h6></h6>
                        <span>{{ Auth::user()->first_name }}</span>
                    </div><!-- az-header-profile -->

                    <a href="/profile/edit" class="dropdown-item"><i class="typcn typcn-trash"></i> Edit Profile</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
                    <a href="#" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="typcn typcn-power-outline"></i> Sign Out
                    </a>
                </div><!-- dropdown-menu -->
            </div>
        </div><!-- az-header-right -->
    </div><!-- container -->
</div><!-- az-header -->

