<?php

include('resources/config/connexion.php');
include('resources/model/autoload.php');
extract($_GET);
$profiles = json_decode(Profiles::select(), true);
if (isset($profile)){
    $accessRights = json_decode(Accessrights::select($profile), true);
}
$resources = json_decode(Resources::select(), true);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$target_link = substr($actual_link, 0,-11);

if(isset($generator)){
    foreach ($profiles as $key=>$value){
        //Accessrights::insert($value['id'], 15);
        foreach ($resources as $key2=>$value2){
            Accessrights::insert($value['id'], $value2['id']);
        }
    }
}

?>
<!DOCTYPE html>
<html class="no-touch" lang="">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Access Rights</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css" >
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-thin.css">
    <link rel="stylesheet" href="resources/views/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/views/css/icons.min.css">
    <link rel="stylesheet" href="resources/views/css/metisMenu.min.css">
    <link rel="stylesheet" href="resources/views/css/daterangepicker.css">
    <link rel="stylesheet" href="resources/views/css/app.min.css">

</head>
<body>

<div class="row" style="padding: 2%">
    <div class="col-sm-10">
        <a href="<?= $target_link ?>" class="site-logo">
            <img src="resources/views/img/permission.png" alt="" style="width: 20%">
        </a>
        <?php if (isset($profile)): ?>
        <h3>Access Rights for <span style="color: #0e3a98"><?= htmlspecialchars_decode(Profiles::displayName($profile)) ?></span>'s role</h3>
        <?php else: ?>
        <h3>Please choose a profile</h3>
        <?php endif; ?>
    </div>

    <div class="col-sm-2 text-end">
        <form action="">
            <button name="generator" type="submit" class="btn btn-sm btn-primary">Generate Access Rights</button>
        </form>
    </div>

    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3">
                <table class="table table-hover table-bordered">
                    <tbody>
                    <?php foreach ($profiles as $key=>$value): ?>
                            <tr>
                                <td>
                                    <a href="?profile=<?= $value['id'] ?>"><?= $value['name'] ?></a>
                                </td>
                            </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-9">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 30%">Resources</th>
                        <th class="text-center"><i class="fa-thin fa-eye fa-fw"></i> Lecture</th>
                        <th class="text-center"><i class="fa-sharp fa-thin fa-file-circle-plus fa-fw"></i> Création</th>
                        <th class="text-center"><i class="fa-sharp fa-thin fa-file-pen fa-fw"></i> Edition</th>
                        <th class="text-center"><i class="fa-sharp fa-thin fa-trash fa-fw"></i> Suppression</th>
                        <th class="text-center"><i class="fa-sharp fa-thin fa-print fa-fw"></i> Impression</th>
                        <th class="text-center"><i class="fa-sharp fa-thin fa-bars-sort fa-fw"></i> Menu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($resources as $key2=>$value2): ?>
                        <?php if (isset($profile)): ?>
                            <tr>
                                <td hidden id="resource_id"><?= $value2['id'] ?></td>
                                <td><i class="<?= $value2['icon'] ?>"></i> <?= $value2['name'] ?></td>
                                <td class="text-center">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" id="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>1" <?php if (Accessrights::CheckAccess($profile, $value2['id'], 'READ')) echo "checked"?>>
                                        <label for="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>1"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" id="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>2" <?php if (Accessrights::CheckAccess($profile, $value2['id'], 'CREATE')) echo "checked"?>>
                                        <label for="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>2"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" id="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>3" <?php if (Accessrights::CheckAccess($profile, $value2['id'], 'UPDATE')) echo "checked"?>>
                                        <label for="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>3"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" id="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>4" <?php if (Accessrights::CheckAccess($profile, $value2['id'], 'DELETE')) echo "checked"?>>
                                        <label for="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>4"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" id="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>5" <?php if (Accessrights::CheckAccess($profile, $value2['id'], 'PRINT')) echo "checked"?>>
                                        <label for="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>5"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" id="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>6" <?php if (Accessrights::CheckAccess($profile, $value2['id'], 'MENU')) echo "checked"?>>
                                        <label for="<?= strtoupper(substr($value2['generic_name'], 0, 3)) ?>6"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php endif;?>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="resources/views/js/jquery.min.js"></script>
<script src="resources/views/js/bootstrap.bundle.min.js"></script>
<script src="resources/views/js/metismenu.min.js"></script>
<script src="resources/views/js/waves.js"></script>
<script src="resources/views/js/feather.min.js"></script>
<script src="resources/views/js/simplebar.min.js"></script>
<script src="resources/views/js/moment.js"></script>
<script src="resources/views/js/daterangepicker.js"></script>
<script src="resources/views/js/app.js"></script>

