<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Fuentes y Estilos -->
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://kit.fontawesome.com/718dcffbc3.js" crossorigin="anonymous"></script>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/theme.js'])


    <title>@yield('title', 'Code & Lens')</title>


</head>


<body class="grid grid-rows-[auto_1fr_auto] min-h-screen  bg-background-100">

    <!-- Header de version Desktop -->
    <header class= "hidden lg:flex bg-background-300 text-text-900 justify-around items-center p-4 h-35">
        <a href="{{route('home')}}">
            <p class="font-two text-xl">Code & Lens</p>
            <p class="font-one text-sm tracking-[10px]">PLATFORM</p>
        </a>

        <!-- Barra de navegación de version Desktop -->
        <nav class= "flex list-none gap-x-10 uppercase">
            <a href="{{route('home')}}" class= "p-2 rounded-md duration-300 ease-out border-transparent border-2 hover:text-accent2-500">
                <li>{{ __('home') }}</li>
            </a>
            <a href="{{route('cursos')}}" class= "p-2 rounded-md duration-300 ease-out border-transparent border-2 hover:text-accent2-500">
                <li>{{ __('courses') }}</li>
            </a>
            <a href="{{route('blogs.index')}}" class= "p-2 rounded-md duration-300 ease-out border-transparent border-2 hover:text-accent2-500">
                <li>{{ __('Blog') }}</li>
            </a>
            <a href="{{route('about')}}" class= "p-2 rounded-md duration-300 ease-out border-transparent border-2 hover:text-accent2-500">
                <li>{{ __('about') }}</li>
            </a>
            <a href="" class= "p-2 rounded-md duration-300 ease-out border-transparent border-2 hover:text-accent2-500">
                <li>{{ __('contact') }}</li>
            </a>
        </nav>
        
        <!-- Botón de Login -->
        <div class= "flex gap-x-10 items-center">
            @guest
                <a href="{{route('login')}}" class= "flex p-2 rounded-md duration-300 ease-out border-transparent border-2 hover:text-accent2-500">
                    <i class="fa-solid fa-user"></i>
                    <p class="ml-2">{{ __('Log in') }}</p> 
                </a>
            @endguest
            @auth
                <a href="/dashboard">
                    <div class="flex flex-col justify-center items-center">
                        @if (Auth::user()->avatar == null)
                            <img src="{{asset('images/avatar.png')}}" alt="avatar" class="w-10 h-10 m-2 object-cover rounded-full">
                        @else
                            <img src="{{asset('storage/avatars/'.Auth::user()->avatar->avatar)}}" alt="avatar" class="w-10 h-10 m-2 object-cover rounded-full">                    
                        @endif
                        <pre class="font-four text-sm">{{Auth::user()->name}}</pre>
                        <pre class="font-four text-sm">{{Auth::user()->lastname}}</pre>        
                    </div>
                </a>
            @endauth

            <!-- Boton de toggle de tema -->
            <button id="theme-toggle" class="p-2 border rounded border-none bg-transparent cursor-pointer hover:bg-transparent hover:text-yellow-500 transition-all duration-300">
                <span id="theme-icon" class="material-symbols-outlined">dark_mode</span>
            </button>
        </div>      
    </header>

    <!-- Header de version Mobile -->
    <div class="flex justify-between items-center bg-background-300 text-text-900 p-4 lg:hidden">
        <a href="{{route('home')}}">
            <p class="font-two text-md">Code & Lens</p>
            <p class="font-one text-xs tracking-[7px]">PLATFORM</p>
        </a>

        <!-- Ícono del menú hamburguesa -->
        <i class="fa-solid fa-bars cursor-pointer" id="menu-toggle"></i>

        <!-- Menú móvil (oculto por defecto) -->
        <div id="mobile-menu" class="fixed inset-0 p-8 bg-text-700 bg-opacity-90 transform translate-x-full transition-transform duration-300 flex flex-col items-end justify-center space-y-4">
            <button id="menu-close" class="bg-trasparent text-3xl text-background-100 rounded">
                <i class="fa-solid fa-xmark"></i>
            </button>
            
           

            <!-- Opciones del menú -->
            @guest
                <a href="{{route('login')}}" class= "flex rounded-md duration-300 ease-out text-background-100">
                    <i class="fa-solid fa-user"></i>
                    <p class="ml-2">{{ __('Log in') }}</p>
                </a>
            @endguest
            @auth
                <a href="/dashboard">
                    <div class="flex flex-col justify-center items-center">
                        @if (Auth::user()->avatar == null)
                            <img src="{{asset('images/avatars/avatar.png')}}" alt="avatar" class="w-10 h-10 m-2 object-cover rounded-full">
                        @else
                            <img src="{{asset('storage/avatars/'.Auth::user()->avatar->avatar)}}" alt="avatar" class="w-20 h-20 m-2 object-cover rounded-full">                    
                        @endif
                        <pre class="font-four text-text-200 text-sm">{{Auth::user()->name}}</pre>
                        <pre class="font-four text-text-200 text-sm">{{Auth::user()->lastname}}</pre>        
                    </div>
                </a>
            @endauth

            <nav class= "flex flex-col list-none text-end  uppercase">
                <a href="{{route('home')}}" class= "text-background-100 pt-4 pb-4">
                    <li>{{ __('home') }}</li>
                </a>
                <a href="{{route('cursos')}}" class= "text-background-100 pt-4 pb-4">
                    <li>{{ __('courses') }}</li>
                </a>
                <a href="{{route('blogs.index')}}" class= "text-background-100 pt-4 pb-4">
                    <li>{{ __('Blog') }}</li>
                </a>
                <a href="{{route('about')}}" class= "text-background-100 pt-4 pb-4">
                    <li>{{ __('about') }}</li>
                </a>
                <a href="" class= "text-background-100 pt-4 pb-4">
                    <li>{{ __('contact') }}</li>
                </a>
            </nav>
            <div class="flex items-center pt-2 pb-2">
                <img src="images/logo.png" alt="" class= "w-6 h-6 m-4">
                <div class="flex flex-col">
                    <p class="font-two text-text-300 text-xl">Code & Lens</p>
                    <p class="font-one text-text-300 text-sm tracking-[10px]">PLATFORM</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Insertar contenido de la pagina -->
    @yield('content')

    
    <!-- Footer -->
    <footer class="grid grid-cols-3 bg-background-300 lg:p-8 h-30 items-center">
        <div class="flex gap-x-2 p-1 lg:gap-x-4 items-center">
            <a href="/locale/en"><img src="{{asset('images/england.jpg')}}" alt="England Flag" class="w-10 h-auto"></a>
            <a href="/locale/es"><img src="{{asset('images/spain.jpg')}}" alt="Spain Flag" class="w-10 h-auto"></a>
        </div>
        <p class="font-one text-text-700 text-xs lg:text-sm">Copyright &copy; {{ date('Y') }} Code & Lens Platform</p>
        <div class="flex p-4 flex-wrap justify-center">
            <a href="https://www.linkedin.com/in/claudioparedesarbelo/" target="blank" class="text-md lg:text-3xl p-2 text-text-700 hover:text-accent2-500" ><i
                    class="fa-brands fa-linkedin-in"></i></a>
            <a href="https://github.com/ClaudioParedesArbeloDev" target="blank" class="text-md lg:text-3xl p-2 text-text-700 hover:text-accent2-500" ><i
                    class="fa-brands fa-github"></i></a>
            <a href="https://www.instagram.com/claudioparedesdeveloper/" target="blank" class="text-md lg:text-3xl p-2 text-text-700 hover:text-accent2-500" ><i
                    class="fa-brands fa-instagram"></i></a>
            <a href="https://x.com/ClaudioPDev" target="blank" class="text-md lg:text-3xl p-2 text-text-700 hover:text-accent2-500" ><i
                    class="fa-brands fa-x-twitter"></i></a>
            <a href="https://www.youtube.com/@ClaudioParedesDeveloper" target="blank" class="text-md lg:text-3xl p-2 text-text-700 hover:text-accent2-500" ><i
                    class="fa-brands fa-youtube"></i></a>
        </div>
    </footer>
</body>
</html>
