<footer class="main-footer">
	<strong>SECRET GARDEN VILLAGE</strong> | By <a href='https://nyoman.id' title='I Nyoman Indra Darmawan' target='_blank'>I Nyoman Indra Darmawan</a>


</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- daterangepicker -->
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('asset/AdminLTE/') ?>dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('asset/AdminLTE/') ?>dist/js/demo.js"></script>
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('asset/AdminLTE/') ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('asset/AdminLTE/') ?>dist/js/demo.js"></script>
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/select2/js/select2.full.min.js"></script>

<script>
	$(function() {
		
		// add collapse sidebar function
		$(".main-header.navbar .nav-link").click(function(){
			$("body").toggleClass("sidebar-collapse");
		});
		
		//Initialize Select2 Elements
		$('.select2').select2()
		
	})
</script>
<script>
	$(function() {
		$(".example1").DataTable({
			"responsive": true,
			"autoWidth": false,
		});

		//Date range picker
		$('#reservationdate').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>

<script>
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 3000)
</script>


<script>
	console.log = function() {}
	$("#pos_barang").on('change', function() {

		$(".pos_nama_barang").html($(this).find(':selected').attr('data-nama'));
		$(".pos_nama_barang").val($(this).find(':selected').attr('data-nama'));

		$(".pos_harga_barang").html($(this).find(':selected').attr('data-harga'));
		$(".pos_harga_barang").val($(this).find(':selected').attr('data-harga'));

		$(".pos_desc_barang").html($(this).find(':selected').attr('data-deskripsi'));
		$(".pos_desc_barang").val($(this).find(':selected').attr('data-deskripsi'));
	});
	$("#pos_promo").on('change', function() {
		$("#pos_value_promo").html($(this).find(':selected').attr('data-value_promo'));
		$("#pos_value_promo").val($(this).find(':selected').attr('data-value_promo'));
	});
	
</script>
</body>

</html>
