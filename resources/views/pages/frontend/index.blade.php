@extends('layouts.main.layout')


@section('content')


<section class="bannerSec">
    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item{{ $index === 0 ? ' active' : '' }}" data-interval="10000">
@if ($slider->type === 'video')
    <div class="bannerVideo">
        <video autoplay muted loop>
            <source src="{{ asset('public/storage/' . $slider->slider_file) }}" type="video/mp4">
        </video>
    </div>
@elseif ($slider->type === 'image')
    <div class="bannerImg">

        @php
            // Extract readable alt text from file name
            $fileName = pathinfo($slider->slider_file, PATHINFO_FILENAME);
            $cleanAlt = ucwords(str_replace(['-', '_'], ' ', $fileName));

            // Optional: default alt if filename is bad
            if (empty(trim($cleanAlt))) {
                $cleanAlt = 'Slider Image';
            }

            // Detect image size automatically (optional but best SEO)
            $imgPath = public_path('storage/' . $slider->slider_file);
            $imgSize = file_exists($imgPath) ? getimagesize($imgPath) : [1200, 600];
            $imgWidth = $imgSize[0];
            $imgHeight = $imgSize[1];
        @endphp

        <img 
            src="{{ asset('public/storage/' . $slider->slider_file) }}" 
            alt="{{ $cleanAlt }}"
            title="{{ $cleanAlt }}"
            width="{{ $imgWidth }}"
            height="{{ $imgHeight }}"
            loading="lazy"
        >
    </div>
@endif

                    <div class="bnrCaption">
                        <div class="container">
                            <div class="banner-title">{{ $slider->heading }}</div>
                            <div class="banner-subtitle">{{ $slider->content }}</div>
                            <div class="justifyCenter">
                                <a class="dfltBtn" href="{{ $slider->page_url }}">{{ $slider->readmore_label }}</a>
                               
                                    
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<!-- ================ Banner Section End ================ -->

{!! $page->section_one !!}


@endsection
