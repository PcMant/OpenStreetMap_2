<?php 
// Dependencias

/*libreria Nominatim*/
use maxh\Nominatim\Nominatim;
require_once 'vendor/autoload.php';

/*libreria Leaflet*/
require_once 'libs/LeafletMaphp-main/LeafletMaphp.php';

// Crear objeto de la clase Nomatim
$url = "http://nominatim.openstreetmap.org/";
$nominatim = new Nominatim($url);

// Consulta inversa a Nominatim
$reverse = $nominatim->newReverse()
    ->latlon((float) $_GET['lat'],(float) $_GET['lon']);
$result = $nominatim->find($reverse);

// Valores sacados de la consulta de Nomatim referenciados a Variables
$nombre = !empty($result['display_name']) ? $result['display_name'] : '';
$calle = !empty($result['address']['road']) ? $result['address']['road'] : '';
$numero = !empty($result['address']['house_number']) ? $result['address']['house_number'] : '';
$cp = !empty($result['address']['postcode']) ? $result['address']['postcode'] : '';

var_dump($result);

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
    <title>TITULO</title>\n
</head>\n
<body>
";

// Añadir marcador en el mapa
$map->addMarker((float) $_GET['lat'],(float) $_GET['lon']);
$map->addTooltip(LeafletMaphp::MARKER, 0, "{$_GET['lat']},{$_GET['lon']}");
$map->addOnClickText(LeafletMaphp::MARKER, 0, '');

echo $map->show();
echo $map->showOnClickDiv();

echo '</body></html>';

?>