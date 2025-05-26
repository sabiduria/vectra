<?php
@session_start();
include ('../config/connexion.php');
include ('../model/autoload.php');
extract($_POST);
if (isset($need)){
	switch ($need){
		case "New":
			$profiles = new Profiles($id, $name, $created, $deleted);
                if ($profiles->insert()){
                    echo "Success";
                } else{
                    echo "Failed";
                }
			break;

		case "Update":
			$profiles = new Profiles($id, $name, $created, $deleted);
                if ($profiles->update()){
                    echo "Success";
                } else{
                    echo "Failed";
                }
			break;

		case "View":
			    echo Profiles::select($id);
			break;

		case "List":
			    echo Profiles::select();
			break;
	}
}