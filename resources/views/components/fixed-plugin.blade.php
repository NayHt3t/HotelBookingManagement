<div class="fixed-plugin">
  <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
    <i class="fa fa-cog py-2"> </i>
  </a>
  <div class="card shadow-lg ">
    <div class="card-header pb-0 pt-3 ">
      <div class="{{ (Request::is('rtl') ? 'float-end' : 'float-start') }}">
        <h5 class="mt-3 mb-0">Booking Notification</h5>
      </div>
      <div class="{{ (Request::is('rtl') ? 'float-start mt-4' : 'float-end mt-4') }}">
        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
          <i class="fa fa-close"></i>
        </button>
      </div>
      <!-- End Toggle Button -->
    </div>
    <hr class="horizontal dark my-1">

    <div class="card-body pt-sm-3 pt-0" style="max-height:auto; overflow-y: auto;">
  @foreach ($bookings as $booking)
    <a href="bookings" class="nav-link">
    <div class="border border-secoundary rounded p-1 mb-0 bg-light text-muted" style="position: relative;">        <!-- Time in the top-right corner -->
        <div class="position-absolute top-0 end-0" style="font-size: 0.9rem;">
          @if (!$booking->noti)
            <span class ="text-primary ">new</span>
          @endif

          <span class="small">{{ \Carbon\Carbon::parse($booking->created_at)->diffForHumans(\Carbon\Carbon::now(), true) }} ago</span>

        </div>

        <div class="d-flex align-items-center mt-2 ">
          <!-- Image -->
          <img src="{{ asset('storage/featured_images/' . $booking->roomType->featured_image) }}" 
               alt="Notification Image" 
               class="rounded me-3" 
               style="width: 50px; height: 50px; object-fit: cover;">

               <p class="mb-1 fw-bold" style="font-size: 0.9rem; color: black;">
            {{$booking->customer->name}} books <span class="text-success">{{$booking->qty}}</span>   <span class="text-warning">{{$booking->roomType->name}}</span>.
          </p>
         
        </div>
        
      </div>
    </a>
    <hr class="horizontal dark">
  @endforeach
</div>

</div>