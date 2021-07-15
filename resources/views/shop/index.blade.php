@extends('layouts.dashboard')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush

@section('content')
<div id="adminServices">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="row">

                        <div class="table-responsive">
                            <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                                <thead class="">
                                    <tr class="text-center text-white bg-purple-alt2">
                                        <th>ID</th>
                                        <th class="d-none d-sm-table-cell">Correo</th>
                                        <th>Paquete</th>
                                        <th class="d-none d-sm-table-cell">Estado</th>
                                        <th class="d-none d-sm-table-cell">Fecha</th>
                                        <th class="d-none d-sm-table-cell">Progreso</th>
                                        <th class="d-none d-sm-table-cell">Ganancia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $categories)
                                    <tr class="text-center">
                                        <td>{{$categories->id}}</td>
                                        <td>{{$categories->email}}</td>
                                        <td>{{$categories->package}}</td>


                                        @if ($categories->status == '0')
                                        <td> <a class=" btn btn-info text-white text-bold-600">Esperando</a></td>
                                        @elseif($categories->status == '1')
                                        <td> <a class=" btn btn-success text-white text-bold-600">Aprobado</a></td>
                                        @elseif($categories->status >= '2')
                                        <td> <a class=" btn btn-danger text-white text-bold-600">Cancelado</a></td>
                                        @endif

                                        <td>{{date('Y-M-d', strtotime($categories->created_at))}}</td>
                                        <td>{{$categories->progreso}}</td>
                                        <td>{{$categories->ganacia}} %</td>

                                    </tr>


                                    @endforeach
                                </tbody>

                        </div>



                    </div>
                </div>
            </div>

            <div class="range-slider">
                <input class="range-slider__range w-50" type="range" value="70" min="0" max="10.000">
                <span class="range-slider__value">0</span>
            </div>

            <style>

/**
 * Fonts
 */

@import url('https://fonts.googleapis.com/icon?family=Material+Icons');
@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap');

/**
 * Reset
 */
*,
*::before,
*::after {
	box-sizing: border-box;
}

html {
	font-family: sans-serif;
	line-height: 1.15;
	-webkit-text-size-adjust: 100%;
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	padding: 0;
	margin: 0;
	-moz-osx-font-smoothing: grayscale;
	-webkit-font-smoothing: antialiased;
}

body {
	-webkit-text-size-adjust: 100%;
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	padding: 0;
	margin: 0;
	-moz-osx-font-smoothing: grayscale;
	-webkit-font-smoothing: antialiased;
	background-color: #f2f2f2;
	color: #1a1a1a;
	font-family: "Source Sans Pro", sans-serif;
	font-size: 1.1rem;
	line-height: 1.5;
}

p,
ol,
ul,
li,
dl,
dt,
dd,
blockquote,
figure,
fieldset,
form,
legend,
textarea,
pre,
iframe,
hr,
h1,
h2,
h3,
h4,
h5,
h6 {
	padding: 0;
	margin: 0;
	-moz-osx-font-smoothing: grayscale;
	-webkit-font-smoothing: antialiased;
}

/**
 * Global Rules
 */
h1,
h2,
h3,
h4,
h5,
h6 {
	color: #0d0d0d;
	font-family: Roboto, sans-serif;
	line-height: 1.2;
	word-wrap: break-word;
}

h1 {
	font-size: 40px;
}

h2 {
	font-size: 32px;
}

a,
a:visited {
	background-color: transparent;
	color: #0067b8;
	text-decoration: none;
	border-bottom: 1px dotted;
}

a:hover,
a:active {
	border-bottom: none;
	outline: 0;
}

a:focus {
	border-bottom: none;
	outline: thin dotted;
}

a img {
	border: 0;
}

.entry-content > *:not(:last-child) {
	margin-bottom: 1rem;
}

footer {
	display: flex;
	align-items: center;
	justify-content: center;
	margin: 2rem;
}

footer .credits {
	font-size: 1rem;
}

/**
 * Article Container
 */
.article-container {
	padding: 2rem;
}

/**
 * Article Block
 */
.article-block {
	text-align: center;
}

.article-block .entry-content > p {
	color: #666;
}

/**
 * Range Slider Container
 */
.range-slider-container {
	padding: 2rem;
}

/**
 * Range Slider Block
 */
.range-slider-block {
	display: flex;
	align-items: center;
	justify-content: center;
}

/**
 * Range Sliders
 */
.range-sliders {
	width: 100%;
	background-color: #fff;
	padding: 1.5rem;
}

.range-sliders > *:not(:last-child) {
	margin-bottom: 1.5rem;
}

