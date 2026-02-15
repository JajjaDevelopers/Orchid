  <style>
      .nav i {
          color:purple;
      }
  </style>
  <div class="az-iconbar">
      <a href="{{ route('admin.dashboard') }}" class="az-iconbar-logo" data-toggle="tooltip-primary" title="Dashboard"><i
              class="typcn typcn-chart-bar-outline"></i></a>
      <nav class="nav">
          {{-- <a href="#asideDashboard" class="nav-link active" data-toggle="tooltip-primary" title="Dashboard"><i class="typcn typcn-device-laptop"></i></a> --}}
          <a href="#testimonials" class="nav-link" data-toggle="tooltip-primary" title="Testimonials"><i
                  class="typcn typcn-microphone"></i>
          </a>
          <a href="#gallery" class="nav-link" data-toggle="tooltip-primary" title="gallery"><i
                  class="typcn typcn-book"></i></a>
          <a href="#users" class="nav-link" data-toggle="tooltip-primary" title="Users"><i
                  class="typcn typcn-user"></i></a>
          <a href="#subscribers" class="nav-link" data-toggle="tooltip-primary" title="Subscribers"><i
                  class="typcn typcn-user-add"></i></a>
          <a href="#events" class="nav-link" data-toggle="tooltip-primary" title="Events"><i
                  class="typcn typcn-group-outline"></i></a>
          <a href="#contacts" class="nav-link" data-toggle="tooltip-primary" title="Contacts"><i
                  class="typcn typcn-phone"></i></a>
          <a href="#newsletter" class="nav-link" data-toggle="tooltip-primary" title="News Letter"><i
                  class="typcn typcn-mail"></i></a>
          <a href="#cms" class="nav-link" data-toggle="tooltip-primary" title="Front Page Cms"><i
                  class="typcn typcn-clipboard"></i></a>
      </nav>
  </div><!-- az-iconbar -->
  <div class="az-iconbar-aside">
      <div class="az-iconbar-header">
          <a href="{{ route('admin.dashboard') }}" class="az-logo"></a></a>
          <a href="" class="az-iconbar-toggle-menu">
              <i class="icon ion-md-arrow-back"></i>
              <i class="icon ion-md-close"></i>
          </a>
      </div><!-- az-iconbar-header -->
      <div class="az-iconbar-body">
          <div id="asideDashboard" class="az-iconbar-pane">
              <h6 class="az-iconbar-title">Dashboard</h6>
              <ul class="nav">
                  <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
              </ul>
          </div>
          <div id="testimonials" class="az-iconbar-pane">
              <h6 class="az-iconbar-title">Testimonials</h6>
              <ul class="nav">
                  <li class="nav-item"><a href="{{ route('admin.sermons.view') }}" class="nav-link">View Testimonials</a>
                  <li class="nav-item"><a href="{{ route('admin.sermons.create') }}" class="nav-link">Add Testimonial</a>
                  </li>
              </ul>
          </div><!-- az-iconbar-pane -->
          <div id="gallery" class="az-iconbar-pane">
              <h6 class="az-iconbar-title">Gallery</h6>
              <ul class="nav">
                  <li class="nav-item"><a href="{{ route('admin.gallery.index') }}" class="nav-link">View Gallery</a></li>
                  <li class="nav-item"><a href="{{ route('admin.gallery.create') }}" class="nav-link">Add Photos</a></li>
          </div><!-- az-iconbar-pane -->
          <div id="users" class="az-iconbar-pane">
              <h6 class="az-iconbar-title">Users</h6>
              <ul class="nav">
                  <li class="nav-item"><a href="{{ route('admin.user.view') }}" class="nav-link">View Users</a></li>
                  <li class="nav-item"><a href="{{ route('admin.user.create') }}" class="nav-link">Create User</a></li>
              </ul>
          </div><!-- az-iconbar-pane -->
          <div id="subscribers" class="az-iconbar-pane">
              <h6 class="az-iconbar-title">Subscribers</h6>
              <ul class="nav">
                  <li class='nav-item'><a href="{{ route('admin.subscriber.view') }}" class="nav-link">View
                          Subscribers</a></li>
              </ul>
          </div><!-- az-iconbar-pane -->
          <div id="events" class="az-iconbar-pane">
              <h6 class="az-iconbar-title">Events</h6>
              <ul class="nav">
                  <li class='nav-item'><a href="{{ route('admin.event.view') }}" class="nav-link">View & Create Events</a></li>
              </ul>
          </div><!-- az-iconbar-pane -->
          <div id="contacts" class="az-iconbar-pane">
              <h6 class="az-iconbar-title">Contacts</h6>
              <ul class="nav">
                  <li class='nav-item'><a href="{{ route('admin.contact.view') }}" class="nav-link">View
                          Contacts</a>
                  </li>
              </ul>
          </div><!-- az-iconbar-pane -->
          <div id="newsletter" class="az-iconbar-pane">
              <h6 class="az-iconbar-title">News Letter</h6>
              <ul class="nav">
                  <li class='nav-item'><a href="{{ route('admin.newsletter.create') }}" class="nav-link">Create</a>
                  </li>
                  <li class='nav-item'><a href="{{ route('admin.newsletter.view') }}" class="nav-link">View</a>
                  </li>
              </ul>
          </div><!-- az-iconbar-pane -->
          <div id="cms" class="az-iconbar-pane">
            <h6 class="az-iconbar-title">Front Page Cms</h6>
            <ul class="nav">
                <li class='nav-item'><a href="{{ route('admin.front.content') }}" class="nav-link">Manage Front Page Cms</a>
                </li>
            </ul>
        </div><!-- az-iconbar-pane -->
      </div><!-- az-iconbar-body -->
  </div><!-- az-iconbar-aside -->
