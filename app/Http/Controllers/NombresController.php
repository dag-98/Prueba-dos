<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NombresController extends Controller
{
    public function ordenarNombresYContar(Request $request)
    {
        // Obtenemos los nombres del arreglo de la solicitud
        $nombres = $request->nombres;

        // Verificamos si se proporcionó el parámetro 'ascendente'
        $ascendente = $request->ascendente;

        // Ordenamos los nombres alfabéticamente
        if ($ascendente) {
            sort($nombres);
        } else {
            rsort($nombres);
        }

        // Contamos cuántos nombres se repiten en el arreglo
        $repeticiones = array_count_values($nombres);

        // Contamos cuántos nombres comienzan con 'A' o 'E'
        $nombresAE = 0;
        foreach ($nombres as $nombre) {
            if (strtoupper(substr($nombre, 0, 1)) === 'A' || strtoupper(substr($nombre, 0, 1)) === 'E') {
                $nombresAE++;
            }
        }

        // Devolvemos un objeto con las propiedades requeridas
        $resultado = [
            'Nombres Ordenados' => $nombres,
            'Nombres Repetidos' => $repeticiones,
            'Nombres que comienzan con A o E' => $nombresAE,
        ];

        return response()->json($resultado);
    }
}
