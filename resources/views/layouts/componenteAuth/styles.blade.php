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
        /* background: url("{{asset('assets/img/sistema/fondo-iniciar-sesion.png')}}"); */
        /* background-size: 100% 60%;*/

        position: absolute;
        width: 100%;
        height: 100%;
        left: 0px;
        top: 0px;
        background: url("{{asset('assets/img/sistema/fondo.jpg')}}");
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;


        /* background: linear-gradient(90.09deg, #000000 27.58%, rgba(0, 227, 242, 0.77372) 134.97%, rgba(0, 246, 225, 0.77) 134.98%); */
        opacity: 0.93;


    }
    @media only screen and (max-width: 767px) {
  body {
    background: url("{{asset('assets/img/sistema/fondo.jpg')}}");
  }
}



    /* @media screen and (max-width: 600px){
        .card-margin{
            margin: 0px 30px;
        }
    }

    .app-content.content{
        overflow-y: scroll !important;
    } */
</style>
<!-- END: Custom CSS-->