import { createElement, initializePopup, inicializeFunctionalidadPDF } from './common'

pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.mjs';

let lastClick = null
document.addEventListener('mousedown', (event) => {
    lastClick = event.target;
});

const listPlaceholder = [
    'Ejemplo: La problematica actual de la empresa es la falta de un sistema de control de inventarios',
    'Ejemplo: \n1. Diseñar la base de datos\n2. Creación de la interfaz de usuario\n3. Implementación de la lógica de negocio',
];

let editorTextProblematica = document.getElementById('editorProblematica');
let editorTextObjetivos = document.getElementById('editorObjetivos');

const problematica = new Quill(editorTextProblematica, {
    theme: 'snow',
    placeholder: listPlaceholder[0],
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'indent': '-1' }, { 'indent': '+1' }],
            ['clean'],
        ]
    }
});

const objetivos = new Quill(editorTextObjetivos, {
    theme: 'snow',
    placeholder: listPlaceholder[1],
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            [{ 'indent': '-1' }, { 'indent': '+1' }],
            ['clean'],
        ]
    }
});

document.addEventListener('click', (event) => {
    if (!editorTextProblematica.contains(event.target) &&
        !problematica.getModule('toolbar').container.contains(event.target) &&
        !editorTextObjetivos.contains(event.target) &&
        !objetivos.getModule('toolbar').container.contains(event.target)) {
        problematica.getModule('toolbar').container.style.display = 'none';
        objetivos.getModule('toolbar').container.style.display = 'none';
    }
});

editorTextProblematica.addEventListener('click', (event) => {
    problematica.getModule('toolbar').container.style.display = 'flex';
    event.stopPropagation(); // Prevent event bubbling
});

editorTextObjetivos.addEventListener('click', (event) => {
    objetivos.getModule('toolbar').container.style.display = 'flex';
    event.stopPropagation(); // Prevent event bubbling
});

// Add event listener to toolbar buttons to prevent hiding
const toolbarButtonsProblematica = problematica.getModule('toolbar').container.querySelectorAll('button');
toolbarButtonsProblematica.forEach(button => {
    button.addEventListener('click', (event) => {
        event.stopPropagation(); // Prevent event from bubbling up
    });
});

const toolbarButtonsObjetivos = objetivos.getModule('toolbar').container.querySelectorAll('button');
toolbarButtonsObjetivos.forEach(button => {
    button.addEventListener('click', (event) => {
        event.stopPropagation(); // Prevent event from bubbling up
    });
});

// Sync content with hidden input fields on form submit
document.getElementById('FormTemas').addEventListener('submit', function (e) {
    // Prevent default form submission
    e.preventDefault();

    // Copy Quill content to hidden input fields
    document.getElementById('problematicaContent').value = problematica.root.innerHTML;
    document.getElementById('objetivosContent').value = objetivos.root.innerHTML;

    // Submit the form after copying the content
    this.submit();
});

document.addEventListener('keydown', (event) => {
    if (event.key === "Enter" && event.target.tagName !== "TEXTAREA") {
        event.preventDefault();
    }
});


let tag_inputs = document.querySelectorAll('.input-tags')
tag_inputs.forEach(element => {
    let searchbox = element.querySelector('.search-tag')
    element.addEventListener('click', (e) => {
        if (e.target == searchbox) return
        searchbox.focus()
    })
});

async function getTagResults(tipo, input) {
    // Obtener el token CSRF del formulario
    let csrf = document.getElementsByName('_token')[0].value;

    // Crear un objeto FormData para enviar los datos
    let form = new FormData();
    form.append('tipo', tipo);
    form.append('input', input);
    form.append('_token', csrf);

    // Realizar una solicitud fetch asíncrona
    const response = await fetch(`${base_url}/etiqueta/search`, {
        method: 'post',
        body: form
    });

    // Analizar la respuesta como JSON
    const data = await response.json();

    // Retornar los datos obtenidos
    return data;
}

let tematicas_elements = {
    'array': [],
    'box': document.getElementById('tematicas'),
    'searchbox': document.getElementById('search-tematicas'),
    'results': document.getElementById('results-tematicas'),
    'input': document.getElementById('input-tematicas')
}



function displayTags(elements) {
    elements.box.innerHTML = ''
    elements.input.value = ''
    elements.array.forEach(tag => {
        let new_node = createElement(`<div class="tag">
            <div class="tag-name">${tag.nombre}</div>
            <div class="tag-button"><i class="fa-solid fa-xmark close" style="font-size: 1.1rem; color: var(--white)"></i></div>
        </div>`)
        new_node.querySelector('.close').addEventListener('click', () => {
            elements.array = elements.array.filter(item => item.nombre != tag.nombre)
            displayTags(elements);
        })
        elements.box.appendChild(new_node)
        if (elements.input.value.length > 0)
            elements.input.value += `-${tag.id}`
        else
            elements.input.value = `${tag.id}`
    })
    elements.searchbox.value = ''
    elements.box.appendChild(elements.searchbox)
}

function createResult(result, elements) {
    let new_node = createElement(`<div class="result click">
        <div class="click">${result.nombre}</div>
        <div class="center click"><i class="fa-solid fa-circle-plus" style="font-size:1.6rem;"></i></div>
    </div>`)
    new_node.addEventListener('click', () => {
        if (!elements.array.some(item => item.id == result.id)) {
            elements.array.push({ 'id': result.id, 'nombre': result.nombre })
            displayTags(elements)
            elements.results.style.display = 'none'
        }
    })
    return new_node
}

async function showResults(elements, type) {
    // Verificar si se ha ingresado algún texto en el searchbox
    if (elements.searchbox.value.length > 0) {
        // Obtener los resultados de la búsqueda de etiquetas
        const results = await getTagResults(type, elements.searchbox.value);

        // Verificar si se encontraron resultados
        if (results.length > 0) {
            // Limpiar el contenido del elemento results
            elements.results.innerHTML = "";

            // Agregar cada resultado al elemento results
            results.forEach(result => {
                elements.results.appendChild(createResult(result, elements));
            });

            // Mostrar el elemento results
            elements.results.style.display = 'flex';
        } else {
            // Ocultar el elemento results si no hay resultados
            elements.results.style.display = 'none';
        }
    } else {
        // Ocultar el elemento results si no se ha ingresado texto en el searchbox
        elements.results.style.display = 'none';
    }
}
// Obtener el elemento de entrada de búsqueda (searchbox) del objeto tematicas_elements
tematicas_elements.searchbox.addEventListener('input', () => showResults(tematicas_elements, 'Temática'))

// Agregar un evento de escucha al elemento searchbox
// Cuando se ingresa algún texto (evento 'input'), se llama a la función showResults
// pasando el objeto tematicas_elements y el string 'Temática' como argumentos

tematicas_elements.searchbox.addEventListener('blur', () => {
    // Agregar un evento de escucha al elemento searchbox
    // Cuando pierde el foco (evento 'blur'), se ejecuta la función anónima

    if (!lastClick.classList.contains('click')) {
        // Si el último elemento clickeado no tiene la clase 'click'
        tematicas_elements.results.style.display = 'none'
        // Ocultar el elemento results del objeto tematicas_elements
    }
})


if (is_upd) {
    tematicas_elements.array = tematicas_upd
    displayTags(tematicas_elements)
}

document.addEventListener("DOMContentLoaded", function () {
    initializePopup();
    inicializeFunctionalidadPDF();
});