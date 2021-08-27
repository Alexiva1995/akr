<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/components.css')}}">
 
<style>
     .main-menu{
        background: url("{{asset('assets/img/sistema/fondo.jpg')}}");
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        /* background-color: linear-gradient(90.09deg, #000000 27.58%, rgba(0, 227, 242, 0.77372) 134.97%, rgba(0, 246, 225, 0.77) 134.98%); */
        opacity: 0.93;
     }
    .bg-gradiente{
        /* position: absolute; */
        width: 100%;
        height: 100%;
        background: linear-gradient(90.09deg, #000000 27.58%, rgba(0, 227, 242, 0.77372) 134.97%, rgba(0, 246, 225, 0.77) 134.98%);
        /* background: linear-gradient(90deg, rgba(0, 246, 225, 0.77) 9.27%, rgba(19, 98, 182, 0.78) 92.53%); */
        opacity: 0.93;
    }
</style>
 
 <!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="bg-gradiente">    
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                @if (!empty($menu))
                @foreach ($menu as $index => $item)
                    @if ($item['submenu'] == 0)
                    <li class=" nav-item">
                        <a href="{{$item['ruta']}}{{$item['complementoruta']}}" target="{{$item['blank']}}">
                            <i class="{{$item['icon']}} text-white"></i>
                            <span class="menu-title text-white" data-i18n="{{$index}}">{{$index}}</span>
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{$item['ruta']}}">
                            <i class="{{$item['icon']}} text-white"></i>
                            <span class="menu-title text-white" data-i18n="{{$index}}">{{$index}}</span>
                        </a>
                        <ul class="menu-content">
                            @foreach ($item['submenus'] as $submenu)
                            <li class="activ">
                                <a href="{{$submenu['ruta']}}{{$submenu['complementoruta']}}" class="text-white" target="{{$submenu['blank']}}">
                                    <i class="feather icon-circle text-white"></i>
                                    <span class="menu-item text-white" data-i18n="{{$submenu['name']}}">{{$submenu['name']}}</span></a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                @endforeach
                @endif
            </ul>
            @if(Auth::user()->id == 1)
            <footer class="site-footer ">
                <div style="text-align:center;">
                    <a class="btn btn-logout" style="margin-top: 295px;" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Cerrar sesión&nbsp;&nbsp;<i class="feather icon-log-out"></i> 
                    </a> 
                </div>
            </footer>
            @else
            <footer class="site-footer ">
                <div style="text-align:center;">
                    <a class="btn btn-logout" style="margin-top: 210px;" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Cerrar sesión&nbsp;&nbsp;<i class="feather icon-log-out"></i> 
                    </a> 
                </div>
            </footer>
            @endif
        </div>
        </div>    
 </div>
<!-- END: Main Menu-->