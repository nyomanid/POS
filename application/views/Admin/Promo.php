<?php
	$this->load->view('Admin/Layout/head'); 
	$this->load->view('Admin/Layout/aside');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Data Promo</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Promo</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<?php if ($this->session->userdata('response')) {
		?>
			<div class="alert alert-<?= $this->session->userdata('response')[0] ?> alert-dismissible mt-3">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-check"></i> Alert!</h5>
				<?= $this->session->userdata('response')[1] ?>
			</div>
		<?php
		} ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12  ">
					<button type="button" class="btn btn-default mb-3" data-toggle="modal" data-target="#modal-default">
						<i class="fas fa-user-plus"></i> Tambah Data Promo
					</button>
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Informasi Promo</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Kode</th>
										<th class="text-center">Nama</th>
										<th class="text-center">Promo</th>
										<th class="text-center">Keterangan</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($promo as $key => $value) {
									?>
										<tr>
											<td class="text-center"><?= $no++ ?></td>
											<td class="text-center"><?= $value->kode_promo ?></td>
											<td class="text-center"><?= $value->nama_promo ?></td>
											<td class="text-center"><?= $value->promo ?> %</td>
											<td class="text-center"><?= $value->keterangan ?></td>
											<td class="text-center">
												<div class="btn-group">
													<a href="<?= base_url('admin/promo/delete/' . $value->kode_promo) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
													<button type="button" data-toggle="modal" data-target="#edit<?= $value->kode_promo ?>" class="btn btn-warning"><i class="fas fa-edit"></i></button>
												</div>
											</td>
										</tr>
									<?php
									}
									?>

								</tbody>

								
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<form action="<?= base_url('admin/promo/create') ?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Data Promo</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama-promo-create">Nama Promo</label>
						<input type="text" name="nama_promo" class="form-control" id="nama-promo-create" placeholder="Nama Promo" required>
					</div>
					<div class="form-group">
						<label for="besar-promo-create">Besar Promo</label>
						<div class="row">
							<div class="col-lg-8">
								<input type="text" name="promo" class="form-control" id="besar-promo-create" placeholder="Besar Promo" required>
							</div>
							<div class="col-lg-4">%</div>
						</div>
					</div>
					<div class="form-group">
						<label for="keterangan-promo-create">Keterangan</label>
						<textarea name="keterangan" class="form-control" id="keterangan-promo-create" required></textarea>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</form>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
foreach ($promo as $key => $value) {
?>
	<div class="modal fade" id="edit<?= $value->kode_promo ?>">
		<div class="modal-dialog">
			<form action="<?= base_url('admin/promo/update/' . $value->kode_promo) ?>" method="POST">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Update Data Promo</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						
						<div class="form-group">
							<label for="nama-promo-create">Nama Promo</label>
							<input type="text" name="nama_promo" class="form-control" value="<?= $value->nama_promo ?>" id="nama-promo-create" placeholder="Nama Promo" required>
						</div>
						<div class="form-group">
							<label for="besar-promo-create">Besar Promo</label>
							<div class="row">
								<div class="col-lg-8">
									<input type="text" name="promo" class="form-control" value="<?= $value->promo ?>" id="besar-promo-create" placeholder="Besar Promo" required>
								</div>
								<div class="col-lg-4">%</div>
							</div>
						</div>
						<div class="form-group">
							<label for="keterangan-promo-create">Keterangan</label>
							<textarea name="keterangan" class="form-control" id="keterangan-promo-create" required><?= $value->keterangan ?></textarea>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</form>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php
}
?>
<?php $this->load->view('Admin/Layout/footer'); ?>