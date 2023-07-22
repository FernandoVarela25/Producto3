<?php
    require_once 'vendor/autoload.php';
    use Laminas\Db\Adapter\Adapter;
    function getDB() {
        $cadConnection = [
            'driver'  =>'Pdo_Mysql',
            'hostname'=>'localhost',
            'database'=>'NovenoC',
            'username'=>'LuisFernando',
            'password'=>'12345678'
        ];
        return new Adapter($cadConnection);
    }
?>