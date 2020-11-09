@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ __('Mis Productos') }}</h4>
                    <a href="{{route('agregarProducto')}}" class="btn btn-primary">Crear Nuevo</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('successdelete'))
                        <div class="alert alert-success">
                            {{ session('successdelete') }}
                        </div>
                    @endif

                    <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#Id</th>
                                  <th scope="col">Titulo</th>
                                  <th scope="col">Descripcion</th>
                                  <th scope="col">Precio</th>
                                  <th scope="col">Acciones</th>
                                </tr>
                              </thead>
                              <tbody>

                                @foreach($allprod as $item)
                                <tr>  
                                    <th scope="row"> {{ $item->id }}</th>

                                    <td>
                                        <a href="{{route('verProductoId', $item)}}">{{ $item->nombre }}</a>
                                    </td>

                                    <td>{{ $item->descripcion }}</td>

                                    <td>{{ $item->precio }}</td>

                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="{{ route('editarProducto', $item) }}"
                                             class="btn btn-warning btn-sm mr-1">Editar</a>

                                            <form action="{{route('eliminarProducto', $item)}}" method="POST" class="d-inline-block">                                           
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                              </tbody>
                            </table>
                            <div class="row justify-content-center mt-3">{{ $allprod->links() }} </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
