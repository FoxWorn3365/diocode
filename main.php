<?php
// Carichiamo subito un file
$file = $argv[1];

if (!file_exists($file)) {
  echo "[DioCode][ERROR][#interpreter] Il file indicato ($file) non esiste!";
  exit;
}

// Ok, ora che sappiamo che il file esiste provvedo a sistemare il codice
$file = preg_split('/\r\n|\r|\n/', file_get_contents($file));

$row = 1;
$error = 0;
$str = array();
foreach ($file as $line) {
  $str[$row] = $line;
  // Il codice NON deve terminare con una ; a differenza di PHP

  // ORA INIZIO AD INTERPRETARE LE LINEE
  $str[$row] = str_replace("HEYDIO", "<?php", $str[$row]);
  $str[$row] = str_replace("MUORIUNPO", "?>", $str[$row]);
  $str[$row] = str_replace("DAMMI UNA ", "require_once('", $str[$row]);
  $str[$row] = str_replace("HAI CAPITO?", "');", $str[$row]);
  $str[$row] = str_replace("TIRA UN PO GIU ", "echo ", $str[$row]);
  $str[$row] = str_replace(" CHE NON ESISTE", ";", $str[$row]);
  $str[$row] = str_replace("HO UN ", "define('", $str[$row]);
  $str[$row] = str_replace(" E SI CHIAMA ", "', '", $str[$row]);
  $str[$row] = str_replace(" E LO PRENDO DA UNA ", "', ", $str[$row]);
  $str[$row] = str_replace(" COME DIO", "');", $str[$row]);
  $str[$row] = str_replace("NONCOMMENTO", "// ", $str[$row]);
  $str[$row] = str_replace("SE DIO DICE CHE ", "if (", $str[$row]);
  $str[$row] = str_replace(" E' UGUALE A ", " == ", $str[$row]);
  $str[$row] = str_replace(" ALLORA MI SA CHE", ") {", $str[$row]);
  $str[$row] = str_replace("MI FACCIO UNO SPUNTINO CON ", "sleep(", $str[$row]);
  $str[$row] = str_replace(" PANINI", ");", $str[$row]);
  $str[$row] = str_replace(" OK", "');", $str[$row]);
  $str[$row] = str_replace(" PERFECT", ");", $str[$row]);
  $str[$row] = str_replace("NELLA BIBBIA DI ", "file_put_contents('", $str[$row]);
  $str[$row] = str_replace(" CI ANDIAMO A SCARABOCCHIARE ", "', '", $str[$row]);
  $str[$row] = str_replace(" CI ANDIAMO A METTERE ", "', ", $str[$row]);
  $str[$row] = str_replace("ALTRIMENTI FAREI", "} else {", $str[$row]);
  $str[$row] = str_replace("E ME NE VADO", "}", $str[$row]);
  $str[$row] = str_replace("MA SE COLPO DI SCENA", "} elseif (", $str[$row]);
  $str[$row] = str_replace(" E' DIVERSO ", " != ", $str[$row]);
  $str[$row] = str_replace(" E' MAGGIORE ", " > ", $str[$row]);
  $str[$row] = str_replace(" E' MINORE ", " < ", $str[$row]);
  $str[$row] = str_replace("BESTEMMIO CON UN SONORO ", "die('", $str[$row]);
  $str[$row] = str_replace("BELLA RAPINA", "readline());", $str[$row]);
  $str[$row] = str_replace("PADRE PIO", 'echo "\n\n";', $str[$row]);
  $str[$row] = str_replace("PREGA A VOCE ", 'echo "', $str[$row]);
  $str[$row] = str_replace(" PER IL SIGNORE", '";', $str[$row]);
  $str[$row] = str_replace(" E GLI FACCIO LEGGERE LA BIBBIA DI ", "', file_get_contents('", $str[$row]);
  $str[$row] = str_replace(" PER ACCULTURARLO", ");", $str[$row]);
  $row++;
}

// Ora che ho finito controllo gli orrori
if ($error == 0) {
  $stringa = "";
  var_dump($str);
  foreach ($str as $pt) {
    $stringa = "$stringa\n$pt";
  }

  file_put_contents($argv[1] . '.php', $stringa);
} else {
  die("[DioCode][FATAL-ERROR][#interpreter] Il file contiene errori!");
}
