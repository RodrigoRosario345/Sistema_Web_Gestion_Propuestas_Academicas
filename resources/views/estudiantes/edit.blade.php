<x-layout pagina="estudiantes">
    <x-slot name="title">Registro de Estudiantes</x-slot>
    <x-slot name="overlay_exito"></x-slot>
    <x-slot name="overlay_delete"></x-slot>
    <x-slot name="overlay_desaigned_tema_student"></x-slot>
    <x-slot name="overlay_asigned_tema_student"></x-slot>
    <x-slot name="overlay_approve_profile_tema"></x-slot>
    <x-slot name="overlay_approve_proyect_tema"></x-slot>
    <x-slot name="overlay_tema"></x-slot>
    <x-slot name="overlay"></x-slot>
    @vite(['resources/js/common.js', 'resources/css/app.css', 'resources/css/estudiantes.css'])


    <div class="container_createe">
        <!-- <h1>Editar Estudiante</h1> -->
        <fieldset>
        <legend>Editar Estudiante</legend>
        <form action="{{ route('estudiantes.update', $estudiante->id) }}" method="POST">
            @csrf
            @method('PUT')  
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" value="{{ $estudiante->user->name }}" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" value="{{ $estudiante->user->username }}" name="username" required>
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" class="form-control" id="celular" value="{{ $estudiante->celular }}" name="celular" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña<small class="form-text text-muted" style="color: var(--grey);"> (Dejar vacío si no desea cambiar)</small></label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <select class="form-select" id="curso" name="curso" required>
                    <option value="9" {{ $estudiante->curso == '9' ? 'selected' : '' }}>9</option>
                    <option value="10" {{ $estudiante->curso == '10' ? 'selected' : '' }}>10</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn-crear">Actualizar</button>
            </div>
        </form>
        </fieldset>
    </div>
</x-layout>
