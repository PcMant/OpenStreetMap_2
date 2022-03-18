<?php 
//lectura de los ficheros csv

//lectura de ficheros CSV
$archivo = fopen('csv/turismo_guada_rutas.csv', "r");

// while(!feof($archivo)){
//     $contenido = fgets($archivo);
// }

// Dependencias

/*libreria Nominatim*/
// use maxh\Nominatim\Nominatim;
// require_once 'vendor/autoload.php';

/*libreria Leaflet*/
// require_once 'libs/LeafletMaphp-main/LeafletMaphp.php';

// Crear objeto de la clase Nomatim
// $url = "http://nominatim.openstreetmap.org/";
// $nominatim = new Nominatim($url);

// Creando objeto de la clase Leaflet
// $map = new LeafletMaphp();

echo "
<!DOCTYPE html>\n
<html>\n
<head>\n
";

/*Mostrar esto dentro de la cabecera*/
// echo $map->showHeadTags();
echo "
    <title>Inicio</title>\n
</head>\n
<body>
";

// Buscar rutas por zona
if(empty($_GET['zona'])){
    echo "
        <form method='zonas' action='index.php'>

        <p>
            <label for='ruta'>zona: </label>
            <select name='zona' id='zona'>
    ";
    
        echo "<option value='A'>Alcarria</option>";
        echo "<option value='C'>Campiña</option>";
        echo "<option value='T'>Molina / Alto Tajo</option>";
        echo "<option value='S'>Sierra Norte</option>";
    
    echo "
            </select>
        </p>

        <button type='submit'>Enviar</button>
        </form>
    ";
}

// Selección de ruta
if(!empty($_GET['zona'])){
    echo "
        <form method='zonas' action='p2.php'>

        <p>
            <label for='ruta'>ruta: </label>
            <select name='ruta' id='ruta'>
    ";
    
    while(!feof($archivo)){
        $contenido = fgets($archivo);
        $contenido = explode("\t", $contenido);
        /*if(!empty($contenido[3]))*/ echo "<option value='{$contenido[0]}'>{$contenido[4]}</option>";
    }
    

    echo "
            </select>
        </p>

        <button type='submit'>Enviar</button>
        </form>
    ";
}

echo '</body></html>';

?>