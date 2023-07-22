<?php
    const SERVER_URI = 'http://localhost/producto3/Server.php';
    require_once 'vendor/autoload.php';
    require_once 'Connection.php';
    use Laminas\Soap\AutoDiscover;
    use Laminas\Db\Adapter\Adapter;
    class NovenoCDB {
        /**
            * @param int $Id  
            * @param string $Name
            * @return string
        */
        function ActMateria($Id, $Name){
            $connection = getDB();
            $query = "update Materias set Nombre='$Name' where idMaterias=$Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if($Result){
                return "Tabla actualizada!";
            }
        }
        /**
            * @param int $Id  
            * @param string $Name
            * @return string
        */
        function ActAlumnoNombre($Id, $Name){
            $connection = getDB();
            $query = "update Alumnos set Nombre='$Name' where idAlumnos=$Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if($Result){
                return "Tabla actualizada!";
            }
        }
        /**
            * @param int $Id  
            * @param string $FirstName
            * @return string
        */
        function ActAlumnoApePaterno($Id, $FirstName){
            $connection = getDB();
            $query = "update Alumnos set ApePaterno='$FirstName' where idAlumnos=$Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if($Result){
                return "Tabla actualizada!";
            }
        }
        /**
            * @param int $Id  
            * @param string $LastName
            * @return string
        */
        function ActAlumnoApeMaterno($Id, $LastName){
            $connection = getDB();
            $query = "update Alumnos set ApeMaterno='$LastName' where idAlumnos=$Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if($Result){
                return "Tabla actualizada!";
            }
        }
        /**
            * @param int $Id  
            * @param string $Date
            * @return string
        */
        function ActClases($Id, $Date){
            $connection = getDB();
            $query = "update Clases set Fecha='$Date' where idClases=$Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if($Result){
                return "Tabla actualizada!";
            }
        }
        /**
            * @param int $Id  
            * @param int $Asistencia
            * @return string
        */
        function ActAsistencia($Id, $Asistencia){
            $connection = getDB();
            $query = "update Asistencias set Asistencia='$Asistencia' where idAsistencias=$Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if($Result){
                return "Tabla actualizada!";
            }
        }
        /**
            * @param string $Name
            * @return string
        */
        function InsMaterias($Name) {
            $connection = getDB();
            $query = "insert into Materias(Nombre) values ('$Name')";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Insercion Correcta";
            }
        }
        /** 
            * @param string $Date
            * @return string
        */
        function InsClases($Date){
            $connection = getDB();
            $query = "insert into Clases(Fecha) values ('$Date')";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Insercion Correcta";
            }
        }
        /** 
            * @param string $Name
            * @param string $FirstName
            * @param string $LastName
            * @return string
        */
        function InsAlumnos($Name,$FirstName,$LastName){
            $connection = getDB();
            $query = "insert into Alumnos(Nombre,ApePaterno,ApeMaterno) values ('$Name','$FirstName','$LastName')";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Insercion Correcta";
            }
        }
        /** 
            *@param int $Attendance
            *@param int $FK_IdAlumnos
            *@param int $FK_IdClases
            *@param int $FK_IdMaterias
            * @return string
        */
        function InsAsistencias($Attendance,$FK_IdAlumnos,$FK_IdClases,$FK_IdMaterias){
            $connection = getDB();
            $query = "INSERT INTO Asistencias(Asistencia,FK_idAlumnos,FK_idClases,FK_idMaterias) VALUES ($Attendance,$FK_IdAlumnos,$FK_IdClases,$FK_IdMaterias);";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Insercion Correcta";
            }
        }
    }
    $wsdl = (new AutoDiscover())
        ->setClass(NovenoCDB::class)
        ->setUri(SERVER_URI)
        ->setServiceName('NovenoC')
        ->setOperationBodyStyle(['use' => 'literal'])
        ->setBindingStyle(['style' => 'rpc'])
        ->generate()
        ->toXml();

    $wsdlfile = tempnam(sys_get_temp_dir(), __FILE__);
    file_put_contents($wsdlfile, $wsdl);

    if (array_key_exists('wsdl', $_GET)) {header('Content-Type: application/wsdl+xml'); die($wsdl);}

    $server = new SoapServer($wsdlfile, ['soap_version' => SOAP_1_2,]);
    $server->setClass(NovenoCDB::class);
    $server->handle();
?>