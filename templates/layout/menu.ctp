<?php
    use App\Controller\AccessrightsController;
    $session = $this->request->getSession();
    $profile_id = $session->read('Auth.ProfileId');
    $profile = $session->read('Auth.Profile');
    $agency_name = $session->read('Auth.ShopName');
?>

<nav class="main-menu-container nav nav-pills flex-column sub-open">
    <div class="slide-left" id="slide-left">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
    </div>
    <ul class="main-menu">
        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'DASH', 'VIEW')) :?>
            <!-- Start::slide__category -->
            <li class="slide__category"><span class="category-name">Main</span></li>
            <!-- End::slide__category -->
            <li class="slide">
                <?= $this->Html->link('<i class="fa-thin fa-chart-waterfall w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Tableau de bord</span>', ['controller' => '/'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
            </li>
        <?php endif; ?>
        <!-- End::slide -->

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'MTR', 'VIEW')) :?>
            <li class="slide">
                <?= $this->Html->link('<i class="fa-thin fa-chart-radar w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Monitoring</span>', ['controller' => 'general', 'action' => 'monitoring'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
            </li>
        <?php endif; ?>
        <!-- End::slide -->

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'ART', 'VIEW')) :?>
            <li class="slide has-sub <?= $menu_product ?? '' ?>">
                <a href="javascript:void(0);" class="side-menu__item">
                    <i class="ri-arrow-down-s-line side-menu__angle"></i>
                    <i class="fa-thin fa-list-timeline w-6 h-6 side-menu__icon"></i>
                    <span class="side-menu__label">Produits</span>
                </a>
                <ul class="slide-menu child1">
                    <li class="slide">
                        <?= $this->Html->link('Liste', ['controller' => 'products', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                    </li>
                    <li class="slide">
                        <?= $this->Html->link('Ajouter', ['controller' => 'products', 'action' => 'add'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                    </li>
                    <li class="slide">
                        <?= $this->Html->link('Importer', ['controller' => 'products', 'action' => 'import'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                    </li>
                    <li class="slide">
                        <?= $this->Html->link('Catégories', ['controller' => 'categories', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                    </li>
                    <li class="slide">
                        <?= $this->Html->link('Modèles', ['controller' => 'brands', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                    </li>
                    <li class="slide">
                        <?= $this->Html->link('Packaging', ['controller' => 'packagings', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                    </li>
                    <li class="slide">
                        <?= $this->Html->link('Statistiques', ['controller' => 'products', 'action' => 'stats'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        <!-- End::slide -->

        <?php if (AccessrightsController::checkRightsOn($profile_id, 'FCT', 'VIEW')) :?>
        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Finance</span></li>
        <!-- End::slide__category -->
        <?php endif; ?>

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'FCT', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_sales ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-cash-register w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Facturation</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Liste', ['controller' => 'sales', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('POS', ['controller' => 'sales', 'action' => 'pos'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Relevé de compte', ['controller' => 'sales', 'action' => 'stats'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'SPT', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_expenses ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-money-check-dollar-pen w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Dépenses</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Liste', ['controller' => 'expenses', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Ajouter', ['controller' => 'expenses', 'action' => 'add'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Types dépenses', ['controller' => 'expensestypes', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'PYR', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_payroll ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-money-bill-1 w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Payroll</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Employés', ['controller' => 'salaries', 'action' => 'index', 'employee'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Tiers', ['controller' => 'salaries', 'action' => 'index', 'tiers'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Avances sur salaire', ['controller' => 'payrolls', 'action' => 'index', 'advance'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <?php if (AccessrightsController::checkRightsOn($profile_id, 'CMD', 'VIEW')) :?>
        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Commandes</span></li>
        <!-- End::slide__category -->
        <?php endif; ?>

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'CMD', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_orders ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-cart-shopping-fast w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Commandes</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Liste', ['controller' => 'orders', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Ajouter', ['controller' => 'orders', 'action' => 'add'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('En attente', ['controller' => 'orders', 'action' => 'index', 'waiting'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'PRC', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_purchases ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-cart-shopping-fast w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Achats</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Liste', ['controller' => 'purchasegroups', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Nouveau', ['controller' => 'purchases', 'action' => 'purchase'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('En attente', ['controller' => 'purchases', 'action' => 'index', 'waiting'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <?php if (AccessrightsController::checkRightsOn($profile_id, 'MTR', 'VIEW')) :?>
        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Ressources Humaines</span></li>
        <!-- End::slide__category -->
        <?php endif; ?>

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'CLT', 'VIEW')) :?>
        <li class="slide">
            <?= $this->Html->link('<i class="fa-thin fa-users w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Clients</span>', ['controller' => 'customers', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'SPL', 'VIEW')) :?>
        <li class="slide">
            <?= $this->Html->link('<i class="fa-thin fa-users-line w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Fournisseurs</span>', ['controller' => 'suppliers', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'EMP', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_employee ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-users w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Employés</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Internes', ['controller' => 'users', 'action' => 'index', 'Intern'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Externes', ['controller' => 'users', 'action' => 'index', 'Extern'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'ATDC', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_attendances ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-calendar-check w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Pointages</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Présences', ['controller' => 'attendances', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Congés', ['controller' => 'leaves', 'action' => 'add'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Types congés', ['controller' => 'leavestypes', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <?php if (AccessrightsController::checkRightsOn($profile_id, 'STK', 'VIEW')) :?>
        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Stocks</span></li>
        <!-- End::slide__category -->
        <?php endif; ?>

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'STK', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_stock ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-boxes-stacked w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Stocks</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Entrées', ['controller' => 'stockins', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Sorties', ['controller' => 'spoilages', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Transferts', ['controller' => 'transfers', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Inventaires', ['controller' => 'invproducts', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Stock alertes', ['controller' => 'general', 'action' => 'stock'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <?php if (AccessrightsController::checkRightsOn($profile_id, 'WRHS', 'VIEW')) :?>
        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Lieux de ventes</span></li>
        <!-- End::slide__category -->
        <?php endif; ?>

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'WRHS', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_warehouse ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-warehouse w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Warehouse</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Shops', ['controller' => 'shops', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Chambres froides', ['controller' => 'rooms', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Zones de ventes', ['controller' => 'areas', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'PRSP', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_prospection ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-warehouse w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Prospections</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Fournisseurs', ['controller' => 'prospections', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Marchés', ['controller' => 'market-prospections', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <?php if (AccessrightsController::checkRightsOn($profile_id, 'RPT', 'VIEW')) :?>
            <!-- Start::slide__category -->
            <li class="slide__category"><span class="category-name">Equipements & Maintenances</span></li>
            <!-- End::slide__category -->
        <?php endif; ?>

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'PRMT', 'VIEW')) :?>
            <li class="slide has-sub <?= $menu_parameters ?? '' ?>">
                <a href="javascript:void(0);" class="side-menu__item">
                    <i class="ri-arrow-down-s-line side-menu__angle"></i>
                    <i class="fa-thin fa-gear w-6 h-6 side-menu__icon"></i>
                    <span class="side-menu__label">Equipments</span>
                </a>
                <ul class="slide-menu child1">
                    <li class="slide">
                        <?= $this->Html->link('Listes', ['controller' => 'equipments', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                    </li>
                    <li class="slide">
                        <?= $this->Html->link('Maintenances', ['controller' => 'maintenance_records', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                    </li>
                    <li class="slide">
                        <?= $this->Html->link('Gestion Carburant', ['controller' => 'fuel_levels', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        <!-- End::slide -->

        <?php if (AccessrightsController::checkRightsOn($profile_id, 'RPT', 'VIEW')) :?>
        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Rapports & Paramètres</span></li>
        <!-- End::slide__category -->
        <?php endif; ?>

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'RPT', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_reports ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-chart-pie w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Rapports</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Ventes', ['controller' => 'general', 'action' => 'sales'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Dépenses', ['controller' => 'general', 'action' => 'report-expense'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Analyse ABC', ['controller' => 'general', 'action' => 'abc'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Bénéfices', ['controller' => 'general', 'action' => 'profits'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Audits d\'activités', ['controller' => 'audits', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

        <!-- Start::slide -->
        <?php if (AccessrightsController::checkRightsOn($profile_id, 'PRMT', 'VIEW')) :?>
        <li class="slide has-sub <?= $menu_parameters ?? '' ?>">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-gear w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Paramètres</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Utilisateurs', ['controller' => 'users', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Affectations', ['controller' => 'affectations', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Paramètres Généraux', ['controller' => 'general-params', 'action' => 'view', 1], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Profiles', ['controller' => 'profiles', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Ressources', ['controller' => 'resources', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Gestion des accès', ['controller' => 'permission', 'action' => ''], ['target' => '_blank', 'escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Taux d\'échanges', ['controller' => 'exchangerates', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Fériés', ['controller' => 'holidays', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <!-- End::slide -->

    </ul>
    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
</nav>
