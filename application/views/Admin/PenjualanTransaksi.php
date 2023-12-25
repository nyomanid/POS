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
					<h1>Transaksi Penjualan</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Penjualan</a></li>
						<li class="breadcrumb-item active">Tambah Transaksi</li>
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
				<!-- left column -->
				<div class="col-md-5">
					<!-- general form elements -->
					<div class="card card-warning">
						<div class="card-header">
							<h3 class="card-title">Form Transaksi</h3>

						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<?php 	
							$data_pos_customer = "";
							$data_pos_promo = "";
							$data_pos_value_promo = "";
							foreach ($this->cart->contents() as $key => $value) {
								$data_pos_customer = $value['options']['pos_customer'];
								$data_pos_promo = $value['options']['pos_promo'];
								$data_pos_value_promo = $value['options']['pos_value_promo'];
							}
					
						?>

						<form role="form" action="<?= base_url('admin/penjualantransaksi/addtocart') ?>" method="POST">
							<div class="card-body">
								<div class="form-group">
									<label for="pos_barang">Nama Barang</label>
									<select id="pos_barang" name="pos_barang" class="form-control" required>
										<option value="">---Pilih Barang---</option>
										<?php
										foreach ($barang as $key => $value) {
										?>
											<option data-deskripsi="<?= $value->deskripsi ?>" data-harga="<?= $value->harga ?>" data-nama="<?= $value->nama_barang ?>" value="<?= $value->kode_barang ?>"><?= $value->nama_barang ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="pos_nama_barang">Nama Barang</label>
											<input type="text" name="pos_nama_barang" class="pos_nama_barang form-control" id="pos_nama_barang" placeholder="Nama Barang" readonly>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="pos_harga_barang">Harga</label>
											<input type="text" name="pos_harga_barang" class="pos_harga_barang form-control" id="pos_harga_barang" placeholder="Harga" readonly>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="pos_desc_barang">Deskripsi</label>
									<textarea type="text" rows="4" class="pos_desc_barang form-control" id="pos_desc_barang" placeholder="Deskripsi" readonly></textarea>
								</div>
								<div class="form-group">
									<label for="pos_qty">Quantity</label>
									<input type="number" min="1" name="pos_qty" class="form-control" id="pos_qty" placeholder="Masukkan Quantity" required>
								</div>
								
								<hr>
								<div class="form-group">
									<label for="pos_customer">Nama Customer <small>(hanya input sekali)</small></label>
									<input type="text" name="pos_customer" class="form-control" id="pos_customer" placeholder="Masukkan Nama Customer" value="<?=$data_pos_customer?>" <?= ($data_pos_customer != '' ? 'readonly' : '')?> required>
								</div>
								<div class="form-group">
									<label for="pos_promo">Pilih Promo (jika ada)  <small>(hanya pilih sekali)</small></label>
									<?php if($data_pos_customer == '') { ?>
										<select id="pos_promo" name="pos_promo" class="form-control">
											<option value="">---Pilih Promo---</option>
											<?php
											foreach ($promo as $key => $value) {
											?>
												<option data-value_promo="<?= $value->promo ?>" value="<?= $value->kode_promo ?>"><?= $value->nama_promo." (".$value->promo."%)" ?></option>
											<?php
											}
											?>
										</select>
									<?php } else { ?>
										<input type="hidden" name="pos_promo" id="pos_promo" value="<?=$data_pos_promo?>" readonly>
										<?php
											foreach ($promo as $key => $value) {
												if($value->kode_promo == $data_pos_promo) {
													?>
													<input type="text" name="" class="form-control" value="<?= $value->nama_promo." (".$value->promo."%)" ?>" readonly>
													<?php
													break;
												}
											}
									} ?>
									<input type="hidden" name="pos_value_promo" id="pos_value_promo" value="<?=$data_pos_value_promo?>" <?= ($data_pos_value_promo != '' ? 'readonly' : '')?>>
								</div>

								
							</div>
							<!-- /.card-body -->

							<div class="card-footer">
								<button type="submit" class="btn btn-warning">Add Cart</button>
							</div>
						</form>
					</div>
				</div>
				<?php
				$qty = 0;
				foreach ($this->cart->contents() as $key => $value) {
					$qty += $value['qty'];
				}
				if ($qty != '0') {
				?>
					<div class="col-md-7">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Informasi Keranjang Transaksi Penjualan <?=($data_pos_customer !='' ? "[Customer: <b>".$data_pos_customer."</b>]" : "") ?></h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th style="width: 10px">#</th>
											<th>Barang</th>
											<th>Harga</th>
											<th style="width: 40px">Qty</th>
											<th>Promo</th>
											<th>Subtotal</th>
											<th style="width: 40px">Hapus</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($this->cart->contents() as $key => $value) {
										?>
											<tr>
												<td><?= $no++ ?>.</td>
												<td><?= $value['name'] ?></td>
												<td>Rp.<?= number_format($value['options']['pos_harga_barang']) ?></td>
												<td class="text-center"><span class="badge bg-success"><?= $value['qty'] ?></span></td>
												<td><?= $value['options']['show_promo']?></td>
												<td>Rp.<?= number_format($value['options']['show_subtotal']) ?></td>
												<td class="text-center"><a class="btn btn-danger btn-sm" href="<?= base_url('admin/penjualantransaksi/deletecart/' . $value['rowid']) ?>"><i class="fas fa-trash-alt fa-sm"></i></a></td>
											</tr>
										<?php
										}
										?>
										<tr>

											<td colspan="3" class="text-right">Total</td>
											<td colspan="3"><strong>Rp. <?= number_format($this->cart->total()) ?></strong></td>
										</tr>

									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
							<div class="card-footer clearfix">
								<a href="<?= base_url('admin/penjualantransaksi/checkout') ?>" class="btn btn-success"><i class="fas fa-save"></i> Simpan Transaksi</a>
							</div>
						</div>
					</div>
				<?php
				}
				?>

				<!-- /.card -->
			</div>
			
			<!-- /.card -->
		</div>

		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<?php $this->load->view('Admin/Layout/footer'); ?>