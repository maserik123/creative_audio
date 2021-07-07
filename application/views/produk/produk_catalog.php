<?php
$this->load->view('templates/header_belanja');
$level = $this->session->userdata('level');
?>
<!-- Featured Section Begin -->
<script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style>
	/* -- quantity box -- */

	.quantity {
		display: inline-block;
	}

	.quantity .input-text.qty {
		width: 35px;
		height: 39px;
		padding: 0 5px;
		text-align: center;
		background-color: transparent;
		border: 1px solid #efefef;
	}

	.quantity.buttons_added {
		text-align: left;
		position: relative;
		white-space: nowrap;
		vertical-align: top;
	}

	.quantity.buttons_added input {
		display: inline-block;
		margin: 0;
		vertical-align: top;
		box-shadow: none;
	}

	.quantity.buttons_added .minus,
	.quantity.buttons_added .plus {
		padding: 7px 10px 8px;
		height: 41px;
		background-color: #ffffff;
		border: 1px solid #efefef;
		cursor: pointer;
	}

	.quantity.buttons_added .minus {
		border-right: 0;
	}

	.quantity.buttons_added .plus {
		border-left: 0;
	}

	.quantity.buttons_added .minus:hover,
	.quantity.buttons_added .plus:hover {
		background: #eeeeee;
	}

	.quantity input::-webkit-outer-spin-button,
	.quantity input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		-moz-appearance: none;
		margin: 0;
	}

	.quantity.buttons_added .minus:focus,
	.quantity.buttons_added .plus:focus {
		outline: none;
	}
</style>
<script>
	function detailProduk(id) {
		save_method = 'update';
		$('#modalDetail').modal({
			show: true,
			backdrop: 'static',
			keyboard: false
		});
		$('.form-group').removeClass('has-error')
			.removeClass('has-success')
			.find('#text-error').remove();
		$.ajax({
			url: "<?php echo site_url('Main_Ctrl/getProdukById/'); ?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(resp) {
				data = resp.data
				$('[id="id_produk"]').html(data.id_produk);
				console.log(data.id_produk)
				// var foto_produk = new Image(100, 80);
				// foto_produk.src = 'uploads/' + data.foto_produk + '';
				// x = document.getElementById("foto_produk");
				// x.appendChild(foto_produk);

				var angka = data.harga_jual;
				var reverse = angka.toString().split('').reverse().join(''),
					ribuan = reverse.match(/\d{1,3}/g);
				ribuan = ribuan.join('.').split('').reverse().join('');

				$('[id="nama_produk"]').html(data.nama_produk);
				$('[id="harga_jual"]').html(ribuan);
				$('[id="stok_produk"]').html(data.stok_produk);
				$('[id="deskripsi_produk"]').html(data.deskripsi_produk);

			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error Get Data From Ajax');
			}
		});

	}
