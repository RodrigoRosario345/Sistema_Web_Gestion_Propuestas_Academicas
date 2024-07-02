import { showOverlay, createElement, formatDate, pxToVw, initializePopup, inicializeFunctionalidadPDF } from './common'

async function getTema(id) {
    const response = await fetch(`${base_url}/tema/${id}`)
    const data = await response.json();
    createDetails(data)
}

function adjustTags(tags, type) {
    if (type != 'any') {
        tags = tags.filter(tag => tag.tipo == type)
    }
    let tag_string = ''
    tags.forEach((tag, i) => {
        tag_string += tag.nombre
        if (i + 1 != tags.length) {
            tag_string += ', '
        }
    })
    return tag_string
}

function adjustObjetivos(objetivos) {



    // Crear un div temporal para alojar el HTML
    let tempDiv = document.createElement('div');
    tempDiv.innerHTML = objetivos;

    if (tempDiv.querySelector('ul') === null && tempDiv.querySelector('ol') === null) {
        let divObjetivos = document.getElementById('objetivos');
        divObjetivos.innerHTML = objetivos;
        return;
    }

    // Obtener la lista
    let lista = tempDiv.querySelector('ul') || tempDiv.querySelector('ol');
    let listStyleType = lista.style.listStyleType;
    let nuevaLista;
    if (lista.tagName === 'UL') {
        nuevaLista = document.createElement('ul');
        nuevaLista.style.listStyleType = listStyleType;
    } else if (lista.tagName === 'OL') {
        nuevaLista = document.createElement('ol');
        nuevaLista.style.listStyleType = listStyleType;
    }

    // let estilosLista = lista.getAttribute('style');
    // console.log(estilosLista);
    let elementosLista = lista.querySelectorAll('li');
    elementosLista.forEach(function (elemento) {
        let nuevoElemento = document.createElement('li');
        let textoLimpio = elemento.textContent;
        nuevoElemento.textContent = textoLimpio;

        let estilosElemento = elemento.getAttribute('style');
        if (estilosElemento) {
            // estilosElemento += estilosLista ? ` ${estilosLista}` : '';
            nuevoElemento.setAttribute('style', estilosElemento);
        }

        nuevaLista.appendChild(nuevoElemento);
    });

    let divObjetivos = document.getElementById('objetivos');
    divObjetivos.appendChild(nuevaLista);
}
function createDetails(data) {
    // Establecer la acción del enlace de eliminar


    if (hasPermissionAsesor) {
        console.log(data.estado);
        let asignarTema = document.getElementById('asignar-tema-estudiante-asesor');
        let aprobarPerfilTema = document.getElementById('perfilAprobado-tema-estudiante-asesor');
        let aprobarProyectoTema = document.getElementById('proyectoTerminado-tema-estudiante-asesor');

        // Eliminar manejadores de eventos previos
        asignarTema.replaceWith(asignarTema.cloneNode(true));
        asignarTema = document.getElementById('asignar-tema-estudiante-asesor');
        aprobarPerfilTema.replaceWith(aprobarPerfilTema.cloneNode(true));
        aprobarPerfilTema = document.getElementById('perfilAprobado-tema-estudiante-asesor');
        aprobarProyectoTema.replaceWith(aprobarProyectoTema.cloneNode(true));
        aprobarProyectoTema = document.getElementById('proyectoTerminado-tema-estudiante-asesor');

        //data.estado = 'Proyecto terminado' || 'Perfil aprobado' || 'Asignado' || 'Ninguno'

        if (data.estado == 'Ninguno') {
            aprobarPerfilTema.style.display = 'none';
            aprobarProyectoTema.style.display = 'none';
            asignarTema.style.display = 'flex';
            asignarTema.innerHTML = '<i class="fa-solid fa-user-graduate"></i> Asignar estudiante';
            document.getElementById('asignar_estudiante_enlace').setAttribute('action', `${base_url}/tema/${data.id}/estado`);
            asignarTema.addEventListener('click', () => {
                showAsignarTema(data, base_url);
            });
        } else if (data.estado == 'Asignado') {
            asignarTema.style.display = 'flex';
            asignarTema.innerHTML = '<i class="fa-solid fa-user-xmark"></i> Desasignar estudiante';
            aprobarPerfilTema.style.display = 'flex';
            aprobarProyectoTema.style.display = 'none';
            document.getElementById('Desasignar_estudiante_enlace').setAttribute('action', `${base_url}/tema/${data.id}/estado`);
            asignarTema.addEventListener('click', () => {
                showDesasignarTema(data, 'desasignar de este tema', 'Desasignar');
            });
            document.getElementById('perfil_aprobado_enlace').setAttribute('action', `${base_url}/tema/${data.id}/estado`);
            aprobarPerfilTema.addEventListener('click', () => {
                showPerfilAprobado(data, base_url);
            });
        } else if (data.estado == 'Perfil aprobado') {
            aprobarPerfilTema.style.display = 'none';
            asignarTema.innerHTML = '<i class="fa-solid fa-file-circle-xmark"></i> Desaprobar perfil';
            aprobarProyectoTema.style.display = 'flex';
            document.getElementById('Desasignar_estudiante_enlace').setAttribute('action', `${base_url}/tema/${data.id}/estado`);
            asignarTema.addEventListener('click', () => {
                showDesasignarTema(data, 'desaprobar de este perfil', 'Desaprobar');
            });
            document.getElementById('proyecto_terminado_enlace').setAttribute('action', `${base_url}/tema/${data.id}/estado`);
            aprobarProyectoTema.addEventListener('click', () => {
                showProyectoTerminado(data, base_url);
            });
        } else if (data.estado == 'Proyecto terminado') {
            aprobarPerfilTema.style.display = 'none';
            aprobarProyectoTema.style.display = 'none';
            asignarTema.style.display = 'none';
        }
    }

    if (hasPermissionAdminTutor) {
        let eliminarEnlace = document.getElementById('eliminar-tema');
        document.getElementById('editar_enlace').href = `${base_url}/tema/${data.id}/edit`
        // Agregar event listener al enlace de eliminar
        eliminarEnlace.addEventListener('click', () => {
            // Mostrar el popup de confirmación
            showConfirmationPopupDelete(data, base_url);
        });
    }


    // if(!hasPermission) {
    //     document.getElementById('buttons').style.display = 'none'
    // }
    document.getElementById('doc-preview').src = `images/previews/${data.preview_img}`
    let download = document.getElementById('download')
    if (data.documento != 'none') {
        download.setAttribute('href', `docs/${data.documento}`)
    } else {
        let button = download.querySelector('.button')
        button.classList.add('disabled')
    }
    document.getElementById('carrera').innerHTML = `Carrera: ${data.carrera.nombre}`
    document.getElementById('fecha').innerHTML = `${formatDate(data.fecha, "DD-MM-AAAAA")}`
    document.getElementById('title').innerHTML = data.titulo
    document.getElementById('autor').innerHTML = `${data.estudiante}`
    document.getElementById('tutor').innerHTML = data.tutor
    document.getElementById('asesor').innerHTML = data.asesor
    document.getElementById('tipo').innerHTML = data.tipo
    let problematica = data.problematica.split('\n')
    document.getElementById('problematica').innerHTML = ""
    problematica.forEach(parrafo => {
        document.getElementById('problematica').innerHTML += `<div class="paragraph">${parrafo}`
    })

    document.getElementById('objetivos').innerHTML = ""
    adjustObjetivos(data.objetivos[0]['texto'])

    document.getElementById('tematicas').innerHTML = adjustTags(data.etiquetas, 'Temática')
    showOverlay(0)


}

