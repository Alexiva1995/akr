@extends('layouts.dashboard')

{{-- vendor css --}}
@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('assets/app-assets/vendors/css/extensions/tether-theme-arrows.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/tether.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('assets/app-assets/vendors/css/extensions/shepherd-theme-default.css')}}">
@endpush

{{-- page css --}}
@push('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/pages/dashboard-analytics.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/pages/card-analytics.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/pages/custom-dashboard.css')}}">
{{-- <link rel="stylesheet" href="{{asset('assets/css/tree.css')}}"> --}}
@endpush

{{-- custom css --}}
@push('custom_css')
<style>
    @media (max-width: 537px) {
        .d-redirection{
            flex-direction: row-reverse;
        }
    }
</style>
@endpush

{{-- page vendor js --}}
@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/tether.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/shepherd.min.js')}}"></script>
@endpush

{{-- page js --}}
@push('page_js')
{{-- <script src="{{asset('assets/app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script> --}}
{{-- <script src="{{asset('assets/app-assets/js/scripts/cards/card-statistics.js')}}"></script> --}}
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
<script src="{{asset('assets/js/librerias/axios.min.js')}}"></script>
@endpush
{{-- custom js --}}
@push('custom_js')
<script src="{{asset('assets/js/dashboard.js')}}"></script>
<script>
    $(document).ready(function () {
      let idrango = parseInt($('#idrango').val())
      console.log(idrango);
      $('.carrusel_rango').slick({
            infinite: true,
            centerMode: true,
            centerPadding: '80px',
            variableWidth: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            touchMove: false,
            initialSlide: (idrango),
            accessibility: false,
            arrows: false,
            responsive: [
              {
                breakpoint: 768,
                settings: {
                  arrows: false,
                  centerMode: true,
                  centerPadding: '40px',
                  slidesToShow: 3
                }
              },
              {
                breakpoint: 480,
                settings: {
                  arrows: false,
                  centerMode: true,
                  centerPadding: '40px',
                  slidesToShow: 1
                }
              }
            ]
          });
  })

  $(".progresscircle").each(function() {
    var value = $(this).attr('data-value');
    console.log("VALUE", value)

    var left = $(this).find('.progress-left .progress-circle');
    var right = $(this).find('.progress-right .progress-circle');

    if (value > 0) {
        if (value <= 50) {
        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
        } else {
        right.css('transform', 'rotate(180deg)')
        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
        }
    }

  })

  function percentageToDegrees(percentage) {
    return percentage / 100 * 360
  }
</script>
@endpush

@section('content')
<section id="dashboard-analytics">
    @if (Auth::user()->admin == 1)
    {{-- Primera Seccion --}}
    @include('dashboard.componente.adminsection')
    {{-- Fin Primera Seccion --}}
    @else
    {{-- Primera Seccion --}}
    @include('dashboard.componente.firstsection')
    {{-- Fin Primera Seccion --}}
    {{-- Segundo Seccion --}}
    {{-- @include('dashboard.componente.secondsection') --}}
    {{-- Fin Segundo Seccion --}}
    {{-- Tercera Seccion --}}
    {{-- @include('dashboard.componente.thirdsection') --}}
    {{-- Fin Tercera Seccion --}}
    @endif

    {{-- link de referido --}}
    @include('layouts.componenteDashboard.linkReferido')
</section>
@endsection
