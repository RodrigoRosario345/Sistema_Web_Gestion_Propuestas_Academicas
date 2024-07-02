let text = document.getElementById('button-text-user')
let nombre = document.getElementById('nombre-input-user')
let username = document.getElementById('username-input')
let password = document.getElementById('password-input')
let form = document.getElementById('user-form')
let button = document.getElementById('btn_registrar_user')
let label_password = document.getElementById('label_password_user')

async function getTag(id){
    const response = await fetch(`${base_url}/user/${id}`)
    const data = await response.json()
    console.log(data)
    return data
}

function editForm(tag){
    text.innerHTML = "Editar usuario";
    nombre.value = tag.usuario.name;
    username.value = tag.usuario.username;
    password.value = "";
    form.setAttribute("action", `${base_url}/user/${tag.usuario.id}`);

    const checkboxes = document.querySelectorAll('.hidden-box-rol');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkboxes.forEach(otherCheckbox => {
                    if (otherCheckbox !== this && otherCheckbox.checked) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });

    // Llenar los checkboxes de roles
    tag.roles.forEach(role => {
        let checkbox = document.querySelector(`input[value="${role.id}"]`);
        if (checkbox) {
            // Comprobar si el rol está asociado al usuario
            if (tag.usuarioRoles.includes(role.name)) {
                checkbox.checked = true;
            }
        }
    });
}


let update_buttons = document.querySelectorAll('.update_user')
update_buttons.forEach(button =>{
    button.addEventListener('click', async () => {
        let tag = await getTag(button.id.split('-')[1])
        const checkboxes = document.querySelectorAll('.hidden-box-rol');
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        editForm(tag)
    })
})

button.addEventListener('click', (e) => {
    if(text.innerHTML == "Editar usuario"){
        e.preventDefault()
        var method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'PUT';
        form.appendChild(method);
        form.submit()
    }
})


document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.hidden-box-rol');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkboxes.forEach(otherCheckbox => {
                    if (otherCheckbox !== this && otherCheckbox.checked) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });
});



