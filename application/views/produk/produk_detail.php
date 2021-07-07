<?php
$this->load->view('templates/header_belanja');
$level = $this->session->userdata('level');
?>

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
                console.log(data.id_produk);
                <?php foreach ($getProdukById as $row) { ?>
                    <?php if ($row->foto_produk != '') { ?>
                        var foto_produk = new Image(400, 400);
                        foto_produk.src = '<?php echo base_url() ?>uploads/' + data.foto_produk + '';
                        x = document.getElementById("foto_produk");
                        x.appendChild(foto_produk);
                    <?php }  ?>
                    <?php if ($row->foto_produk1 != '') { ?>
                        var foto_produk1 = new Image(400, 400);
                        foto_produk1.src = '<?php echo base_url() ?>uploads/' + data.foto_produk1 + '';
                        x = document.getElementById("foto_produk");
                        x.appendChild(foto_produk1);
                    <?php } ?>

                <?php } ?>
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

<style>
    .slider {
        width: 100%;
        text-align: center;
        overflow: hidden;
        margin: 5px 0;
    }

    .slides {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }

    .slides::-webkit-scrollbar {
        width: 5px;
        height: 10px;
    }

    .slides::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 5px;
    }

    .slides::-webkit-scrollbar-track {
        background: transparent;
    }

    .slides>div {
        scroll-snap-align: start;
        flex-shrink: 0;
        width: 100%;
        height: 100%;
        margin: 0 10px 0 10px;
        border-radius: 7px;
        background: #fff;
        transform-origin: center center;
        transform: scale(1);
        transition: transform 0.5s;
        position: relative;
        /* border: 1px solid #555; */
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        font-size: 100%;
    }
</style>

