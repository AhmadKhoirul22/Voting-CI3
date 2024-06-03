<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?= $title?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<!-- css -->
	<?php require_once('layout/_css.php') ?>
	<!-- /css  -->
</head>

<body>
	<!-- ======= Header ======= -->
	<?php require_once('layout/_header.php') ?>
	<!-- End Header -->
	<!-- ======= Sidebar ======= -->
	<?php require_once('layout/_sidebar.php') ?>
	<!-- End Sidebar-->
	<!-- main -->
	<main id="main" class="main">
		<div class="pagetitle">
			<div class="row">
				<div class="card">
				<h1><?= $title?></h1>
					<div class="card-body">
					<h3 class="text-center"><?= $voting->nama_voting?></h3>
					<div class="row">
						<?php foreach($ikt as $kan){?>
						<div class="col-lg-6 text-center">
							<div class="card">
								<img src="<?= base_url('assets/upload/'.$kan['foto'])?>" class="rounded-circle text-center">
								<div class="card-body">
									<h5 class="card-title"><?= $kan['nama_kandidat']?></h5>
									<p class="card-text"><?= $kan['keterangan']?><p>
									<form action="<?= base_url('admin/pemilih/tambah')?>" method="post">
										<input type="hidden" name="id_voting" value="<?= $kan['id_voting']?>">
										<input type="hidden" name="id_admin" value="<?= $this->session->userdata('id_admin')?>">
										<input type="hidden" name="id_kandidat" value="<?= $kan['id_kandidat']?>">
										<button type="submit" class="btn btn-warning">Pilih</button>
									</form>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					</div>
				</div>
			</div>
		</div>
	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<?php require_once('layout/_footer.php') ?>
	<!-- End Footer -->
	<!-- Vendor JS Files -->
	<?php require_once('layout/_js.php') ?>

</body>

</html>
