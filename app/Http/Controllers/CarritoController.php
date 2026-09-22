<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session()->get('cart', []);
        return view('carrito.index', compact('carrito'));
    }

    public function add(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $cantidad = $request->input('cantidad', 1);

        if ($producto->stock <= 0) {
            return back()->with('error', 'El producto no tiene stock disponible.');
        }

        if ($cantidad > $producto->stock) {
            return back()->with('error', 'La cantidad supera el stock disponible.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $nuevaCantidad = $cart[$id]['cantidad'] + $cantidad;
            if ($nuevaCantidad > $producto->stock) {
                return back()->with('error', 'No puedes agregar más unidades que el stock disponible.');
            }
            $cart[$id]['cantidad'] = $nuevaCantidad;
        } else {
            $cart[$id] = [
                'nombre' => $producto->nombre,
                'cantidad' => $cantidad,
                'precio' => $producto->precio_final,
                'franquicia' => $producto->franquicia,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $cantidad = $request->cantidad;

        if ($cantidad > $producto->stock) {
            return back()->with('error', 'La cantidad excede el stock disponible.');
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['cantidad'] = $cantidad;
            session()->put('cart', $cart);
        }

        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
}