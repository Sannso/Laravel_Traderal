@extends('layouts.app')

@section('content')
<div class = "container">

    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="container">
                    <h4>Busqueda de productos</h4>
                    {{ Form::open(['route' => 'principal', 'method' => 'GET', 'class' => 'form-inline pull-right'])}}
                        <div class="form-group mr-2">
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre Producto...'])}}
                        </div>

                        <div class="form-group mr-2">
                            {{ Form::text('desc', null, ['class' => 'form-control', 'placeholder' => 'Descripcion...'])}}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">
                                <span class="glyphicon glyphicon-search">Buscar</span>
                            </button>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 pd-3">
        <div class="row justify-content-around">
            
                @foreach($products as $item)
                    <div class="col-md-4">
                            <div class="card mx-auto mt-4" style="width: 20rem; height: 25rem;">
                              <img class="card-img-top" src="/images/{{$item->ruta}}" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title">{{$item->nombre}}</h5>
                                <p class="card-text">{{$item->descripcion}}</p>
                                <a href="{{route('verProductoId', $item)}}" class="btn btn-primary">Contactar</a>
                              </div>
                            </div>  
                    </div>   
                @endforeach  
    </div>
        <div class="row justify-content-center mt-5">
            {{ $products->links() }}
        </div>

</div>    
@endsection