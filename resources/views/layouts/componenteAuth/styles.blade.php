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
        background: url("{{asset('assets/img/sistema/fondo.jpg')}}");
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0px;
        top: 0px;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        opacity: 0.93;

        background-image: url("{{asset('assets/img/sistema/fondo.jpg')}}"
        );
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    }


    /*===============*/
    /*ESTILOS DEL REGISTER*/
    /*================*/
    .infor {
        margin-top: 25%;
    }

    input:focus~.floating-label,
    input:not(:focus):valid~.floating-label {
        top: 3px;
        bottom: 100px;
        left: 20px;
        font-size: 11px;
        opacity: 1;
    }



    .floating-label {
        position: absolute;
        pointer-events: none;
        left: 20px;
        top: 18px;
        transition: 0.2s ease all;
        color: white;
    }

    #age {
        background-color: rgba(0, 0, 0, 0.3);
        background-color: transparent;
    }


    .cardd {
        background: rgba(0, 0, 0, 0.75);
        border: 1px solid #000000;
        box-sizing: border-box;
        border-radius: 11px;
        margin-top: 10%;
        margin-bottom: 10%;
    }

    #country {
        color: red;
    }

    @media (max-width: 600px) {
        .container {
            max-width: 100%;
            flex: 0 1 100%;
        }
    }


    @media (max-width: 999px) {
        .floating-label {
            max-width: 100%;
            flex: 0 1 100%;
            font-size: 8px;
        }
    }



    .container {

        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
</style>
<!-- END: Custom CSS-->