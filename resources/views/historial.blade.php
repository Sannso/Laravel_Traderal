
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ __('Historial de productos') }}</h4>
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
                                  <th scope="col">Id Producto</th>
                                  <th scope="col">Titulo</th>
                                  <th scope="col">Propietario</th>
                                  <th scope="col">Precio</th>
                                  <th scope="col">Accion</th>
                                </tr>
                              </thead>
                              <tbody>

                                @foreach($products as $item)
                                <tr>  
                                    <th scope="row"> {{ $item->id_producto }}</th>

                                    <td>{{ $item->producto }}</td>

                                    <td>{{ $item->dueño }}</td>

                                    <td>{{ $item->precio }}</td>

                                    <td>{{ $item->accion }}</td>
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
