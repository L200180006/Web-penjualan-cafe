<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    function number_with_dot($number, $sign = false)
    {
        if ($sign) {
            return 'Rp ' . number_format($number, 0, ',', '.');
        }
        return number_format($number, 0, ',', '.');
    }
    ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>


    <div class="row">
        <div class="col-lg-9 mx-auto">
            <a class="btn btn-primary mb-3" href="<?= base_url('admin/add_menu') ?>" role="button">Add Menu</a>
            <table class="table table-hover">
                <thead class="table-warning">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($food_menu as $f) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $f['nama_menu']; ?></td>
                            <td><?= number_with_dot($f['harga_menu']); ?></td>
                            <td>
                                <a href="<?= base_url('admin/edit_menu/' . $f['id']); ?>" class="badge badge-success">edit</a>
                                <a onclick="return confirm('Apakah anda ingin menghapus data ini?')" href="<?= base_url('admin/delete_menu/' . $f['id']); ?>" class="badge badge-danger">delete</a>
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