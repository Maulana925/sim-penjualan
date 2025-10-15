<?php
	
	session_start();
	if(!isset($_SESSION["login"])){
		header("Location: ../login.php");
		exit;
	}

include "../system/proses.php";
	$idb = $_GET['idb'];
	$hapus = $db->delete("barang","id_brg='$idb'");
	if( $hapus ){
		$_SESSION['flash'] = [
			'title' => 'Data Barang',
			'message' => 'Data barang berhasil dihapus.',
			'type' => 'success'
		];
	}else{
		$_SESSION['flash'] = [
			'title' => 'Data Barang',
			'message' => 'Data barang gagal dihapus.',
			'type' => 'error'
		];
	}

	header("Location: ../index.php?p=barang");
	exit;
	
 ?>
