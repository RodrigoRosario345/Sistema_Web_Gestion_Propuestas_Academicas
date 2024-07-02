<!-- Editar perfil de acuerdo al id -->
<x-layout pagina="perfil">
    <x-slot name="title">Perfil</x-slot>
    <x-slot name="overlay_exito"></x-slot>
    <x-slot name="overlay_delete"></x-slot>
    <x-slot name="overlay_desaigned_tema_student"></x-slot>
    <x-slot name="overlay_asigned_tema_student"></x-slot>
    <x-slot name="overlay_approve_profile_tema"></x-slot>
    <x-slot name="overlay_approve_proyect_tema"></x-slot>
    <x-slot name="overlay_tema"></x-slot>

    <div class="container_estudiantes">
        <h1>Editar Perfil</h1>
        <div class="container_createe" style="padding-left: 0; padding-top: 0;">
        <fieldset>
        <legend>Datos Personales</legend>
        <form action="{{ route('perfil.actualizar', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')  
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" value="{{ $usuario->username }}" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña<small class="form-text text-muted" style="color: var(--grey);"> (Dejar vacío si no desea cambiar)</small></label>
                <input type="password" class="form-control" id="password" name="password">
                
            </div>
            <button type="submit" class="btn-crear" style="width: fit-content;">Actualizar</button>
        </form>
        </fieldset>
    </div>
</x-layout>
