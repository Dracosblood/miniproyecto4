<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $docente = Docente::all();
        return $docente;
    }

    public function show($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($docente);
    }

    public function store(Request $request)
    {
        // Valida los datos entrantes
        $request->validate([
            'nombre_materia' => 'required',
            'descripccion' => 'required', // Asegúrate de que estés validando el campo "apellido"
        ]);

        // Crea un nuevo usuario utilizando los datos de la solicitud
        $docente = new Docente();
        $docente->nombre = $request->input('nombre_materia');
        $docente->apellido = $request->input('descripcion'); // Asegúrate de asignar el apellido

        // Guarda el usuario en la base de datos
        $docente->save();

        // Devuelve una respuesta de éxito
        return response()->json(['message' => 'Materia creado con éxito'], 201);
    }

    public function update(Request $request, $id)
    {
        // Valida los datos entrantes
        $request->validate([
            'nombre_materia' => 'required',
            'descripccion' => 'required', // Asegúrate de que estés validando el campo "apellido"
        ]);

        // Encuentra el usuario existente por ID
        $docente = Docente::find($id);

        if (!$docente) {
            return response()->json(['message' => 'Materia no encontrado'], 404);
        }

        // Actualiza los campos del usuario en función de los datos de la solicitud
        $docente->nombre = $request->input('nombre_materia');
        $docente->apellido = $request->input('descripcion');
        // Actualiza otros campos según sea necesario

        // Guarda los cambios en la base de datos
        $docente->save();

        // Devuelve una respuesta de éxito
        return response()->json(['message' => 'Materia actualizado con éxito'], 200);
    }

    public function destroy($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Utiliza el método destroy para eliminar el usuario por su ID
        Docente::destroy($id);

        return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
    }
}