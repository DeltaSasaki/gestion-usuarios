<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Obtener el perfil del usuario autenticado
     */
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Listado paginado de usuarios (solo para admins)
     */
    public function index(Request $request)
    {
        // Verificar si el usuario es administrador
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Acceso denegado. Se requiere rol de administrador.'
            ], 403);
        }

        // Paginación con valores por defecto
        $limit = $request->query('limit', 15);
        $users = User::paginate($limit);

        return response()->json($users);
    }
}