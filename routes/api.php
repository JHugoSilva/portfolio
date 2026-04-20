<?php

// routes/api.php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/teste', function () {
    return response()->json([
        'message' => 'API funcionando 🚀'
    ]);
});

Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::get('profile/{token}', 'getUser')->middleware('auth:sanctum');
        Route::delete('logout/{token}', 'logout')->middleware('auth:sanctum');
    });
});



Route::prefix('site')->group(function () {
    Route::controller(AboutController::class)->group(function () {
        Route::get('about', 'show');
    });

    Route::controller(SkillController::class)->group(function () {
        Route::get('skills', 'index');
    });

    Route::controller(EducationController::class)->group(function () {
        Route::get('educations', 'index');
    });

    Route::controller(ExperienceController::class)->group(function () {
        Route::get('experiences', 'index');
    });

    Route::controller(MediaController::class)->group(function () {
        Route::get('medias', 'index');
    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('services', 'index');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::post('/contato', 'enviarEmail');
    });
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('v1')->group(function () {
        Route::controller(AboutController::class)->group(function () {
            Route::get('about', 'show');
            Route::post('about', 'update');
        });
        Route::controller(MediaController::class)->group(function () {
            Route::post('medias', 'store');
            Route::delete('medias/{media}', 'destroy');
        });
        Route::controller(ServiceController::class)->group(function () {
            Route::get('services', 'index');
            Route::post('services', 'store');
            Route::post('services/{service}', 'update');
            Route::delete('services/{id}', 'destroy');
        });
        Route::controller(SkillController::class)->group(function () {
            Route::get('skills', 'index');
            Route::post('skills', 'store');
            Route::post('skills/{skill}', 'update');
            Route::delete('skills/{skill}', 'destroy');
        });

        Route::controller(EducationController::class)->group(function () {
            Route::get('educations', 'index');
            Route::post('educations', 'store');
            Route::post('educations/{education}', 'update');
            Route::delete('educations/{id}', 'destroy');
        });

        Route::controller(ExperienceController::class)->group(function () {
            Route::get('experiences', 'index');
            Route::post('experiences', 'store');
            Route::post('experiences/{experience}', 'update');
            Route::delete('experiences/{id}', 'destroy');
        });

        Route::controller(ProjectController::class)->group(function () {
            Route::get('projects', 'index');
            Route::get('projects/{project}', 'edit');
            Route::post('projects', 'store');
            Route::post('projects/{project}', 'update');
            Route::delete('projects/{id}', 'destroy');
        });

        Route::controller(TestimonialController::class)->group(function () {
            Route::get('testimonials', 'index');
            Route::get('testimonials/{testimonial}', 'edit');
            Route::post('testimonials', 'store');
            Route::post('testimonials/{testimonial}', 'update');
            Route::delete('testimonials/{id}', 'destroy');
        });

        Route::controller(MessageController::class)->group(function () {
            Route::get('messages', 'index');
            Route::post('messages/{message}', 'changeStatus');
            Route::delete('messages/{id}', 'destroy');

            // Route::get('testimonials/{testimonial}', 'edit');
            // Route::post('testimonials', 'store');
            // Route::post('testimonials/{testimonial}', 'update');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('users', 'index');
            Route::post('users', 'store');
            Route::post('users/{user}', 'update');
            Route::delete('users/{id}', 'destroy');
        });

        Route::controller(DashboardController::class)->group(function () {
            Route::get('dashboard', 'index');
            // Route::post('users', 'store');
            // Route::post('users/{user}', 'update');
            // Route::delete('users/{id}', 'destroy');
        });
    });
});
