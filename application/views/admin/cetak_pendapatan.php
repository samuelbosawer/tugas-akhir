<?php

function tgl($date)
{
    return date('d-m-Y', strtotime($date));
}
?>
<center>
    <table width="700px" border="0">
        <tr>
            <td width="50px" align="center">
                <p style="font-size: 20px;"><b> LAPORAN PEMASUKAN</b> </p>
                <p style="font-size: 12px;"><b> SISTEM INFORMASI PENYEWAAN</b>
            </td>
        </tr>
    </table>
</center>
<hr style="height:5px;color:black;background-color:black">


<br>
<?php if (count($pendapatan) == 0) : ?>
    <h4>DATA TIDAK ADA</h4>
<?php else : ?>
    <table border="1" style=" border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Pendapatan Tempat Penyewaan</th>
                <th>Pendapatan Admin</th>
                <th>Tanggal</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $admin = 0;
            $tempat = 0;
            $i = 1;
            foreach ($pendapatan as $p) : ?>
                <tr>
                    <td style="text-align: center;"><?= $i++ ?></td>
                    <td>Rp. <?= number_format($p->pendapatan_tempat, 0, ',', '.'); ?></td>
                    <td>Rp. <?= number_format($p->pendapatan_admin, 0, ',', '.'); ?></td>
                    <td><?= tgl($p->tanggal) ?></td>
                </tr>
                <?php
                $tempat = $tempat + $p->pendapatan_tempat;
                $admin  = $admin  + $p->pendapatan_admin;
                ?>

            <?php endforeach ?>
            <tr class="text-align">
                <td>Total</td>
                <td>Rp. <?= number_format($tempat); ?></td>
                <td colspan="2"> Rp. <?= number_format($admin); ?></td>

            </tr>
        </tbody>
        </tbody>
    </table>
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