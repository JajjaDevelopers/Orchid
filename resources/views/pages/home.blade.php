@extends('layouts_front.app')
@section('css')
    <style>
        .swiper-slide img {
            height: 100vh;
            object-fit: cover;
        }

        .swiper-container {
            position: relative;
            z-index: 0;
        }

        .overlay-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 10;
        }
    </style>
@endsection
@section('content')
    <div class="relative overflow-hidden h-screen">
        <!-- Carousel -->
        <div class="swiper h-full w-full">

            <div class="swiper-wrapper">
                @if ($carousel)
                @foreach($carousel->carousel_array as $img)
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="{{ asset($img) }}" class="slide-image" alt="">
                </div>
                @endforeach
                @else
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="{{ asset('images/orchid1.jpg') }}" class="slide-image" alt="">
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <img src="{{ asset('images/orchid2.jpg') }}" class="slide-image"
                        alt="">
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <img src="{{ asset('images/orchid3.jpg') }}" class="slide-image"
                        alt="">
                </div>
                 <!-- Slide 4 -->
                <div class="swiper-slide">
                    <img src="{{ asset('images/orchid4.jpg') }}" class="slide-image"
                        alt="">
                </div>
                @endif
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Navigation -->
            {{-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> --}}

            <!-- Scrollbar -->
            {{-- <div class="swiper-scrollbar"></div> --}}
        </div>

        <!-- Overlay Content -->
        <div class="overlay-content flex flex-col items-center justify-center text-white text-center">
            <h2 class="text-xl tracking-widest">ORCHID USHERS</h2>
            <h1 class="text-5xl font-bold mt-4">
                WHERE <span class="text-purple-500">EXPERIENCE</span><br> MEETS ELEGANCY
            </h1>
            <p class="mt-4 text-lg">Creating unforgettable experience through professionalism and dedication.</p>
            <div class="mt-8 space-x-4">
                <a href="{{route('orchid.contact')}}" class="bg-purple-800 hover:bg-purple-900 text-white font-bold py-2 px-4 rounded-lg">
                    Talk to us!</a>
                <a href="{{route('orchid.aboutus')}}"
                    class="border-2 border-purple-400 hover:border-purple-500 text-white hover:text-purple-500 font-bold py-2 px-4 rounded-lg">Read
                    more</a>
            </div>
        </div>
    </div>
@endsection
