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
            <a class="btn btn-primary mb-3" href="<?= base_url('user/add_purchasing') ?>" role="button">Add Data</a>
            <table class="table table-hover">
                <thead class="table-warning">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($purchasing as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $p['nama_item']; ?></td>
                            <td><?= number_with_dot($p['harga_item']); ?></td>
                            <td><?= $p['tgl_pembelian']; ?></td>
                            <td>
                                <a href="<?= base_url('user/edit_purchasing/' . $p['id']); ?>" class="badge badge-success">edit</a>
                                <a onclick="return confirm('Apakah anda ingin menghapus data ini?')" href="<?= base_url('user/delete_purchasing/' . $p['id']); ?>" class="badge badge-danger">delete</a>
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