function showConfirmationPopupDelete(data, baseUrl) {
    document.getElementById('title-delete-tema').innerHTML = data.titulo;
    document.getElementById('eliminar_enlace').setAttribute('action', `${baseUrl}/tema/${data.id}`)
    showOverlay(2)
}


function cargarJS(functionName) {
    document.addEventListener('popupOpened', (event) => {
        functionName();
    });
    document.dispatchEvent(new CustomEvent('popupOpened'));
}

function showAsignarTema(data, baseUrl) {
    cargarJS(initializePopup);
    showOverlay(3);
}

function showDesasignarTema(data, PalabraClave, estadoButton) {
    document.getElementById('button_asigned_student').innerHTML = estadoButton;
    document.getElementById('clave-action-tema').innerHTML = PalabraClave;
    document.getElementById('title-estudent-tema').innerHTML = data.estudiante;
    showOverlay(4);
}

function showProyectoTerminado(data, baseUrl) {
    console.log(data.estudiante);
    document.getElementById('title-estudent-tema_terminado').innerHTML = data.estudiante;
    showOverlay(6);
}

function showPerfilAprobado(data, baseUrl) {
    console.log(data.documento);
    let file = document.querySelector('.file-name');
    let nombreArchivo = document.getElementById('nombre-archivo');
    if (data.documento != 'none') {
        file.innerHTML = data.preview_img;
        nombreArchivo.value = data.documento;
    }else{
        file.innerHTML = '';
        nombreArchivo.value = '';
    }

    cargarJS(inicializeFunctionalidadPDF);
    showOverlay(5);
}