.range-sliders input[type=range] {
	width: 100%;
	background: linear-gradient(to right, #f00 0%, #f00 50%, #fff 50%, #fff 100%);
	border-radius: 8px;
	height: 2px;
	outline: none;
	-webkit-appearance: none;
}

.range-sliders input[type=range]:focus {
	outline: none;
}

.range-sliders input[type=range]::-webkit-slider-runnable-track {
	width: 100%;
	height: 1px;
	cursor: pointer;
	box-shadow: none;
	background-color: #e6e6e6;
	border-radius: 0;
}

.range-sliders input[type=range]::-moz-range-track {
	width: 100%;
	height: 1px;
	cursor: pointer;
	box-shadow: none;
	background-color: #ccc;
	border-radius: 0;
}

.range-sliders input[type=range]::-webkit-slider-thumb {
	box-shadow: none;
	height: 30px;
	width: 12px;
	border-color: transparent;
	border-radius: 22px;
	background-color: #999;
	cursor: ew-resize;
	-webkit-appearance: none;
	margin-top: -15px;
}

.range-sliders input[type=range]::-moz-range-thumb {
	box-shadow: none;
	height: 30px;
	width: 12px;
	border-color: transparent;
	border-radius: 22px;
	background-color: #999;
	cursor: ew-resize;
	-webkit-appearance: none;
	margin-top: -15px;
}

.range-sliders input[type=range]::-moz-focus-outer {
	border: 0;
}

.range-sliders input[type=range].range-slider-red {
	background: linear-gradient(to right, #f00 0%, #f00 50%, #fff 50%, #fff 100%);
}

.range-sliders input[type=range].range-slider-red::-webkit-slider-runnable-track {
	background-color: rgba(255, 0, 0, 0.1);
}

.range-sliders input[type=range].range-slider-red::-moz-range-track {
	background-color: rgba(255, 0, 0, 0.1);
}

.range-sliders input[type=range].range-slider-red::-webkit-slider-thumb {
	background-color: #f00;
}

.range-sliders input[type=range].range-slider-red::-moz-range-thumb {
	background-color: #f00;
}

.range-sliders input[type=range].range-slider-green {
	background: linear-gradient(to right, #090 0%, #090 50%, #fff 50%, #fff 100%);
}

.range-sliders input[type=range].range-slider-green::-webkit-slider-runnable-track {
	background-color: rgba(0, 153, 0, 0.1);
}

.range-sliders input[type=range].range-slider-green::-moz-range-track {
	background-color: rgba(0, 153, 0, 0.1);
}

.range-sliders input[type=range].range-slider-green::-webkit-slider-thumb {
	background-color: #090;
}

.range-sliders input[type=range].range-slider-green::-moz-range-thumb {
	background-color: #090;
}

.range-sliders input[type=range].range-slider-blue {
	background: linear-gradient(to right, #00f 0%, #00f 50%, #fff 50%, #fff 100%);
}

.range-sliders input[type=range].range-slider-blue::-webkit-slider-runnable-track {
	background-color: rgba(0, 0, 255, 0.1);
}

.range-sliders input[type=range].range-slider-blue::-moz-range-track {
	background-color: rgba(0, 0, 255, 0.1);
}

.range-sliders input[type=range].range-slider-blue::-webkit-slider-thumb {
	background-color: #00f;
}

.range-sliders input[type=range].range-slider-blue::-moz-range-thumb {
	background-color: #00f;
}

.range-sliders .input-slider {
	border: 1px solid #e6e6e6;
	padding: 0.5rem;
	-moz-appearance: textfield;
}

.range-sliders .input-slider::-webkit-outer-spin-button,
.range-sliders .input-slider::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
}

.range-sliders .range-slider-group {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: space-between;
}

.range-sliders .range-slider-group .range-label {
	width: 100%;
	font-size: 1rem;
	margin-bottom: 0.5rem;
}

.range-sliders .range-slider-group .range-slider {
	width: calc(100% - 60px);
}

.range-sliders .range-slider-group .input-slider {
	width: 45px;
}
@media (min-width: 576px) {

	.range-sliders {
		width: 500px;
		padding: 3rem;
	}
}
@media (min-width: 768px) {

	body {
		font-size: 1.125rem;
	}

	.range-slider-container {
		padding: 4rem 4rem;
	}
}



            </style>

            <script>
           
           //
// HTML Range Slider
//

( function( $ ) {
	// Variables
	const $rangeSlider = $( '#range-sliders .range-slider' );
	const $inputSlider = $( '#range-sliders .input-slider' );

	// Bg Init
	const bgInit = ( $this, val = 0, min = 0, max = 255, color = '#f00' ) => {
		// Background Change
		const valBg = ( val - min ) / ( max - min ) * 100;
		$this.css( 'background', `linear-gradient(to right, ${ color } 0%, ${ color } ${ valBg }%, #fff ${ valBg }%, white 100%)` );
	};

	// Pre Init
	const preInit = () => {
		const rangeSliders = [ 'range-slider-red', 'range-slider-green', 'range-slider-blue' ];
		rangeSliders.forEach( function( key ) {
			// Background Change
			const $this = $( `#${ key }` );
			const val = Number( $this.val() );
			const min = Number( $this.attr( 'min' ) );
			const max = Number( $this.attr( 'max' ) );
			const color = $this.data( 'color' );
			bgInit( $this, val, min, max, color );
		} );
	};

	// Toggle Class
	const init = () => {
		// Slider Range Change or Input
		$rangeSlider.off( 'change input' ).on( 'change input', function( e ) {
			// Prevent Default
			e.preventDefault();
			e.stopPropagation();

			// Background Change
			const $this = $( this );
			const val = Number( $this.val() );
			const min = Number( $this.attr( 'min' ) );
			const max = Number( $this.attr( 'max' ) );
			const color = $this.data( 'color' );
			bgInit( $this, val, min, max, color );

			// Assign value to slider input
			$this.next().val( $( this ).val() );
		} );

		// Input Slider Input
		$inputSlider.off( 'input' ).on( 'input', function( e ) {
			// Prevent Default
			e.preventDefault();
			e.stopPropagation();

			// Background Change
			const $thisInput = $( this );
			let val = Number( $thisInput.val() );
			const min = Number( $thisInput.attr( 'min' ) );
			const max = Number( $thisInput.attr( 'max' ) );
			//const color = $this.data( 'color' );

			// Max Validation
			if ( val > max ) {
				val = max;
				$thisInput.val( val );
			}

			// Min Validation
			if ( val < min ) {
				val = min;
				$thisInput.val( val );
			}

			// Background Change
			const $this = $thisInput.prev();
			const color = $this.data( 'color' );
			bgInit( $this, val, min, max, color );

			// Assign value to slider range.
			$this.val( val );
		} );
	};

	// Document Ready
	$( function() {
		preInit();
		init();
	} );
}( jQuery ) );



            </script>


        </div>

        @endsection