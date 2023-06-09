<?php

class Viaje{
    // Recolecta y modifica los datos de un viaje
    // Los atributos son: $codigoDeViaje, $destino, $cantMaxPasajeros, $pasajeros

    private $codigoDeViaje;

    private $destino;

    private $cantMaxPasajeros;

    private $pasajeros;

    public function __construct($codigoDeViaje, $destino, $cantMaxPasajeros){
        //metodo constructor de la clase viaje
        $this->codigoDeViaje = $codigoDeViaje;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->pasajeros = array();
    }

    public function getCodigoDeViaje(){
        return $this->codigoDeViaje;
    }
    
    public function setCodigoDeViaje($codigoDeViaje){
        $this->codigoDeViaje = $codigoDeViaje;
    }

    public function getDestino(){
        return $this->destino;
    }
    
    public function setDestino($destino){
        $this->destino = $destino;
    }

    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    public function setCantMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }

    public function getPasajeros(){
        return $this->pasajeros;
    }

    public function setPasajeros($pasajeros){
        $this->pasajeros = $pasajeros;
    }

    public function agregarPasajero($nombre, $apellido, $dni, $indice){
        $arreglo = $this->getPasajeros();
        $arreglo [$indice] = array(
            "nombre" => $nombre,
            "apellido" => $apellido,
            "dni" => $dni,
        );
        $this->setPasajeros($arreglo);
    }

    public function modificarPasajero($indice, $nombre, $apellido, $dni){
        $indice = $indice - 1;
        $arreglo = $this->getPasajeros();
        $arreglo [$indice] = array(
            "nombre" => $nombre,
            "apellido" => $apellido,
            "dni" => $dni,
        );
        $this->setPasajeros($arreglo);
    }

    public function mostrarArreglo(){
        $arreglo = $this->getPasajeros();
        $cadena = "";
        foreach ($arreglo as $indice => $subArreglo){
            $cadena = $cadena . "\n\n Pasajero: ". $indice + 1 ." \n";
            foreach($subArreglo as $clave => $valor){
                $cadena = $cadena . $clave . ": " . $valor . " \n";
            }
        }
        return $cadena;
    }

    public function __toString(){
        return "Codigo de viaje: " . $this->getCodigoDeViaje() . " \n El destino: " . $this->getDestino() . "\n Cantidad Maxima de pasajeros: " . $this->getCantMaxPasajeros() . "\n" . $this->mostrarArreglo();
    }

    public function eliminaPasajero($indice){
        $arreglo = $this->getPasajeros();
        $indice = $indice - 1;
        unset($arreglo[$indice]);
        $arreglo = array_values($arreglo);
        $this->setPasajeros($arreglo);
    }

    public function nuevoPasajero($nombre, $apellido, $dni){
        $arreglo = $this->getPasajeros();
        $max = $this->getCantMaxPasajeros();
        if ($max <= count($arreglo)){
            $resultado = "No se puede ingresar un nuevo pasajero porque ya esta lleno.";
        }else {
            $arregloAgregar = [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "dni" => $dni
            ];

            array_push($arreglo, $arregloAgregar);
            $this->setPasajeros($arreglo);
            $resultado = "Se agrego el pasajero correctamente!";
        }
        return $resultado;
    }
}