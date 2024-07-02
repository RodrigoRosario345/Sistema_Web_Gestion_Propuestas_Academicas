
<x-layout pagina="docentes">
    <x-slot name="title">Docentes</x-slot>
    <x-slot name="overlay_exito"></x-slot>
    <x-slot name="overlay_delete"></x-slot>
    <x-slot name="overlay_desaigned_tema_student"></x-slot>
    <x-slot name="overlay_asigned_tema_student"></x-slot>
    <x-slot name="overlay_approve_profile_tema"></x-slot>
    <x-slot name="overlay_approve_proyect_tema"></x-slot>
    <x-slot name="overlay_tema"></x-slot>
    <x-slot name="overlay"></x-slot>
    
    <main class="container_formularios">
         
        @yield('content')
        
    </main>
    
</x-layout>