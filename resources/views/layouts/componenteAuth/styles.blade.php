<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/vendors.min.css')}}">
@stack('vendor_css')
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/bootstrap-extended.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/components.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/themes/dark-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/themes/semi-dark-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/estilos.css')}}">

@stack('theme_css')

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/core/colors/palette-gradient.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/pages/authentication.css')}}">
@stack('page_css')
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
@stack('custom_css')



<style>
    .bg-full-screen-image-alt {

        background-image: url("{{asset('assets/img/sistema/fondo.jpg')}}"
        );
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
    }
</style>
<!-- END: Custom CSS-->