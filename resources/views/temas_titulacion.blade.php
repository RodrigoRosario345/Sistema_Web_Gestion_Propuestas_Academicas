@php
    use Illuminate\Support\Facades\Auth;
@endphp
<x-layout pagina="temas">
    <x-slot name="title">Temas de Titulación</x-slot>
    <x-slot name="overlay_exito"></x-slot>
    <x-slot name="overlay_delete">
        <div class="detail_sucess">
            <div class="close_sucess">
                <i class="fa-solid fa-xmark close" style="font-size: 2.4rem;" data-overlay-index="2"></i>
            </div>
            <div class="icon_sucess">
                <i class="fa-solid fa-trash-can" style="font-size: 6rem; color:var(--red-tag);"></i>
            </div>
            <div class="title_delete">
                <div style="color: var(--white); font-size: 1.4rem">¿Estás seguro?</div>
                <div style="color: var(--white); font-size: 1.1rem">Estás seguro que quieres eliminar el tema de titulación: </div>
                <div id="title-delete-tema"></div>
            </div>
            <div class="buttons-actions-delete">
                <div class="button-cancel-tema close" data-overlay-index="2">
                    Cancelar
                </div>
                <form action="" method="POST" style="display:inline;" class="eliminar_enlace" id="eliminar_enlace">
                    @csrf
                    @method('DELETE')
                    <button class="button-delete-tema" type="submit">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </x-slot>
    <x-slot name="overlay_desaigned_tema_student">
        <div class="detail_sucess">
            <div class="close_sucess">
                <i class="fa-solid fa-xmark close" style="font-size: 2.4rem;" data-overlay-index="4"></i>
            </div>
            <div class="icon_sucess">
                <i class="fa-solid fa-user-graduate" style="font-size: 6rem; color:var(--red-tag);"></i>
            </div>
            <div class="title_delete">
                <div style="color: var(--white); font-size: 1.4rem">¿Estás seguro?</div>
                <div style="color: var(--white); font-size: 1.1rem">Estás seguro que quieres <span id="clave-action-tema">desasignar de este tema</span> al estudiante: </div>
                <div id="title-estudent-tema" style="color: var(--grey_clear); font-size: 1rem"></div>
            </div>
            <div class="buttons-actions-delete">
                <div class="button-cancel-tema close" data-overlay-index="4">
                    Cancelar
                </div>
                <form action="" method="POST" style="display:inline;"  id="Desasignar_estudiante_enlace">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="estudiante" id="user" value="Ninguno">
                    <input type="hidden" name="estado" id="estado" value="Ninguno">
                    <input type="hidden" name="asesor" id="asesor" value="Ninguno">
                    <button class="button_asigned_student" id="button_asigned_student"  type="submit">
                        Desasignar
                    </button>
                </form>
            </div>
        </div>
    </x-slot>
    <x-slot name="overlay_asigned_tema_student">
        <div class="detail_asigned_student">
            <div class="close-estudent">
                <div class="title">Asignar estudiante</div>
                <i class="fa-solid fa-xmark close" style="font-size: 2.4rem" data-overlay-index="3"></i>
            </div>
            <div class="content_data_autoria">
                <fieldset>
                    <legend>Estudiante</legend>
                    <div class="container-tutor">
                        <div class="customInputContainer" data-type="estudiantes_rol">
                            <div class="customInput">
                                <div class="selectedData">Seleccione un estudiante</div>
                                <i class="fa-solid fa-angle-right"></i>
                            </div>
                            <div class="options">
                                <div class="searchInput">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input type="text" id="searchInput" placeholder="Buscar..." value="">
                                </div>
                                <ul>
                                
                                </ul>
                            </div>
                        </div>   
                    </div>
                </fieldset>
                <form action="" method="POST" style="display:inline;"  id="asignar_estudiante_enlace">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="estudiante" id="user" value="">
                    <input type="hidden" name="estado" id="estado" value="Asignado">
                    <input type="hidden" name="asesor" id="asesor" value="{{ Auth::user()->name }}">
                    <button class="button_asigned_student" type="submit">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </x-slot>
    <x-slot name="overlay_approve_profile_tema">
        <div class="detail_asigned_student">
            <div class="close-estudent">
                <div class="title">Aprobar perfil</div>
                <i class="fa-solid fa-xmark close eliminate-content" style="font-size: 2.4rem" data-overlay-index="5"></i>
            </div>
            <div class="content_data_autoria">
                <fieldset>
                    <legend>Subir PDF</legend>
                    <div class="document" style="width: 16vw; height: 16vw; margin: 1rem 0">
                        <div class="drag_area">
                            <div id="input" class="input_section">
                                <i class="fa-regular fa-file-pdf" style="font-size:3vw; color:var(--grey)"></i>
                                <button class="button explore" type="button" id="explore">Explorar</button>
                                <div style="text-align: center; width: 50%; font-size: 0.8vw">O arrastre un archivo aqui</div>
                                <div style="font-size: 0.7vw">(Formato soportado: PDF)</div>
   
                                <input type="hidden" id="nombre-archivo" value="">
                            </div>
                            <div class="uploaded_section">
                                <div class="row">
                                    <img src="{{ url('/') }}/images/page/pdf.png" alt="">
                                    <div class="col">
                                        <div class="file-name"></div>
                                        <div class="size"></div>
                                    </div>
                                </div>
                                <button class="button explore" type="button" id="other">Elegir otro</button>
                            </div>
                            <div class="message_section">
                                Colocar aquí
                            </div>
                        </div>
                    </div>
                </fieldset>
                <form action="" method="POST" style="display:inline;"  id="perfil_aprobado_enlace" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="estado" id="estado" value="Perfil aprobado">
                    <input type="file" id="file-input" accept=".pdf" style="display: none" name="file">
                    <input type="text" id="image-input" style="display: none" name="image">
                    <button class="button_asigned_student" type="submit">
                        Aprobar
                    </button>
                </form>
            </div>
        </div>
    </x-slot>
    <x-slot name="overlay_approve_proyect_tema">
        <div class="detail_sucess">
            <div class="close_sucess">
                <i class="fa-solid fa-xmark close" style="font-size: 2.4rem;" data-overlay-index="6"></i>
            </div>
            <div class="icon_sucess">
                <i class="fa-solid fa-user-graduate" style="font-size: 6rem; color:var(--red-tag);"></i>
            </div>
            <div class="title_delete">
                <div style="color: var(--white); font-size: 1.4rem">¿Estás seguro?</div>
                <div style="color: var(--white); font-size: 1.1rem">Estás seguro que quieres concluir con el proyecto del estudiante: </div>
                <div id="title-estudent-tema_terminado" style="color: var(--grey_clear); font-size: 1rem"></div>
            </div>
            <div class="buttons-actions-delete">
                <div class="button-cancel-tema close" data-overlay-index="6">
                    Cancelar
                </div>
                <form action="" method="POST" style="display:inline;"  id="proyecto_terminado_enlace">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="estado" id="estado" value="Proyecto terminado">
                    <button class="button_asigned_student" id="button_asigned_student"  type="submit">
                        Concluir
                    </button>
                </form>
            </div>
        </div>
    </x-slot>
    <x-slot name="overlay_tema">
        <div class="tema_details">
            <div style="display: flex; justify-content:space-between; align-items: center; margin-bottom: 0.9rem">
                <div class="title">Detalles del tema de titulación </div>
                <i class="fa-solid fa-xmark close" style="font-size: 2.4rem" data-overlay-index="0"></i>
            </div>

                <div class="detail">
                    <div class="book_content">
                        <div class="metadata">
                            <div id='carrera'>Carrera:</div>
                            <div id='fecha'></div>
                        </div>
                        <div class="book_title" id='title'>
                            Titulo
                        </div>
                            <div class="date-autores-doc">
                                <div class="doc-preview">
                                    <img src="" id='doc-preview'>
                                    <a href="" id='download'><x-button icon="fa-solid fa-eye" color="white" style="position: absolute; bottom: 1rem; right: 1rem; text-align: center"></x-button></a>
                                </div>
                                <div class="data-authors-tema">
                                    <div style="font-size: .9rem">
                                        <div><i class="fa-solid fa-user-graduate" style="color: var(--blue); font-size:0.9rem; margin-right: 0.3rem"></i><span style="color: var(--blue); font-weight: 700">Estudiante Asignado:</span> <span id='autor'></span></div>
                                    </div>
                                    <div style="font-size: .9rem">
                                        <div><i class="fa-solid fa-user" style="color: var(--blue); font-size:0.9rem; margin-right: 0.3rem"></i><span style="color: var(--blue); font-weight: 700">Asesor:</span> <span id='asesor'></span></div>
                                    </div>
                                    <div style="font-size: .9rem">
                                        <div><i class="fa-solid fa-user-tie" style="color: var(--blue); font-size:0.9rem; margin-right: 0.3rem"></i><span style="color: var(--blue); font-weight: 700">Tutor:</span> <span id='tutor'></span></div>
                                    </div>
                                    <div style="font-size: .9rem">
                                        <div><i class="fa-solid fa-book-bookmark" style="color: var(--blue); font-size:0.9rem; margin-right: 0.3rem"></i><span style="color: var(--blue); font-weight: 700">Modalidad propuesta:</span> <span id='tipo'></span></div>
                                    </div>
                                    <div style="font-size: .9rem">
                                        <span style="color: var(--blue); font-weight: 700"><i class="fa-solid fa-file-signature"></i>Temáticas:</span> 
                                        <span id='tematicas'></span>
                                    </div>
                                </div>
                            </div>
                        <div class="subtitle">
                            PROBLEMATICA
                        </div>
                        <div id='problematica' class="paragraphs"></div>
                        <div class="subtitle">
                            OBJETIVOS
                        </div>
                        <div id='objetivos'></div>
                    </div>
                    <div class="buttons-actions">
                        @can('admin.estudiantes.index')
                            <div class="button-asigned-temas">
                                <button class="button_delete-update" id="asignar-tema-estudiante-asesor">
                                    <i class="fa-solid fa-user-graduate" style="color:var(--white);"></i>&nbsp; Asignar estudiante
                                </button>
                                <button class="button_delete-update" id="perfilAprobado-tema-estudiante-asesor">
                                    <i class="fa-solid fa-file-circle-check" style="color:var(--white);"></i>&nbsp; Aprobar perfil
                                </button>
                                <button class="button_delete-update" id="proyectoTerminado-tema-estudiante-asesor">
                                    <i class="fa-solid fa-file-circle-check" style="color:var(--white);"></i>&nbsp; Concluir proyecto
                                </button>
                            </div>
                        @endcan
                        <div style="width: 100%; display: flex; justify-content: flex-end; gap: 1rem" id="buttons">
                            @can('admin.tema.edit')
                                <a href="#" id="editar_enlace" class="button-a">
                                    <button class="button_delete-update" id="editar_enlace">
                                        <i class="fa-solid fa-pen-to-square" style="color:var(--white);"></i> Editar
                                    </button>
                                </a>
                                <button class="button_delete-update" id="eliminar-tema">
                                    <i class="fa-solid fa-trash-can" style="color:var(--red);"></i> Eliminar
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
        </div>
    </x-slot>

    <div class="container_temas">
        <form id="search-form" style="display: flex; flex-direction:column; gap: 10px">
            @csrf
            <div class="search">
                <div class="searchbar">
                    <div style="display: flex; gap: 10px; width: 95%;">
                        <div class="prompts">
                            <div class="prompt" id="text-prompt" style="display:none">
                                <div id='text' style="width:max-content"></div>
                                <div class="circle"><i class="fa-solid fa-xmark" style="font-size: 1rem; color: var(--grey); line-height: 19px"></i></div>
                            </div>
                            <div id='tags-prompts' style="display:flex; gap: 10px"></div>
                        </div>
                        <input type="text" class="search-prompt" style="width: 55vw" placeholder="Buscar...">
                        <input type="hidden" id="text_input" name="texto">
                        <input type="hidden" id="tags_input" name="tags">
                    </div>
                    <i class="fa-solid fa-magnifying-glass search-icon" id="search-button"></i>
                </div>
                <div class="prompt-results">
                    <div id="tags-results" style="display:flex; flex-direction:column;"></div>
                </div>
            </div>
            <div class="filters">
                <div>
                    <div class="filter" style="gap: 0.2rem">
                        <label for="date">Fecha:</label>
                        <div style="font-size: 1.1rem">Del <input class="input_date" type="date" name="fecha_inicio"> al <input class="input_date" type="date" name="fecha_fin"></div>
                    </div>
                </div>
                <div style="display: flex; gap: 1.2rem">
                    <div class="filter">
                        <label for="date">Carrera:</label>
                        <select name="carrera" class="select_carrera">
                            <option value="all">Todas</option>
                            <option value="1">Ing. en Ciencias de la Computación</option>
                            <option value="2">Ing. en Sistemas</option>
                            <option value="3">Ing. en T.I. y Seguridad</option>
                            <option value="4">Ing. en Telecomunicaciones</option>
                            <option value="5">Ing. en Diseño y Animación</option>
                        </select>
                    </div>
                    <div class="filter">
                        <label for="date">Ordenar por:</label>
                        <select name="orden" class="select_carrera">
                            <option value="titulo">Título</option>
                            <option value="fecha" selected>Fecha</option>
                            <option value="carrera_id">Carrera</option>
                            <option value="tutor">Tutor</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <div class="results" id="trabajo_results">
            <div class="title" id="title_retuls">Resultados</div>
            @if(!isset($_GET['etiqueta']) && !isset($_GET['tem']))
            @foreach($temas as $i => $tema)
                @if($i%3 == 0) <div class="row"> @endif
                <x-tema
                    id="{{ $tema->id }}"
                    numeracion="{{ $i+1 }}"
                    logo="{{ $tema->carrera->logo }}"
                    sigla="{{ $tema->carrera->sigla }}"
                    estado="{{ $tema->estado }}"
                    color="{{ $tema->carrera->color }}"
                    date="{{ Helpers::formatDate($tema->fecha) }}"
                    title="{{ $tema->titulo }}"
                    author="{{ $tema->estudiante }}"
                    tutor="{{ $tema->tutor }}"
                    tipo="{{ $tema->tipo}}"
                    >
                </x-tema>
                @if(($i+1)%3 == 0 || $loop->last) </div> @endif
            @endforeach
            @endif
        </div>
    </div>


</x-layout>
<script>
    const base_url = "{{ url('/') }}";
    const hasPermissionAsesor = @json(auth()->user()->hasPermissionTo('admin.estudiantes.index'));
    const hasPermissionAdminTutor = @json(auth()->user()->hasPermissionTo('admin.tema.edit'));
</script>
@vite(['resources/js/temas.js'])
