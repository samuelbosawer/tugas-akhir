<?php

function tgl($date)
{
    return date('d/m/Y', strtotime($date));
}
?>
<center>
    <table width="700px" border="0">
        <tr>
            <td width="50px" align="center">
                <p style="font-size: 20px;"><b> LAPORAN PENYEWAAN</b> </p>
                <p style="font-size: 12px;"><b> SISTEM INFORMASI PENYEWAAN</b>
            </td>
        </tr>
    </table>
</center>
<hr style="height:5px;color:black;background-color:black">


<br>
<?php $jumlah = 0;
if (count($penyewaan) == 0) : ?>
    <h4>DATA TIDAK ADA</h4>
<?php else : ?>
    <center>
        <h5 align="center">Penyewaan yang sudah melakukan pembayaran</h5>
    </center>
    <table border="1" style=" border-collapse: collapse; width: 100%; font-size: 10px;">
        <thead>
            <tr>
                <th>No Resi</th>
                <th>Mulai - Selesai Sewa</th>
                <th>Nama <br>Pelanggan </th>
                <th>Nama <br>Tempat Penyewaan </th>
                <th>Jumlah<br> Stok</th>
                <th>Harga</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php $jumlah = 0;
            $i = 1;
            foreach ($penyewaan as $p) : ?>
                <tr>
                    <td style="text-align: center;"><?= $p->no_penyewaan ?></td>
                    <td><?= tgl($p->mulai_sewa) . '-' . tgl($p->akhir_sewa) ?></td>
                    <td><?= $p->nama ?></td>
                    <td><?= $p->nama_tempat ?></td>
                    <td><?= $p->jumlah_stok ?></td>
                    <td>Rp. <?= number_format($p->harga, 0, ',', '.'); ?></td>
                    <?php $total = $p->harga * $p->jumlah_stok;
                    $jumlah = $jumlah + $total;
                    ?>
                    <td>Rp. <?= number_format($total, 0, ',', '.'); ?></td>
                    <!-- <td><?= tgl($p->tanggal) ?></td> -->
                </tr>
            <?php endforeach ?>
        </tbody>
        </tbody>
    </table>
<?php endif ?>
<?php if ($jumlah == '0') : ?>
    <p> Jumlah Pemasukan = Rp. 0 </p>
<?php else : ?>
    <p> Jumlah Pemasukan = Rp. <?= number_format($jumlah, 0, ',', '.'); ?> </p>
<?php endif ?>
<br><br>
<p style="font-size:12; text-align: right;">Jayapura, <?= date('d / m / Y') ?></p>
<table style="font-size:12; font-weight:bold; text-align: center;">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="width: 200px;"></td>
        <td>
        <td>
        </td>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="width: 180px;text-align:right"> </td>
        <td>
        <td>
    </tr>
    <tr>
        <td>
        </td>
        <td></td>
        <td> </td>
        <td></td>
        <td>Admin Sistem
        <td>
    </tr>
    <tr>
        <td>
        </td>
        <td></td>
        <td> </td>
        <td></td>
        <td style="font-size:12; font-weight:bold; text-align:right;  margin-right: 100px;">
            <br><br><br>
        <td>
    </tr>
    <tr>
        <td style="width: 180px;text-align:right"> </td>
        <td></td>
        <td></td>
        <td></td>
        <td>Samuel Bosawer</td>
        <td>
    </tr>
    <tr>
        <td style="width: 180px;text-align:right"> </td>
        <td></td>
        <td></td>
        <td></td>
        <td>
        <td>
    </tr>
    <tr>
        <td style="width: 180px;text-align:right"> </td>
        <td></td>
        <td></td>
        <td></td>
        <td>
        <td>
    </tr>
</table>