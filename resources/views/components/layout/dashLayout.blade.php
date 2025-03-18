<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://kit.fontawesome.com/718dcffbc3.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/theme.js', 'resources/js/sidebar.js'])
    <title>@yield('title', 'Code & Lens')</title>
</head>
<body>
    <div class="bg-background-100">
        <div class="h-screen flex overflow-hidden bg-background-300">
            <div class="bg-background-500 text-text-700 w-16 min-h-screen flex flex-col justify-between overflow-y-auto transition-all duration-300 ease-in-out" id="sidebar">
                <button class="hidden lg:flex text-text-700 hover:text-accent2-700" id="open-sidebar">
                    <svg class="w-6 h-6 m-4 fill="none" stroke="currentColor" viewBox="0 0 24 24" >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <div class="flex flex-col justify-center items-center">
                    @if (Auth::user()->avatar == null)
                        <img src="{{asset('images/avatar.png')}}" alt="avatar" class="w-16 h-16 m-2 object-cover rounded-full">
                    @else
                        <img src="{{asset('storage/avatars/'.Auth::user()->avatar->avatar)}}" alt="avatar" class="w-16 h-16 m-2 object-cover rounded-full">                    
                    @endif
                    <pre class="sidebar-text hidden font-four text-sm">{{Auth::user()->name}}</pre>
                    <pre class="sidebar-text hidden font-four text-sm">{{Auth::user()->lastname}}</pre>        
                </div>
                <div class="p-4 flex flex-col items-center">
                    <ul class="mt-4 space-y-4">
                        <li>
                            <a href="{{route('dashboard')}}" class="flex items-center space-x-2 hover:text-accent2-700">
                                <span class="material-symbols-outlined">home</span>
                                <span class="sidebar-text hidden">{{__('home')}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('profile.edit')}}" class="flex items-center space-x-2 hover:text-accent2-700 pt-4">
                                <span class="material-symbols-outlined">person</span>
                                <span class="sidebar-text hidden">{{__('profile')}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-2 hover:text-accent2-700 pt-4">
                                <span class="material-symbols-outlined">route</span>
                                <span class="sidebar-text hidden">{{__('my path')}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-2 hover:text-accent2-700 pt-4">
                                <span class="material-symbols-outlined">cast_for_education</span>
                                <span class="sidebar-text hidden">{{__('more courses')}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-2 hover:text-accent2-700 pt-4">
                                <span class="material-symbols-outlined">notifications</span>
                                <span class="sidebar-text hidden">{{__('notifications')}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-2 hover:text-accent2-700 pt-4">
                                <span class="material-symbols-outlined">forum</span>
                                <span class="sidebar-text hidden">{{__('chat')}}</span>
                            </a>
                        </li>
                        @if(Auth::user()->roles->contains('name', 'admin'))
                            <li>
                                <a href="{{route('admin')}}" class="flex items-center space-x-2 hover:text-accent2-700 pt-4">
                                    <span class="material-symbols-outlined">admin_panel_settings</span>
                                    <span class="sidebar-text hidden">{{__('admin')}}</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="#"  onclick= "this.closest('form').submit();" class="flex items-center pt-4 space-x-2 hover:text-accent2-700"">
                                    <span class="material-symbols-outlined">logout</span>
                                    <span class="sidebar-text hidden">{{__('logout')}}</span>
                                </a>
                            </form>
                        </li>
                        
                    </ul>
                    
                </div>
               
                <button id="theme-toggle" class="flex items-center justify-center space-x-2 hover:text-accent2-700" transition-all duration-300">
                    <span id="theme-icon" class="material-symbols-outlined">dark_mode</span>
                    <span class="sidebar-text hidden">Theme Color</span>
                </button>
                <div class="flex justify-center items-center">
                    <img src="{{asset('images/logo.png')}}" alt="logo" class="w-10 h-auto m-2">
                    <h2 class="sidebar-text hidden font-black">Code & Lens</h2>
                </div>
                <div class="flex justify-center gap-x-2 p-1 mb-4 lg:gap-x-4 items-center">
                    <a href="/locale/en"><img src="{{asset('images/england.jpg')}}" alt="England Flag" class="lang hidden w-10 h-auto"></a>
                    <a href="/locale/es"><img src="{{asset('images/spain.jpg')}}" alt="Spain Flag" class="lang hidden w-10 h-auto"></a>
                </div>
               
            </div>
    
            
            <div class="flex-1 flex flex-col overflow-hidden">

                @yield('content')

            </div>
        </div>
    </div>   
</body>
</html>