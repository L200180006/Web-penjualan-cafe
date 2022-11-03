<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <form class="user" method="POST" action="<?= base_url('admin/add_user'); ?>">

        <div class="col-lg-9 mx-auto">
            <div class="p-5">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Create Account
                </button>
    </form>

</div>
</div>
</div>
</div>





</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->