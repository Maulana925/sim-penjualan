<?php

	
	session_start();
	if(!isset($_SESSION["login"])){
		header("Location: ../login.php");
		exit;
	}
	
include "../system/proses.php";

	if( isset($_POST['simpan']) ){
		$simpan=$db->insert("barang","'$_POST[id_brg]',
									'$_POST[nama_brg]',
									'$_POST[harga]',
									'$_POST[stok]',
									'$_POST[expired]',
									'$_POST[id_jenis]'");
		if( $simpan ){
			$_SESSION['flash'] = [
				'title' => 'Data Barang',
				'message' => 'Data barang berhasil disimpan.',
				'type' => 'success'
			];
		}else{
			$_SESSION['flash'] = [
				'title' => 'Data Barang',
				'message' => 'Data barang gagal disimpan.',
				'type' => 'error'
			];
		}

	}else{
		$edit=$db->update("barang","id_brg='$_POST[id_brg]',
									nama_brg='$_POST[nama_brg]',
									harga='$_POST[harga]',
									stok='$_POST[stok]',
									expired='$_POST[expired]',
									id_jenis_brg='$_POST[id_jenis]'","id_brg = '$_POST[id_brg]'");

		if( $edit ){
			$_SESSION['flash'] = [
				'title' => 'Data Barang',
				'message' => 'Perubahan data barang berhasil disimpan.',
				'type' => 'success'
			];
		}else{
			$_SESSION['flash'] = [
				'title' => 'Data Barang',
				'message' => 'Perubahan data barang gagal disimpan.',
				'type' => 'error'
			];
		}
	}

	header("Location: ../index.php?p=barang");
	exit;

 ?>
