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
					<?php if($voting == NULL){ ?>
					<form class="row g-3" action="<?= base_url('admin/voting/tambah')?>" method="post">
						<div class="col-12">
							<label for="inputNanme4" class="form-label">Nama Voting</label>
							<input type="text" class="form-control" name="voting" id="inputNanme4">
						</div>
						<div class="col-12">
							<label for="inputEmail4" class="form-label">Nama Kandidat</label>
							<select name="kandidat[]" class="form-control" multiple>
									<?php foreach($kandidat as $k) { ?>
									<option value="<?= $k['id_kandidat']?>"><?= $k['nama_kandidat']?></option>	
									<?php } ?>
							</select>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-secondary">Reset</button>
						</div>
					</form>
					<?php } ?>
					<hr>
					<!-- event -->
					<?php if($voting != NULL){?>
					<h3 class="text-center"><?= $voting->nama_voting?></h3>
					<div class="row">
						<?php foreach($ikt as $kan){?>
						<div class="col-lg-6 text-center">
							<div class="card">
								<img src="<?= base_url('assets/upload/'.$kan['foto'])?>" class="rounded-circle text-center">
								<div class="card-body">
									<h5 class="card-title"><?= $kan['nama_kandidat']?></h5>
									<p class="card-text"><?= $kan['keterangan']?><p>
									<p class="card-text">Poin : <?= $kan['poin']?></p>	
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<!-- event -->
					<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
						data-bs-target="#verticalycentered">
						Update Voting
					</button>
					<a href="<?= base_url('admin/voting/delete/'.$kan['id_voting'])?>" class="btn btn-danger mb-3" onclick="confirm('yakin menhgapus?')">Delete Voting</a>
					<div class="modal fade" id="verticalycentered" tabindex="-1" aria-hidden="true"
						style="display: none;">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Update Voting</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form class="row g-3" action="<?= base_url('admin/voting/update')?>" method="post"
										enctype="multipart/form-data">
										<input type="hidden" name="id_voting" value="<?= $kan['id_voting']?>">
										<div class="col-12">
											<label for="inputNanme4" class="form-label">Nama Voting</label>
											<input type="text" class="form-control" id="inputNanme4"
												name="nama_voting" value="<?= $kan['nama_voting']?>">
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
					<div class="row">
						<?php
								$this->db->from('admin');
								$data['admin'] = $this->db->get()->result_array();
								$this->db->from('ikut');
								$data['ikut'] = $this->db->get()->result_array();
								// hak memilih
								$sudah_memilih = array();
								$belum_memilih = array();
						
						foreach ($data['admin'] as $admin) {
							$found = false;
							foreach ($data['ikut'] as $ikut) {
								if ($admin['id_admin'] == $ikut['id_admin']) {
									$found = true;
									$sudah_memilih[] = array(
										'nama' => $admin['nama'],
										'waktu' => $ikut['waktu']
									);
									break;
								}
							}
							if (!$found) {
								$belum_memilih[] = array(
									'nama' => $admin['nama']
								);
							}
						}
						?>
						<div class="col-lg-6 text-center">
							<div class="card">
								<div class="card-body">
							<h6>Sudah Memilih</h6>
							<table class="table datatable">
								<thead>
									<tr>
									<th>No</th>
									<th>Nama</th>
									<th>waktu</th>
									</tr>
								</thead>
								<tbody>
								<?php $no=1; foreach($sudah_memilih as $ss){?>
									<tr>
										<td><?= $no++;?></td>
										<td><?= $ss['nama']?></td>
										<td><?= $ss['waktu']?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							</div>
							</div>
						</div>
						<div class="col-lg-6 text-center">
							<div class="card">
								<div class="card-body">
									<h6>Belum Memilih</h6>
									<table class="table datatable">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach($belum_memilih as $blm){?>
											<tr>
												<td><?= $no++?></td>
												<td><?= $blm['nama']?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
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
