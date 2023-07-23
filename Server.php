<?php
    const SERVER_URI = 'http://localhost/Producto3/Server.php';
    require_once 'vendor/autoload.php';
    require_once 'Connection.php';
    use Laminas\Soap\AutoDiscover;
    use Laminas\Db\Adapter\Adapter;

    class NovenoCDB {
        /** 
            * @param string $Name
            * @param string $FirstName
            * @param string $LastName
            * @return string
        */
        function InsAlumno($Name,$FirstName,$LastName){
            $connection = getDB();
            $query = "insert into Alumnos(Nombre,ApePaterno,ApeMaterno) values ('$Name','$FirstName','$LastName')";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Alumno insertado con exito";
            }
        }
        /** 
            *@param int $Attendance
            *@param int $FK_IdAlumnos
            *@param int $FK_IdClases
            *@param int $FK_IdMaterias
            * @return string
        */
        function InsAsistencia($Attendance,$FK_IdAlumnos,$FK_IdClases,$FK_IdMaterias){
            $connection = getDB();
            $query = "INSERT INTO Asistencias(Asistencia,FK_idAlumnos,FK_idClases,FK_idMaterias) VALUES ($Attendance,$FK_IdAlumnos,$FK_IdClases,$FK_IdMaterias);";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Asistencia insertada con exito";
            }
        }
        /** 
            * @param string $Date
            * @return string
        */
        function InsClase($Date){
            $connection = getDB();
            $query = "insert into Clases(Fecha) values ('$Date')";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Clase insertada con exito";
            }
        }
        /**
            * @param string $Name
            * @return string
        */
        function InsMateria($Name) {
            $connection = getDB();
            $query = "insert into Materias(Nombre) values ('$Name')";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Materia insertada con exito";
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
                return "Nombre del alumno actualizado!";
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
                return "Apellido paterno actualizado!";
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
                return "Apellido materno actualizado!";
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
                return "Asistencia actualizada!";
            }
        }
        /**
            * @param int $Id  
            * @param string $Date
            * @return string
        */
        function ActClase($Id, $Date){
            $connection = getDB();
            $query = "update Clases set Fecha='$Date' where idClases=$Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if($Result){
                return "Fecha de la clase actualizada!";
            }
        }
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
                return "Materia actualizada!";
            }
        }
        /**
            * @param int $Id
            * @return string
        */
        function DelAlumno($Id) {
            $connection = getDB();
            $query = "DELETE FROM Alumnos WHERE idAlumnos = $Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Se ha eliminado al alumno";
            }
        }
        /**
            * @param int $Id
            * @return string
        */
        function DelClase($Id) {
            $connection = getDB();
            $query = "DELETE FROM Clases WHERE idClases = $Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Se ha eliminado la clase";
            }
        }
        /**
            * @param int $Id
            * @return bool
        */
        function DelMateria($Id) {
            $connection = getDB();
            $query = "DELETE FROM Materias WHERE idMaterias = $Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Se ha eliminado la materia";
            }
        }
        /**
            * @param int $Id
            * @return string
        */
        function DelAsistencia($Id) {
            $connection = getDB();
            $query = "DELETE FROM Asistencias WHERE idAsistencias = $Id";
            $Result = $connection->query($query, Adapter::QUERY_MODE_EXECUTE);
            if ($Result){
                return "Se ha eliminado la asistencia";
            }
        }
        /**
            * @param string $option
            * @return string
        */
        function MesConMasMenosPorcentajeAsistencias($option) {
            $connection = getDB();
            $query1 = "SELECT (SUM(Asistencias.Asistencia) / 441 * 100) AS Porcentaje_Asistencias
                    FROM Asistencias
                    JOIN Clases ON Asistencias.FK_idClases = Clases.idClases
                    WHERE Clases.Fecha >= '2023-05-01' AND Clases.Fecha <= '2023-05-31';";
            $statement = $connection->query($query1, Adapter::QUERY_MODE_EXECUTE);
            $resultSet = $statement->current();
            $Mayo = (float) $resultSet['Porcentaje_Asistencias'];

            $query2 = "SELECT (SUM(Asistencias.Asistencia) / 462 * 100) AS Porcentaje_Asistencias
                    FROM Asistencias
                    JOIN Clases ON Asistencias.FK_idClases = Clases.idClases
                    WHERE Clases.Fecha >= '2023-06-01' AND Clases.Fecha <= '2023-06-30';";
            $statement = $connection->query($query2, Adapter::QUERY_MODE_EXECUTE);
            $resultSet = $statement->current();
            $Junio = (float) $resultSet['Porcentaje_Asistencias'];

            $query3 = "SELECT (SUM(Asistencias.Asistencia) / 168 * 100) AS Porcentaje_Asistencias
                    FROM Asistencias
                    JOIN Clases ON Asistencias.FK_idClases = Clases.idClases
                    WHERE Clases.Fecha >= '2023-07-01' AND Clases.Fecha <= '2023-07-31';";
            $statement = $connection->query($query3, Adapter::QUERY_MODE_EXECUTE);
            $resultSet = $statement->current();
            $Julio = (float) $resultSet['Porcentaje_Asistencias'];

            switch($option){
                case "Mayor":
                    if($Mayo >= $Junio && $Mayo >= $Julio){return "El mes con mayor porcentaje de asistencias es: Mayo";}
                    if($Junio >= $Mayo && $Junio >= $Julio){return "El mes con mayor porcentaje de asistencias es: Junio";}
                    if($Julio >= $Mayo && $Julio >= $Junio){return "El mes con mayor porcentaje de asistencias es: Julio";}
                    break;
                case "Menor":
                    if($Mayo <= $Junio && $Mayo <= $Julio){return "El mes con menor porcentaje de asistencias es: Mayo";}
                    if($Junio <= $Mayo && $Junio <= $Julio){return "El mes con menor porcentaje de asistencias es: Junio";}
                    if($Julio <= $Mayo && $Julio <= $Junio){return "El mes con menor porcentaje de asistencias es: Julio";}
                    break;
                default: 
                return "Opcion invalida";
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