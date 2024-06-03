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
						Tambah Admin
					</button>
					<div class="modal fade" id="verticalycentered" tabindex="-1" aria-hidden="true"
						style="display: none;">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Tambah Admin</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form class="row g-3" action="<?= base_url('admin/user/tambah')?>" method="post">
										<div class="col-12">
											<label for="inputNanme4" class="form-label">Nama</label>
											<input type="text" class="form-control" id="inputNanme4" name="nama">
										</div>
										<div class="col-12">
											<label for="inputEmail4" class="form-label">Username</label>
											<input type="text" class="form-control" id="inputEmail4" name="username">
										</div>
										<div class="col-12">
											<label for="inputPassword4" class="form-label">Level</label>
											<select name="level" id="" class="form-control">
												<option value="Admin">Admin</option>
												<option value="Pemilih">Pemilih</option>
											</select>
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
								<th>Nama</th>
								<th>Username</th>
								<th>Level</th>
								<th>aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach($admin as $aa){?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $aa['nama']?></td>
								<td><?= $aa['username']?></td>
								<td><?= $aa['level']?></td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="modal"
										data-bs-target="#edit<?= $aa['id_admin']?>">
										edit <i class="bi-pencil-square"></i>
									</button>
									<a onClick="return confirm('apakah yakin untuk hapus data user')"
										class="btn btn-danger"
										href="<?= base_url('admin/user/delete/'.$aa['id_admin']) ?>"><i
											class="ri-delete-bin-6-fill"></i> delete</a>
								</td>
							</tr>
							<div class="modal fade" id="edit<?= $aa['id_admin']?>" tabindex="-1" aria-hidden="true"
								style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Update User</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form class="row g-3" method="post"
												action="<?= base_url('admin/user/update')?>">
												<input type="hidden" name="id_admin" value="<?= $aa['id_admin']?>">
												<div class="col-12">
													<label for="inputEmail4" class="form-label">Nama</label>
													<input type="text" name="nama" class="form-control" id="inputEmail4"
														value="<?= $aa['nama']?>">
												</div>
												<div class="col-12">
													<label for="inputNanme4" class="form-label">Username</label>
													<input type="text" name="username" class="form-control"
														id="inputNanme4" value="<?= $aa['username']?>">
												</div>
												<div class="col-12">
													<label for="inputNanme4" class="form-label">Password</label>
													<input type="password" name="password" class="form-control"
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
