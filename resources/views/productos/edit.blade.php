@extends('layouts.index')
	@section('content')
	@if ($errors->any())
		<div class="alert-danger">
			<p>
				!Opps ha ocurrido un error :(
			<ul>
				@foreach ($errors->all() as $elem)
					<li>{{ $elem }}</li>
				@endforeach
			</ul>
			</p>
		</div>
	@endif
	<div class="container">
		<form class="row gy-3 mb-3" action="{{ route('productos.update', $producto->id) }}" method="POST">
			@method('PATCH')
			@csrf
			<div class="col-sm-6">
				<label for="nombre" class="form-label"><b>Nombre</b></label>
				<input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Nombre del producto" value="{{ $producto->nombre }}">
			</div>
			<div class="col-sm-6">
				<label for="document" class="form-label"><b>Referencia</b></label>
				<input type="text"  required class="form-control" id="referencia" name="referencia" placeholder="Referencia" value="{{ $producto->referencia }}">
			</div>
			<div class="col-sm-6">
				<label for="precio" class="form-label"><b>Precio</b></label>
				<input type="number" class="form-control" id="precio" name="precio" required placeholder="Precio" value="{{ $producto->precio }}">
			</div>
			<div class="col-sm-6">
				<label for="peso" class="form-label"><b>Peso</b></label>
				<input type="number" class="form-control" id="peso" name="peso" required placeholder="Peso" value="{{ $producto->peso }}">
			</div>
			<div class="col-sm-6">
				<label for="experiencia" class="form-label"><b>Categoria</b></label>
				<input type="text" required class="form-control" id="categoria" name="categoria" placeholder="Categoria" value="{{ $producto->categoria }}">
			</div>
			<div class="col-sm-6">
				<label for="stock" class="form-label"><b>Stock</b></label>
				<input type="number" required class="form-control" id="stock" name="stock" placeholder="Stock" value="{{ $producto->stock }}">
			</div>
			<div class="col-sm-12">
				<button type="submit" class="btn btn-success">
				Guardar cambios
				</button>
				<button type="reset" class="btn btn-secondary">Limpiar campos</button>
			</div>
		</form>
	</div>
	@endsection	