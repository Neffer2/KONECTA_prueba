<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Productos = Producto::All();
        return view('productos.index', ['productos' => $Productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'referencia' => 'required',
            'precio' => 'required',
            'peso' => 'required',
            'categoria' => 'required',
            'stock' => 'required|min:1',
        ]);

        $Producto = new Producto;
        $Producto->nombre = $request->nombre;
        $Producto->referencia = $request->referencia;
        $Producto->precio = $request->precio;
        $Producto->peso = $request->peso;
        $Producto->categoria = $request->categoria;
        $Producto->stock = $request->stock;
        $Producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto registrado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('productos.edit', ['producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'referencia' => 'required',
            'precio' => 'required',
            'peso' => 'required',
            'categoria' => 'required',
            'stock' => 'required|min:1',
        ]);

        $Producto = Producto::find($id);
        $Producto->nombre = $request->nombre;
        $Producto->referencia = $request->referencia;
        $Producto->precio = $request->precio;
        $Producto->peso = $request->peso;
        $Producto->categoria = $request->categoria;
        $Producto->stock = $request->stock;
        $Producto->update();

        return redirect()->route('productos.index')->with('success', 'Cambios guardados con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Producto = Producto::find($id);
        $Producto->ventas()->each(function($ventas){
            $ventas->delete();
        }); 
        $Producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
    }
}
