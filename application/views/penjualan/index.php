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
            <table class="table table-hover">
                <thead class="table-warning">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Selling No.</th>
                        <th scope="col">Staff</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($penjualan as $item) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td>
                                <?= $item['no_penjualan']; ?>
                            </td>
                            <td>
                                <?= $item['name']; ?>
                            </td>
                            <td>
                                <?= $item['tgl_penjualan']; ?>
                            </td>
                            <td>
                                <?= $item['jam_penjualan']; ?>
                            </td>
                            <td>
                                <?= number_with_dot($item['total'], true); ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/detail/' . $item['id']); ?>" class="badge badge-info">detail</a>
                                <a href="<?= base_url('admin/delete/' . $item['id']); ?>" class="badge badge-danger">delete</a>
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