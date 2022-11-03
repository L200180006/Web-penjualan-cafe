<!DOCTYPE html>
<?php
function number_with_dot($number, $sign = false)
{
    if ($sign) {
        return number_format($number, 0, ',', '.');
    }
    return number_format($number, 0, ',', '.');
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<body>
    <h3>Masdro Kopi</h3>

    <table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
        <tr>
            <td id="no_penjualan"><?= $penjualan['no_penjualan'] ?></td>
            <td id="name" align='center'><?= $penjualan['name'] ?></td>
        </tr>
        <tr>
            <td id="tgl_penjualan"><?= $penjualan['tgl_penjualan'] ?></td>
            <td id="jam_penjualan" align='center'><?= $penjualan['jam_penjualan'] ?></td>
        </tr>
        <tr>
            <td colspan='2'>
                <hr>
            </td>
        </tr>
    </table>
    <table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>

        <tr align='center'>
            <td width='40%'>Item</td>
            <td width='25%'>Price</td>
            <td width='10%'>Qty</td>
            <td width='25%'>Sub-Total</td>
        <tr>
            <td colspan='5'>
                <hr>
            </td>
        </tr>
        </tr>
        <?php foreach ($detail_penjualan as $detail) : ?>
            <tr>
                <td><?= $detail['nama_menu'] ?></td>
                <td><?= number_with_dot($detail['harga_menu'], true) ?></td>
                <td><?= number_with_dot($detail['jumlah']) ?></td>
                <td style='vertical-align:top; text-align:right; padding-right:10px'><?= number_with_dot($detail['sub_total'], true) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan='5'>
                <hr>
            </td>
        </tr>
        <tr>
            <td colspan='3'>
                <div style='text-align:right; color:black'>Total : </div>
            </td>
            <td id="total" style='vertical-align:top; text-align:right; padding-right:10px'><?= number_with_dot($penjualan['total'], true) ?></td>
        </tr>
        <tr>
            <td colspan='3'>
                <div style='text-align:right; color:black'>Cash : </div>
            </td>
            <td id="bayar" style='vertical-align:top; text-align:right; padding-right:10px'><?= number_with_dot($penjualan['bayar'], true) ?></td>
        </tr>
        <tr>
            <td colspan='3'>
                <div style='text-align:right; color:black'>Change : </div>
            </td>
            <td id="kembalian" style='vertical-align:top; text-align:right; padding-right:10px'><?= number_with_dot($penjualan['kembalian'], true) ?></td>
        </tr>
    </table>
</body>

</html>