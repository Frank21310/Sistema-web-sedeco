@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2 class="">Usuarios</h2>
                </div>
                <div class="col g-col-6 d-flex justify-content-end ">
                    <a id="BtnAgregar" href="{{ route('Usuarios.create') }}" class="btn btn-primary ml-auto BotonRojo">
                        <i class="fas fa-plus"></i>
                        Agregar
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3>Lista de Usuarios existentes</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-2">
                            <a class="navbar-brand">Listar</a>
                        </div>
                        <div class="col-3">
                            <select name="limit" id="limit" class="form-control custom-select">
                                @foreach ([5, 10, 15, 20] as $limit)
                                    <option value="{{ $limit }}"
                                        @if (@isset($_GET['limit'])) {{ $_GET['limit'] == $limit ? 'selected' : '' }} @endif>
                                        {{ $limit }}
                                    </option>
                                @endforeach
                            </select>
                            <?php
                            if (isset($_GET['page'])) {
                                $pag = $_GET['page'];
                            } else {
                                $pag = 1;
                            }
                            if (isset($_GET['limit'])) {
                                $limit = $_GET['limit'];
                            } else {
                                $limit = 10;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-2">
                            <a class="navbar-brand">Buscar</a>
                        </div>
                        <div class="col-10">
                            <input class="form-control custom-input" type="search" id="search" placeholder="Search"
                                aria-label="Search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <div class="table table-striped">
                    <table class="table custom-table">
                        <thead class="custom-thead">
                            <tr>
                                <th class="custom-th">Num. Empleado</th>
                                <th class="custom-th">Email</th>
                                <th class="custom-th">Rol</th>
                                <th class="col-2 custom-th">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Users as $User)
                                <tr>
                                    <td class="custom-td">{{ $User->empleado_num }}</td>
                                    <td class="custom-td">{{ $User->email }}</td>
                                    <td class="custom-td">{{ $User->Roles->nombre_rol }}</td>
                                    <td class="custom-td">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('Usuarios.show', $User->id) }}"
                                                class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('Usuarios.edit', $User->id) }}"
                                                class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('Usuarios.destroy', $User->id) }}"
                                                id="delete_{{ $User->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('¿Estás seguro de eliminar el registro?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer">
            @if ($Users->count() > 0)
                {{ $Users->links() }}
            @endif
        </div>
    </div>

    <Script type="text/javascript">
    
        $('#limit').on('change', function() {
            window.location.href = "{{ route('Usuarios.index') }}?limit=" + $(this).val() + '&search=' + $(
                '#search').val()
        })

        $('#search').on('keyup', function(e) {
            if (e.keyCode == 13) {
                window.location.href = "{{ route('Usuarios.index') }}?limit=" + $('#limit').val() +
                    '&search=' +
                    $(this).val()
            }
        })
    </Script>
@endsection
