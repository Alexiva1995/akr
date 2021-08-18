 <!-- BEGIN: Main Menu-->
 <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow bg-purple-alt" data-scroll-to-active="true">
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main bg-purple-alt" id="main-menu-navigation" data-menu="menu-navigation">
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
                    <ul class="menu-content bg-purple-alt">
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
    </div>
</div>
<!-- END: Main Menu-->