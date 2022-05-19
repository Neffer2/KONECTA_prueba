<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index (){
        $productos = Producto::all();
        $ventas = Venta::all();
        
        return view('ventas.index', ['productos' => $productos, 'ventas' => $ventas]);
    }

    public function vender (Request $request){
        $request->validate([
            'id' => 'required',
            'cantidad' => 'required|min:1',
        ]);

        //Enceuntra el producto por Id y verifica si tiene stock disponible
        $producto = DB::table('productos')
                    ->where('id', '=', $request->id)
                    ->where('stock', '>=', $request->cantidad)
                    ->get();

        //Si no hay stock
        if ($producto->isEmpty()){
            return back()->withErrors('No tienes suficiente stock.');
        }

        // Si la venta no se registra por algún motivo
        if (!$this->store_venta($request->id, $request->cantidad)){
            return back()->withErrors('No se registró la venta');
        }

        $producto = Producto::find($request->id);
        $producto->stock -= $request->cantidad;
        $producto->update();


        return redirect()->route('vender')->with('success', 'Producto vendido, stock actulizado.');
    }


    public function store_venta ($producto_id, $cantidad){
        $venta = new Venta;
        $venta->producto_id = $producto_id;
        $venta->cantidad = $cantidad;

        if ($venta->save()){
            return true;
        }else{
            return false;
        }
    }
}
