<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<?= $this->session->flashdata('message'); ?>

	<div class="row">
		<div class="col">
			<div class="card shadow">
				<div class="card-body">
					<form action="<?= base_url('penjualan/store') ?>" id="form-tambah" method="POST">
						<div class="form-row">
							<div class="form-group col-2">
								<label>Selling No.</label>
								<input type="text" name="no_penjualan" value="MDK<?= time() ?>" readonly class="form-control">
							</div>
							<div class="form-group col-3">
								<label>Staff</label>
								<input type="hidden" name="user_id" value="<?= $user['id'] ?>" readonly class="form-control">
								<input type="text" name="name" value="<?= $user['name'] ?>" readonly class="form-control">
							</div>
							<div class="form-group col-2">
								<label>Date</label>
								<input type="date" name="tgl_penjualan" value="<?= date('Y-m-d') ?>" readonly class="form-control">
							</div>
							<div class="form-group col-2">
								<label>Time</label>
								<input type="text" name="jam_penjualan" value="<?= date('H:i:s') ?>" readonly class="form-control">
							</div>
						</div>
						<hr>
						<div class="form-row">
							<div class="form-group col-3">
								<label for="nama_menu">Menu</label>
								<select id="nama_menu" class="form-control">
									<option value="">Choose Menu</option>
									<?php foreach ($food_menu as $menu) : ?>
										<option value="<?= $menu['id'] ?>"><?= $menu['nama_menu'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group col-2">
								<label>Price</label>
								<input type="text" id="harga_menu" value="" readonly class="form-control number-cleave">
							</div>

							<div class="form-group col-2">
								<label>Amount</label>
								<div class="input-group">
									<span class="input-group-btn">
										<button type="button" class="quantity-left-minus btn btn-light btn-number font-weight-bold" id="decrement">
											-
										</button>
									</span>
									<input type="text" id="jumlah" class="form-control input-number number-cleave">
									<span class="input-group-btn">
										<button type="button" class="quantity-right-plus btn btn-light btn-number font-weight-bold" id="increment">
											+
										</button>
									</span>
								</div>
							</div>
							<div class="form-group col-2">
								<label>Sub Total</label>
								<input type="text" id="sub_total" value="" class="form-control number-cleave" readonly>
							</div>
							<div class="form-group col-1">
								<label for="">&nbsp;</label>
								<button type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
							</div>
						</div>
						<div class="keranjang">
							<h5>Detail</h5>
							<hr>
							<table class="table table-bordered" id="keranjang">
								<thead>
									<tr>
										<td width="35%">Menu</td>
										<td width="15%">Price</td>
										<td width="15%">Amount</td>
										<td width="15%">Sub Total</td>
										<td width="10%">Aksi</td>
									</tr>
								</thead>
								<tbody>

								</tbody>
								<tfoot>
									<tr>
										<td colspan="3" align="right"><strong>Total : </strong></td>
										<td id="total"></td>
										<td>
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										</td>
									</tr>
									<tr>
										<td colspan="3" align="right"><strong>Cash : </strong></td>
										<td><input type="text" name="bayar" id="bayar" class="form-control number-cleave">
											<?= form_error('bayar', '<small class="text-danger pl-3">', '</small>'); ?>
										</td>
									</tr>

									<tr>
										<td colspan="3" align="right"><strong>Change : </strong></td>
										<td id="kembalian"></td>

									</tr>
								</tfoot>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>





</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.0.2/cleave.min.js" integrity="sha512-SvgzybymTn9KvnNGu0HxXiGoNeOi0TTK7viiG0EGn2Qbeu/NFi3JdWrJs2JHiGA1Lph+dxiDv5F9gDlcgBzjfA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	var row = 0;
	var edit = 0;

	$('.number-cleave').toArray().forEach(function(field) {
		new Cleave(field, {
			numeral: true,
			numeralThousandsGroupStyle: 'thousand',
			numeralDecimalMark: ',',
			delimiter: '.'
		});
	});

	function number_with_dot(x) {
		var parts = x.toString().split('.');
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
		return parts.join('.');
	}

	function remove_dot(text) {
		text = text ?? '';
		return text.toString().replace(/\./g, '');
	}

	$('#nama_menu').on('change', function() {
		var id = $(this).val();
		$.ajax({
			type: 'POST',
			url: '<?= base_url('user/get_menu_harga') ?>',
			data: {
				id: id
			},
			success: function(data) {
				var data = JSON.parse(data);
				var id = data.id;
				var harga_menu = parseInt(data.harga_menu);
				var jumlah = remove_dot($('#jumlah').val());
				jumlah = $.isNumeric(jumlah) ? parseInt(jumlah) : 1;

				$('#jumlah').val(number_with_dot(jumlah));
				$('#harga_menu').val(number_with_dot(harga_menu));
				$('#sub_total').val(number_with_dot(harga_menu * jumlah));
			}
		});
	});

	$('#jumlah').on('keyup change', function() {
		var jumlah = remove_dot($(this).val());
		jumlah = $.isNumeric(jumlah) ? parseInt(jumlah) : 0;
		var harga_menu = remove_dot($('#harga_menu').val());
		harga_menu = $.isNumeric(harga_menu) ? parseInt(harga_menu) : 0;

		$('#jumlah').val(number_with_dot(jumlah));
		$('#harga_menu').val(number_with_dot(harga_menu));
		var sub_total = jumlah * harga_menu;
		$('#sub_total').val(number_with_dot(sub_total));
	});

	$('#tambah').on('click', function() {
		var id = $('#nama_menu option:selected').val();
		var jumlah = remove_dot($('#jumlah').val());
		jumlah = $.isNumeric(jumlah) ? parseInt(jumlah) : 0;
		var harga_menu = remove_dot($('#harga_menu').val());
		harga_menu = $.isNumeric(harga_menu) ? parseInt(harga_menu) : 0;

		if (id == '') {
			alert('Pilih menu terlebih dahulu');
			return false;
		}

		if (harga_menu == 0) {
			alert('Harga menu tidak boleh 0');
			return false;
		}

		if (jumlah == 0) {
			alert('Jumlah tidak boleh 0');
			return false;
		}

		var sub_total = jumlah * harga_menu;
		row += 1;
		var html = '<tr id="row-' + row + '">';
		html += '<input type="hidden" name="id_menu[]" value="' + id + '">';
		html += '<input type="hidden" name="jumlah[]" value="' + jumlah + '">';
		html += '<input type="hidden" name="harga_menu[]" value="' + harga_menu + '">';
		html += '<td>' + $('#nama_menu option:selected').text() + '</td>';
		html += '<td>' + number_with_dot(harga_menu) + '</td>';
		html += '<td>' + number_with_dot(jumlah) + '</td>';
		html += '<td class="sub-total" sub-total-hidden="' + sub_total + '">' + number_with_dot(sub_total) + '</td>';
		html += `
			<td>
				<button type="button" class="btn btn-warning btn-sm edit" data-id="row-` + row + `"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-danger btn-sm hapus" data-id="row-` + row + `"><i class="fa fa-trash"></i></button>
			</td>`;
		html += '</tr>';

		$('#keranjang tbody').append(html);

		var total = 0;

		$(".sub-total").each(function() {
			var value = $(this).attr("sub-total-hidden");
			// add only if the value is number
			if (!isNaN(value) && value.length != 0) {
				total += parseInt(value);
			}
		});

		$('#total').text('Rp ' + number_with_dot(total));

		$('#nama_menu').val('');
		$('#jumlah').val('');
		$('#harga_menu').val('');
		$('#sub_total').val('');
	});

	$('#keranjang tbody').on('click', 'tr td .hapus', function() {
		var id = $(this).attr('data-id');
		$('#keranjang tbody tr#' + id).remove();

		var total = 0;

		$(".sub-total").each(function() {
			var value = $(this).attr("sub-total-hidden");
			// add only if the value is number
			if (!isNaN(value) && value.length != 0) {
				total += parseInt(value);
			}
		});

		$('#total').text('Rp ' + number_with_dot(total));
	});

	$('#keranjang tbody').on('click', 'tr td .edit', function() {
		var id = $(this).attr('data-id');
		var id_menu = $('#keranjang tbody tr#' + id + ' input[name="id_menu[]"]').val();
		id_menu = $.isNumeric(id_menu) ? parseInt(id_menu) : 0;
		var jumlah = $('#keranjang tbody tr#' + id + ' input[name="jumlah[]"]').val();
		jumlah = $.isNumeric(jumlah) ? parseInt(jumlah) : 0;
		var harga_menu = $('#keranjang tbody tr#' + id + ' input[name="harga_menu[]"]').val();
		harga_menu = $.isNumeric(harga_menu) ? parseInt(harga_menu) : 0;

		$('#nama_menu').val(id_menu);
		$('#jumlah').val(number_with_dot(jumlah));
		$('#harga_menu').val(number_with_dot(harga_menu));
		$('#sub_total').val(number_with_dot(jumlah * harga_menu));

		$('#keranjang tbody tr#' + id).remove();
		var total = 0;

		$(".sub-total").each(function() {
			var value = $(this).attr("sub-total-hidden");
			// add only if the value is number
			if (!isNaN(value) && value.length != 0) {
				total += parseInt(value);
			}
		});

		$('#total').text('Rp ' + number_with_dot(total));
	});

	$('#increment').on('click', function() {
		var jumlah = remove_dot($('#jumlah').val());
		jumlah = $.isNumeric(jumlah) ? parseInt(jumlah) : 0;
		jumlah += 1;
		$('#jumlah').val(number_with_dot(jumlah));

		var harga_menu = remove_dot($('#harga_menu').val());
		harga_menu = $.isNumeric(harga_menu) ? parseInt(harga_menu) : 0;

		$('#harga_menu').val(number_with_dot(harga_menu));
		var sub_total = jumlah * harga_menu;
		$('#sub_total').val(number_with_dot(sub_total));
	});

	$('#decrement').on('click', function() {
		var jumlah = remove_dot($('#jumlah').val());
		jumlah = $.isNumeric(jumlah) ? parseInt(jumlah) : 0;
		if (jumlah > 1) {
			jumlah -= 1;
			$('#jumlah').val(number_with_dot(jumlah));
		}

		var harga_menu = remove_dot($('#harga_menu').val());
		harga_menu = $.isNumeric(harga_menu) ? parseInt(harga_menu) : 0;

		$('#harga_menu').val(number_with_dot(harga_menu));
		var sub_total = jumlah * harga_menu;
		$('#sub_total').val(number_with_dot(sub_total));
	});

	$('#bayar').on('keyup change', function() {
		var bayar = remove_dot($(this).val());
		bayar = $.isNumeric(bayar) ? parseInt(bayar) : 0;
		var total = 0;

		$(".sub-total").each(function() {
			var value = $(this).attr("sub-total-hidden");
			// add only if the value is number
			if (!isNaN(value) && value.length != 0) {
				total += parseInt(value);
			}
		});

		var kembalian = bayar - total;
		$('#kembalian').text('Rp ' + number_with_dot(kembalian));
	});
</script>