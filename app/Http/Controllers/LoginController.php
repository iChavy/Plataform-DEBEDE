<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('Correo_electronico', $request->email)->first();

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|min:6|max:100',
                'Contrasenya' => 'required|min:6|max:20|exists:users,Contrasenya',
            ],
            [
                'email.required' => 'Se debe ingresar un correo electronico.',  
                'email.min' => 'Debe ser de largo mínimo :min',
                'email.max' => 'Debe ser de largo máximo :max',

                'Contrasenya.required' => 'Se debe ingresar una contraseña.',
                'Contrasenya.min' => 'Debe ser de largo mínimo :min',
                'Contrasenya.max' => 'Debe ser de largo máximo :max',
                'Contrasenya.exists' => 'Correo o contraseña inválidos',

            ]
        );
        $validator->validate();
        if (empty($user)) {
            return redirect()->to('/login');
        }
        if ($request->Contrasenya == $user->Contrasenya) {
            setcookie('user', $user->Correo_electronico);
            setcookie('id', $user->id); // PROBAR CON DOMINIO
            setcookie('rol', $user->ID_Rol);
            $id = $user->id;
            //agregar if para las vistas
            return (redirect()->to('/user/vistaUser/' . $id));
        }
        return redirect()->to('/login');
    }

    public function logout(Request $request)
    {
        setcookie('user', '', time() - 1);
        setcookie('id', '', time() - 1);
        setcookie('rol', '', time() - 1);
        return redirect()->to('/inicio');
    }
}
