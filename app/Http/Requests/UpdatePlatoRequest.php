<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlatoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $platoId = $this->route('id');

        return [
            'nombre'      => 'required|string|min:3|max:100|unique:platos,nombre,' . $platoId,
            'precio'      => 'required|numeric|min:1000.00',
            'descripcion' => 'required|string|min:10',
            'imagen'      => 'nullable|image|mimes:jpg,png,webp|max:2048', // Opcional al editar
        ];
    }
}
