<div class="az-dashboard-nav">
    <nav class="nav">
        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a class="nav-link" href="{{route('admin.gallery.index')}}">Gallery</a>
        <a class="nav-link" href="{{ route('admin.testimonials.index') }}">Testimonials</a>
        {{-- <a class="nav-link"  href="{{ route('admin.user.view') }}">Users</a> --}}
        <a class="nav-link" href="{{ route('admin.subscriber.view') }}">Subscribers</a>
        <a class="nav-link" href="{{ route('admin.contact.view') }}">Contacts</a>
        <a class="nav-link" href="{{ route('admin.newsletter.view') }}">Newsletter</a>
        <a class="nav-link" href="#">Events</a>
        <a class="nav-link" data-toggle="tab" href="#">More</a>
    </nav>
</div>
