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
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
    <title>
        <?= $AppDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->script([
        'libs/choices.js/public/assets/scripts/choices.min.js',
        'main.js'
    ]) ?>
    <!-- App css -->
    <?= $this->Html->css([
        'libs/bootstrap/css/bootstrap.min.css',
        'styles.css',
        'icons.css',
        'libs/node-waves/waves.min.css',
        'libs/simplebar/simplebar.min.css',
        'libs/flatpickr/flatpickr.min.css',
        'libs/@simonwep/pickr/themes/nano.min.css',
        'libs/choices.js/public/assets/styles/choices.min.css',
        'libs/flatpickr/flatpickr.min.css',
        'libs/@tarekraafat/autocomplete.js/css/autoComplete.css',
        'libs/flatpickr/flatpickr.min.css'
    ]) ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css" >
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-thin.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <style>
        .select2-container .select2-selection--single{
            height: 33.1px !important;
            border: 1px solid #e3ebf6;
        }
    </style>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body style="background-color: white !important;">
<!-- Loader -->
<div id="loader" >
    <?= $this->Html->image('loader.svg') ?>
</div>
<!-- Loader -->

<div class="page">
    <!-- Start::app-content -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- Start::page-header -->
            <div class="row">
                <div class="col-sm-2 pt-3">
                    <?= $this->Html->image('logo.png', ['style' => 'width : 80%']) ?>
                </div>

                <div class="col-sm-8">
                    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
                        <div>
                            <ol class="breadcrumb mb-1">
                                <li class="breadcrumb-item">
                                    <?= $this->Html->link('<i class="fa-thin fa-chart-waterfall w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Tableau de bord</span>', ['controller' => '/'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $this->fetch('title') ?></li>
                            </ol>
                            <h1 class="page-title fw-medium fs-18 mb-0"><?= ucfirst($title_2 ?? 'Point de ventes') ?></h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2 pt-3 text-end">
                    Aujourd'hui
                    <h6>
                        <strong><?= date('Y-m-d') ?></strong>
                    </h6>
                </div>
            </div>
            <!-- End::page-header -->

            <div class="card rounded-0">
                <div class="card-body">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End::app-content -->

    <!-- Footer Start -->
    <footer class="footer mt-auto py-3 bg-white text-center">
        <div class="container">
            <span class="text-muted"> Copyright © <span id="year"></span> <a
                    href="javascript:void(0);" class="text-dark fw-medium"><?= $AppDescription ?></a>.
                Designed with <span class="bi bi-heart-fill text-danger"></span> by <a href="javascript:void(0);">
                    <span class="fw-medium text-primary"><?= $company ?></span>
                </a> All
                rights
                reserved
            </span>
        </div>
    </footer>
    <!-- Footer End -->
</div>

<!-- Scroll To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span>
</div>
<div id="responsive-overlay"></div>
<!-- Scroll To Top -->


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?= $this->Html->script([
    'libs/@popperjs/core/umd/popper.min.js',
    'libs/bootstrap/js/bootstrap.bundle.min.js',
    'libs/node-waves/waves.min.js',
    'libs/simplebar/simplebar.min.js',
    'libs/@tarekraafat/autocomplete.js/autoComplete.min.js',
    'libs/@simonwep/pickr/pickr.es5.min.js',
    'libs/flatpickr/flatpickr.min.js',
    'libs/apexcharts/apexcharts.min.js',
    'datatables.js',
    'select2.js',
    'create-invoice',
    'libs/isotope-layout/isotope.pkgd.min.js',
    'pos-dashboard.js',
]) ?>
<!-- Datatables Cdn -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

</body>
</html>
