<form action="{{ route('user.store') }}" method="POST" id="user-form">
    @csrf
    <div class="content_data_label">
        <div style="display: flex; gap: 2rem;">
            <div class="input-box-label">
                <div style="display:flex;">
                <div class="container_roles_config" >
                    <ul class="list-rol">
                        <h2 class="ticle-Name-Roles">Datos Usuario</h2>
                        <div style="background: #F6F6F6; height: 100%">
                            <div class="labels_etiquetas" style="margin-left:1rem; padding-top: 10px">
                                <div class="label">Nombre</div>
                            </div>
                            <input class="input_configuracion" type="text" name="name"  id="nombre-input-user" style="margin-left:1rem;" required>
                            <div class="labels_etiquetas" style="margin-left:1rem; ; padding-top: 10px">
                                <div class="label">Usuario</div>
                            </div>
                            <input class="input_configuracion" type="text" name="username" id="username-input" style="margin-left:1rem;" required>
                            <div class="labels_etiquetas" id="label_password_user" style="margin-left:1rem; ; padding-top: 10px">
                                <div class="label">Contraseña</div>
                            </div>
                            <input  class="input_configuracion" type="password" name="password" id="password-input" style="margin-left:1rem; margin-bottom:1.5rem;" required>  
                        </div>
                    </ul>
                </div>
                    <div class="container_roles_config-rol">
                        <ul class="list-rol">
                            <h2 class="ticle-Name-Roles">Roles</h2>
                            <ul class="list-rol">
                                <li class="list-item-rol">
                                    <input id="rol1" class="hidden-box-rol"  type="checkbox" name="roles[]" value="Admin">
                                    <label for="rol1" class="check-label-rol">
                                        <span class="check-label-text-rol">Administrador</span>
                                        <span class="check-label-box-rol"></span>
                                    </label>
                                </li>
                                <li class="list-item-rol">
                                    <input id="rol2" class="hidden-box-rol"  type="checkbox" name="roles[]" value="Tutor">
                                    <label for="rol2" class="check-label-rol">
                                        <span class="check-label-text-rol">Tutor</span>
                                        <span class="check-label-box-rol"></span>
                                    </label>
                                </li>
                                <li class="list-item-rol">
                                    <input id="rol3" class="hidden-box-rol"  type="checkbox" name="roles[]" value="Asesor">
                                    <label for="rol3" class="check-label-rol">
                                        <span class="check-label-text-rol">Asesor</span>
                                        <span class="check-label-box-rol"></span>
                                    </label>
                                </li>
                            </ul>
                        </ul>
                    </div>
                </div>
                </div>
        </div>
        <button type="submit" class="button_registrar_etiqueta" id="btn_registrar_user">
            <i class="fa-regular fa-user" style="color: var(--white);"></i>
            <div id="button-text-user">Crear Usuario</div>
        </button>
    </div>
</form>
<div class="list_labels">
    <h2 style="margin-bottom: 1.25rem; font-size: 1.3rem; color:var(--black)">Lista de usuarios</h2>
    <div class="list_title">
        <li>Nombre</li>
        <li>Usuario</li>
        <li>Roles</li>
        <li>Operaciones</li>
    </div>
    <div class="linea_separacion_2"></div>
    @foreach($users as $user)
        <div class="data_labels">
            <div class="icon_name_user">
                <div class="icon_nombre_label"> 
                    <i class="fa-solid fa-user" style="color: var(--blue); font-size: 1.5rem"></i>
                </div>
                <div class="nombre_etiqueta">{{$user->name}}</div>
            </div>
            <div class="icon_email" style="color: var(--blue);">
                <div>{{ $user->username}}</div>
            </div>
            <div class="icon_roles" style="color: var(--blue);">
                @foreach($user->roles as $key => $rol)
                    <span>{{ $rol->name }}{{ !$loop->last ? ' - ' : '' }}</span>
                @endforeach
            </div>
            <div class="operaciones">
                <div class="update_user" id="tag-{{$user->id}}">
                    <i class="fa-solid fa-pen-to-square" style="color: var(--white); font-size: 1.15rem"></i>
                </div>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="submit_button">
                        <div class="delete_label" style="margin-left:15px">
                            <i class="fa-solid fa-trash-can" style="color: var(--red); font-size: 1.15rem"></i>
                        </div>
                    </button>
                </form>
            </div>
        </div>
        <div class="linea_separacion_list"></div>
    @endforeach
</div>
      
@vite(['resources/js/form_users.js'])
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.hidden-box-rol');
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    });
</script>