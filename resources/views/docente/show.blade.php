@extends('docentes_tab')

@section('template_title')
    {{ $docente->name ?? __('Show') . " " . __('Docente') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="agregar_objetivos">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver Informacion del') }} Docente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('docentes.index') }}"> {{ __('Atras') }}</a>
                            
                            
                        </div>
                    </div>

                    <div class="agregar_objetivos2">
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $docente->user->name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre de Usuario:</strong>
                            {{ $docente->user->username }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Celular:</strong>
                            {{ $docente->celular }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Direccion:</strong>
                            {{ $docente->direccion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Ci:</strong>
                            {{ $docente->ci }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Especialidad:</strong>
                            {{ $docente->especialidad }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Rol:</strong>
                            @foreach($docente->user->roles as $key => $rol)
                                <span>{{ $rol->name }}{{ !$loop->last ? ' - ' : '' }}</span>
                            @endforeach
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
