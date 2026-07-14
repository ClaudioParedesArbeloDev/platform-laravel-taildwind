<?php

use App\Http\Controllers\Auth0ManualController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\SoftwareCheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MyPathController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\LocaleCookie;


Route::post('/checkout/webhook', [CheckoutController::class, 'webhook'])
    ->name('checkout.webhook')
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

Route::get('/locale/{locale}', function ($locale) {
    return redirect()->back()->withCookie('locale', $locale);
});

Route::middleware(LocaleCookie::class)->group(function () {


    Route::get('/', [CoursesController::class, 'home'])
        ->name('home');

    Route::get('/auth0-login', [Auth0ManualController::class, 'login'])->name('auth0-login');
    Route::get('/auth0-callback', [Auth0ManualController::class, 'callback'])->name('auth0-callback');
    
    
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

    Route::get('/dashboard/asistencia', [AttendanceController::class, 'index'])
        ->name('attendance.index')
        ->middleware(['auth', 'is.admin']);


    Route::get('/dashboard/asistencia/{course}', [AttendanceController::class, 'edit'])
        ->name('attendance.edit')
        ->middleware(['auth', 'is.admin']);


    Route::put('/dashboard/asistencia/{course}', [AttendanceController::class, 'update'])
        ->name('attendance.update')
        ->middleware(['auth', 'is.admin']);

    //Routes of blogs
    Route::get('/blogs', [BlogController::class, 'index'])
        ->name('blogs.index');
    
    Route::get('/blogs/create', [BlogController::class, 'create'])
        ->name('blogs.create')->middleware(['auth', 'is.admin']);
    
    Route::post('/blogs', [BlogController::class, 'store'])
        ->name('blogs.store')->middleware(['auth', 'is.admin']);
    
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])
        ->name('blogs.show');
    
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])
        ->name('blogs.edit')->middleware(['auth', 'is.admin']);

    Route::put('/blogs/{blog}', [BlogController::class, 'update'])
        ->name('blogs.update')->middleware(['auth', 'is.admin']);

    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])
        ->name('blogs.destroy')->middleware(['auth', 'is.admin']);

    // Comentarios (ver: todos, comentar: solo logueados)
    Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])
        ->name('comments.store')->middleware('auth');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy')->middleware('auth');

    // Likes estilo YouTube (solo logueados)
    Route::post('/blogs/{blog}/like', [LikeController::class, 'toggleBlog'])
        ->name('blogs.like')->middleware('auth');

    Route::post('/comments/{comment}/like', [LikeController::class, 'toggleComment'])
        ->name('comments.like')->middleware('auth');
    


    //Routes of courses
   Route::get('/courses', [CoursesController::class, 'index'])
        ->name('courses.index')->middleware(['auth', 'is.admin']);
    
    Route::get('/courses/create', [CoursesController::class, 'create'])
        ->name('courses.create')->middleware(['auth', 'is.admin']);
    
    Route::post('/courses', [CoursesController::class, 'store'])
        ->name('courses.store')->middleware(['auth', 'is.admin']);
    
    Route::get('/courses/{id}', [CoursesController::class, 'show'])
        ->name('courses.show')->middleware(['auth', 'is.admin']);
    
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


    //Routes of software
    Route::get('/software', [SoftwareController::class, 'catalog'])
        ->name('software.catalog');

    Route::get('/software/manage', [SoftwareController::class, 'index'])
        ->name('software.index')->middleware(['auth', 'is.admin']);

    Route::get('/software/create', [SoftwareController::class, 'create'])
        ->name('software.create')->middleware(['auth', 'is.admin']);

    Route::post('/software', [SoftwareController::class, 'store'])
        ->name('software.store')->middleware(['auth', 'is.admin']);

    Route::get('/software/{id}', [SoftwareController::class, 'show'])
        ->name('software.show');

    Route::get('/software/{id}/edit', [SoftwareController::class, 'edit'])
        ->name('software.edit')->middleware(['auth', 'is.admin']);

    Route::put('/software/{id}', [SoftwareController::class, 'update'])
        ->name('software.update')->middleware(['auth', 'is.admin']);

    Route::delete('/software/{id}', [SoftwareController::class, 'destroy'])
        ->name('software.destroy')->middleware(['auth', 'is.admin']);

    // Addons (complementos) de un software - solo admin
    Route::post('/software/{softwareId}/addons', [SoftwareController::class, 'storeAddon'])
        ->name('software.addons.store')->middleware(['auth', 'is.admin']);

    Route::delete('/software/{softwareId}/addons/{addonId}', [SoftwareController::class, 'destroyAddon'])
        ->name('software.addons.destroy')->middleware(['auth', 'is.admin']);

    // Checkout de software (Mercado Pago)
    Route::get('/software/{softwareId}/checkout', [SoftwareCheckoutController::class, 'show'])
        ->name('software.checkout.show')->middleware(['auth']);

    Route::post('/software/checkout/process', [SoftwareCheckoutController::class, 'process'])
        ->name('software.checkout.process')->middleware(['auth']);

    Route::get('/software/checkout/success', [SoftwareCheckoutController::class, 'success'])
        ->name('software.checkout.success');

    Route::get('/software/checkout/failure', [SoftwareCheckoutController::class, 'failure'])
        ->name('software.checkout.failure');

    Route::get('/software/checkout/pending', [SoftwareCheckoutController::class, 'pending'])
        ->name('software.checkout.pending');

    // Mis Apps (software comprado por el usuario logueado)
    Route::get('/mis-apps', [SoftwareController::class, 'myPurchases'])
        ->name('software.my')->middleware(['auth']);



    Route::get('/checkout/success', [CheckoutController::class, 'success'])
        ->name('checkout.success');

    Route::get('/checkout/failure', [CheckoutController::class, 'failure'])
        ->name('checkout.failure');

    Route::get('/checkout/pending', [CheckoutController::class, 'pending'])
        ->name('checkout.pending');

    Route::get('/checkout/{courseId}', [CheckoutController::class, 'show'])
        ->name('checkout.show')->middleware('auth');

    Route::post('/checkout/process', [CheckoutController::class, 'process'])
        ->name('checkout.process')->middleware('auth');

    
     //Routes of classes
    Route::get('/dashboard/classes/create', [ClassesController::class, 'create'])
        ->name('classes.create')->middleware(['auth', 'is.admin']);

    Route::post('/dashboard/classes', [ClassesController::class, 'store'])
        ->name('classes.store')->middleware(['auth', 'is.admin']);

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
    Route::get('/forgot-password', function () {return view('auth.email');})->middleware('guest')->name('password.request');

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

    Route::get('/pages/dashboard/admin/ventas', [SalesController::class, 'index'])
        ->name('sales.index')->middleware(['auth', 'is.admin']);

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')->middleware('auth');

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

    Route::delete('/courses/{courseId}/students/{userId}', [CoursesController::class, 'removeStudent'])
        ->name('courses.students.destroy')->middleware(['auth', 'is.admin']);
    
    Route::get('/courses/{course}/classes', [CoursesController::class, 'showClasses'])
        ->name('cursos.classes')->middleware(['auth', 'is.admin']);

    Route::get('/courses/{course}/class', [CoursesController::class, 'showClassesStudents'])
        ->name('cursos.class')->middleware('auth');

    Route::post('/courses/class', [ClassesController::class, 'homework'])
        ->name('cursos.homework')->middleware('auth');

    Route::post('courses/enroll', [CoursesController::class, 'enroll'])
        ->name('courses.enroll');
});