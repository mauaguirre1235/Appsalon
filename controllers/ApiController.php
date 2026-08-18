<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController
{
    public static function index()
    {

        $servicios = Servicio::all();
        header('Content-Type: application/json');
        echo json_encode($servicios);
    }

    public static function guardar()
    {
        // Almacena la cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        // obtener el id de la cita
        $id = $resultado['id'];

        // Almacena los servicios con el ID de la cita
        $idServicios = explode(",", $_POST['servicios']);
        
        foreach($idServicios as $idServicio){
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }


}
