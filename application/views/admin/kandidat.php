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
			<div class="card">
				<h1 class="card-header"><?= $title?></h1>
				<div id="autohide">
					<?= $this->session->flashdata('notifikasi') ?>
				</div>
				<div class="card-body">
					<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
						data-bs-target="#verticalycentered">
						Tambah Kandidat
					</button>
					<div class="modal fade" id="verticalycentered" tabindex="-1" aria-hidden="true"
						style="display: none;">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Tambah Kandidat</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form class="row g-3" action="<?= base_url('admin/kandidat/tambah')?>" method="post"
										enctype="multipart/form-data">
										<div class="col-12">
											<label for="inputNanme4" class="form-label">Nama Kandidat</label>
											<input type="text" class="form-control" id="inputNanme4"
												name="nama_kandidat">
										</div>
										<div class="col-12">
											<label for="inputEmail4" class="form-label">Keterangan</label>
											<input type="text" class="form-control" id="inputEmail4" name="keterangan">
										</div>
										<div class="col-12">
											<label for="inputPassword4" class="form-label">Foto</label>
											<input type="file" class="form-control" id="inputPassword4" name="foto">
										</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary"
										data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
								</form>
							</div>
						</div>
					</div>
					<!-- table -->
					<table class="table datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Kandidat</th>
								<th>Keterangan</th>
								<th>Foto</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($kandidat as $k) { ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $k['nama_kandidat']?></td>
								<td><?= $k['keterangan']?></td>
								<td> <img src="<?= base_url('assets/upload/'.$k['foto'])?>" class="rounded-circle"
										width="200px"></td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="modal"
										data-bs-target="#edit<?= $k['id_kandidat']?>">
										edit <i class="bi-pencil-square"></i>
									</button>
									<a onClick="return confirm('apakah yakin untuk hapus data user')"
										class="btn btn-danger"
										href="<?= base_url('admin/kandidat/delete/'.$k['foto']) ?>"><i
											class="ri-delete-bin-6-fill"></i> delete</a>
								</td>
								<div class="modal fade" id="edit<?= $k['id_kandidat']?>" tabindex="-1" aria-hidden="true"
								style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Update Kandidat</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form class="row g-3" method="post" enctype="multipart/form-data"
												action="<?= base_url('admin/kandidat/update')?>">
												<input type="hidden" name="nama_foto" value="<?= $k['foto']?>">
												<div class="col-12">
													<label for="inputEmail4" class="form-label">Nama</label>
													<input type="text" name="nama_kandidat" class="form-control" id="inputEmail4"
														value="<?= $k['nama_kandidat']?>">
												</div>
												<div class="col-12">
													<label for="inputNanme4" class="form-label">Keterangan</label>
													<input type="text" name="keterangan" class="form-control"
														id="inputNanme4" value="<?= $k['keterangan']?>">
												</div>
												<div class="col-12">
													<label for="inputNanme4" class="form-label">Foto</label>
													<img src="<?= base_url('assets/upload/'.$k['foto'])?>" class="rounded-circle form-control" width="40px">
												</div>
												<div class="col-12">
													<label for="inputNanme4" class="form-label">Foto</label>
													<input type="file" name="foto" class="form-control"
														id="inputNanme4">
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary"
												data-bs-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Save changes</button>
										</div>
										</form>
									</div>
								</div>
							</div>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<!-- table -->
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
