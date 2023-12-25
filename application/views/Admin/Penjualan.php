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
					<h1>Data Penjualan</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Data Penjualan</li>
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
				<div class="col-12 col-sm-12">
					<a href="<?= base_url('admin/penjualantransaksi/') ?>" class="btn btn-success mb-3"><i class="fas fa-cart-plus"></i> Tambah Transaksi Penjualan</a>
					<div class="card card-info card-outline card-tabs">
						
						<div class="card-body">
							
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Informasi Penjualan</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table class="example1 table table-bordered table-striped">
										<thead>
											<tr>
												<th class="text-center">No</th>
												<th class="text-center">Tanggal Transaksi</th>
												<th class="text-center">Customer</th>
												<th class="text-center">Promo</th>
												<th class="text-center">Total Bayar</th>
												<th class="text-center">PPN</th>
												<th class="text-center">Grand Total</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach ($penjualan as $key => $value) {
												$info_promo = "-";
												foreach($promo as $p) {
													if($p->kode_promo == $value->kode_promo) {
														$info_promo = $p->nama_promo." (".$p->promo."%)";
													}
												}
											?>

												<tr>
													<td class="text-center"><?= $no++ ?></td>
													<td class="text-center"><?= $value->tgl_transaksi ?></td>
													<td class="text-center"><?= $value->customer ?></td>
													<td class="text-center"><?= $info_promo ?></td>
													<td class="text-center">Rp.<?= number_format($value->total_bayar) ?></td>
													<td class="text-center"><?= $value->ppn ?></td>
													<td class="text-center">Rp.<?= number_format($value->grand_total) ?></td>
													
													<td class="text-center">
														<div class="btn-group">
															<a href="<?= base_url('admin/penjualan/detail/' . $value->no_transaksi) ?>" class="btn btn-info"><i class="fas fa-info"></i></a>
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
								
						</div>
						<!-- /.card -->
					</div>
				</div>
			</div>

			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<?php $this->load->view('Admin/Layout/footer'); ?>