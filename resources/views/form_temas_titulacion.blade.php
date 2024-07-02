@php
    use Illuminate\Support\Facades\Auth;
@endphp
<x-layout pagina="registro_temas">
    <x-slot name="title">Registro Tema de Titulación</x-slot>
    @if(session('exito'))
        <x-slot name="overlay_exito">
            <div class="detail_sucess">
                <div class="close_sucess">
                    <i class="fa-solid fa-xmark close" style="font-size: 2.4rem;" data-overlay-index="1"></i>
                </div>
                <div class="icon_sucess">
                    <i class="fa-solid fa-circle-check sucess" style="color: #73d185;"></i>
                </div>
                <div class="title_sucess">
                    ¡Tema de Titulación<br> 
                    {{ session('exito') }}!
                </div>
            </div>
        </x-slot>
        <script>
            let overlay_detail_exito = document.getElementById('overlay_detail_exito')
            overlay_detail_exito.style.display = 'flex';
        </script>
    @else
        <x-slot name="overlay_exito"></x-slot>
    @endif
    <x-slot name="overlay_delete"></x-slot>
    <x-slot name="overlay_desaigned_tema_student"></x-slot>
    <x-slot name="overlay_asigned_tema_student"></x-slot>
    <x-slot name="overlay_approve_profile_tema"></x-slot>
    <x-slot name="overlay_approve_proyect_tema"></x-slot>
    <x-slot name="overlay_tema"></x-slot>
    <div class="container_formularios">
        <form         
            id="FormTemas"

            @if(isset($tema))
                action="{{ route('tema.update', $tema->id) }}"
            @else
                action="{{ route('tema.store') }}" 
            @endif
            method="POST"
            enctype="multipart/form-data" >
            @if(isset($tema)) @method('PUT') @endif
            @csrf
            <div class="inicio_details">
                <div class="titulo_titulacion">
                    Tema de titulación
                </div>
                <div class="input_fecha">
                    <span>Fecha de registro:</span>
                    <input name="fecha" class="fecha_registro" type="date" id="fecha" value="{{ isset($tema) ? $tema->fecha : '' }}" required>
                </div>
            </div>

            <div class="content_data_documento">
                <fieldset>
                    <legend>Datos del Tema</legend>
                    <div class="detalles_documento">
                        <div class="input-box-documento">
                            <div class="titulo-id label">
                                <span>Título</span>
                            </div>
                            <input name="titulo" type="text" value="{{ isset($tema) ? $tema->titulo : '' }}" placeholder="Escriba aquí el título" required>
                        </div>
                        <div class="label">Problematica</div>
                        <div id="editorProblematica" translate="no" style="min-height: 1.8rem;">{!! isset($tema) ? $tema->problematica : '' !!}</div>
                        <input type="hidden" name="problematica" id="problematicaContent" value="{{ isset($tema) ? $tema->problematica : '' }}" required>

                        <div class="label">Objetivos</div>
                        <div id="editorObjetivos" translate="no">
                            {!! isset($tema) ? $tema->objetivos->pluck('texto')->implode('<br>') : '' !!}
                        </div>
                        <input type="hidden" name="objetivos" id="objetivosContent" value="{{ isset($tema) ? $tema->objetivos->pluck('texto')->implode('<br>') : '' }}" required>
                        
                        <div class="details_carrera_cu">
                            <div class="input-box-documento" style="width: 48%;">
                                <div class="label">Carrera:</div>
                                <select name="carrera_id" >
                                    <option value="Seleccione una carrera" selected disabled hidden>Seleccione una carrera</option>
                                    <option value="1" @selected(isset($tema) && $tema->carrera_id == 1)>Ing. en Ciencias de la Computación</option>
                                    <option value="2" @selected(isset($tema) && $tema->carrera_id == 2)>Ing. en Sistemas</option>
                                    <option value="3" @selected(isset($tema) && $tema->carrera_id == 3)>Ing. en T.I. y Seguridad</option>
                                    <option value="4" @selected(isset($tema) && $tema->carrera_id == 4)>Ing. en Telecomunicaciones</option>
                                    <option value="5" @selected(isset($tema) && $tema->carrera_id == 5)>Ing. en Diseño y Animación</option>
                                </select>
                            </div>
                            <div class="input-box-documento" style="width: 48%;">
                                <div class="label">Modalidad propuesta:</div>
                                <select name="tipo" id="tipo_trabajo" required>
                                    <option value="Seleccione una modalidad de trabajo" selected disabled hidden>Seleccione una modalidad de trabajo</option>
                                    <option value="Tesis de Grado" @selected(isset($tema) && $tema->tipo == 'Tesis de Grado')>Tesis de Grado</option>
                                    <option value="Proyecto de Grado" @selected(isset($tema) && $tema->tipo == 'Proyecto de Grado')>Proyecto de Grado</option>
                                    <option value="Trabajo Dirigido" @selected(isset($tema) && $tema->tipo == 'Trabajo Dirigido')>Trabajo Dirigido</option>
                                </select>
                            </div>
                        </div>
                        <div class="contenedor_files_etiquetas">
                            <div class='titles'>
                                <div class="title_files_labels">
                                    <span style="width:45%">Subir documento</span>
                                    <span style="width:45%">Temáticas</span>
                                </div>
                            </div>
                            <div style="display: flex; width: 100%; align-items: flex-start; gap: 5%"> 
                                <div class="document">
                                    <div class="drag_area">
                                        <div id="input" class="input_section">
                                            <i class="fa-regular fa-file-pdf" style="font-size:4rem; color:var(--grey)"></i>
                                            <button class="button explore" type="button" id="explore">Explorar</button>
                                            <div style="text-align: center; width: 50%;">O arrastre un archivo aqui</div>
                                            <div style="font-size: 0.7rem">(Formato soportado: PDF)</div>
                                            <input type="file" id="file-input" accept=".pdf" style="display: none" name="file">
                                            <input type="text" id="image-input" style="display: none" name="image">
                                            <input type="hidden" id="nombre-archivo" value="{{ isset($tema) ? $tema->documento : '' }}">

                                        </div>
                                        <div class="uploaded_section">
                                            <div class="row">
                                                <img src="{{ url('/') }}/images/page/pdf.png" alt="">
                                                <div class="col">
                                                    <div class="file-name">{{ isset($tema) ? $tema->preview_img : '' }}</div>
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
                                <div class="input-box-etiquetas">
                                    <div class="input-box-etiqueta" style="margin-top: 5px;">
                                        <input name="tematicas" type="hidden" id='input-tematicas'>
                                        <div class="input-tags" id="tematicas">
                                            <input type="text" id="search-tematicas" class="search-tag" autocomplete="off" placeholder="Buscar...">
                                        </div>
                                        <div class="search-results click" id='results-tematicas'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            @can('admin.users')
                <div class="content_data_autoria">
                    <fieldset>
                        <legend>Asignar Tutor del Tema</legend>
                        <div class="container-tutor">
                            <div class="customInputContainer" data-type="tutores">
                                <div class="customInput">
                                    <div class="selectedData">{{ isset($tema) ? $tema->tutor : 'Seleccione un tutor' }}</div>
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                                <div class="options">
                                    <div class="searchInput">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" id="searchInput" placeholder="Buscar...">
                                    </div>
                                    <ul>
                                    </ul>
                                </div>
                            </div>   
                        </div>

                    </fieldset>
                </div>
            @endcan
            <input type="hidden" name="estudiante" id="estudiante" value="{{ isset($tema) ? $tema->estudiante : '' }}">

            <input type="hidden" name="tutor" id="user" value="{{ isset($tema) ? $tema->tutor : Auth::user()->name }}">
      
            <input type="hidden" name="asesor" id="asesor" value="{{ isset($tema) ? $tema->asesor : '' }}">
            <input type="hidden" name="estado" id="estado" value="{{ isset($tema) ? $tema->estado : '' }}">
            <div class="button_enviar">
                <input class="input_enviar" type="submit" value="{{ isset($tema) ? 'Actualizar' : 'Completar Registro' }}">
            </div>
        </form>
    </div>  
