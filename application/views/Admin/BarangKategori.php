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
					<h1>Kategori Barang</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Kategori Barang</li>
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
						<i class="fas fa-user-plus"></i> Tambah Data Kategori
					</button>
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Informasi Kategori</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Nama Kategori</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($kategori as $key => $value) {
									?>
										<tr>
											<td class="text-center"><?= $no++ ?></td>
											<td class="text-center"><?= $value->nama_kategori ?></td>

											<td class="text-center">
												<div class="btn-group">
													<a href="<?= base_url('admin/barang/delete_kategori/' . $value->id_kategori) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
													<button type="button" data-toggle="modal" data-target="#edit<?= $value->id_kategori ?>" class="btn btn-warning"><i class="fas fa-edit"></i></button>
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
		<form action="<?= base_url('admin/barang/create_kategori') ?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Data Kategori Barang</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_kategori">Nama Kategori</label>
						<input type="text" name="nama" class="form-control" id="nama_kategori" placeholder="Nama Kategori" required>
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
foreach ($kategori as $key => $value) {
?>
	<div class="modal fade" id="edit<?= $value->id_kategori ?>">
		<div class="modal-dialog">
			<form action="<?= base_url('admin/barang/update_kategori/' . $value->id_kategori) ?>" method="POST">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Update Data Kategori Barang</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="nama_kategori_update">Nama Kategori</label>
							<input type="text" name="nama" value="<?= $value->nama_kategori ?>" class="form-control" id="nama_kategori_update" placeholder="Nama Kategori" required>
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