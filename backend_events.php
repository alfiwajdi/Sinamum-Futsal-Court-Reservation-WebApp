<?php
require_once '_db.php';
    
$stmt = $db->prepare('SELECT * FROM events WHERE NOT ((end <= :start) OR (start >= :end))');
$stmt->bindParam(':start', $_GET['start']);
$stmt->bindParam(':end', $_GET['end']);
$stmt->execute();
$result = $stmt->fetchAll();

class Event {}
$events = array();

foreach($result as $row) {
  $e = new Event();
  $e->id = $row['id'];
  $e->text = $row['name'];
  $e->phone = $row['phone'];
  $e->start = $row['start'];
  $e->end = $row['end'];
  $e->resource = $row['resource_id'];
  $e->email = $row['cust_id'];
  $e->make_payment = $row['make_payment'];
  $e->bubbleHtml = "Event details: <br/>".$e->text;
  $events[] = $e;
}

header('Content-Type: application/json');
echo json_encode($events);
