<x-layout pagina="reportes">
    <x-slot name="title">Reporte de Temas Asesor</x-slot>
    <x-slot name="overlay_exito"></x-slot>
    <x-slot name="overlay_delete"></x-slot>
    <x-slot name="overlay_desaigned_tema_student"></x-slot>
    <x-slot name="overlay_asigned_tema_student"></x-slot>
    <x-slot name="overlay_approve_profile_tema"></x-slot>
    <x-slot name="overlay_approve_proyect_tema"></x-slot>
    <x-slot name="overlay_tema"></x-slot>

    <div class="container_estudiantes">
        @can('admin.reportes.Asesor')
        <div style=" display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h1 >Reporte de Temas</h1>
            <a href="{{ route('reportes_pdf', ['tipo' => 'temas']) }}" class="btn-crear" style="width: fit-content; margin-top: 0;">
                <i class="fa-solid fa-download"></i> Descargar Reporte
            </a>
        </div>
        

        <table class="table table-bordered" style="width: 100%; margin-top:1rem;">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Estudiante</th>
                    <th>Estado</th>
                    <th>Modalidad</th>
                    <th>Tutor</th>
                </tr>
            </thead>
            <tbody>
                @if (count($temas) == 0)
                    <tr>
                        <td colspan="5">No hay temas registrados de alguno de sus estudiantes.</td>
                    </tr>
                @endif
                @foreach ($temas as $tema)
                    <tr>
                        <td>{{ $tema->titulo }}</td>
                        <td>{{ $tema->estudiante }}</td>
                        <td>{{ $tema->estado }}</td>
                        <td>{{ $tema->tipo }}</td>
                        <td>{{ $tema->tutor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style=" display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; margin-top:2rem;">
            <h1>Reporte de Temas No Asignados</h1>
            <a href="{{ route('reportes_pdf', ['tipo' => 'no_asignados']) }}" class="btn-crear" style="width: fit-content; margin-top: 0;">
                <i class="fa-solid fa-download"></i> Descargar Reporte
            </a>
        </div>
        <table class="table table-bordered" style="width: 100%; margin-top:1rem;">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Estudiante</th>
                    <th>Estado</th>
                    <th>Modalidad</th>
                    <th>Tutor</th>
                </tr>
            </thead>
            <tbody>
                @if (count($temas_no_asignados) == 0)
                    <tr>
                        <td colspan="5">No hay temas no asignados.</td>
                    </tr>
                @endif
                @foreach($temas_no_asignados as $tema)
                    <tr>
                        <td>{{ $tema->titulo }}</td>
                        <td>{{ $tema->estudiante }}</td>
                        <td>{{ $tema->estado }}</td>
                        <td>{{ $tema->tipo }}</td>
                        <td>{{ $tema->tutor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @endcan

        
        @can('admin.reportes.Admin')
        <div style=" display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; margin-top:2rem;">
            <h1>Reporte de Temas Asignados</h1>
            <a href="{{ route('reportes_pdf', ['tipo' => 'asignados']) }}" class="btn-crear" style="width: fit-content; margin-top: 0;">
                <i class="fa-solid fa-download"></i> Descargar Reporte
            </a>
        </div>
        <table class="table table-bordered" style="width: 100%; margin-top:1rem;">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Estudiante</th>
                    <th>Tutor</th>
                    <th>Asesor</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($temasAsig as $item)
                    @if($item->estado == 'Asignado')
                        <tr>
                            <td>{{ $item->titulo }}</td>
                            <td>{{ $item->estudiante }}</td>
                            <td>{{ $item->tutor}}</td>
                            <td>{{ $item->asesor}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        @endcan

    </div>
</x-layout>
