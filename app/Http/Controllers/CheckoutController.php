<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $carrito = session()->get('cart', []);
        if (empty($carrito)) {
            return redirect()->route('welcome')->with('error', 'El carrito está vacío.');
        }

        $total = array_sum(array_map(fn($item) => $item['precio'] * $item['cantidad'], $carrito));

        return view('checkout.index', compact('carrito', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'cliente_nombre' => 'required|string|max:255',
            'cliente_email' => 'required|email|max:255',
            'tarjeta_numero' => 'required|string|min:16|max:16',
        ]);

        $carrito = session()->get('cart', []);
        if (empty($carrito)) {
            return redirect()->route('welcome')->with('error', 'El carrito está vacío.');
        }

        DB::beginTransaction();

        try {
            $total = 0;

            // Verificar Stock antes de procesar
            foreach ($carrito as $productoId => $item) {
                $producto = Producto::findOrFail($productoId);
                if ($producto->stock < $item['cantidad']) {
                    DB::rollBack();
                    return redirect()->route('carrito.index')->with('error', "Stock insuficiente para: {$producto->nombre}");
                }
                $total += $item['precio'] * $item['cantidad'];
            }

            // Registrar Venta
            $venta = Venta::create([
                'cliente_nombre' => $request->cliente_nombre,
                'cliente_email' => $request->cliente_email,
                'tarjeta_numero' => '**** **** **** ' . substr($request->tarjeta_numero, -4),
                'total' => $total,
            ]);

            // Registrar Detalles y Descontar Stock
            foreach ($carrito as $productoId => $item) {
                $producto = Producto::findOrFail($productoId);

                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'subtotal' => $item['precio'] * $item['cantidad'],
                ]);

                // Descontar Stock de la BD
                $producto->decrement('stock', $item['cantidad']);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('welcome')->with('success', "¡Venta realizada con éxito! Orden #{$venta->id}");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar la compra: ' . $e->getMessage());
        }
    }
}