<?php foreach ($resources as $key3=>$value3): ?>
    <script>
        <?php $accessID = Accessrights::getAcccessId($profile,$value3['id'])!=null ? Accessrights::getAcccessId($profile,$value3['id']): 0?>
        $(function() {
            // hooking event only on buttons, can do tr's as well.
            $('#<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>1').click(function(){
                var chkState;
                var value;
                var r = true;
                var checkbox = document.getElementById('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>1');
                var resource_id = document.getElementById('resource_id');
                if (checkbox.checked===true){ chkState = true; value=1;} else { chkState = false; value=0;}
                if (r === true) {
                    checkbox.checked = chkState;

                    localStorage.setItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>1', 'READ-'+value+'-'+<?= $accessID ?>);
                    $.ajax({
                        type: "POST",
                        url: "update.php",
                        data: { storageValue: localStorage.getItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>1') }
                    });
                } else { checkbox.checked = !chkState; }
            });

            $('#<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>2').click(function(){
                var chkState;
                var value;
                var r = true;
                var checkbox = document.getElementById('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>2');
                var resource_id = document.getElementById('resource_id');
                if (checkbox.checked===true){ chkState = true; value=1;} else { chkState = false; value=0;}
                if (r === true) {
                    checkbox.checked = chkState;

                    localStorage.setItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>2', 'CREATE-'+value+'-'+<?= $accessID ?>);
                    $.ajax({
                        type: "POST",
                        url: "update.php",
                        data: { storageValue: localStorage.getItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>2') }
                    });
                } else { checkbox.checked = !chkState; }
            });

            $('#<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>3').click(function(){
                var chkState;
                var value;
                var r = true;
                var checkbox = document.getElementById('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>3');
                var resource_id = document.getElementById('resource_id');
                if (checkbox.checked===true){ chkState = true; value=1;} else { chkState = false; value=0;}
                if (r === true) {
                    checkbox.checked = chkState;

                    localStorage.setItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>3', 'UPDATE-'+value+'-'+<?= $accessID ?>);
                    $.ajax({
                        type: "POST",
                        url: "update.php",
                        data: { storageValue: localStorage.getItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>3') }
                    });
                } else { checkbox.checked = !chkState; }
            });

            $('#<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>4').click(function(){
                var chkState;
                var value;
                var r = true;
                var checkbox = document.getElementById('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>4');
                var resource_id = document.getElementById('resource_id');
                if (checkbox.checked===true){ chkState = true; value=1;} else { chkState = false; value=0;}
                if (r === true) {
                    checkbox.checked = chkState;

                    localStorage.setItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>4', 'DELETE-'+value+'-'+<?= $accessID ?>);
                    $.ajax({
                        type: "POST",
                        url: "update.php",
                        data: { storageValue: localStorage.getItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>4') }
                    });
                } else { checkbox.checked = !chkState; }
            });

            $('#<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>5').click(function(){
                var chkState;
                var value;
                var r = true;
                var checkbox = document.getElementById('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>5');
                var resource_id = document.getElementById('resource_id');
                if (checkbox.checked===true){ chkState = true; value=1;} else { chkState = false; value=0;}
                if (r === true) {
                    checkbox.checked = chkState;

                    localStorage.setItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>5', 'PRINT-'+value+'-'+<?= $accessID ?>);
                    $.ajax({
                        type: "POST",
                        url: "update.php",
                        data: { storageValue: localStorage.getItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>5') }
                    });
                } else { checkbox.checked = !chkState; }
            });

            $('#<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>6').click(function(){
                var chkState;
                var value;
                var r = true;
                var checkbox = document.getElementById('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>6');
                var resource_id = document.getElementById('resource_id');
                if (checkbox.checked===true){ chkState = true; value=1;} else { chkState = false; value=0;}
                if (r === true) {
                    checkbox.checked = chkState;

                    localStorage.setItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>6', 'MENU-'+value+'-'+<?= $accessID ?>);
                    $.ajax({
                        type: "POST",
                        url: "update.php",
                        data: { storageValue: localStorage.getItem('<?= strtoupper(substr($value3['generic_name'], 0, 3)) ?>6') }
                    });
                } else { checkbox.checked = !chkState; }
            });
        });
    </script>
<?php endforeach; ?>

<div class="responsive-bootstrap-toolkit"><div class="device-xs visible-xs visible-xs-block"></div><div class="device-sm visible-sm visible-sm-block"></div><div class="device-md visible-md visible-md-block"></div><div class="device-lg visible-lg visible-lg-block"></div></div></body></html>
