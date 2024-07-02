<x-layout pagina="usuarios">
    <x-slot name="title">Usuarios</x-slot>
    <x-slot name="overlay_exito"></x-slot>
    <x-slot name="overlay_delete"></x-slot>
    <x-slot name="overlay_desaigned_tema_student"></x-slot>
    <x-slot name="overlay_asigned_tema_student"></x-slot>
    <x-slot name="overlay_approve_profile_tema"></x-slot>
    <x-slot name="overlay_approve_proyect_tema"></x-slot>
    <x-slot name="overlay_tema"></x-slot>
    <div class="container_temas">
        <x-user :users="$users"></x-user> 
    </div>

</x-layout>
<script>
    let base_url = "{{ url('/') }}"
</script>
