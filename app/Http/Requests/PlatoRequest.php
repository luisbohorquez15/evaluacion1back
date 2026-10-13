<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'      => 'required|string|min:3|max:100|unique:platos,nombre',
            'precio'      => 'required|numeric|min:1000.00',
            'descripcion' => 'required|string|min:10',
            'imagen'      => 'required|image|mimes:jpg,png,webp|max:2048',
        ];
    }
}