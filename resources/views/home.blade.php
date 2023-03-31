@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    <button class="btn btn-sm btn-outline-success" type="button" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i></button>
                    {{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif



                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Actions</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Age</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">
                                    <button class="btn btn-sm btn-outline-primary" type="button" data-id="{{$user->id }}" data-name="{{$user->name }}" data-email="{{$user->email }}" data-birthday="{{$user->birthday }}" data-toggle="modal" data-target="#modalVer"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-success" type="button" data-id="{{$user->id }}" data-name="{{$user->name }}" data-email="{{$user->email }}" data-birthday="{{$user->birthday }}" data-toggle="modal" data-target="#modalEditar"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" type="button" data-id="{{$user->id }}" data-name="{{$user->name }}" data-email="{{$user->email }}" data-birthday="{{$user->birthday }}" data-toggle="modal" data-target="#modalEliminar"><i class="fa fa-trash"></i></button>
                                </th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->birthday}}</td>

                                <td>{{$user->age}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modales para edicion, registro -->
<div class="modal fade" id="modalVer" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Ver informacion del usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="name">{{ __('Name') }}</label>
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name">{{ __('Email') }}</label>
                        <div class="col-md-12">
                            <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="email" value="" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name">{{ __('Birthday') }}</label>
                        <div class="col-md-12">
                            <input id="birthday" type="text" class="form-control @error('name') is-invalid @enderror" name="birthday" value="" readonly>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar informacion del usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('edit')}}">
                    @csrf
                    @method('POST')
                    <div class="row mb-3">
                        <input type="hidden" id="id" name="id">

                        <label for="name">{{ __('Name') }}</label>
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autocomplete="name" autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name">{{ __('Email') }}</label>
                        <div class="col-md-12">
                            <input id="email" type="text" class="form-control" name="email" value="" required autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name">{{ __('Birthday') }}</label>
                        <div class="col-md-12">
                            <input id="birthday" type="date" class="form-control" name="birthday" value="" required autofocus>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">¿Estas seguro que deseas eliminarlo?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('delete')}}">
                    @csrf
                    @method('POST')
                    <div class="row mb-3">
                        <input type="hidden" id="id" name="id">
                        <label for="name">{{ __('Name') }}</label>
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autocomplete="name" autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name">{{ __('Email') }}</label>
                        <div class="col-md-12">
                            <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="email" value="" required autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name">{{ __('Birthday') }}</label>
                        <div class="col-md-12">
                            <input id="birthday" type="text" class="form-control @error('name') is-invalid @enderror" name="birthday" value="" required autofocus>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Registrar nuevo usuario:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('add')}}">
                    @csrf
                    @method('POST')
                    <div class="row mb-3">
                        <input type="hidden" id="id" name="id">
                        <label for="name">{{ __('Name') }}</label>
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name">{{ __('Email') }}</label>
                        <div class="col-md-12">
                            <input id="email" type="text" class="form-control" name="email" value="" required autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password">{{ __('Confirm password') }}</label>

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name">{{ __('Birthday') }}</label>
                        <div class="col-md-12">
                            <input id="birthday" type="date" class="form-control" name="birthday" value="" required autofocus>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>







<!-- Modal para ver usuario-->
<script>
    $(document).ready(function() {
        $('#modalVer').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
            var name = button.data('name')
            var email = button.data('email')
            var birthday = button.data('birthday')


            var modal = $(this)
            modal.find('.modal-title').text('Modificar usuario: '.$name)
            modal.find('#id').val(id)
            modal.find('#name').val(name)
            modal.find('#email').val(email)
            modal.find('#birthday').val(birthday)

        })
    });
</script>


<script>
    $(document).ready(function() {
        $('#modalEditar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
            var name = button.data('name')
            var email = button.data('email')
            var birthday = button.data('birthday')


            var modal = $(this)
            modal.find('.modal-title').text('Modificar usuario: '.$name)
            modal.find('#id').val(id)
            modal.find('#name').val(name)
            modal.find('#email').val(email)
            modal.find('#birthday').val(birthday)

        })
    });
</script>

<script>
    $(document).ready(function() {
        $('#modalEliminar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
            var name = button.data('name')
            var email = button.data('email')
            var birthday = button.data('birthday')


            var modal = $(this)
            modal.find('.modal-title').text('Modificar usuario: '.$name)
            modal.find('#id').val(id)
            modal.find('#name').val(name)
            modal.find('#email').val(email)
            modal.find('#birthday').val(birthday)

        })
    });
</script>










@endsection