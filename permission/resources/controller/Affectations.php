<?php
@session_start();
include ('../config/connexion.php');
include ('../model/autoload.php');
extract($_POST);
if (isset($need)){
	switch ($need){
		case "New":
			$affectations = new Affectations($id, $user_id, $shop_id, $profile_id, $created, $modified, $createdby, $modifiedby, $deleted);
                if ($affectations->insert()){
                    echo "Success";
                } else{
                    echo "Failed";
                }
			break;

		case "Update":
			$affectations = new Affectations($id, $user_id, $shop_id, $profile_id, $created, $modified, $createdby, $modifiedby, $deleted);
                if ($affectations->update()){
                    echo "Success";
                } else{
                    echo "Failed";
                }
			break;

		case "View":
			    echo Affectations::select($id);
			break;

		case "List":
			    echo Affectations::select();
			break;

        case 'HaveJustOneMagasin':
            $users_id=Users::getUsersID($username);
            echo Affectations::getShopIdOf($users_id);
            break;

        case 'ShopName':
            $users_id=Users::getUsersID($username);
            echo Shops::getDesignationOf(Affectations::getShopIdOf($users_id));
            break;
	}
}