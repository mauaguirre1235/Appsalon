<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController
{

    public static function login(Router $router)
    {
        $router->render('auth/login');

    }
    public static function logout()
    {
        echo "desde logout";

    }
    public static function olvide(Router $router)
    {
        $router->render('auth/olvide-password', [

        ]);

    }
    public static function recuperar()
    {
        echo "recuperar";


    }
    public static function crear(Router $router)
    {
        $usuario = new Usuario;

        // Alertas vacias 
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();


            // Revisar que alerta este vacio 
            if (empty($alertas)) {
                // verificar que el usuario no este registrado

                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password 
                    $usuario->hashPasword();

                    // generar un token
                    $usuario->crearToken();
                    
                    debuguear($usuario);
                }
            }


        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas

        ]);

    }

 


}