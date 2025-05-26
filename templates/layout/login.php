<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$AppDescription = 'Vectra';
$company = 'Sabiantart Corporate';
$session = $this->request->getSession();
$username = $session->read('Auth.Username');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title><?= $AppDescription ?> - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Financial Admin Software Developed by SabiantArt Corporate" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <?= $this->Html->script([
            'authentication-main.js',
        ]) ?>

        <?= $this->Html->css([
            'libs/bootstrap/css/bootstrap.min.css',
            'styles.css',
            'icons.css',
        ]) ?>
        <style>
            .account-body .auth-header-box{
                background-color : #fff !important;
            }
        </style>
    </head>

    <body class="account-body accountbg">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <?= $this->Html->script([
            'libs/bootstrap/js/bootstrap.bundle.min.js',
            'show-password.js',
        ]) ?>
    </body>
</html>
