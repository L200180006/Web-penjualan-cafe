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
    <form class="user" method="POST" action="<?= base_url('user/report_byDate') ?>">
        <div class="form-row mb-3">
            <table>
                <tr>
                    <td>Date From</td>
                    <td> To</td>
                </tr>
                <tr>
                    <td><input type="date" name="tgl_awal" id="tgl_awal" class="form-control"></td>
                    <td><input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control ml-2"></td>
                    <td><button type="submit" class="btn btn-primary ml-3">
                            Process
                        </button></td>
                </tr>
            </table>
        </div>
    </form>

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
            <tfoot> </tfoot>
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
            <tfoot></tfoot>
        </table>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->