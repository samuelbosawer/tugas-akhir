<div class="banner_bottom_agile_info">
	<?php foreach ($detail as $d) : ?>
		<div class="container">
			<div class="agile_ab_w3ls_info">
				<div class="col-md-6 ab_pic_w3ls">
					<img src="<?= base_url() ?>assets/upload/perlengkapan/<?= $d->foto ?>" alt=" " class="img-responsive" />
				</div>
				<div class="col-md-6 ab_pic_w3ls_text_info">
					<h5>Detail <span> perlengkapan</span> </h5>
					<table class="table">
						<tr>
							<td>Nama Perlengkapan</td>
							<td><?= $d->nama_perlengkapan ?></td>
						</tr>
						<tr>
							<td>Harga Sewa / Hari</td>
							<td>Rp. <?= number_format($d->harga, 0, ',', '.'); ?> </td>
						</tr>
						<tr>
							<td>Warna</td>
							<td><?= $d->warna ?> </td>
						</tr>
						<tr>
							<td>Stok yang tersisa</td>
							<td><?= $d->stok ?> </td>
						</tr>
						<tr>
							<td>Nama tempat penyewaan</td>
							<td> <a href="<?= base_url() ?>pelanggan/tempat-sewa/detail/<?= $d->id_tempat ?>" target="_blank"> <?= $d->nama_tempat ?> </a> </td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td> <?= $d->alamat_jalan ?>, <?= $d->alamat_distrik ?> </td>
						</tr>
					</table>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-6">
				<h2>Dekripsi </h2>
				<p class="" style="margin-top: 10px;"> <?= $d->deskripsi ?></p>
			</div>
			<div class="col-md-6" style="margin-top: 10px;">
				<a name="" id="" class="btn btn-success btn-lg" href="<?= base_url() ?>pelanggan/perlengkapan/keranjang/<?= $d->id_perlengkapan ?>" role="button"> <i class="fa fa-cart-arrow-down"></i> </a>
				<a name="" id="" class="btn btn-primary btn-lg" href="<?= base_url() ?>pelanggan/perlengkapan/keranjang/<?= $d->id_perlengkapan ?>" role="button"> Bayar</a>

			</div>
		</div>
	<?php endforeach ?>
</div>