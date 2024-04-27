<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ModelRol;
use App\Models\Centro;
use App\Models\Empresa;
use App\Mail\UsuarioCreado;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function store(Request $request){
        // Si hay un userId en la solicitud, estás editando un usuario existente
        if ($request->has('userId')) {
            // Obtiene el usuario existente por su ID
            $user = User::find($request->userId);

            // Verifica si se encontró el usuario
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            // Actualiza solo los atributos que existen en el request
            if ($request->has('name')) {
                $user->name = $request->name;
            }

            if ($request->has('email')) {
                $user->email = $request->email;
            }

            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }

            if ($request->has('empresaId')) {
                // Verifica si hay múltiples empresas seleccionadas
                if (is_array($request->empresaId)) {
                    // Si hay múltiples empresas, conviértelas en una cadena separada por comas
                    $empresaId = implode(',', $request->empresaId);
                    $user->empresaId = $empresaId;
                } else {
                    // Si solo hay una empresa, asigna directamente el valor
                    $user->empresaId = $request->empresaId;
                }
            }

            if ($request->has('centroId')) {
                $user->centroId = $request->centroId;
            }

            $user->save();

            // Restablece los roles existentes del usuario
            $user->roles()->detach();

            // Asigna el nuevo rol
            if ($request->has('roleId')) {
                switch ($request->roleId) {
                    case 1:
                        $user->assignRole('cliente');
                        break;
                    case 2:
                        $user->assignRole('admin');
                        break;
                    case 3:
                        $user->assignRole('cliente-admin');
                        break;
                    // Agrega más casos según tus necesidades
                }
            }

            // Recupera datos de empresa y centro
            $centro = Centro::find($user->centroId);
            $empresa = Empresa::find($user->empresaId);

            try {
                foreach (['csoto@pclink.cl'] as $recipient) {
                    // Envía el correo
                    Mail::to($recipient)->send(new UsuarioCreado($user, $empresa, $centro));
                }

                return response()->json(['success' => 'Usuario actualizado con éxito, correo enviado']);
            } catch (\Exception $e) {
                return response()->json(['success' => 'Usuario actualizado con éxito, correo no enviado.']);
            }
        } else {
            // Si no hay userId en la solicitud, estás creando un nuevo usuario
            // Lógica para crear un nuevo usuario
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);

            if ($request->has('empresaId')) {
                // Verifica si hay múltiples empresas seleccionadas
                if (is_array($request->empresaId)) {
                    // Si hay múltiples empresas, conviértelas en una cadena separada por comas
                    $empresaId = implode(',', $request->empresaId);
                    $user->empresaId = $empresaId;
                } else {
                    // Si solo hay una empresa, asigna directamente el valor
                    $user->empresaId = $request->empresaId;
                }
            }

            if ($request->has('centroId')) {
                $user->centroId = $request->centroId;
            }

            $user->save();

            // Asigna el rol
            if ($request->has('roleId')) {
                switch ($request->roleId) {
                    case 1:
                        $user->assignRole('cliente');
                        break;
                    case 2:
                        $user->assignRole('admin');
                        break;
                    case 3:
                        $user->assignRole('cliente-admin');
                        break;
                    // Agrega más casos según tus necesidades
                }
            }

            // Recupera datos de empresa y centro
            $centro = Centro::find($user->centroId);
            $empresa = Empresa::find($user->empresaId);

            try {
                foreach (['csoto@pclink.cl'] as $recipient) {
                    // Envía el correo
                    Mail::to($recipient)->send(new UsuarioCreado($user, $empresa, $centro));
                }

                return response()->json(['success' => 'Usuario creado con éxito, correo enviado']);
            } catch (\Exception $e) {
                return response()->json(['success' => 'Usuario creado con éxito, correo no enviado.']);
            }
        }
    }

    public function listar(Request $request){
        $query = User::query();

        // Cargar las relaciones de roles y obtener los datos filtrados
        $data = $query->with('roles')->get();

        // Formatea los datos según tus necesidades
        $formattedData = [];

        foreach ($data as $user) {
            $roles = $user->roles->pluck('name')->implode(', '); // Obtén los nombres de los roles como una cadena

            $formattedData[] = [
                $user->id,
                $user->name,
                $user->empresaId,
                $roles, // Agrega la cadena de roles al array
            ];
        }

        return response()->json(['data' => $formattedData]);
    }

    public function detalle($id)
    {
        $usuario = User::find($id);

        $rolId = Role::join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('model_has_roles.model_id', $usuario->id)
        ->where('model_has_roles.model_type', User::class)
        ->value('roles.id');

        // Asigna el ID del rol directamente al usuario
        $usuario->roleId = $rolId;
        
        // Puedes ajustar qué datos específicos deseas devolver en la respuesta JSON
        return response()->json(['usuario' => $usuario]);
    }

}
