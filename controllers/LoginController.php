<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{

    public static function login(Router $router)
    {
        $alertas = [];  

       


        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);

           $alertas =  $auth->validarLogin();

           if(empty($alertas)){
            // comprobar que exista el usuario
            $usuario = Usuario::where('email', $auth->email);

            if($usuario) {
                // verificar el password
               if( $usuario->comprobarPasswordAndVerificado($auth->password)){
                    // autenticar al usuario 
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                    $_SESSION['email'] = $usuario->email ;
                    $_SESSION['login'] = true;

                    // redireccionamiento 
                    if($usuario->admin === "1") {
                        $_SESSION['admin'] =$usuario->admin ?? null;

                         header('Location: /admin');
                    } else {
                        header('Location: /cita');
                    }

                    debuguear($_SESSION);

               }
            } else {
                Usuario::setAlerta('error', 'usuario no encontrado');
            }
           

            }
            
        } 

        $alertas =Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas

        ]);

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

                    // Enviar el email 
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    $email->enviarConfirmacion();

                    // crear usuario 
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');

                    }

                    //debuguear($usuario);
                }
            }


        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas

        ]);

    }

    public static function mensaje(Router $router)
    {

        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router)
    {

        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            // mostrar mensaje de error 
            Usuario::setAlerta('error', 'Token no Valido');
        } else {
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');

        } 
        // obtener alertas
        $alertas = Usuario::getAlertas();

        // renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }




}