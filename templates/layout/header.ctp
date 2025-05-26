<?php

use App\Controller\GeneralController;

$session = $this->request->getSession();
?>
<header class="app-header sticky" id="header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <?= $this->Html->link($this->Html->image('logo.png', ['class'=>'desktop-logo']), ['controller'=>'/'], ['class'=>'header-logo', 'escape'=>false]) ?>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element mx-lg-0 mx-2">
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element header-search d-md-block d-none my-auto auto-complete-search">
                <!-- Start::header-link -->
                <!--input type="text" class="header-search-bar form-control" id="header-search" placeholder="Search anything here ..." spellcheck=false autocomplete="off" autocapitalize="off">
                <a href="javascript:void(0);" class="header-search-icon border-0">
                    <i class="ri-search-line"></i>
                </a-->
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <ul class="header-content-right">

            <li class="header-element d-block">
                <span class="badge bg-success mt-2">
                    Shop Actif : <?= $session->read('Auth.ShopName') ?>
                </span>
            </li>

            <!-- Start::header-element -->
            <li class="header-element d-md-none d-block">
                <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#header-responsive-search">
                    <!-- Start::header-link-icon -->
                    <i class="bi bi-search header-link-icon"></i>
                    <!-- End::header-link-icon -->
                </a>
            </li>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <li class="header-element notifications-dropdown d-xl-block d-none dropdown">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 header-link-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                    </svg>
                    <span class="header-icon-pulse bg-primary2 rounded pulse pulse-secondary"></span>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <!-- Start::main-header-dropdown -->
                <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                    <div class="p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 fs-15 fw-medium">Notifications</p>
                            <span class="badge bg-secondary text-fixed-white" id="notifiation-data">5 Unread</span>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <ul class="list-unstyled mb-0" id="header-notification-scroll">
                        <li class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="pe-2 lh-1">
                                    <span class="avatar avatar-md avatar-rounded bg-primary">
                                        <?= $this->Html->image('avatar.png') ?>
                                    </span>
                                </div>
                                <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-0 fw-medium"><a href="chat.html">New Messages</a></p>
                                        <div class="text-muted fw-normal fs-12 header-notification-text text-truncate">Jane Sam sent you a message.</div>
                                        <div class="fw-normal fs-10 text-muted op-8">Now</div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="min-w-fit-content dropdown-item-close1">
                                            <i class="ri-close-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="pe-2 lh-1">
                                    <span class="avatar avatar-md bg-primary avatar-rounded fs-20">
                                        <i class="fe fe-shopping-cart lh-1 "></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-0 fw-medium"><a href="chat.html">Order Updates</a></p>
                                        <div class="text-muted fw-normal fs-12 header-notification-text text-truncate">Order <span class="text-primary1">#54321</span> has been shipped.</div>
                                        <div class="fw-normal fs-10 text-muted op-8">2 hours ago</div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="min-w-fit-content dropdown-item-close1">
                                            <i class="ri-close-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="pe-2 lh-1">
                                    <span class="avatar avatar-md bg-orange avatar-rounded">
                                        <?= $this->Html->image('avatar.png') ?>
                                    </span>
                                </div>
                                <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-0 fw-medium"><a href="chat.html">Comment on Post</a></p>
                                        <div class="text-muted fw-normal fs-12 header-notification-text text-truncate">Reacted: <span class="text-primary3">John Richard</span> on your next purchase!</div>
                                        <div class="fw-normal fs-10 text-muted op-8">2 hours ago</div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="min-w-fit-content dropdown-item-close1">
                                            <i class="ri-close-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="pe-2 lh-1">
                                    <span class="avatar avatar-md bg-success avatar-rounded">
                                        <?= $this->Html->image('avatar.png') ?>
                                    </span>
                                </div>
                                <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-0 fw-medium"><a href="chat.html">Follow Request</a></p>
                                        <div class="text-muted fw-normal fs-12 header-notification-text text-truncate"><span class="text-info">Kelin Brown</span> has sent you the request.</div>
                                        <div class="fw-normal fs-10 text-muted op-8">1 Day ago</div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="min-w-fit-content dropdown-item-close1">
                                            <i class="ri-close-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="pe-2 lh-1">
                                    <span class="avatar avatar-md bg-primary2 avatar-rounded">
                                        <i class="ri-gift-line lh-1 fs-16"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-0 fw-medium"><a href="chat.html">Exclusive Offers</a></p>
                                        <div class="text-muted fw-normal fs-12 header-notification-text text-truncate">Enjoy<span class="text-success">20% off</span> on your next purchase!</div>
                                        <div class="fw-normal fs-10 text-muted op-8">5 hours ago</div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="min-w-fit-content dropdown-item-close1">
                                            <i class="ri-close-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="p-3 empty-header-item1 border-top">
                        <div class="d-grid">
                            <a href="javascript:void(0);" class="btn btn-primary btn-wave">View All</a>
                        </div>
                    </div>
                    <div class="p-5 empty-item1 d-none">
                        <div class="text-center">
                            <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                <i class="ri-notification-off-line fs-2"></i>
                            </span>
                            <h6 class="fw-medium mt-3">No New Notifications</h6>
                        </div>
                    </div>
                </div>
                <!-- End::main-header-dropdown -->
            </li>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <li class="header-element dropdown">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div>
                            <?= $this->Html->image('11.jpg', ['class' => 'avatar avatar-sm']) ?>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul style="width: 15rem !important;" class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                    <li>
                        <div class="dropdown-item text-center border-bottom">
                            <span>
                                M. <?= GeneralController::getUserNameOf($session->read('Auth.Id')); ?>
                            </span>
                            <span class="d-block fs-12 text-muted">
                                <?= $session->read('Auth.Profile') ?>
                            </span>
                        </div>
                    </li>
                    <li>
                        <?= $this->Html->link('<i class="fe fe-user p-1 rounded-circle bg-primary-transparent me-2 fs-16"></i> Profile', ['controller' => 'users', 'action' => 'view'], ['class' => 'dropdown-item d-flex align-items-center', 'escape' => false]) ?>
                    </li>
                    <li class="border-top bg-light"><a class="dropdown-item d-flex align-items-center" href="#"><i class="fe fe-help-circle p-1 rounded-circle bg-primary-transparent set me-2 fs-16"></i>Aide</a></li>
                    <li>
                        <?= $this->Html->link('<i class="fe fe-crosshair p-1 rounded-circle bg-primary-transparent ut me-2 fs-16"></i> Changer de shop', ['controller' => 'affectations', 'action' => 'chooser'], ['class' => 'dropdown-item d-flex align-items-center', 'escape' => false]) ?>
                    </li>
                    <li>
                        <?= $this->Html->link('<i class="fe fe-lock p-1 rounded-circle bg-primary-transparent ut me-2 fs-16"></i> Deconnexion', ['controller' => 'users', 'action' => 'logout'], ['class' => 'dropdown-item d-flex align-items-center', 'escape' => false]) ?>
                    </li>
                </ul>
            </li>
            <!-- End::header-element -->

        </ul>
        <!-- End::header-content-right -->
    </div>
    <!-- End::main-header-container -->
</header>
