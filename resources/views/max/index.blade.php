@extends('layouts.index')
	@section('content')
		<div class="container">
			<h2>Consulta máximo stock: </h2>
			<p>SELECT MAX(stock) id, nombre, stock FROM `productos`;</p>
			<p>Resultado: {{ $maximo_stock }}</p>
			<br><br>
			<h2>Consulta producto mas vendido</h2>
			<p>SELECT producto_id, count(*) as conteo FROM ventas GROUP BY producto_id ASC LIMIT 1;</p>
			<p>Resultado: el producto con id {{ $maximo_venta[0]->producto_id }} se vendió {{ $maximo_venta[0]->conteo }} veces </p>
		</div>
	@endsection 