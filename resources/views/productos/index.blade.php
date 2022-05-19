@extends('layouts.index')
	@section('content')
		<div class="container mt-2">
			<div><p><h2><b>Productos</b></h2></p></div>
			@if (session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
			@endif
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
			<div class="row">
				<div class="col-md-12">
					<table class="table">
					  	<thead>
					    	<tr>	
					    		<th scope="col">#</th>
					      		<th scope="col">Nombre</th>
								<th scope="col">Referencia</th>
								<th scope="col">Precio</th>
								<th scope="col">Peso</th>
								<th scope="col">Categoria</th>
								<th scope="col">Stock</th>
								<th scope="col">Editar</th>
								<th scope="col">Eliminar</th>
							</tr>
						</thead>
					  	<tbody>
					  		@foreach ($productos as $key => $elem)
					  			<tr>
							      	<th scope="row">{{ $key+=1 }}</th>
							      	<td>{{ $elem->nombre }}</td>
							      	<td>{{ $elem->referencia }}</td>
							      	<td>{{ $elem->precio }}</td>
							      	<td>{{ $elem->peso }}</td>
							      	<td>{{ $elem->categoria }}</td>
							      	<td>{{ $elem->stock }}</td>
							      	<td>
						      			<a href="{{ route('productos.edit', $elem->id) }}" class="btn btn-primary">Editar</a>
							      	</td>
							      	<td>
					      				<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletemodal{{ $elem->id }}">Eliminar</button>
							      	</td>
					  			</tr>
					  			<!-- Modal -->
								<div class="modal fade" id="deletemodal{{ $elem->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      	<div class="modal-header">
								        	<h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
								        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								  			</div>
										    <div class="modal-body">
										        ¿Estás seguro de eliminar el producto {{ $elem->nombre }}?
										    </div>
								  			<div class="modal-footer">
								  				<form action="{{ route('productos.destroy', $elem->id) }}" method="POST">
								  					@csrf
								  					@method('DELETE')
									        		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
									        		<button type="submit" class="btn btn-danger">Eliminar</button>
								  				</form>
											</div>
										</div>
									</div>
								</div>
					  		@endforeach
					  	</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<div><p><h3><b>Nuevo producto</b></h3></p></div>
					<form class="row gy-3 mb-3" action="{{ route('productos.store') }}" method="POST">
						@csrf
						<div class="col-sm-6">
							<label for="nombre" class="form-label"><b>Nombre</b></label>
							<input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Nombre del producto">
						</div>
						<div class="col-sm-6">
							<label for="document" class="form-label"><b>Referencia</b></label>
							<input type="text" required class="form-control" id="referencia" name="referencia" placeholder="Referencia">
						</div>
						<div class="col-sm-6">
							<label for="precio" class="form-label"><b>Precio</b></label>
							<input type="number" class="form-control" id="precio" name="precio" required placeholder="Precio">
						</div>
						<div class="col-sm-6">
							<label for="peso" class="form-label"><b>Peso</b></label>
							<input type="number" class="form-control" id="peso" name="peso" required placeholder="Peso">
						</div>
						<div class="col-sm-6">
							<label for="experiencia" class="form-label"><b>Categoria</b></label>
							<input type="text" required class="form-control" id="categoria" name="categoria" placeholder="Categoria">
						</div>
						<div class="col-sm-6">
							<label for="stock" class="form-label"><b>Stock</b></label>
							<input type="number" required class="form-control" id="stock" name="stock" placeholder="Stock">
						</div>
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success">
							Crear
							</button>
							<button type="reset" class="btn btn-secondary">Limpiar campos</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endsection