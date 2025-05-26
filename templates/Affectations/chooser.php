<?php

use App\Controller\AffectationsController;

$session = $this->request->getSession();

$details = AffectationsController::getLoginDetails($session->read('Auth.Id'));

?>

<!-- Start:: row-1 -->

<div class="row">
    <?php foreach ($details as $detail) : ?>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card custom-card team-member text-center">
                <div class="team-bg-shape primary"></div>
                <div class="card-body">
                    <div class="mb-3 lh-1 d-flex gap-2 justify-content-center">
                    <span class="avatar avatar-xl avatar-rounded bg-primary">
                        <?= $this->Html->image('store.png', ['class' => 'card-img']) ?>
                    </span>
                    </div>
                    <div class="">
                        <p class="mb-2 fs-11 badge bg-primary fw-medium"><?= $detail['profile_name'] ?></p>
                        <h6 class="mb-3 fw-semibold"><?= $detail['shop_name'] ?></h6>
                        <p>Adresse : <?= $detail['address'] ?></p>
                        <p>Telephone : <?= $detail['phone'] ?></p>
                        <div class="d-flex justify-content-center">
                            <?= $this->Html->link('Se connecter'
                                , ['controller' => 'affectations', 'action' => 'chooser', $detail['shop_id']]
                                , ['class' => 'btn btn-primary', 'style' => 'width : 100%']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- End:: row-1 -->
