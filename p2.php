<?php 
//lectura de ficheros CSV
$archivo = fopen('csv/turismo_guada_puntos.csv', "r");

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
echo "<link rel='stylesheet' href='styless.css' />";
echo "
    <title>{$_GET['ruta']}</title>\n
</head>\n
<body>
";

echo "<h1>{$_GET['ruta']}</h1>";

//recorrer el fichero csv
$cc = 0; $cm = 0; $data= array();
while(!feof($archivo)){
    $contenido = fgets($archivo);
    $contenido = explode("\t", $contenido);

    //conprobar la ruta
    if(preg_match("/{$_GET['ruta']}/", $contenido[0]) == 1){

        $color = '';

        //colores
        switch($contenido[1]){
            case 'I': $color='green'; break;
            case 'F': $color='red'; break;
            case 'G': $color='blue'; break;
            case 'D': $color='gray'; break;
        }

        $cor = explode(",", $contenido[2]);

        $altura = !empty($cor[4]) ? ','.$cor[4] : '';

        // MArcas y circulos
        if(preg_match('/^R$/', $contenido[1]) == 1){
            $map->addMarker($cor[0], $cor[1]);
            if($contenido[3] != '') $map->addPopUp(LeafletMaphp::MARKER, $cm, $contenido[3]);
            if($contenido[2] != '') $map->addTooltip(LeafletMaphp::MARKER, $cm, $contenido[2]);


            $textoR = "
            <h4>{$contenido[3]}</h4>
            <a href='pantalla3.php?lat={$cor[0]}&lon={$cor[1]}'>Ver más información</a>
            ";

            $map->addOnClickText(LeafletMaphp::MARKER, $cm, $textoR);

            $cm++;
        }else{
            $map->addCircle($cor[0], $cor[1], $color);
            if($contenido[3] != '') $map->addPopUp(LeafletMaphp::CIRCLE, $cc, $contenido[3]);
            if($contenido[2] != '') $map->addTooltip(LeafletMaphp::CIRCLE, $cc, "{$contenido[2]}{$altura}");

            array_push($data,$cor[0]); array_push($data,$cor[1]);

            $cc++;
        }

    }
}

// Añadiendo las linedas que marcan la ruta
var_dump($data);
foreach($data as $key => $d){
    
}

// Mostrando mapa
echo $map->showOnClickDiv();
echo $map->show();


echo '</body></html>';

?>