<?php 
	session_start();
	require "proses.php";
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = $db->get("*","petugas","WHERE username='$username' AND password='$password'");
		$row = $result->rowCount();
		$data = $result->fetch();
		if( $row > 0){
			$_SESSION['login']=$data['id_petugas'];
			$_SESSION['login_id'] = $data['id_petugas'];
			$_SESSION['username'] = $data['username'];
			$_SESSION['level'] = $data['level'];
			$_SESSION['flash'] = [
				'title' => 'Halo, ' . $data['username'],
				'message' => 'Selamat datang kembali di SIM Penjualan.',
				'type' => 'success'
			];
			header("Location: ../index.php");
			exit;
		}else{
			$_SESSION['flash'] = [
				'title' => 'Login Gagal',
				'message' => 'Username atau password salah.',
				'type' => 'error'
			];
		    header("Location: ../login.php");
			exit;
		}
	}
 ?>
 