function addListeners() {
    let temas = document.querySelectorAll('.trabajo')
    temas.forEach(tema => {
        let id = tema.querySelector('.id_trabajo').innerHTML
        tema.addEventListener('click', () => {
            getTema(id)
        })
    });
}

addListeners()


let searchbar = document.querySelector('.searchbar')
searchbar.addEventListener('click', (e) => {
    let input = searchbar.querySelector('.search-prompt')
    if (e.target == input)
        return
    input.focus()
});

async function getTagResults(input) {
    let csrf = document.getElementsByName('_token')[0].value
    let form = new FormData()
    form.append('tipo', 'any')
    form.append('input', input)
    form.append('_token', csrf)
    const response = await fetch(`${base_url}/etiqueta/search`, { method: 'post', body: form })
    const data = await response.json()
    return data
}

let search_prompt = document.querySelector('.search-prompt')
let text_prompt = document.getElementById('text-prompt')
let text = document.getElementById('text')
let prompt_results = document.querySelector('.prompt-results')
let tags_results = document.getElementById('tags-results')
let tags_prompts = document.getElementById('tags-prompts')
let prompt_tags = []
let text_input = document.getElementById('text_input')
let tags_input = document.getElementById('tags_input')
let prompts = document.querySelector('.prompts')

function displayTags() {
    tags_prompts.innerHTML = ""
    tags_input.value = ""
    prompt_tags.forEach(tag => {
        let new_node = createElement(`<div class="prompt">
            <div id='text' style="width:max-content">${tag.nombre}</div>
            <div class="circle"><i class="fa-solid fa-xmark" style="font-size: 1rem; color: var(--grey); line-height: 19px"></i></div>
        </div>`)
        let button = new_node.querySelector('.circle')
        button.addEventListener('click', () => {
            prompt_tags = prompt_tags.filter(item => item.nombre != tag.nombre)
            displayTags();
        })
        tags_prompts.appendChild(new_node)
        if (tags_input.value.length > 0)
            tags_input.value += `-${tag.id}`
        else
            tags_input.value = `${tag.id}`
    });
    reduceWidth()
}

function displayResults(tags) {
    tags_results.innerHTML = ""
    tags.forEach(tag => {
        let new_node = createElement(`<div class="prompt-result">
            ${tag.nombre}
        </div>`)
        new_node.addEventListener('click', () => {
            if (!prompt_tags.some(item => item.nombre == tag.nombre)) {
                prompt_tags.push({ "id": tag.id, "nombre": tag.nombre })
                displayTags(prompt_tags)
                prompt_results.style.display = 'none'
                search_prompt.value = ''
            }
        })
        tags_results.appendChild(new_node)
    });
}

function reduceWidth() {
    let prompt_width = parseInt(getComputedStyle(prompts).width)
    prompt_width = pxToVw(prompt_width)
    search_prompt.style.width = `${55 - prompt_width}vw`
}

search_prompt.addEventListener('input', async () => {
    if (search_prompt.value.length > 0) {
        prompt_results.style.display = 'flex'
        let tags = await getTagResults(search_prompt.value)
        displayResults(tags)
    } else {
        prompt_results.style.display = 'none'
    }

})

function addTextPrompt(prompt) {
    text.innerHTML = "Buscar: " + prompt
    text_input.value = prompt
    text_prompt.style.display = 'flex'
    reduceWidth()
}


let button = text_prompt.querySelector('.circle')
button.addEventListener('click', () => {
    text_prompt.style.display = 'none'
    text_input.value = ""
    reduceWidth()
})

async function fetchTemas() {
    let formData = new FormData(document.getElementById('search-form'))
    // console.log(formData)
    const response = await fetch(`${base_url}/tema/search`, { method: "post", body: formData })
    const data = await response.json()
    return data
}



function enumarateModify(number) {
    if (number.toString().length < 10) {
        return "0" + number;
    } else {
        return number;
    }
}

function verifyStateTema(estado, estadoActual) {
    if (estado == estadoActual) {
        return 'current-item';
    }
    else {
        return '';
    }
}

