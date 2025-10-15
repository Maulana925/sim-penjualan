<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SIM Penjualan — Login</title>
	<link rel="stylesheet" type="text/css" href="assets/css/login-3d.css">
	<link rel="stylesheet" type="text/css" href="assets/css/toast.css">
	<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.min.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body class="login-body">
	<main class="login-shell">
		<section class="login-panel tilt-card" data-float="26">
			<div class="panel-head">
				<span class="panel-kicker"><i class="fas fa-store"></i> SIM Penjualan</span>
				<h1>Masuk ke Dashboard</h1>
				<p>Kelola barang, pelanggan, dan transaksi dalam satu ruang kerja futuristik.</p>
			</div>
			<form class="login-form" action="system/cek_login.php" method="POST">
				<label class="field">
					<i class="field-icon fas fa-user"></i>
					<input type="text" name="username" placeholder="Username Anda" autocomplete="off" required>
				</label>
				<label class="field">
					<i class="field-icon fas fa-lock"></i>
					<input type="password" name="password" placeholder="Password" required>
				</label>
				<button type="submit" name="submit" class="login-button">
					<span>Masuk</span>
					<i class="fas fa-arrow-right"></i>
				</button>
			</form>
			<div class="panel-footer">
				<i class="fas fa-info-circle"></i>
				<span>Gunakan kredensial yang diberikan admin untuk mengakses sistem.</span>
			</div>
		</section>
		<aside class="login-showcase tilt-card" data-float="18">
			<div class="showcase-sphere"></div>
			<div class="showcase-header">
				<h2>3D Retail Intelligence</h2>
				<p>Pantau performa toko dengan visual modern dan interaksi yang responsif.</p>
			</div>
			<ul class="feature-list">
				<li><i class="fas fa-chart-line"></i> Insight penjualan realtime dengan tampilan dashboard 3D.</li>
				<li><i class="fas fa-box-open"></i> Manajemen stok, pelanggan, dan transaksi hanya dalam beberapa klik.</li>
				<li><i class="fas fa-shield-alt"></i> Keamanan login dengan notifikasi instan setiap kali autentikasi.</li>
			</ul>
		</aside>
	</main>

	<script type="text/javascript" src="assets/js/vanilla-tilt.min.js"></script>
	<script type="text/javascript" src="assets/js/ui-3d.js"></script>
	<script type="text/javascript" src="assets/js/app-toast.js"></script>
	<?php
	$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
	if ($flash) {
		unset($_SESSION['flash']);
		$toastData = $flash;
		if (isset($toastData['print'])) {
			unset($toastData['print']);
		}
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		if (window.AppToast) {
			AppToast.show(<?php echo json_encode($toastData); ?>);
		}
	});
	</script>
	<?php } ?>
</body>
</html>
