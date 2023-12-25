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
					<h1>Penjualan Detail</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Penjualan</a></li>
						<li class="breadcrumb-item active">Detail</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="callout callout-danger">
						<h5><i class="fas fa-info"></i> Note:</h5>
						Informasi penjualan detail dengan transaksi atas nama <strong><?= $detail['transaksi']->customer ?></strong>
					</div>
					<!-- Main content -->
					<div class="invoice p-3 mb-3">
						<!-- title row -->
						<div class="row">
							<div class="col-12">
								<h4>
									<i class="fas fa-globe"></i> Secret Garden Village [Customer: <strong><?= $detail['transaksi']->customer ?></strong>]
									<small class="float-right">Date: <?= $detail['transaksi']->tgl_transaksi ?></small>
								</h4>
							</div>
							<!-- /.col -->
						</div>
						<!-- info row -->
						
						<!-- /.row -->

					
						<!-- Table row -->
						<div class="row">
							<div class="col-12 table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>ID Detail</th>	
											<th>No Transaksi</th>
											<th>Barang (Kode)</th>
											<th>Qty</th>
											<th>Harga</th>
											<th>Promo (%)</th>
											<th>Discount</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($detail['transaksi_detail'] as $key => $value) {
										?>
											<tr>
												<td><?= $value->id_detail ?></td>
												<td><?= $value->no_transaksi ?></td>
												<td><?= $value->nama_barang." (".$value->kode_barang.")" ?></td>
												<td><?= $value->qty ?></td>
												<td>Rp.<?= number_format($value->harga) ?></td>
												<td><?= $promo->promo ?></td>
												
												<td>Rp.<?= number_format($value->discount) ?></td>
												<td>Rp.<?= number_format($value->subtotal) ?></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->

						<div class="row">
							<!-- accepted payments column -->
							<div class="col-6">

							</div>
							<!-- /.col -->
							<div class="col-6">
								

								<div class="table-responsive">
									<table class="table">

										<tr>
											<th>Total:</th>
											<td>Rp. <?= number_format($detail['transaksi']->total_bayar) ?></td>
										</tr>
									</table>
								</div>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->

						<!-- this row will not appear when printing -->
						<div class="row no-print">
							<div class="col-12">
								<button onclick="window.print()" class="btn btn-success"><i class="fas fa-print"></i> Print</button>
								<a href="<?= base_url('admin/penjualan') ?>" class="btn btn-danger"><i class="fas fa-reply"></i> Kembali</a>

							</div>
						</div>
					</div>
					<!-- /.invoice -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<?php $this->load->view('Admin/Layout/footer'); ?>