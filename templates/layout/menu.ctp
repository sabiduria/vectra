<?php
    use App\Controller\AccessrightsController;
    $session = $this->request->getSession();
    $profile_id = $session->read('Auth.ProfileId');
    $profile = $session->read('Auth.ProfileName');
    $agency_name = $session->read('Auth.AgencyName');
?>

<nav class="main-menu-container nav nav-pills flex-column sub-open">
    <div class="slide-left" id="slide-left">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
    </div>
    <ul class="main-menu">
        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Main</span></li>
        <!-- End::slide__category -->

        <!-- Start::slide -->
        <li class="slide">
            <?= $this->Html->link('<i class="fa-thin fa-chart-waterfall w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Tableau de bord</span>', ['controller' => '/'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
        </li>
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide">
            <?= $this->Html->link('<i class="fa-thin fa-chart-radar w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Monitoring</span>', ['controller' => 'general', 'action' => 'monitoring'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
        </li>
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide has-sub">
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
        <!-- End::slide -->

        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Finance</span></li>
        <!-- End::slide__category -->

        <!-- Start::slide -->
        <li class="slide has-sub">
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
                    <?= $this->Html->link('Ajouter', ['controller' => 'sales', 'action' => 'add'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('POS', ['controller' => 'sales', 'action' => 'pos'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Relevé de compte', ['controller' => 'sales', 'action' => 'stats'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide">
            <?= $this->Html->link('<i class="fa-thin fa-money-check-dollar-pen w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Dépenses</span>', ['controller' => 'expenses', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
        </li>
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide has-sub">
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
        <!-- End::slide -->

        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Commandes</span></li>
        <!-- End::slide__category -->

        <!-- Start::slide -->
        <li class="slide has-sub">
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
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide has-sub">
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
        <!-- End::slide -->

        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Ressources Humaines</span></li>
        <!-- End::slide__category -->

        <!-- Start::slide -->
        <li class="slide">
            <?= $this->Html->link('<i class="fa-thin fa-users w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Clients</span>', ['controller' => 'customers', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
        </li>
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide">
            <?= $this->Html->link('<i class="fa-thin fa-users-line w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Fournisseurs</span>', ['controller' => 'suppliers', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
        </li>
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide has-sub">
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
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide">
            <?= $this->Html->link('<i class="fa-thin fa-calendar-check w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Présences</span>', ['controller' => 'attendances', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
        </li>
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide">
            <?= $this->Html->link('<i class="fa-thin fa-calendar-circle-user w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Congés</span>', ['controller' => 'leaves', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
        </li>
        <!-- End::slide -->

        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Stocks</span></li>
        <!-- End::slide__category -->

        <!-- Start::slide -->
        <li class="slide has-sub">
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
        <!-- End::slide -->

        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Lieux de ventes</span></li>
        <!-- End::slide__category -->

        <!-- Start::slide -->
        <li class="slide has-sub">
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
        <!-- Start::slide -->
        <li class="slide">
            <?= $this->Html->link('<i class="ri-line-chart-line w-6 h-6 side-menu__icon"></i><span class="side-menu__label">Prospections</span>', ['controller' => 'prospections', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
        </li>
        <!-- End::slide -->
        <!-- End::slide -->

        <!-- Start::slide__category -->
        <li class="slide__category"><span class="category-name">Rapports & Paramètres</span></li>
        <!-- End::slide__category -->

        <!-- Start::slide -->
        <li class="slide has-sub">
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
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide has-sub">
            <a href="javascript:void(0);" class="side-menu__item">
                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                <i class="fa-thin fa-gear w-6 h-6 side-menu__icon"></i>
                <span class="side-menu__label">Paramètres</span>
            </a>
            <ul class="slide-menu child1">
                <li class="slide">
                    <?= $this->Html->link('Utitlisateurs', ['controller' => 'users', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Affectations', ['controller' => 'affectations', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Profiles', ['controller' => 'profiles', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Ressources', ['controller' => 'resources', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Gestion des accès', ['controller' => 'products', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Types dépenses', ['controller' => 'expensestypes', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Taux d\'échanges', ['controller' => 'exchangerates', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Types congés', ['controller' => 'leavestypes', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
                <li class="slide">
                    <?= $this->Html->link('Fériés', ['controller' => 'holidays', 'action' => 'index'], ['escape'=>false, 'class' => 'side-menu__item']) ?>
                </li>
            </ul>
        </li>
        <!-- End::slide -->

    </ul>
    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
</nav>
