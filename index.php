<?php

session_start();
error_reporting(0);

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
$level = $_SESSION['level'];

?>
<!DOCTYPE html>
<html>

<head>
	<title>SIM Penjualan</title>
	<!-- Style -->
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="assets/css/toast.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.min.css"
		integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

</head>

<body>
   <div class="header">
       <div class="nav-left">
           <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar" aria-expanded="true">
               <span class="bar"></span>
               <span class="bar"></span>
               <span class="bar"></span>
           </button>
           <div class="judul">
               <h1>SIM Penjualan</h1>
           </div>
       </div>

       <div class="nav-right"></div>

   </div>
	<div class="sidebar">

		<div class="menu">

			<ul>
				<?php
				if ($_SESSION['level'] == "admin") {
					$home = "";
					$user = "";
					$barang = "";
					$pelanggan = "";
					$jenis = "";
					$transaksi = "";
					$laporan = "hidden";
					$gp = "hidden";
					$lpr = "hidden";
				} elseif ($_SESSION['level'] == "kasir") {
					$home = "";
					$user = "hidden";
					$barang = "hidden";
					$pelanggan = "hidden";
					$jenis = "hidden";
					$transaksi = "";
					$laporan = "hidden";
					$gp = "";
					$lpr = "hidden";
				} else {
					$home = "";
					$user = "hidden";
					$barang = "hidden";
					$pelanggan = "hidden";
					$jenis = "hidden";
					$transaksi = "hidden";
					$laporan = "";
					$gp = "hidden";
				}


				?>
		<li <?php echo $home; ?>><a class="menu-link" href="index.php?p=home"><i class="fas fa-tachometer-alt"></i><span class="menu-text">Beranda</span></a>
		</li>

		<li <?php echo $user; ?>><a class="menu-link" href="index.php?p=user"><i class="fa fa-user"></i><span class="menu-text">User</span></a></li>

		<li <?php echo $barang; ?>><a class="menu-link" href="index.php?p=barang"><i class="fa fa-shopping-cart"></i><span class="menu-text">Barang</span></a>
		</li>

		<li <?php echo $pelanggan; ?>><a class="menu-link" href="index.php?p=pelanggan"><i class="fa fa-user-friends"></i><span class="menu-text">Pelanggan</span></a></li>

		<li <?php echo $jenis; ?>><a class="menu-link" href="index.php?p=jenis_barang"><i class="fa fa-tags"></i><span class="menu-text">Jenis Barang</span></a>
		</li>

		<li <?php echo $transaksi; ?>><a class="menu-link" href="index.php?p=transaksi"><i class="fas fa-table"></i><span class="menu-text">Transaksi</span></a>
		</li>

		<li <?php echo $gp; ?>><a class="menu-link" href="index.php?p=ganti_password"><i class="fas fa-user-lock"></i><span class="menu-text">Ganti Password</span></a></li>


		<li <?php echo $laporan; ?> id="lpr"><a class="menu-link" href="#"><i class="fas fa-print"></i><span class="menu-text">Laporan</span></a></li>


		<li <?php echo $lpr; ?> id="lpr1" class="submenu"><a
					href="index.php?p=laporan_pertanggal"><span>Per Tanggal</span></a></li>

		<li <?php echo $lpr; ?> id="lpr2" class="submenu"><a
					href="index.php?p=laporan_perbulan"><span>Per Bulan</span></a></li>

		<li <?php echo $lpr; ?> id="lpr3" class="submenu"><a
					href="index.php?p=laporan_pertahun"><span>Per Tahun</span></a></li>


		<li <?php echo $home; ?>><a class="menu-link" href="logout.php" onclick="return confirm('Yakin Ingin Logout ?')"><i
					class="fa fa-sign-out-alt"></i><span class="menu-text">Logout</span></a></li>

			</ul>
		</div>
	</div>
	<div class="content">
		<?php
		if (empty($_GET['p'])) {
			echo "<script>document.location.href='index.php?p=home'</script>";
		} else {
			$p = $_GET['p'];
			include "content/$p.php";
		}
		?>
	</div>
	<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="assets/js/app-toast.js"></script>
	<script type="text/javascript" src="assets/js/vanilla-tilt.min.js"></script>
	<script type="text/javascript" src="assets/js/ui-3d.js"></script>
	<script type="text/javascript" src="assets/js/transaksi.js"></script>
	<script>
	(function(){
		var STORAGE_KEY = 'sim-penjualan-sidebar';
		var toggle = document.getElementById('sidebarToggle');
		var prefersCompact = localStorage.getItem(STORAGE_KEY);

		function applyState(compact){
			document.body.classList.toggle('compact', compact);
			if(toggle){
				toggle.setAttribute('aria-expanded', (!compact).toString());
			}
		}

		function responsiveState(){
			if (prefersCompact === null){
				applyState(window.innerWidth < 1100);
			}
		}

		if (prefersCompact !== null){
			applyState(prefersCompact === '1');
		}else{
			responsiveState();
		}

		if (toggle){
			toggle.addEventListener('click', function(){
				var newState = !document.body.classList.contains('compact');
				applyState(newState);
				localStorage.setItem(STORAGE_KEY, newState ? '1' : '0');
				prefersCompact = newState ? '1' : '0';
			});
		}

		window.addEventListener('resize', function(){
			if (prefersCompact === null){
				responsiveState();
			}
		});

		document.addEventListener('DOMContentLoaded', function(){
			if (document.querySelector('[data-pos-page="transaksi"]') && typeof buka_tab === 'function') {
				buka_tab();
			}
		});
	})();
	</script>
	<?php
	$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
	if ($flash) {
		$toastData = $flash;
		$printId = null;
		if (isset($toastData['print'])) {
			$printId = $toastData['print'];
			unset($toastData['print']);
		}
		unset($_SESSION['flash']);
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		if (window.AppToast) {
			AppToast.show(<?php echo json_encode($toastData); ?>);
		}
		<?php if (!empty($printId)) { ?>
		window.open('struk/struk.php?idt=' + <?php echo json_encode($printId); ?>, '_blank');
		<?php } ?>
	});
	</script>
	<?php } ?>
</body>

</html>
