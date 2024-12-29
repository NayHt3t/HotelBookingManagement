@extends('layouts.master')

@section('content')





    <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/big_image_1.jpg);">
      <div class="container">



        <div class="row align-items-center site-hero-inner justify-content-center">





          <div class="col-md-12 text-center">

            <div class="mb-5 element-animate">
              <h1>Welcome To Our Luxury Rooms</h1>
              <p>Discover our world's #1 Luxury Room For VIP.</p>

            </div>



          </div>

          <section class="section bg-light pb-0  roomsserach" style="border-radius :15px"  >
      <div class="container p-4 ">

        <div class="row check-availabilty" id="next">

          <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

            <form action="/search" class="ml-3 mr-3" method="post">
              @csrf
              <div class="row">
                <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                  <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="icon-calendar"></span></div>
                    <input type="date" name="checkin" id="checkin_date" class="form-control">
                  </div>
                </div>
                <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                  <label for="checkout_date" class="font-weight-bold text-black">Check Out</label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="icon-calendar"></span></div>
                    <input type="date" name="checkout" id="checkout_date" class="form-control">
                  </div>
                </div>

                @php
                       $categories = \App\Models\Category::all();
                @endphp

                <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                      <label for="adults" class="font-weight-bold text-black">Room Type</label>
                      <div class="field-icon-wrap">

                      <select name="category" id="" class="form-control">
                        <option value="">Room Type</option>
                        @foreach ($categories as $category  )

                        <option value="{{$category->id}}">{{$category->name}}</option>

                        @endforeach

                      </select>

                      </div>
                </div>

                <div class="col-md-6 col-lg-3 align-self-end">
                  <button type="submit" class="btn btn-primary btn-block text-white">Check</button>
                </div>
              </div>
            </form>
          </div>


        </div>
      </div>
    </section>

        </div>
      </div>
    </section>
    <!-- END section -->



    <section class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12 heading-wrap text-center">
            <h4 class="sub-heading">Our Promotions</h4>
              <h2 class="heading">Our December Promotions</h2>
          </div>
        </div>
        <div class="row ">

            @php
                $promotions = \App\Models\Promotion::all();
            @endphp

            @foreach ($promotions as $promo )
            <div class="col-md-4">
                <div class="post-entry">
                <img src="{{ $promo->roomPrice->roomType->featured_image }}" alt="Image placeholder" class="img-fluid">
                  <div class="body-text">
                    <div class="category"></div>
                    <h3 class="mb-3">{{ $promo->roomPrice->roomType->name }}</h3>
                    {{-- <h5 class="mb-3">Normal price - {{ $promo->roomPrice->price }}</h5> --}}
                    <h2 class="mb-3 font-weight-bold">{{ $promo->discount }} % OFF</h2>

                    <p class="mb-4">Promotion start date : {{ $promo->start_date }}</p>
                    <p class="mb-4">Promotion end date : {{ $promo->end_date }}</p>
                    <p><a href="#" class="btn btn-primary btn-outline-primary btn-sm">Book now</a></p>
                  </div>
                </div>
              </div>
            @endforeach



        </div>
      </div>
    </section>
    <!-- END section -->



    <section class="site-section bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12 heading-wrap text-center">
            <h4 class="sub-heading">Our Luxury Rooms</h4>
              <h2 class="heading">Featured Rooms</h2>
          </div>
        </div>
        <div class="row ">
          <div class="col-md-7">
            <div class="media d-block room mb-0">
          <figure>




          <img src="https://assets.simpleviewinc.com/simpleview/image/upload/c_limit,h_1200,q_75,w_1200/v1/clients/milwaukee/VM_Hilton_Plaza_Suite_King_Room_9b5d673a-95c6-445e-ad6b-5ae85e260f18.jpg" alt="Generic placeholder image" class="img-fluid">





                <div class="overlap-text">
                  <span>
                    Featured Room
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                  </span>
                </div>
              </figure>
              <div class="media-body">
                <h3 class="mt-0"><a href="#">Presidential Room</a></h3>
                <ul class="room-specs">
                  <li><span class="ion-ios-people-outline"></span> 2 Guests</li>
                  <li><span class="ion-ios-crop"></span> 22 ft <sup>2</sup></li>
                </ul>
                <p>Nulla vel metus scelerisque ante sollicitudin. Fusce condimentum nunc ac nisi vulputate fringilla. </p>
                <p><a href="#" class="btn btn-primary btn-sm">Book Now From $20</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-5 room-thumbnail-absolute">
            <a href="#" class="media d-block room bg first-room"
             style="background-image: url(images/img_2.jpg); ">
              <!-- <figure> -->
                <div class="overlap-text">
                  <span>
                    Hotel Room
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                  </span>
                  <span class="pricing-from">
                    from $22
                  </span>
                </div>
              <!-- </figure> -->
            </a>

            <a href="#" class="media d-block room bg second-room" style="background-image: url(images/img_4.jpg); ">
              <!-- <figure> -->
                <div class="overlap-text">
                  <span>
                    Hotel Room
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                  </span>
                  <span class="pricing-from">
                    from $22
                  </span>
                </div>
              <!-- </figure> -->
            </a>

          </div>
        </div>
      </div>
    </section>



    <section class="section-cover" data-stellar-background-ratio="0.5"
    style="background-image: url(images/img_5.jpg);">
      <div class="container">
        <div class="row justify-content-center align-items-center intro">
          <div class="col-md-9 text-center element-animate">
            <h2>Relax and Enjoy your Holiday</h2>
            <p class="lead mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto quidem tempore expedita facere facilis, dolores!</p>
            <div class="btn-play-wrap"><a href="https://vimeo.com/channels/staffpicks/93951774" class="btn-play popup-vimeo "><span class="ion-ios-play"></span></a></div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="site-section bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12 heading-wrap text-center">
            <h4 class="sub-heading">Our Blog</h4>
              <h2 class="heading">Our Recent Blog</h2>
          </div>
        </div>
        <div class="row ">
          <div class="col-md-4">
            <div class="post-entry">
              <img src="images/img_3.jpg" alt="Image placeholder" class="img-fluid">
              <div class="body-text">
                <div class="category">Rooms</div>
                <h3 class="mb-3"><a href="#">New Rooms</a></h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum deserunt illo quis similique dolore voluptatem culpa voluptas rerum, dolor totam.</p>
                <p><a href="#" class="btn btn-primary btn-outline-primary btn-sm">Read More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="post-entry">
              <img src="images/img_6.jpg" alt="Image placeholder" class="img-fluid">
              <div class="body-text">
                <div class="category">News</div>
                <h3 class="mb-3"><a href="#">New Staff Added</a></h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum deserunt illo quis similique dolore voluptatem culpa voluptas rerum, dolor totam.</p>
                <p><a href="#" class="btn btn-primary btn-outline-primary btn-sm">Read More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="post-entry">
              <img src="images/img_5.jpg" alt="Image placeholder" class="img-fluid">
              <div class="body-text">
                <div class="category">New Rooms</div>
                <h3 class="mb-3"><a href="#">Big Rooms for All</a></h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum deserunt illo quis similique dolore voluptatem culpa voluptas rerum, dolor totam.</p>
                <p><a href="#" class="btn btn-primary btn-outline-primary btn-sm">Read More</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

@endsection
