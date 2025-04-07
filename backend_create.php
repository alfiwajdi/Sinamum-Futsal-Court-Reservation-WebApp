<?php
require_once '_db.php';
session_start();
$json = file_get_contents('php://input');
$params = json_decode($json);

$stmt = $db->prepare("INSERT INTO events (name, start, end, resource_id, phone, cust_id, total_payment, deposit_payment) VALUES (:name, :start, :end, :resource, :phone, :email, :total, :deposit)");
$stmt->bindParam(':start', $params->start);
$stmt->bindParam(':end', $params->end);
$stmt->bindParam(':name', $params->text);
$stmt->bindParam(':resource', $params->resource);
$stmt->bindParam(':phone', $params->phone);
$stmt->bindParam(':email', $_SESSION['user']);
$stmt->bindParam(':total', $params->total);
$stmt->bindParam(':deposit', $params->deposit);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$db->lastInsertId();
$response->id = $db->lastInsertId();

header('Content-Type: application/json');
echo json_encode($response);