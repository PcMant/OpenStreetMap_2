<?php 
// variables base de datos
$host_db = 'localhost';
$port_db = 3306;
$database = 'turismo';
$user_db = 'root';
$pass_db = '';

// Consulta en la base de datos
try {
    // Obteniendo rutas
    $pdo = new PDO("mysql:host={$host_db};port={$port_db};dbname={$database};charset=utf8", $user_db, $pass_db);
    

    //Consulta
    $sql = 'SELECT * FROM `rutas`';
    $sentencia = $pdo->prepare($sql);
    
    $sentencia->execute();
    $resultados = $sentencia->fetchAll();

    
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}


// Dependencias

/*libreria Nominatim*/
// use maxh\Nominatim\Nominatim;
// require_once 'vendor/autoload.php';

/*libreria Leaflet*/
require_once 'libs/LeafletMaphp-main/LeafletMaphp.php';

// Crear objeto de la clase Nomatim
// $url = "http://nominatim.openstreetmap.org/";
// $nominatim = new Nominatim($url);

// Creando objeto de la clase Leaflet
$map = new LeafletMaphp();

echo "
<!DOCTYPE html>\n
<html>\n
<head>\n
";

/*Mostrar esto dentro de la cabecera*/
echo $map->showHeadTags();
echo "
    <title>TITULO</title>\n
</head>\n
<body>
";



echo '</body></html>';

?>