<?php
/**
 * @var \App\View\AppView $this
 */

use App\Controller\GeneralController;

?>

<div class="row">
    <div class="col-sm-12">
        <div class="d-sm-flex align-items-end  p-3 bg-light gap-5 flex-wrap pb-5">
            <div class="min-w-fit-content me-3">
                <p class="mb-1">Total Ventes</p>
                <h4 class="fw-medium mb-0">$15,874.50<span class="badge bg-success ms-2 fs-9"><i class="ti ti-trending-up me-1"></i>0.32%</span></h4>
            </div>
            <div class="min-w-fit-content">
                <p class="mb-1">Total Commandes</p>
                <h4 class="fw-medium mb-0">$124,784.23<span class="badge bg-danger ms-2 fs-9"><i class="ti ti-trending-down me-1"></i>0.12%</span></h4>
            </div>
            <div class="min-w-fit-content">
                <p class="mb-1">Taux d'échanges</p>
                <h4 class="fw-medium mb-0">$124,784.23<span class="badge bg-danger ms-2 fs-9"><i class="ti ti-trending-down me-1"></i>0.12%</span></h4>
            </div>
            <div class="min-w-fit-content">
                <p class="mb-1 fs-12 text-muted">
                    <span class="text-success">+124.25</span>
                    <i class="mdi mdi-circle-small"></i>
                    <span>Hier</span>
                </p>
                <p class="mb-0 fs-11 text-muted">
                    <span>Jun 16, 2022</span>
                    <i class="mdi mdi-circle-small"></i>
                    <span>10:45 AM</span>
                    <i class="mdi mdi-circle-small"></i>
                    <span>UTC +5:30</span>
                </p>
            </div>
            <div class="flex-1 text-sm-end mt-2 mt-sm-0 ms-auto">
                <a href="javascript:void(0);" class="btn btn-w-lg btn-primary1-light"><i class="ti ti-plus me-1"></i>Details</a>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-xl-6">
        <div class="card custom-card overflow-hidden main-content-card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-2 gap-1 flex-xxl-nowrap flex-wrap">
                    <div>
                        <span class="text-muted d-block mb-1 text-nowrap">Total Produits</span>
                        <h4 class="fw-medium mb-0">854</h4>
                    </div>
                    <div class="lh-1">
                        <span class="avatar avatar-md avatar-rounded bg-primary">
                            <i class="ti ti-shopping-cart fs-5"></i>
                        </span>
                    </div>
                </div>
                <div class="text-muted fs-13">Stats : <span class="text-success">2.56%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6">
        <div class="card custom-card overflow-hidden main-content-card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-2 gap-1 flex-xxl-nowrap flex-wrap">
                    <div>
                        <span class="text-muted d-block mb-1 text-nowrap">Total Clients</span>
                        <h4 class="fw-medium mb-0">31,876</h4>
                    </div>
                    <div class="lh-1">
                        <span class="avatar avatar-md avatar-rounded bg-primary1">
                            <i class="ti ti-users fs-5"></i>
                        </span>
                    </div>
                </div>
                <div class="text-muted fs-13">Stats : <span class="text-success">0.34%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6">
        <div class="card custom-card overflow-hidden main-content-card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-2 gap-1 flex-xxl-nowrap flex-wrap">
                    <div>
                        <span class="text-muted d-block mb-1 text-nowrap">Total Revenue</span>
                        <h4 class="fw-medium mb-0">$34,241</h4>
                    </div>
                    <div class="lh-1">
                        <span class="avatar avatar-md avatar-rounded bg-primary2">
                            <i class="ti ti-currency-dollar fs-5"></i>
                        </span>
                    </div>
                </div>
                <div class="text-muted fs-13">Stats : <span class="text-success">7.66%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6">
        <div class="card custom-card overflow-hidden main-content-card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-2 gap-1 flex-xxl-nowrap flex-wrap">
                    <div>
                        <span class="text-muted d-block mb-1 text-nowrap">Total Factures</span>
                        <h4 class="fw-medium mb-0">1,76,586</h4>
                    </div>
                    <div class="lh-1">
                        <span class="avatar avatar-md avatar-rounded bg-primary3">
                            <i class="ti ti-chart-bar fs-5"></i>
                        </span>
                    </div>
                </div>
                <div class="text-muted fs-13">Stats : <span class="text-danger">0.74%<i class="ti ti-arrow-narrow-down fs-16"></i></span></div>
            </div>
        </div>
    </div>

    <div class="col-xxl-8 col-xl-6">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Aperçu des ventes
                </div>
            </div>
            <div class="card-body">
                <div id="sales-overview"></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-xl-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-header pb-0 justify-content-between">
                <div class="card-title">
                    Statistiques de commande
                </div>
                <div class="dropdown">
                    <a aria-label="anchor" href="javascript:void(0);" class="btn btn-light btn-icons btn-sm text-muted" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fe fe-more-vertical"></i>
                    </a>
                </div>
            </div>
            <div class="card-body py-4 px-3">
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <div class="avatar avatar-md bg-primary-transparent">
                        <i class="ti ti-trending-up fs-5"></i>
                    </div>
                    <div class="flex-fill d-flex align-items-start justify-content-between flex-wrap">
                        <div>
                            <span class="fs-11 mb-1 d-block fw-medium">TOTAL COMMANDES</span>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 d-flex align-items-center flex-wrap">3,736<span class="text-success fs-12 ms-2 op-1"><i class="ti ti-trending-up align-middle me-1"></i>0.57%</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="orders" class="my-2"></div>
            </div>
            <div class="card-footer border-top border-block-start-dashed">
                <div class="d-grid">
                    <button class="btn btn-primary-ghost btn-wave fw-medium waves-effect waves-light table-icon">Complete Statistics<i class="ti ti-arrow-narrow-right ms-2 fs-16 d-inline-block"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xxl-4 col-xl-6">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Statistiques de vente
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2 justify-content-between flex-fill pb-3">
                    <div class="py-3 px-4 rounded border border-dashed bg-light">
                        <span>Ventes</span>
                        <p class="fw-medium fs-14 mb-0">$3.478B</p>
                    </div>
                    <div class="py-3 px-4 rounded border border-dashed bg-light">
                        <span>This Year</span>
                        <p class="text-success fw-medium fs-14 mb-0">4,25,349</p>
                    </div>
                    <div class="py-3 px-4 rounded border border-dashed bg-light">
                        <span>Last Year</span>
                        <p class="text-danger fw-medium fs-14 mb-0">3,41,622</p>
                    </div>
                </div>
                <div id="sales-statistics"></div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-xl-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-header pb-0 justify-content-between">
                <div class="card-title">
                    Statistiques globales
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group activity-feed">
                    <li class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="lh-1">
                                <p class="mb-2 fs-13 text-muted">Total Expenses</p>
                                <h6 class="fw-medium mb-0">$134,032<span class="fs-12 text-success ms-2 fw-normal d-inline-block">0.45%<i class="ti ti-trending-up ms-1"></i></span></h6>
                            </div>
                            <div class="text-end">
                                <div id="line-graph1"></div>
                                <a href="javascript:void(0);" class="fs-12">
                                    <span>See more</span>
                                    <span class="table-icon"><i class="ms-1 d-inline-block ri-arrow-right-line"></i></span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="lh-1">
                                <p class="mb-2 fs-13 text-muted">General Leads</p>
                                <h6 class="fw-medium mb-0">74,354<span class="fs-12 text-danger ms-2 fw-normal d-inline-block">3.84%<i class="ti ti-trending-down ms-1"></i></span></h6>
                            </div>
                            <div class="text-end">
                                <div id="line-graph2"></div>
                                <a href="javascript:void(0);" class="fs-12">
                                    <span>See more</span>
                                    <span class="table-icon"><i class="ms-1 d-inline-block ri-arrow-right-line"></i></span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="lh-1">
                                <p class="mb-2 fs-13 text-muted">Churn Rate</p>
                                <h6 class="fw-medium mb-0">6.02%<span class="fs-12 text-success ms-2 fw-normal d-inline-block">0.72%<i class="ti ti-trending-up ms-1"></i></span></h6>
                            </div>
                            <div class="text-end">
                                <div id="line-graph3"></div>
                                <a href="javascript:void(0);" class="fs-12">
                                    <span>See more</span>
                                    <span class="table-icon"><i class="ms-1 d-inline-block ri-arrow-right-line"></i></span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="lh-1">
                                <p class="mb-2 fs-13 text-muted">New Users</p>
                                <h6 class="fw-medium mb-0">7,893<span class="fs-12 text-success ms-2 fw-normal d-inline-block">11.05%<i class="ti ti-trending-up ms-1"></i></span></h6>
                            </div>
                            <div class="text-end">
                                <div id="line-graph4"></div>
                                <a href="javascript:void(0);" class="fs-12">
                                    <span>See more</span>
                                    <span class="table-icon"><i class="ms-1 d-inline-block ri-arrow-right-line"></i></span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="lh-1">
                                <p class="mb-2 fs-13 text-muted">Returning Users</p>
                                <h6 class="fw-medium mb-0">3,258<span class="fs-12 text-success ms-2 fw-normal d-inline-block">1.69%<i class="ti ti-trending-up ms-1"></i></span></h6>
                            </div>
                            <div class="text-end">
                                <div id="line-graph5"></div>
                                <a href="javascript:void(0);" class="fs-12">
                                    <span>See more</span>
                                    <span class="table-icon"><i class="ms-1 d-inline-block ri-arrow-right-line"></i></span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-xl-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Catégories les plus vendues
                </div>
            </div>
            <div class="card-body p-0">
                <div class="p-3 pb-0">
                    <div class="progress-stacked progress-sm mb-2 gap-1">
                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-primary1" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-primary2" role="progressbar" style="width: 15%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-primary3" role="progressbar" style="width: 25%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 20%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>Overall Sales</div>
                        <div class="h6 mb-0"><span class="text-success me-2 fs-11">2.74%<i class="ti ti-arrow-narrow-up"></i></span>1,25,875</div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <tbody>
                        <tr>
                            <td>
                                <span class="fw-medium top-category-name one">Clothing</span>
                            </td>
                            <td>
                                <span class="fw-medium">31,245</span>
                            </td>
                            <td class="text-center">
                                <span class="text-muted fs-12">25% Gross</span>
                            </td>
                            <td class="text-end">
                                <span class="badge bg-success">0.45% <i class="ti ti-trending-up"></i></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-medium top-category-name two">Electronics</span>
                            </td>
                            <td>
                                <span class="fw-medium">29,553</span>
                            </td>
                            <td class="text-center">
                                <span class="text-muted fs-12">16% Gross</span>
                            </td>
                            <td class="text-end">
                                <span class="badge bg-warning">0.27% <i class="ti ti-trending-up"></i></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-medium top-category-name three">Grocery</span>
                            </td>
                            <td>
                                <span class="fw-medium">24,577</span>
                            </td>
                            <td class="text-center">
                                <span class="text-muted fs-12">22% Gross</span>
                            </td>
                            <td class="text-end">
                                <span class="badge bg-secondary">0.63% <i class="ti ti-trending-up"></i></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-medium top-category-name four">Automobiles</span>
                            </td>
                            <td>
                                <span class="fw-medium">19,278</span>
                            </td>
                            <td class="text-center">
                                <span class="text-muted fs-12">18% Gross</span>
                            </td>
                            <td class="text-end">
                                <span class="badge bg-primary1">1.14% <i class="ti ti-trending-down"></i></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom-0">
                                <span class="fw-medium top-category-name five">others</span>
                            </td>
                            <td class="border-bottom-0">
                                <span class="fw-medium">15,934</span>
                            </td>
                            <td class="text-center border-bottom-0">
                                <span class="text-muted fs-12">15% Gross</span>
                            </td>
                            <td class="text-end border-bottom-0">
                                <span class="badge bg-primary">3.87% <i class="ti ti-trending-up"></i></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
