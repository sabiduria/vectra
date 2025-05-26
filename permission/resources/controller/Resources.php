<?php
@session_start();
include ('../config/connexion.php');
include ('../model/autoload.php');
extract($_POST);
if (isset($need)){
	switch ($need){
		case "New":
			$resources = new Resources(null, htmlentities($name_fr), htmlentities($name_en), $position, isset($resource_id) ? ($resource_id != 'none' ? $resource_id : null) : null, htmlentities($link), $icon, isset($hasmany) ? $hasmany : 0, null, null);
                if ($resources->insert()){
                    echo "Success";
                    header('Location:../add?resources');
                } else{
                    echo "Failed";
                }
			break;

		case "Update":
			$resources = new Resources($id, $name_fr, $name_en, $position, $resource_id, $link, $icon, $hasmany, $created, $deleted);
                if ($resources->update()){
                    echo "Success";
                } else{
                    echo "Failed";
                }
			break;

		case "View":
			    echo Resources::select($id);
			break;

		case "List":
			    echo Resources::select();
			break;
	}
}