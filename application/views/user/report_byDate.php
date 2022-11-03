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

    <h2>Income & Expenses Report <?= date('d F Y', strtotime($this->input->post('tgl_awal'))); ?> - <?= date('d F Y', strtotime($this->input->post('tgl_akhir'))); ?></h2>
    <div class="col-lg-9 mx-auto">
        <table class="table table-hover">
            <h3>Income</h3>
            <thead class="table-warning">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Selling No.</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($penjualan as $p) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $p['no_penjualan']; ?></td>
                        <td><?= $p['nama_menu']; ?></td>
                        <td><?= $p['tgl_penjualan']; ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" align="right"><strong>Total : </strong></td>
                    <td>Rp. <?= number_with_dot($total_penjualan['total']) ?></td>

                </tr>
            </tfoot>
        </table>

        <table class="table table-hover">
            <h3>Expenses</h3>
            <thead class="table-warning">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($purchasing as $p) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $p['nama_item']; ?></td>
                        <td><?= $p['harga_item']; ?></td>
                        <td><?= $p['tgl_pembelian']; ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" align="right"><strong>Total : </strong></td>
                    <td>Rp. <?= number_with_dot($total_purchasing['harga_item']) ?></td>

                </tr>
            </tfoot>
        </table>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->