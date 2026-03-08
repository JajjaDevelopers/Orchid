 <div class="az-sidebar">
     <div class="az-sidebar-header">
         <a href="#">
             <img src="{{ asset('images/orchid.jpg') }}" width="170px" height="100px">
             <!-- <h3 class="text-success"><strong>LOGO</strong></h3> -->
         </a>
     </div><!-- az-sidebar-header -->
     <div class="az-sidebar-body">
         <ul class="nav">
             <li class="nav-item active show">
                 <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                         class="typcn typcn-clipboard"></i>Dashboard</a>
             </li><!-- nav-item -->
             <li class="nav-item">
                 <a href="#" class="nav-link with-sub">
                     <i class="typcn typcn-user"></i>
                     <span>Users</span>
                 </a>

                 <ul class="nav-sub">
                     <li class="nav-sub-item">
                         <a href="{{ route('admin.user.view') }}" class="nav-link">View Users</a>
                     </li>
                     <li class="nav-sub-item">
                         <a href="{{ route('admin.user.create') }}" class="nav-link">Create User</a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item">
                 <a href="" class="nav-link with-sub">
                     <i class="typcn typcn-group-outline"></i> Testimonials
                 </a>
                 <ul class="nav-sub">
                     <li class="nav-sub-item">
                         <a href="{{ route('admin.testimonials.index') }}" class="nav-link">View Testimonials</a>
                     </li>
                     <li class="nav-sub-item">
                         <a href="{{ route('admin.testimonials.create') }}" class="nav-link">Add Testimonial</a>
                     </li>
                 </ul>
             </li><!-- nav-item -->


             <li class="nav-item">
                 <a href="" class="nav-link with-sub"><i class="typcn typcn-book"></i>Gallery</a>
                 <ul class="nav-sub">
                     <li class="nav-sub-item"><a href="{{ route('admin.gallery.index') }}" class="nav-link">View
                             Gallery</a></li>
                     <li class="nav-sub-item"><a href="{{ route('admin.gallery.create') }}" class="nav-link">Add
                             Photos</a>
                     </li>
                 </ul>
             </li><!-- nav-item -->
             <li class="nav-item">
                 <a href="#" class="nav-link with-sub">
                     <i class="typcn typcn-user-add"></i>
                     <span>Subscribers</span>
                 </a>

                 <ul class="nav-sub">
                     {{-- Fee Categories --}}
                     <li class="nav-sub-item">
                         <a href="{{ route('admin.subscriber.view') }}" class="nav-link">View
                             Subscribers</a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item">
                 <a href="" class="nav-link with-sub">
                     <i class="typcn typcn-group-outline"></i>Events
                 </a>
                 <ul class="nav-sub">
                     <li class="nav-sub-item"><a href="{{ route('admin.event.view') }}" class="nav-link">View & Create
                             Events</a>
                     </li>
                 </ul>
             </li><!-- nav-item -->

             <li class="nav-item">
                 <a href="" class="nav-link with-sub">
                     <i class="typcn typcn-phone"></i>Contacts
                 </a>
                 <ul class="nav-sub">
                     <li class="nav-sub-item"><a href="{{ route('admin.contact.view') }}" class="nav-link">View
                             Contacts</a>
                     </li>
                 </ul>
             </li><!-- nav-item -->


             <li class="nav-item">
                 <a href="#" class="nav-link with-sub">
                     <i class="typcn typcn-mail"></i>
                     <span>News Letter</span>
                 </a>
                 <ul class="nav-sub">
                     <li class="nav-sub-item">
                         <a href="{{ route('admin.newsletter.create') }}" class="nav-link">Create</a>
                     </li>
                 </ul>
             </li>

             <li class="nav-item">
                 <a href="#" class="nav-link with-sub">
                     <i class="typcn typcn-clipboard"></i>
                     <span>Page Content</span>
                 </a>

                 <ul class="nav-sub">
                     {{-- Expenses --}}
                     <li class="nav-sub-item">
                         <a href="{{ route('admin.front.content') }}" class="nav-link">Images</a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item">
                 <a href="#" class="nav-link"><i class="typcn typcn-cog"></i>Settings</a>
             </li><!-- nav-item -->
         </ul><!-- nav -->
     </div><!-- az-sidebar-body -->
 </div><!-- az-sidebar -->
