<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PembelianController;

Route::group(['prefix' => ''], function () {
    Route::get('/', fn () => view('home.home'));
    Route::get('/about', fn () => view('home.about'));

    Route::get('/galeri', fn () => view('home.galeri.galeri'));
    Route::get('/galeri1', fn () => view('home.galeri.galeri1'));
    Route::get('/galeri2', fn () => view('home.galeri.galeri2'));
    Route::get('/galeri3', fn () => view('home.galeri.galeri3'));

    Route::get('/blog', fn () => view('home.blog'));

    Route::get('/contact', fn () => view('home.contact'));

    Route::get('/chart', fn() => view('home.sentra.addchart'));
    Route::get('/cekout', fn() => view('home.sentra.cekout'));
    Route::get('/sentra', fn () => view('home.sentra.sentra'));
    Route::get('/sentra1', fn () => view('home.sentra.sentra1'));
    Route::get('/sentra2', fn () => view('home.sentra.sentra2'));


    Route::get('/admin1', function () {
        return view('admin.index');
    });
    Route::get('/artikel-admin', function () {
        return view('admin.artikel');
    });
    Route::get('/sentra11', function () {
        return view('home.sentra11');
    });

});

Route::middleware(['guest'])->group(function () {
    Route::get('/regist', [UserRegisterController::class, 'showRegistration'])->name('register');
    Route::post('/regist', [UserRegisterController::class, 'register'])->name('register.process');
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
});
Route::middleware(['auth', 'akses:user'])->group(function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/sentra',[PembelianController::class,'sentra'])->name('sentra');
        Route::post('/contact', [UserDataController::class, 'contact'])->name('contact');
        Route::get('/my-profile', [UserDataController::class, 'showUserData'])->name('profile.show');
        Route::get('/my-profile/edit', [UserDataController::class, 'editUserData'])->name('profile.edit')->middleware(['auth', 'akses:user']);
        Route::patch('/my-profile/edit', [UserDataController::class, 'update'])->name('profile.update')->middleware(['auth', 'akses:user']);
        Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('change.password.form');
        Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change.password');
    });
});

Route::get('/logout', [SesiController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'akses:admin'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        // Route::get("/admin", [AdminController::class, "tampilanAdmin"])->name('admin')->middleware(['auth', 'akses:admin']);
        Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
        Route::delete('/user-result/{editusertesdata}', [AdminController::class, 'historyDestroy'])->name('admin.userresult.destroy')->middleware(['auth', 'akses:admin']);
        Route::get("/user-profile", [AdminController::class, "showUser"])->name('admin.userprofile')->middleware(['auth', 'akses:admin']);
        Route::get("/user-profile/add-user", [AdminController::class, "showAddUser"])->name('admin.adduser')->middleware(['auth', 'akses:admin']);
        Route::post("/user-profile/add-user", [AdminController::class, "addUser"])->name('admin.adduser')->middleware(['auth', 'akses:admin']);
        Route::delete('/user-profile/{userdestroy}', [AdminController::class, 'userDestroy'])->name('admin.userprofile.destroy')->middleware(['auth', 'akses:admin']);
        Route::get('/profile', [AdminController::class, 'showProfile'])->name('admin.profile')->middleware(['auth', 'akses:admin']);
        Route::get("/dat-reg-asesmen/delete/{idasesi}", [AdminController::class, "AsesmenDeleteAll"])->name('admin.datregasesmen.delete')->middleware(['auth', 'akses:admin']);
        Route::get("/dat-reg-asesi/{idasesi}", [AdminController::class, "showRegAsesi"])->name('admin.datregasesi')->middleware(['auth', 'akses:admin']);
        Route::post('/dat-reg-asesi/store', [AdminController::class, 'storeDatRegAsesi'])->name('admin.datregasesi.store')->middleware(['auth', 'akses:admin']);


    });
});

Route::get('password/forgot', [ForgotPasswordController::class, 'showForgotForm'])->name('password.forgot');
Route::post('password/forgot', [ForgotPasswordController::class, 'forgotPassword'])->name('password.forgot.submit');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.reset.submit');
