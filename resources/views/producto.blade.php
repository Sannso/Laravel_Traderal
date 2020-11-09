@extends('layouts.app')

@section('content')

 <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <!-- Blog Post -->
        <div class="card mb-4">
          <img class="card-img-top" src="/images/{{$prod->ruta}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">{{$prod->nombre}}</h2>
            <h3 class="card-title"> Precio: {{floatval($prod->precio)}}$</h3>
            <p class="card-text">{{$prod->descripcion}}</p>
          </div>
        </div>
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Datos vendedor</h5>
          <div class="card-body">
            @foreach($own as $i)
              <p>Nombre: {{$i->name}}</p>
              <p>Email: {{$i->email}}</p>
              <p>Telefono: {{$i->tel}}</p>
            @endforeach
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
@endsection