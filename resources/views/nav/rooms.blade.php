@extends('layouts.master')



    @section('content')

    <section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/big_image_1.jpg);">
      <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
          <div class="col-md-12 text-center">

            <div class="mb-5 element-animate">
              <h1>Our Rooms</h1>
              <p>Discover our world's #1 Luxury Room For VIP.</p>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

   
    <section class="site-section">
      <div class="container">
        <div class="row">

        @foreach ($rooms as $room)

       

        <div class="col-md-4 mb-4">
            <div class="media d-block room mb-0">
              <figure>
               
                <img src="{{$room->featured_image}}" alt="Generic placeholder image" class="img-fluid">
                <div class="overlap-text">
                  <span>
                    {{$room->category->name}}
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                  </span>
                </div>
              </figure>
              <div class="media-body">
                <h3 class="mt-0"><a href="#">{{$room->name}}</a></h3>
                
                @foreach ($room->roomPrices as $roomPrice)
                <h5>Room Price : {{$roomPrice->price}}</h5>
                
                @endforeach

                <p>{{$room->description}}</p>
                <form action="/booking" method="post">
                @csrf
                <input type="hidden" name="roomType_id" value="{{$room->id}}">
     
                <button type="submit"  class="btn btn-primary btn-sm">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        
        @endforeach
          
  
        </div>
      </div>
      <div class="d-flex justify-content-center">{{$rooms->links('pagination::bootstrap-4')}}</div>
    </section>

    
   
   


    <section class="section-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/img_5.jpg);">
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
    
    @endsection
   
 