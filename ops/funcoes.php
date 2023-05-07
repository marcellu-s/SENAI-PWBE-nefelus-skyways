<?php
function distancia($lat1, $lon1, $lat2, $lon2) {
  $radius = 6371; // raio médio da Terra em km
  $dLat = deg2rad($lat2 - $lat1);
  $dLon = deg2rad($lon2 - $lon1);
  $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
  $c = 2 * asin(sqrt($a));
  $distance = $radius * $c;
  return $distance;
}

// Exemplo de uso:
$lat1 = -23.563333;
$lon1 = -46.654444;
$lat2 = -22.903611;
$lon2 = -43.209444;
$distance = distancia(-19.7657, -47.9662, -23.4356, -46.4731);
echo "A distância entre as coordenadas é de " . round($distance, 2) . " km.";
?>