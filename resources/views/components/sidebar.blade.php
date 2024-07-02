@php
    use Illuminate\Support\Facades\Auth;
@endphp
<div class="sidebar">
    <ul>
        <div class="logo_usfx"><img src="{{url('/')}}/images/page/logo_usfx_2.png" alt=""></div>
        <div class="Menulist">
            <h2 class="title_gestion">Gestión de Temas</h2>
            @can('admin.temas')
                <li style="--bg:#2196f3;" @if($pagina == 'temas') class="active" @endif>
                    <a href="{{ route('temas') }}">
                        <div class="icon"><i class="fa-solid fa-book-bookmark"></i></div>
                        <div class="text">Temas de Titulación</div>
                    </a>
                </li>
            @endcan
            @can('admin.form_temas')
                <li style="--bg:#2196f3;" @if($pagina == 'registro_temas') class="active" @endif>
                    <a href="{{ route('form_temas') }}">
                        <div class="icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <div class="text">Registro de Temas</div>
                    </a>
                </li>
            @endcan
            @can('admin.reportes')
                <li style="--bg:#2196f3;" @if($pagina == 'reportes') class="active" @endif>
                    <a href="{{ route('reportes') }}">
                        <div class="icon"><i class="fa-solid fa-chart-column"></i></div>
                        <div class="text">Reportes</div>
                    </a>
                </li>
            @endcan
            @can('admin.users')
                <h2 class="title_gestion">Gestión de Usuarios</h2>
                <li style="--bg:#2196f3;" @if($pagina == 'usuarios') class="active" @endif>
                    <a href="{{ route('docentes.index') }}">
                        <div class="icon"><i class="fa-solid fa-user-tie"></i></div>
                        <div class="text">Docentes</div>
                    </a>
                </li>
            @endcan
            @can('admin.estudiantes.index')
                <li style="--bg:#2196f3;" @if($pagina == 'estudiantes') class="active" @endif>
                    <a href="{{ route('estudiantes.index') }}">
                        <div class="icon"><i class="fa-solid fa-user-graduate"></i></div>
                        <div class="text">Estudiantes</div>
                    </a>
                </li>
            @endcan
            @if(Auth::check())
                <form action="{{ route('logout')}}" method="POST">
                    @csrf
                    <button type="submit"  style="background: none; border: none; cursor: pointer;">
                        <div class="button_log_out">
                            <div class="icon"><i class="fa-solid fa-sign-out"></i></div>
                            <div class="text">Cerrar Sesión</div>
                        </div>
                    </button>
                </form>
            @endif
        </div>
    </ul>
</div>	