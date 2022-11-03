<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>


    <div class="row">
        <div class="col-lg-9 mx-auto">
            <a class="btn btn-primary mb-3" href="<?= base_url('admin/add_user') ?>" role="button">Add User</a>
            <table class="table table-hover">
                <thead class="table-warning">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($user as $u) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $u['name']; ?></td>
                            <td><?= $u['username']; ?></td>
                            <td>
                                <?php
                                if ($u['role_id'] == 1) {
                                    echo "Admin";
                                } else if ($u['role_id'] == 2) {
                                    echo "User";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/edit_user/' . $u['id']); ?>" class="badge badge-success">edit</a>
                                <a onclick="return confirm('Apakah anda ingin menghapus data ini?')" href="<?= base_url('admin/delete_user/' . $u['id']); ?>" class="badge badge-danger">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->