let enumerationTemas = 1;
function createTema(tema) {
    let fecha = formatDate(tema.fecha, "MM-AAAAA")
    let numeracion = enumerationTemas++;
    let element = createElement(
        `<div class="card-temas-list">
            <div class="flip-card">
                <div class="flip-card__container">
                    <div class="card-front">
                        <div class="card-front__tp card-front__tp--city">
                            <div class="enumeration-item">
                                <h1>${enumarateModify(numeracion)}</h1>
                            </div>
                            <h2 class="card-front__heading">
                                ${tema.tipo}
                            </h2>
                            <h3 class="card-front__subheading">
                                ${tema.titulo}
                            </h3>
                            <div class="step-wizard">
                                <ul class="step-wizard-list">
                                    <li class="${verifyStateTema('Ninguno', tema.estado)}" style="display: none;"></li> 
                                    <li class="step-wizard-item ${verifyStateTema('Asignado', tema.estado)}">
                                        <span class="progress-count">1</span>
                                        <span class="progress-label">Tema asignado</span>
                                    </li>
                                    <li class="step-wizard-item ${verifyStateTema('Perfil aprobado', tema.estado)}">
                                        <span class="progress-count">2</span>
                                        <span class="progress-label">Perfil aprobado</span>
                                    </li>
                                    <li class="step-wizard-item ${verifyStateTema('Proyecto terminado', tema.estado)}">
                                        <span class="progress-count">3</span>
                                        <span class="progress-label ">Proyecto terminado</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-front__bt">
                            <p class="card-front__text-view card-front__text-view--city">
                                Mírame
                            </p>
                        </div>
                    </div>
                    <div class="card-back">
                    </div>
                </div>
            </div>
            <div class="inside-page">
                <div class="inside-page__container">
                    <div class="tema">
                        <img src="images/page/${tema.carrera.logo}">
                        <div class="tema-header" style="background-color: var(--${tema.carrera.color});"></div>
                        <div class="main_data">
                            <div class="date">
                                ${fecha}
                            </div>
                            <div class="trabajo_title">
                                ${tema.titulo}
                            </div>
                        </div>
                        <div class="sub_data">
                            <div class="data_label">
                                <i class="fa-solid fa-user-graduate" style="color: var(--grey); font-size:1vw"></i>
                                <div>Estudiante Asignado:</div>
                            </div>
                            <div class="data">${tema.estudiante}</div>
                            <div class="data_label">
                                <i class="fa-solid fa-user-tie" style="color: var(--grey); font-size:1vw"></i>
                                <div>Tutor:</div>
                            </div>
                            <div class="data">${tema.tutor}</div>
                            <div class="data_label">
                                <i class="fa-solid fa-book-bookmark" style="color: var(--grey); font-size:1vw"></i>
                                <div>Modalidad propuesta:</div>
                            </div>
                            <div class="data">${tema.tipo}</div>
                        </div>
                    </div>
                    <button class="inside-page__btn inside-page__btn--${tema.carrera.sigla} trabajo">
                        <div style="display: none" class='id_trabajo'>${tema.id}</div>
                        Ver Detalles
                    </button>
                </div>
            </div>
        </div>`
    );
    return element
}


let results = document.getElementById('trabajo_results')
// let title = document.getElementById('title_results')
let search_button = document.getElementById('search-button')

function displayTemas(temas) {
    results.innerHTML = `<div class="title" id="title_retuls">Resultados</div>`
    let row
    // console.log(temas)
    temas.forEach((tema, i) => {
        if (i % 3 == 0) {
            row = createElement(`<div class="row"></div>`)
            results.append(row)
        }
        row.appendChild(createTema(tema))
    });
    addListeners()
}

search_button.addEventListener('click', async () => {
    enumerationTemas = 1;
    let data = await fetchTemas()
    displayTemas(data)
})

search_prompt.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});


async function showTagIssue(id) {
    const response = await fetch(`${base_url}/etiqueta/${id}`)
    const tag = await response.json()
    prompt_tags.push({ "id": tag.id, "nombre": tag.nombre })
    displayTags()
    let data = await fetchTemas()
    displayTemas(data)
}

// if(tag_id){
//     showTagIssue(tag_id)
// }

async function showIssue(codigo) {
    addTextPrompt(codigo)
    let data = await fetchTemas()
    displayTemas(data)
    let id = document.querySelector('.trabajo').querySelector('.id_trabajo').innerHTML
    getTema(id)
}

// if(tema_codigo){
//     showIssue(tema_codigo)
// }





