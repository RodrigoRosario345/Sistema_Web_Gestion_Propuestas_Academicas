<x-layout pagina="estudiantes">
    <x-slot name="title">Registro de Estudiantes</x-slot>
    <x-slot name="overlay_exito"></x-slot>
    <x-slot name="overlay_delete"></x-slot>
    <x-slot name="overlay_desaigned_tema_student"></x-slot>
    <x-slot name="overlay_asigned_tema_student"></x-slot>
    <x-slot name="overlay_approve_profile_tema"></x-slot>
    <x-slot name="overlay_approve_proyect_tema"></x-slot>
    <x-slot name="overlay_tema"></x-slot>

    <div class="container_estudiantes">
        
        <h1>Crear Estudiante</h1>
        <div class="btns_crear">
            <a href="{{ route('estudiantes.create') }}">
                <button type="button" class="btn-crear">Crear Manual</button>
            </a>

            <a>
                <button type="button" class="btn-crear" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    Subir Lista de Estudiantes
                </button>
            </a>

        </div>
        
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true" hidden>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Importar Estudiantes desde Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('estudiantes.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label" style="font-weight: 600;"
                                >Seleccionar archivo Excel (.xlsx o .xls)</label>
                                <input type="file" class="form-control" id="file" name="file" required style="display:none;">
                                <label for="file" class="custom-file-upload">
                                    Seleccionar archivo
                                </label>
                                <span id="file-name">Archivo no seleccionado</span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btne btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btne btn-primary">Subir y Procesar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h1>Lista de Estudiantes</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                    @if ($estudiante->asesor_id == auth()->user()->id)
                        
                <tr>
                    <td>{{ $estudiante->user->name }}</td>
                    <td>{{ $estudiante->user->username }}</td>
                    <td>{{ $estudiante->celular }}</td>
                    <td>{{ $estudiante->curso }}</td>
                    <td>
                      <div class="action-buttons">  
                        <div>
                            <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn2  btn2-primary "">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>

                        <!-- <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="btn btn-primary">
                            <i class="fas fa-eye"></i>
                        </a> -->
                        <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST"  onsubmit="return confirm('¿Estás seguro de eliminar este estudiante?')" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn2 btn-danger2  btn2-primary"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                       </div>  
                    </td>
                </tr>
                    @endif
                 @endforeach
            </tbody>
        </table>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'), {
            keyboard: false});
        });
    </script>    

    <script>
        document.getElementById('file').addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : 'Archivo no seleccionado';
        document.getElementById('file-name').innerText = fileName;
        });
    </script>

</x-layout>
