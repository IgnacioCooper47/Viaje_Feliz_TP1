<?php

include "viaje.php";

echo "\n\n Bienvenido a Viaje Feliz!\n\n";

$viaje = null;

$opcion = 0;

while ($opcion != 4){
    echo "\n MENU\n";
    echo "1- Cargar la información del viaje.\n";
    echo "2- Ver información del viaje.\n";
    echo "3- Modificar los datos del viaje.\n";
    echo "4- Salir.\n\n";
    
    echo "Porfavor selecione una opción: ";
    $opcion = trim(fgets(STDIN));
    
    if ($opcion > 4 || $opcion < 1){
        echo "Opcion invalida, vuelva a intentarlo\n";
    }    
    
    switch ($opcion){
        case 1:
            echo "\ningrese el codigo de viaje: ";
            $codigo = trim(fgets(STDIN));
            
            echo "\n Ingrese el Destino del viaje: ";
            $destino = trim(fgets(STDIN));

            echo "\n Ingrese la cantidad maxima de pasajeros: ";
            $maxPasajeros = trim(fgets(STDIN));

            echo "\n Ahora agregamos los pasajeros al viaje. \n";
            echo "Cuantos pasajeros: ";
            $p = trim(fgets(STDIN));
            
            $viaje = new viaje($codigo, $destino, $maxPasajeros);

            while ($maxPasajeros < $p || !(is_numeric($p))){
                echo "\n Porfavor volver a ingresar cuantos pasajeros van a viajar, ingreso mas de la cantidad maxima: ";
                $p = trim(fgets(STDIN));
            }

            for ($i=0; $i < $p; $i++){
                echo "\n Pasajero numero: ". $i + 1;
                echo "\n Ingrese el nombre del pasajero: ";
                $nombre = trim(fgets(STDIN));
                echo "\n Ingrese el apellido del pasajero: ";
                $apellido = trim(fgets(STDIN));
                echo "\n Ingrese el numero de documento del pasajero: ";
                $documento = trim(fgets(STDIN));

                $viaje-> agregarPasajero($nombre, $apellido, $documento, $i);
            }
        break;

        case 2:
            if ($viaje == null){
                echo "\n No existe viaje registrado.";
                echo "\n Primero debe cargar un viaje.\n\n";
            } else {
                $resumen = $viaje-> __toString();
                echo $resumen;
            }
        break;

        case 3:
            $subOpcion = null;
            if ($viaje == null){
                echo "\n No existe viaje registrado.";
                echo "\n Primero debe cargar un viaje.";
            }else {
                while ($subOpcion != 7){
                    echo "\n SELECCIONE QUE QUIERE MODIFICAR \n\n";
                    echo "1- Modificar el codigo de viaje. \n";
                    echo "2- Modificar el destino del viaje. \n";
                    echo "3- Modificar la cantidad maxima de pasajeros del viaje. \n";
                    echo "4- Modificar algun pasajero. \n";
                    echo "5- Eliminar un pasajero. \n";
                    echo "6- Agregar un pasajero. \n";
                    echo "7- Salir. \n";
                    
                    echo "Eliga una opción: ";
                    $subOpcion = trim(fgets(STDIN));

                    if ($subOpcion > 7 || $subOpcion < 1) {
                        echo "\nOpcion invalida, vuelva a intentarlo\n";
                        continue; // Se salta el resto de la iteración y se vuelve al inicio del bucle while
                    }

                    switch ($subOpcion){
                        case 1:
                            echo "\n Ingrese el nuevo codigo de viaje: ";
                            $codigoNew = trim(fgets(STDIN));
                            $viaje->setCodigoDeViaje($codigoNew);
                        break;

                        case 2:
                            echo "\n Ingrese el nuevo destino del viaje: ";
                            $destinoNew = trim(fgets(STDIN));
                            $viaje->setDestino($destinoNew);
                        break;

                        case 3:
                            echo "\n Ingrese la nueva cantidad de pasajeros: ";
                            $maxPasajerosNew = trim(fgets(STDIN));
                            $viaje->setCantMaxPasajeros($maxPasajerosNew);
                        break;

                        case 4:
                           echo "\n Ingrese que numero de pasajero quiere modificar: ";
                           $n = trim(fgets(STDIN));
                           echo "\n Ingrese los datos modificados del pasajero: ";
                           echo "\n Ingrese el nuevo nombre: ";
                           $nombreNew = trim(fgets(STDIN));
                           echo "\n Ingrese el nuevo apellido: "; 
                           $apellidoNew = trim(fgets(STDIN));
                           echo "\n Ingrese el nuevo numero de documento: ";
                           $dniNew = trim(fgets(STDIN));

                           $viaje->modificarPasajero($n, $nombreNew, $apellidoNew, $dniNew);
                        break;
                        
                        case 5:
                            echo "\n Ingrese el numero del pasajero que quiere borrar.";
                            echo "\n A continuacion le vamos a mostrar los pasajeros: \n";

                            $arregloPasajeros = $viaje->getPasajeros();
                            $in = 0;
                            foreach ($arregloPasajeros as $persona){
                                $in = $in + 1;
                                echo "\n Pasajero: ". $in;
                                echo "\n Nombre: " . $persona["nombre"];
                                echo "\n Apellido: " . $persona["apellido"];
                                echo "\n Numero de documento: " . $persona["dni"] . "\n";
                            }
                            
                            echo "\nAhora diganos cual era el numero de pasajero para borrar: ";
                            $nBorrar = trim(fgets(STDIN));
                            
                            while ($nBorrar > count($arregloPasajeros)){
                                echo "\nNumero invalido, vuelva a ingresar el numero de pasajero...";
                                echo "\nIngresar: ";
                                $nBorrar = trim(fgets(STDIN));
                            }
                            $viaje->eliminaPasajero($nBorrar);

                        break;

                        case 6:
                            $arregloPasajeros = $viaje->getPasajeros();

                            if (count($arregloPasajeros) >= $viaje->getCantMaxPasajeros()){
                                echo "\n No se puede agregar pasajeros, porque esta lleno.\n";
                                echo "\n Modificar la cantidad maxima de pasajeros para poder agregar más.\n";
                            }else {
                                echo "\n ingrese los datos del nuevo pasajero...\n";
                                echo "\nNombre: ";
                                $newName = trim(fgets(STDIN));
                                echo "\nApellido: ";
                                $newSurname = trim(fgets(STDIN));
                                echo "\nNumero de documento: ";
                                $newDni = trim(fgets(STDIN));

                                $resultadoAgregarPasajero = $viaje->nuevoPasajero($newName, $newSurname, $newDni);
                                echo $resultadoAgregarPasajero;
                            }
                        break;
                        
                        case 7:
                            echo "\nSaliendo...\n\n";
                        break;
                    }
                }
            }
        case 4: 
            echo "\nSaliendo...\n\n";
        break;
    }
}

