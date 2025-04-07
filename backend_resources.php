<?php
require_once '_db.php';
    
$scheduler_resources = $db->query('SELECT * FROM resources ORDER BY name');

class Resource {}

$resources = array();

foreach($scheduler_resources as $resource) {
  $g = new Resource();
  $g->id = $resource['id'];
  $g->name = $resource['name'];
  $g->expanded = true;
  $g->children = array();
  $resources[] = $g;
}

header('Content-Type: application/json');
echo json_encode($resources);
