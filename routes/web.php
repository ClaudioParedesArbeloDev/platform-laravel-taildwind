<?php


/* use Illuminate\Support\Facades\Auth; */
use Illuminate\Support\Facades\Route;
/* use Illuminate\Support\Facades\Mail; */


use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MyPathController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\LocaleCookie;

/* use App\Http\Middleware\IsAdmin;
use App\Mail\ContactMailable;
use App\Mail\HomeworkLinkUpdated; */



Route::get('/locale/{locale}', function ($locale) {
    return redirect()->back()->withCookie('locale', $locale);
});


Route::middleware(LocaleCookie::class)->group(function () {


    Route::get('/', [CoursesController::class, 'home'])
        ->name('home');


    
    //Routes of users
    Route::get('/users', [UsersController::class, 'index'])
        ->name('users.index')->middleware(['auth', 'is.admin']);
    
    Route::get('/users/create', [UsersController::class, 'create'])
        ->name('users.create');
    
    Route::post('/users', [UsersController::class, 'store'])
        ->name('users.store');
    
    Route::get('/users/{id}', [UsersController::class, 'show'])
        ->name('users.show')->middleware(['auth', 'is.admin']);
    
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])
        ->name('users.edit')->middleware(['auth', 'is.admin']);

    Route::put('/users/{id}', [UsersController::class, 'update'])
        ->name('users.update')->middleware(['auth', 'is.admin']);

    Route::delete('/users/{id}', [UsersController::class, 'destroy'])
        ->name('users.destroy')->middleware(['auth', 'is.admin']); 



    //Routes of blogs
    Route::get('/blogs', [BlogController::class, 'index'])
        ->name('blogs.index');
    
    Route::get('/blogs/create', [BlogController::class, 'create'])
        ->name('blogs.create')->middleware(['auth', 'is.admin']);
    
    Route::post('/blogs', [BlogController::class, 'store'])
        ->name('blogs.store')->middleware(['auth', 'is.admin']);
    
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])
        ->name('blogs.show');
    
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])
        ->name('blogs.edit')->middleware(['auth', 'is.admin']);

    Route::put('/blogs/{id}', [BlogController::class, 'update'])
        ->name('blogs.update')->middleware(['auth', 'is.admin']);

    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])
        ->name('blogs.destroy')->middleware(['auth', 'is.admin']);
    


    //Routes of courses
   Route::get('/courses', [CoursesController::class, 'index'])
        ->name('courses.index');
    
    Route::get('/courses/create', [CoursesController::class, 'create'])
        ->name('courses.create')->middleware(['auth', 'is.admin']);
    
    Route::post('/courses', [CoursesController::class, 'store'])
        ->name('courses.store')->middleware(['auth', 'is.admin']);
    
    Route::get('/courses/{id}', [CoursesController::class, 'show'])
        ->name('courses.show');
    
    Route::get('/courses/{id}/edit', [CoursesController::class, 'edit'])
        ->name('courses.edit')->middleware(['auth', 'is.admin']);

    Route::put('/courses/{id}', [CoursesController::class, 'update'])
        ->name('courses.update')->middleware(['auth', 'is.admin']);

    Route::delete('/courses/{id}', [CoursesController::class, 'destroy'])
        ->name('courses.destroy')->middleware(['auth', 'is.admin']);

    Route::get('/cursos', [CoursesController::class, 'cursos'])
        ->name('cursos');

    Route::get('/cursos/{id}', [CoursesController::class, 'cursoDetail'])
        ->name('cursos.detail');


    
     //Routes of classes
    Route::get('/dashboard/classes', [ClassesController::class, 'index'])
        ->name('classes.index')->middleware('auth');

    Route::get('/dashboard/classes/create', [ClassesController::class, 'create'])
        ->name('classes.create')->middleware(['auth', 'is.admin']);

    Route::post('/dashboard/classes', [ClassesController::class, 'store'])
        ->name('classes.store')->middleware(['auth', 'is.admin']);

    Route::get('/dashboard/classes/{id}', [ClassesController::class, 'show'])
        ->name('classes.show')->middleware('auth');

    Route::get('/dashboard/classes/{id}/edit', [ClassesController::class, 'edit'])
        ->name('classes.edit')->middleware(['auth', 'is.admin']);

    Route::put('/dashboard/classes/{id}', [ClassesController::class, 'update'])
        ->name('classes.update')->middleware(['auth', 'is.admin']);

    Route::delete('/dashboard/classes/{id}', [ClassesController::class, 'destroy'])
        ->name('classes.destroy')->middleware(['auth', 'is.admin']);
    

        
    //Route of logins


    Route::get('/login', [LoginController::class, 'login'])
        ->name('login')->middleware('guest');
    
    Route::post('login', [LoginController::class, 'store'])
        ->name('login.store');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::get('/register', [LoginController::class, 'register'])
        ->name('register')->middleware('guest');
    
    Route::get('/check-username', [UsersController::class, 'checkUsername'])
        ->name('check-username');



    //Routes of home
    Route::get('/about', [AboutUsController::class, 'index'])
        ->name('about');

   Route::get('/contact', [ContactController::class, 'index'])
        ->name('contact.index');

    Route::post('/contact', [ContactController::class, 'store'])
        ->name('contact.store');

    Route::get('/success', function () {return view('pages.success');
        })->name('success');
        
        

    //Routes Password Reset
    Route::get('/forgot-password', function () {return view('auth.email');})
        ->middleware('guest')->name('password.request');

    Route::post('/forgot-password', [ResetPasswordController::class, 'send'])
        ->middleware('guest')->name('password.email');
    
    Route::get('/reset-password/{token}', function (string $token) {
            return view('auth.reset', ['token' => $token]);
        })->middleware('guest')->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->middleware('guest')->name('password.update');



    //Routes of dashboard
    Route::get('/pages/dashboard/admin', [AdminController::class, 'index'])
        ->name('admin')->middleware(['auth', 'is.admin']);

    Route::view('dashboard', 'pages.dashboard.home')->middleware('auth')
        ->name('dashboard');

    Route::get('/dashboard/perfil', [ProfileController::class, 'edit'])
        ->name('profile.edit')->middleware('auth');
    
    Route::put('/dashboard/update', [ProfileController::class, 'update'])
        ->name('profile.update')->middleware('auth');

    Route::get('/dashboard/cursos', [CoursesController::class, 'cursosDashboard'])
        ->name('dashboard.cursos')->middleware('auth');

    Route::get('/dashboard/mypath', [MyPathController::class, 'index'])
        ->name('dashboard.mypath')->middleware('auth');
    
    Route::get('/dashboard/{course}/students', [CoursesController::class, 'showStudents'])
        ->name('cursos.students')->middleware(['auth', 'is.admin']);

    Route::put('/courses/{courseId}/students/{userId}/status', [CoursesController::class, 'updateStatus'])
        ->name('courses.updateStatus')->middleware(['auth', 'is.admin']);
    
    Route::get('/courses/{course}/classes', [CoursesController::class, 'showClasses'])
        ->name('cursos.classes')->middleware(['auth', 'is.admin']);

    Route::get('/courses/{course}/class', [CoursesController::class, 'showClassesStudents'])
        ->name('cursos.class')->middleware('auth');

    Route::post('/courses/class', [ClassesController::class, 'homework'])
        ->name('cursos.homework')->middleware('auth');

    Route::post('courses/enroll', [CoursesController::class, 'enroll'])
        ->name('courses.enroll');
});


