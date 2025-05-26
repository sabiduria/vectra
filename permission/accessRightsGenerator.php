<?php
include('resources/config/connexion.php');
include('resources/model/autoload.php');

$profiles = json_decode(Profiles::select(), true);
$resources = json_decode(Resources::select(), true);


foreach ($profiles as $key=>$value){
    //Accessrights::insert($value['id'], 15);
    foreach ($resources as $key2=>$value2){
        echo $value2['name'].'-'.$value['name'].'<br>';
        Accessrights::insert($value['id'], $value2['id']);
    }
    echo '<br>';
}

