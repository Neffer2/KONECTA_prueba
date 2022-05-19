<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class ConsultasController extends Controller
{
    public function max(){

        $maximo_stock = Producto::max('stock');
        //En raw porque con eloquent no supe como :/
        $maximo_venta = \DB::select('SELECT producto_id, count(*) as conteo FROM ventas GROUP BY producto_id ASC LIMIT 1');


        return view('max.index', ['maximo_stock' => $maximo_stock, 'maximo_venta' => $maximo_venta]);
    }
}
