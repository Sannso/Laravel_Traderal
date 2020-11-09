
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ __('Usuarios y productos') }}</h4>
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
                                  <th scope="col">Propietario</th>
                                  <th scope="col">Titulo</th>
                                  <th scope="col">Descripcion</th>
                                  <th scope="col">Precio</th>
                                  <th scope="col">Acciones</th>
                                </tr>
                              </thead>
                              <tbody>

                                @foreach($products as $item)
                                <tr>  
                                    <th scope="row"> {{ $item->dueño }}</th>

                                    <td>
                                        <a href="{{route('verProductoId', $item)}}">{{ $item->nombre }}</a>
                                    </td>

                                    <td>{{ $item->descripcion }}</td>

                                    <td>{{ $item->precio }}</td>

                                    <td>
                                        <div class="d-flex justify-content-around">
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
                            <div class="row justify-content-center mt-3">{{ $products->links() }} </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
