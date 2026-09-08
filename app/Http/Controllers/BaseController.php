<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index()
    {
        return view('home',[
            'app_name' => 'libreria UNAB',
        ]);
    }

    public function productos()
    {
        $productos = new Producto();
        return view('productos',[
            'app_name' => 'libreria UNAB',
            'productos' => $productos->all(),
        ]);
    }
}