</script>
<section class="featured spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="hero__categories" id="kategori">
					<div class="hero__categories__all">
						<i class="fa fa-bars"></i>
						<span>Kategori Produk</span>
					</div>
					<ul>
						<li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Alarm'); ?>">Alarm</a></li>
						<li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Audio'); ?>">Audio</a></li>
						<li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Klakson'); ?>">Klakson</a></li>
						<li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Sarung_Jok'); ?>">Sarung Jok</a></li>
						<li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Sarung_Stir'); ?>">Sarung Stir</a></li>
						<li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/TV'); ?>">TV</a></li>
						<li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Wiper'); ?>">Wiper</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="hero__search">
					<div class="hero__search__form">
						<form method="POST" action="<?php echo base_url('Main_Ctrl/pencarian'); ?>">
							<div class="hero__search__categories">
								Pencarian
							</div>
							<input type="text" name="cari" placeholder="Apa yang kamu butuhkan?">
							<button type="submit" class="site-btn">SEARCH</button>
						</form>
					</div>
				</div>
				<div class="hero__item set-bg" id="banner" data-setbg="<?php echo base_url('assets/ecommerce/img/Banner1.jpg'); ?>">
					<div class="hero__text">
						<span></span>
						<h2><br /></h2>
						<p></p>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<p><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
			<?php
			$no = 1;
			foreach ($produk as $u) {
				$kode = $u->id_produk;
			?>
				<div class="col-lg-3" style="padding:10px;">
					<img src="<?php echo base_url('uploads/'); ?><?= $u->foto_produk ?>" style="width:100%;height:200px;">
					<hr>

					<b><?php echo $u->nama_produk ?></b><br>
					Rp. <?php echo number_format($u->harga_jual, 0, ",", "."); ?><br>
					Tersisa : <?php echo $u->stok_produk ?> <br><br>
					<form method="POST" action="<?php echo base_url('Transaksi_Ctrl/addBelanja'); ?>">
						<input type="hidden" name="id_produk" value="<?= $kode ?>">
						<input type="hidden" name="harga_produk" value="<?= $u->harga_jual ?>">
						<div class="quantity buttons_added">
							<input type="button" value="-" class="minus">
							<input type="number" step="1" min="1" max="" name="qty_transaksi" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
							<input type="button" value="+" class="plus">
						</div>
						<!-- <button type="button" class="btn btn-warning btn-sm" onclick="detailProduk(<?php echo $u->id_produk; ?>)">
							<li class="fa fa-search"></li> Detail
						</button> -->
						<button type="button" class="btn btn-warning btn-sm" onclick="window.location ='<?php echo base_url('Main_Ctrl/detailProduk/') . $kode; ?>'">
							<li class="fa fa-search"></li> Detail
						</button>
						<button type="submit" class="btn btn-success btn-sm" value="Beli">
							<li class="fa fa-shopping-bag"></li> Beli
						</button>
					</form>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<style>
	.scroll {
		width: 100%;
		height: 440px;
		overflow-y: scroll;
	}

	.zoomeffect {
		width: 100%;
		height: 100%;
		text-align: center;
		overflow: hidden;
		position: relative;
		cursor: default;
	}

	.zoomeffect img {
		display: block;
		position: relative;
		cursor: pointer;
		-webkit-transition: all .4s linear;
		transition: all .4s linear;
		width: 50%;
	}

	.zoomeffect:hover img {
		-ms-transform: scale(2.2);
		-webkit-transform: scale(2.2);
		transform: scale(2.2);
	}
</style>
<!-- Modal -->
<div id="modalDetail" class="modal fade" role="dialog">
	<div class="modal-dialog modal-xl">

		<!-- Modal content-->
		<div class="modal-content ">
			<div class="modal-header">
				<h4 class="modal-title"> <span class="fa fa-search"></span> Detail Produk</h4>
				<button type="button" class="close" data-dismiss="modal" onclick="window.location.reload()">&times;</button>
			</div>
			<div class="modal-body scroll">
				<div class="row">

					<div class="col-md-12">

						<!-- Nama Produk -->
						<div class="row">
							<div class="col-md-3">
								<label for="">Nama Produk</label>
							</div>
							<div class="col-md-8">
								<strong id="nama_produk"></strong>
							</div>
						</div>
						<!-- Harga produk -->
						<div class="row">
							<div class="col-md-3">
								<label for="">Harga Produk</label>
							</div>
							<div class="col-md-8">
								Rp. <span id="harga_jual"></span>
							</div>
						</div>
						<!-- Stok produk -->
						<div class="row">
							<div class="col-md-3">
								<label for="">Jumlah Stok</label>
							</div>
							<div class="col-md-8">
								<span id="stok_produk"></span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label for="">Deskripsi</label>
							</div>
							<div class="col-md-8">
								<span id="deskripsi_produk"></span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label for="">Komentar / Review Produk</label>
							</div>
							<div class="col-md-8">
								<span id="dataKomentar"></span>
							</div>
						</div>

						<!-- <div class="zoomeffect" style="height: 200px;width: 200px;">
							<div id="foto_produk" style="text-align: right;"></div>
						</div> -->
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload()">Close</button>
			</div>

		</div>
	</div>
</div>
<!-- Featured Section End -->
<?php $this->load->view('templates/footer_belanja'); ?>
<script>
	function wcqib_refresh_quantity_increments() {
		jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
			var c = jQuery(b);
			c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
		})
	}
	String.prototype.getDecimals || (String.prototype.getDecimals = function() {
		var a = this,
			b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
		return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
	}), jQuery(document).ready(function() {
		wcqib_refresh_quantity_increments()
	}), jQuery(document).on("updated_wc_div", function() {
		wcqib_refresh_quantity_increments()
	}), jQuery(document).on("click", ".plus, .minus", function() {
		var a = jQuery(this).closest(".quantity").find(".qty"),
			b = parseFloat(a.val()),
			c = parseFloat(a.attr("max")),
			d = parseFloat(a.attr("min")),
			e = a.attr("step");
		b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
	});
</script>