<!-- Featured Section Begin -->
<section class="">
    <div class="container">
        <div class="row">
            <p><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
            <div class="col-lg-12">
                <h4>Detail Produk</h4>
                <hr>
            </div>
            <div class="col-lg-6">
                <table style="width: 100%;">
                    <tbody>
                        <?php foreach ($getProdukById as $row) { ?>
                            <tr>
                                <br>
                                <td>


                                    <?php if ($row->foto_produk != '') { ?>
                                        <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk; ?>" id="foto"><img src="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk; ?>" alt="" srcset="" width="60px" height="60px"></a>
                                    <?php } else {
                                    } ?>


                                    <?php if ($row->foto_produk1 != '') { ?>
                                        <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk1; ?>" id="foto1"><img src="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk1; ?>" alt="" srcset="" width="60px" height="60px"></a>
                                    <?php } else {
                                    } ?>

                                    <?php if ($row->foto_produk2 != '') { ?>
                                        <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk2; ?>" id="foto2"><img src="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk2; ?>" alt="" srcset="" width="60px" height="60px"></a>
                                    <?php } else {
                                    } ?>
                                    <?php if ($row->foto_produk3 != '') { ?>
                                        <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk3; ?>" id="foto3"><img src="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk3; ?>" alt="" srcset="" width="60px" height="60px"></a>
                                    <?php } else {
                                    } ?>
                                    <?php if ($row->foto_produk4 != '') { ?>
                                        <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk4; ?>" id="foto4"><img src="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk4; ?>" alt="" srcset="" width="60px" height="60px"></a>
                                    <?php } else {
                                    } ?>
                                    <?php if ($row->foto_produk5 != '') { ?>
                                        <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk5; ?>" id="foto5"><img src="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk5; ?>" alt="" srcset="" width="60px" height="60px"></a>
                                    <?php } else {
                                    } ?>

                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;font-weight: bold;"><?php echo $row->nama_produk; ?></td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;">Harga : <?php echo rupiah_format($row->harga_jual); ?></td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;">Jumlah Produk : <?php echo ($row->stok_produk); ?> Items</td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;">Status Produk : <?php echo $row->stok_produk > $row->rop ? 'Masih tersedia' : 'Stok akan habis'; ?></td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;"><strong>Deskripsi</strong> : <br> <?php echo ($row->deskripsi_produk); ?></td>
                            </tr>

                            <?php $getKomentarByIdProduk = $this->Transaksi->getKomentarByIdProduk($row->id_produk); ?>
                            <tr>
                                <th style="font-size:14px;">Ulasan Produk :</th>
                            </tr>
                            <?php foreach ($getKomentarByIdProduk as $r) { ?>
                                <tr>
                                    <td style="font-size: 14px;"> <?php echo $r->komentar == '' ? '' : '<div style="font-size:14px;"><li class="fa fa-user"></li> ' . $r->nama_user . '</div>'; ?> <div style="font-size: 12px;">
                                            <?php if ($r->komentar == '') {
                                            } else { ?>
                                                <li class="fa fa-comment"></li> <?php echo ('' . $r->komentar . ''); ?>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <h6 style="font-weight: bold;">Tambahkan produk ke keranjang : </h6><br>
                <?php
                $no = 1;
                foreach ($getProdukById as $u) {
                    $kode = $u->id_produk;
                ?>
                    <div class="col-lg-7">
                        <div class="slider">
                            <div class="slides">
                                <?php if ($u->foto_produk != '') { ?>
                                    <div> <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $u->foto_produk; ?>"><img src="<?php echo base_url('uploads/'); ?><?= $u->foto_produk ?>" style="width:100%;height:200px;"></a></div>
                                <?php } else {
                                } ?>
                                <?php if ($u->foto_produk1 != '') { ?>
                                    <div> <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $u->foto_produk1; ?>"><img src="<?php echo base_url('uploads/'); ?><?= $u->foto_produk1 ?>" style="width:110%;height:210px;"></a></div>
                                <?php } else {
                                } ?>
                                <?php if ($u->foto_produk2 != '') { ?>
                                    <div> <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $u->foto_produk2; ?>"><img src="<?php echo base_url('uploads/'); ?><?= $u->foto_produk2 ?>" style="width:110%;height:210px;"></a></div>
                                <?php } else {
                                } ?>
                                <?php if ($u->foto_produk3 != '') { ?>
                                    <div> <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $u->foto_produk3; ?>"><img src="<?php echo base_url('uploads/'); ?><?= $u->foto_produk3 ?>" style="width:110%;height:210px;"></a></div>
                                <?php } else {
                                } ?>
                                <?php if ($u->foto_produk4 != '') { ?>
                                    <div> <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $u->foto_produk4; ?>"><img src="<?php echo base_url('uploads/'); ?><?= $u->foto_produk4 ?>" style="width:110%;height:210px;"></a></div>
                                <?php } else {
                                } ?>
                                <?php if ($u->foto_produk5 != '') { ?>
                                    <div> <a target="_blank" href="<?php echo base_url() ?>/uploads/<?php echo $u->foto_produk5; ?>"><img src="<?php echo base_url('uploads/'); ?><?= $u->foto_produk5 ?>" style="width:110%;height:210px;"></a></div>
                                <?php } else {
                                } ?>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="<?php echo base_url('Transaksi_Ctrl/addBelanja'); ?>">
                        <input type="hidden" name="id_produk" value="<?= $kode ?>">
                        <input type="hidden" name="harga_produk" value="<?= $u->harga_jual ?>">
                        <small>Jumlah :</small>
                        <div class="quantity buttons_added">
                            <input type="button" value="-" class="minus">
                            <input type="number" step="1" min="1" max="" name="qty_transaksi" value="1" title="Qty" style="width: 60px;" class="input-text qty text" pattern="" inputmode="">
                            <input type="button" value="+" class="plus">
                        </div>
                        <br>
                        <button type="button" class="btn btn-warning btn-sm" onclick="window.location='<?php echo base_url('Main_Ctrl/produk') ?>'">
                            <li class="fa fa-list"></li> Lihat Daftar Produk
                        </button>
                        <button type="submit" class="btn btn-success btn-sm" value="Beli">
                            <li class="fa fa-shopping-cart"></li> Tambahkan ke keranjang
                        </button>
                    </form>
                <?php } ?>
                <br>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="modalDetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title"> <span class="fa fa-search"></span> Detail Produk</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload()">&times;</button>
            </div>
            <div class="modal-body ">
                <div class="row ">
                    <div class="col-md-12 ">
                        <!-- Nama Produk -->
                        <div class="row ">
                            <strong id="foto_produk"></strong>
                        </div>

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
<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById("banner").style.display = "none";
        document.getElementById("kategori").style.display = "none";
    });
</script>

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