<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php foreach ($user as $u) { ?>

        <form class="col-lg-9 mx-auto" method="POST" action="<?= base_url('admin/update_user'); ?>">
            <div class="form-group">
                <input type="hidden" name="id" id="id" value="<?= $u['id']; ?>">
                <label>Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?= $u['name']; ?>">
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $u['username']; ?>">
                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role_id" id="role_id" class="form-control">
                    <?php if ($u['role_id'] == 1) {
                    ?>
                        <option value="1" <?php echo  set_select('role_id', '1', TRUE); ?>> Admin </option>
                        <option value="2"> User </option>
                    <?php } else { ?>
                        <option value="1"> Admin </option>
                        <option value="2" <?php echo  set_select('role_id', '2', TRUE); ?>> User </option>

                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    <?php } ?>

</div>
</div>
</div>





</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->