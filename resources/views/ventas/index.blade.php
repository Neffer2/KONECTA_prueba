@extends('layouts.index')
	@section('content')
		<div class="container">
			<div><p><h2><b>Productos</b></h2></p></div>
			@if (session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
			@endif
			@if ($errors->any())
				<div class="alert alert-danger">
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
					    		<th scope="col">Id</th>
					      		<th scope="col">Nombre</th>
								<th scope="col">Referencia</th>
								<th scope="col">Precio</th>
								<th scope="col">Peso</th>
								<th scope="col">Categoria</th>
								<th scope="col">Stock</th>
							</tr>
						</thead>
					  	<tbody>
					  		@foreach ($productos as $key => $elem)
					  			<tr>
							      	<th scope="row">{{ $elem->id }}</th>
							      	<td>{{ $elem->nombre }}</td>
							      	<td>{{ $elem->referencia }}</td>
							      	<td>{{ $elem->precio }}</td>
							      	<td>{{ $elem->peso }}</td>
							      	<td>{{ $elem->categoria }}</td>
							      	<td>{{ $elem->stock }}</td>
					  			</tr>
					  		@endforeach
					  	</tbody>
					</table>
				</div>
				<hr>
				<div class="col-md-6">
					<h2>Vender</h2>
					<form class="row" action="{{ route('vender') }}" method="POST">
						@csrf
						<div class="col-md-6">
							<label for="producto" class="form-label">Producto</label>
							<select required id="producto" name="id" class="form-select" aria-label="Default select example">
								@foreach ($productos as $key => $elem)
								@if (!$elem->stock <= 0)
									<option value="{{ $elem->id }}">{{ $elem->nombre }}</option>
								@endif
								@endforeach
							</select>
							<div id="producto" class="form-text">¿No aparece tu producto? Actualiza tu stock.</div>
						</div>
						<div class="col-md-6">
							<label for="cantidad" class="form-label">Cantidad</label>
							<input id="cantidad" required class="form-control" type="number" name="cantidad" min="1">
							<div id="cantidad" class="form-text">Recuera! Si la cantidad supera tu stock, la venta fallará.</div>
						</div>
						<div class="col-md-6 mt-2">
							<button type="submit" class="btn btn-success">Vender</button>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<h2>Lista de ventas</h2>
					<table class="table">
					  	<thead>
					    	<tr>	
					      		<th scope="col">Id venta</th>
								<th scope="col">Producto</th>
								<th scope="col">Cantidad</th>
								<th scope="col">Fecha de venta</th>
							</tr>
						</thead>
					  	<tbody>
					  		@foreach ($ventas as $key => $elem)
					  			<tr>
							      	<td>{{ $elem->id }}</td>
							      	<td>{{ $elem->producto->nombre }}</td>
							      	<td>{{ $elem->cantidad }}</td>
							      	<td>{{ $elem->created_at }}</td>
					  			</tr>
					  		@endforeach
					  	</tbody>
					</table> 
				</div>
		</div>
	@endsection 