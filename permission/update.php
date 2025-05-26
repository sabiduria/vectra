<?php
include ('resources/config/connexion.php');
include ('resources/model/autoload.php');
extract($_GET);
extract($_POST);

$data = explode('-', $storageValue);
$access = $data[0];
$state = $data[1];
$accessID = $data[2];
Accessrights::update($accessID, $access, $state);