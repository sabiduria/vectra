<?php
@session_start();
include ('../config/connexion.php');
include ('../model/autoload.php');
extract($_POST);
if (isset($need)){
	switch ($need){
		case "New":
			$accessrights = new Accessrights($id, $profile_id, $resource_id, $accessrights, $created, $modified, $createdby, $modifiedby, $deleted);
                if ($accessrights->insert()){
                    echo "Success";
                } else{
                    echo "Failed";
                }
			break;

		case "Update":
			$accessrights = new Accessrights($id, $profile_id, $resource_id, $accessrights, $created, $modified, $createdby, $modifiedby, $deleted);
                if ($accessrights->update()){
                    echo "Success";
                } else{
                    echo "Failed";
                }
			break;

		case "View":
			    echo Accessrights::select($id);
			break;

		case "List":
			    echo Accessrights::select();
			break;
	}
}