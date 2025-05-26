<div class="container">
    <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
            <div class="card custom-card my-4">
                <div class="card-body p-5">
                    <div class="mb-3 d-flex justify-content-center">
                        <?= $this->Html->image('logo.png', ["class"=>"desktop-logo"]) ?>
                    </div>
                    <p class="h5 mb-2 text-center">Login</p>
                    <p class="mb-4 text-muted op-7 fw-normal text-center">Welcome back !</p>

                    <?= $this->Form->create() ?>
                    <div class="row gy-3">
                        <div class="col-xl-12">
                            <label for="username" class="form-label text-default">User Name<sup class="fs-12 text-danger">*</sup></label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="user name">
                        </div>
                        <div class="col-xl-12 mb-2">
                            <label for="password" class="form-label text-default d-block">Password<sup class="fs-12 text-danger">*</sup><a href="#" class="float-end fw-normal text-muted">Forget password ?</a></label>
                            <div class="position-relative">
                                <input type="password" class="form-control create-password-input" name="password" id="password" placeholder="password">
                                <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('password',this)" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></a>
                            </div>
                            <div class="mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label text-muted fw-normal" for="defaultCheck1">
                                        Remember password ?
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mt-4">
                        <?= $this->Form->button(__('Log In'), ["class"=>["btn btn-primary w-100 waves-effect waves-light"], "escape"=>false]); ?>
                    </div>
                    <?= $this->Form->end() ?>

                    <div class="card-body bg-light-alt text-center mt-3">
                        <span class="text-muted d-none d-sm-inline-block">SabiantArt Corporate ©
                            <script>document.write(new Date().getFullYear())</script>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
