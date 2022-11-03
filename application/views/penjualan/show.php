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

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-2">
                            <label>Selling No.</label>
                            <input type="text" name="no_penjualan" value="<?= $penjualan['no_penjualan'] ?>" readonly class="form-control">
                        </div>
                        <div class="form-group col-3">
                            <label>Staff</label>
                            <input type="text" name="name" value="<?= $penjualan['name'] ?>" readonly class="form-control">
                        </div>
                        <div class="form-group col-2">
                            <label>Date</label>
                            <input type="text" name="tgl_penjualan" value="<?= $penjualan['tgl_penjualan'] ?>" readonly class="form-control">
                        </div>
                        <div class="form-group col-2">
                            <label>Time</label>
                            <input type="text" name="jam_penjualan" value="<?= $penjualan['jam_penjualan'] ?>" readonly class="form-control">
                        </div>
                    </div>
                    <hr>

                    <div class="keranjang">
                        <table class="table table-bordered" id="keranjang">
                            <thead>
                                <tr>
                                    <td width="35%">Menu</td>
                                    <td width="15%">Price</td>
                                    <td width="15%">Amount</td>
                                    <td width="10%">Sub Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail_penjualan as $detail) : ?>
                                    <tr>
                                        <td><?= $detail['nama_menu'] ?></td>
                                        <td><?= number_with_dot($detail['harga_menu'], true) ?></td>
                                        <td><?= number_with_dot($detail['jumlah']) ?></td>
                                        <td><?= number_with_dot($detail['sub_total'], true) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" align="right"><strong>Total : </strong></td>
                                    <td id="total"><?= number_with_dot($penjualan['total'], true) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right"><strong>Cash : </strong></td>
                                    <td id="bayar"><?= number_with_dot($penjualan['bayar'], true) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right"><strong>Change : </strong></td>
                                    <td id="kembalian"><?= number_with_dot($penjualan['kembalian'], true) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->