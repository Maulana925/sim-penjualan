<?php
	include "system/proses.php";

	$tgl = date('Y-m-d');

	$nomot = "TR001";
	try {
		$hasil = $db->get("MAX(id_transaksi) AS maxKode", "transaksi");
		$data = $hasil ? $hasil->fetch(PDO::FETCH_ASSOC) : null;
		$kodebarang = $data && !empty($data['maxKode']) ? $data['maxKode'] : null;
		if ($kodebarang) {
			$angkaTerakhir = (int) substr($kodebarang, 2);
			$angkaTerakhir++;
			$nomot = "TR" . sprintf("%03d", $angkaTerakhir);
		}
	} catch (Exception $e) {
		// fallback ke default ketika query gagal
		$nomot = "TR001";
	}

	$id_ptg = $_SESSION['login_id'];
?>
	<div class="judul-content">
		<h1>Transaksi</h1>
	</div>
<div class="pos-wrapper" data-pos-page="transaksi">
	<div class="pos-layout">
		<form action="crud/simpan_transaksi.php" method="POST">
			<input type="hidden" name="id_user" value="<?php echo $id_ptg; ?>">

			<div class="pos-card pos-meta">
				<div class="pos-meta-grid">
					<div class="pos-field">
						<span class="pos-label">ID Transaksi</span>
						<input type="text" name="id_transaksi" id="id_transaksi" class="text disable" readonly value="<?= $nomot; ?>">
					</div>
					<div class="pos-field">
						<span class="pos-label">Tanggal</span>
						<input type="text" name="tanggal" id="tanggal" class="text disable" value="<?= $tgl; ?>" readonly>
					</div>
				</div>
			</div>

			<div class="pos-columns">
				<div class="pos-card pos-customer">
					<div class="pos-section-header">
						<i class="fas fa-user-friends"></i>
						<span>Informasi Pelanggan</span>
					</div>
					<div class="pos-field-group">
						<label class="pos-label">Kategori</label>
						<select class="textkecil" name="kategori" id="kategori" onchange="plgn()">
							<option disabled selected>--Pilih--</option>
							<option>Pelanggan</option>
							<option>Non Pelanggan</option>
						</select>
					</div>
					<div class="pos-field-group pos-customer-grid">
						<div>
							<label class="pos-label" id="id_plgn">ID Pelanggan</label>
							<input type="text" name="idplgnn" id="id_pelanggan" onkeyup="idp()" class="textkecil" autocomplete="off">
						</div>
						<div>
							<label class="pos-label" id="nm_plgn">Nama Pelanggan</label>
							<input type="text" name="nama_pelanggan" id="nama_pelanggan" class="textkecil disable" readonly>
						</div>
					</div>
				</div>

				<div class="pos-card pos-item">
					<div class="pos-section-header">
						<i class="fas fa-box-open"></i>
						<span>Tambah Barang</span>
					</div>
					<div class="pos-item-grid">
						<div class="pos-field">
							<label class="pos-label">ID Barang</label>
							<input type="text" name="id_barang" class="textkecil" id="id_barang" autocomplete="off" onkeyup="idb()">
						</div>
						<div class="pos-field">
							<label class="pos-label">Nama Barang</label>
							<input type="text" name="nama_barang" id="nama_barang" class="textkecil disable" readonly>
						</div>
						<div class="pos-field">
							<label class="pos-label">Harga</label>
							<input type="text" name="harga" id="harga" class="textkecil disable" readonly>
						</div>
						<div class="pos-field">
							<label class="pos-label">Jumlah</label>
							<input type="text" name="jumlah" id="jumlah" class="textkecil" autocomplete="off" onkeyup="t()">
						</div>
						<div class="pos-field">
							<label class="pos-label">Total</label>
							<input type="text" name="total" id="total" class="textkecil disable" readonly>
						</div>
					</div>
					<div class="pos-action">
						<button type="button" class="simpantrans btn-biru" onclick="simpan_detail()">
							<i class="fas fa-plus-circle"></i> Tambah ke Keranjang
						</button>
					</div>
				</div>
			</div>

			<div class="pos-columns pos-bottom">
				<div class="pos-card pos-cart">
					<div class="pos-section-header">
						<i class="fas fa-shopping-basket"></i>
						<span>Keranjang</span>
					</div>
					<div id="kotak-detail" class="pos-cart-table"></div>
				</div>

				<div class="pos-card pos-payment">
					<div class="pos-section-header">
						<i class="fas fa-cash-register"></i>
						<span>Pembayaran</span>
					</div>
					<div class="pos-payment-grid">
						<div class="pos-field">
							<label class="pos-label" for="subtotal">Sub Total</label>
							<input type="text" name="subtotal" id="subtotal" class="textkecil disable" readonly>
						</div>
						<div class="pos-field">
							<label class="pos-label" for="diskon">Diskon</label>
							<input type="text" name="diskon" id="diskon" class="textkecil disable" readonly>
						</div>
						<div class="pos-field">
							<label class="pos-label" for="totalbayar">Total Bayar</label>
							<input type="text" name="totalbayar" id="totalbayar" class="textkecil disable" readonly>
						</div>
						<div class="pos-field">
							<label class="pos-label" for="bayar">Bayar</label>
							<input type="text" name="bayar" id="bayar" class="textkecil" onkeyup="byr()" required="">
						</div>
						<div class="pos-field">
							<label class="pos-label" for="kembali">Kembali</label>
							<input type="text" name="kembali" id="kembali" class="textkecil disable" readonly>
						</div>
					</div>
					<div class="pos-action">
						<button type="submit" name="simpan" class="simpantrans">
							<i class="fas fa-receipt"></i> Selesaikan Transaksi
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
