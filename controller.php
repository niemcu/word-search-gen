<?php

include_once 'TableGenerator.class.php';
include_once 'GridFiller.class.php';

$words = explode(" ", $_REQUEST['wordsList']);

//$words = array("PEDAL", "FRAJER", "GEJ", "ZOFIA", "ELO");
$filler = new GridFiller($words, 10, 10);
$grid = $filler->getGrid();

$generator = new TableGenerator($grid, 10, 10);

echo $generator->getHTML();


?>