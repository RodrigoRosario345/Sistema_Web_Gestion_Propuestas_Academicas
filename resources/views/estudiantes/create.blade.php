<x-layout pagina="estudiantes">
    <x-slot name="title">Registro de Estudiantes</x-slot>
    <x-slot name="overlay_exito"></x-slot>
    <x-slot name="overlay_delete"></x-slot>
    <x-slot name="overlay_desaigned_tema_student"></x-slot>
    <x-slot name="overlay_asigned_tema_student"></x-slot>
    <x-slot name="overlay_approve_profile_tema"></x-slot>
    <x-slot name="overlay_approve_proyect_tema"></x-slot>
    <x-slot name="overlay_tema"></x-slot>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <x-slot name="overlay"></x-slot>

    <div class="container_createe">
        <!-- <h1>Insertar un Estudiante</h1> -->
        <fieldset>
        <legend>Crear Estudiante</legend>
        <form action="{{ route('estudiantes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <div>
                    <label for="nombre" class="form-label">Nombre</label>
                </div>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <div>
                    <label for="username" class="form-label">Nombre de Usuario</label>
                </div>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <div>
                    <label for="celular" class="form-label">Celular</label>
                </div>
                <input type="text" class="form-control" id="celular" name="celular" required>
            </div>
            <div class="mb-3">
                <div>
                    <label for="password" class="form-label">Contraseña</label>
                </div>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">

                <label for="curso" class="form-label">Curso</label>

                <select class="form-select" id="curso" name="curso" required>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div>
            <button type="submit" class="btn-crear">Guardar</button>
            </div>
        </form>
        </fieldset>

    
</x-layout>