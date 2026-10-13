<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function metricas()
    {
        Gate::authorize('ver-metricas');

        return response()->json([
            'total_eventos' => Evento::count(),
            'recaudo_total' => 2500000.00
        ], 200);
    }
}