</x-layout>
<script src="https://mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>
@vite(['resources/js/form_temas.js'])
<script>
    
    const base_url = "{{ url('/') }}"
    let is_upd = false 
    function updateData(data) {
            let selectedIng = data.innerText
            let selectedData = document.querySelector('.selectedData')
            let customInputContainer = document.querySelector('.customInputContainer')
            let tutor = document.querySelector('#tutor')

            selectedData.innerText = selectedIng
            tutor.value = selectedIng
            
            for (const li of document.querySelectorAll("li.selected")) {
                li.classList.remove("selected");
            }
            data.classList.add('selected')
            customInputContainer.classList.toggle('show')
            console.log(selectedIng);
    }
    function formatDoc(cmd, value = null) {
    if (value) {
        document.execCommand(cmd, false, value);
    } else {
        document.execCommand(cmd);
    }
}
    @if(!isset($tema))
        let fechaInput = document.getElementById('fecha')
        let fecha = new Date()
        fecha = fecha.toISOString().split('T')[0];
        fechaInput.value = fecha

    @else
        is_upd = true 
        tematicas_upd = []
        @foreach ($tematicas as $etiqueta)
            tematicas_upd.push({'id': {{$etiqueta->id}}, 'nombre': '{{$etiqueta->nombre}}'})
        @endforeach
    @endif
</script>