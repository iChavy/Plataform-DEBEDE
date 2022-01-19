<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $user = User::where('Correo_electronico', $request->email)->first();
        if(empty($user)){
            return redirect()->to('/login');
        }
        if($request->Contrasenya == $user->Contrasenya){
            setcookie('user', $user->Correo_electronico); 
            setcookie('id', $user->id);// PROBAR CON DOMINIO
            setcookie('rol', $user->ID_Rol);
            $id = $user->id;
            //agregar if para las vistas
            return (redirect()->to('/user/vistaUser/'.$id));
        }
        return redirect()->to('/login');
    }

    public function logout(Request $request)
    {
        setcookie('user', '', time()-1);
        setcookie('id', '', time()-1);
        setcookie('rol', '', time()-1);
        return redirect()->to('/inicio');
    } 


}
