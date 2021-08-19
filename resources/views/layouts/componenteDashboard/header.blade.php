
<style>
    .navbar{
        background-color: #121212
    }
</style>
{{-- navbar navbar-with-menu floating-nav navbar-light navbar-shadow --}}
<nav id="navbar_top" class="navbar navbar-expand-lg navbar-floating footer-static">
    <a class="navbar-brand ml-4" href={{route('home')}}><img src="{{asset('assets/Diseño/DreamsBlue.svg')}}" alt="hola"></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="dropdown dropdown-user nav-item">
                <a class="dropdown-toggle nav-link dropdown-user-link d-flex" href="#" data-toggle="dropdown">
                    @if (Auth::user()->photoDB != NULL)
                        <span>
                            <img class="rounded-circle" src="{{asset('storage/'.Auth::user()->photoDB)}}"alt="" height="25" width="25">
                            &nbsp;
                        </span>
                    @else
                        <span>                        
                            <img class="round" src="{{asset('assets/img/sistema/favicon.png')}}"
                                alt="{{ Auth::user()->fullname }}" height="25" width="25">
                                &nbsp;
                        </span>
                    @endif 
                    <div class="user-nav d-sm-flex d-none">
                        @if (Auth()->user()->admin == '1')
                            <span class="user-name text-white m-auto">{{Auth::user()->fullname}} <span class="text-white text-bold-600">ADMIN</span></span>
                        @else
                            <span class="user-name text-white m-auto">{{Auth::user()->fullname}}</span>
                        @endif
                    </div>                       
                </a>
                @if (session('impersonated_by'))
                    <div class="dropdown-menu dropdown-menu-right">                
                        <a class="dropdown-item" href="{{ route('impersonate.stop') }}">
                            <i class="feather icon-log-in"></i> Volver a mi Usuario
                        </a>    
                    </div>
                @endif                                

            </li>
        </ul>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function(){
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            document.getElementById('navbar_top').classList.add('fixed-top');
            // add padding top to show content behind navbar
            navbar_height = document.querySelector('.navbar').offsetHeight;
            document.body.style.paddingTop = navbar_height + 'px';
        } else {
            document.getElementById('navbar_top').classList.remove('fixed-top');
            // remove padding top from body
            document.body.style.paddingTop = '0';
        } 
    });
    });  
</script>