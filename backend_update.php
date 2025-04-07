<?php
session_start();
require_once '_db.php';

$json = file_get_contents('php://input');
$params = json_decode($json);

$date1 = $params->start;
$date2 = $params->end;
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
$hours = abs($timestamp2 - $timestamp1)/(60*60);
$total = $hours*80;
$deposit = $hours*80*0.3;

$stmt = $db->prepare("UPDATE events SET name = :name, start = :start, end = :end, resource_id = :resource, phone = :phone, cust_id = :email, make_payment = :make_payment, total_payment = :total, deposit_payment = :deposit WHERE id = :id");
$stmt->bindParam(':id', $params->id);
$stmt->bindParam(':name', $params->text);
$stmt->bindParam(':start', $params->start);
$stmt->bindParam(':end', $params->end);
$stmt->bindParam(':resource', $params->resource);
$stmt->bindParam(':phone', $params->phone);
$stmt->bindParam(':make_payment', $params->make_payment);
$stmt->bindParam(':total', $total);
$stmt->bindParam(':deposit', $deposit);
$stmt->bindParam(':email', $params -> email);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Update successful';

header('Content-Type: application/json');
echo json_encode($response);