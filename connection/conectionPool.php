<?php 


// class Conexion{

//     private $name_db = "almacen_nuevo";
//     private $server = '128.5.8.85';
//     private $user = 'dev';
//     private $password = '12345678';

//     // function __construct($name_db){
//     //     $this->name_db = $name_db;
//     // }



    function Conectar(){
        echo "hola";
        $name_db = "almacen_nuevo_qa";
        $server = '128.5.8.85';
        $user = 'dev';
        $password = '12345678';
        // try{
        //     // $base = new PDO($this->server, $this->user, $this->password);
        //     $base = mssql_connect($this->server, $this->user, $this->password);
        //     $database = mssql_select_db($this->name_db, $base);
        //     // $base->exec('SET CARACTER SET utf8');
        //     if ($base) {
        //         return $base;
        //     }else{
        //         echo "error";
        //     }
        // }catch (Exception $e) {
        //         $e->getMessage();
        //         die("Error " . "<div style='color: red;'><strong>" . $e->getMessage() . "</strong></div>");
        // }
    }
// }
?>