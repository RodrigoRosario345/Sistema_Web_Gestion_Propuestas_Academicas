<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    EstudianteController, EtiquetaController, TemaController, LoginController, UserController, DocenteController
};

// Ruta protegida por el middleware de autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', function () {
        $controller = new TemaController();
        return view('temas_titulacion', ['temas' => $controller->index()]);
    })->name('temas');

    Route::get('/form_temas', function () {
        return view('form_temas_titulacion');
    })->name('form_temas');

    Route::get('/users', function(){
        $userController = new UserController();
        return view('users', ['users' => $userController->index()]);
    })->name('users');

    // Temas
    Route::get('/tema/{id}', [TemaController::class, 'show'])->name('tema.show');
    Route::post('/tema/search', [TemaController::class, 'search'])->name('tema.search');
    Route::post('/tema', [TemaController::class, 'store'])->name('tema.store');
    Route::get('/tema/{id}/edit', [TemaController::class, 'edit'])->name('tema.edit');
    Route::put('/tema/{id}', [TemaController::class, 'update'])->name('tema.update');
    Route::put('/tema/{id}/estado', [TemaController::class, 'asigned_student_tem'])->name('tema.estado');
    Route::delete('/tema/{id}', [TemaController::class, 'destroy'])->name('tema.destroy');

    // Estudiantes
    Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiantes.index');
    Route::post('/estudiantes/import', [EstudianteController::class, 'import'])->name('estudiantes.import');
    Route::resource('estudiantes', EstudianteController::class);
    Route::post('/estudiantes', [EstudianteController::class, 'store'])->name('estudiantes.store');
    Route::put('/estudiantes/{estudiante}', [EstudianteController::class, 'update'])->name('estudiantes.update');
    Route::delete('/estudiantes/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');

    // Etiquetas
    Route::get('/etiqueta/{id}', [EtiquetaController::class, 'show'])->name('etiqueta.show');
    Route::post('/etiqueta/search', [EtiquetaController::class, 'search'])->name('etiqueta.search');

    // Usuarios
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/tutores', [UserController::class, 'tutores'])->name('user.tutores');
    Route::get('/estudiantes_rol', [UserController::class, 'estudiantes'])->name('user.estudiantes');

    // Docente
    Route::get('/docentes', [DocenteController::class, 'index'])->name('docente.index');
    Route::put('/docentes/{docente}/edit', [DocenteController::class, 'update'])->name('docente.update');
    Route::resource('docentes', DocenteController::class);

    // Ruta para mostrar el perfil
    Route::get('/perfil/{id}', [UserController::class, 'mostrarPerfil'])->name('perfil');

    // Ruta para actualizar el perfil
    Route::put('/perfil/{id}', [UserController::class, 'actualizarPerfil'])->name('perfil.actualizar');

    // Reportes Asesor
    Route::get('/reportes', [TemaController::class, 'reportes'])->name('reportes');
    Route::get('reportes_pdf/{tipo}', [TemaController::class, 'generarPDF'])->name('reportes_pdf');
});

// Rutas de autenticación
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'loginVerify'])->name('login.verify');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
