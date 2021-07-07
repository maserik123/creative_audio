<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<?php
$this->load->view('templates/header_belanja');
$level = $this->session->userdata('level');
?>

<script>
    $(document).ready(function() {
        $('.provinsiUserShow').hide();
        $('#provinsiUserHide').show();

    })

    function edit() {
        $('.provinsiUserShow').hide();
        $('#provinsiUserHide').hide();

    }
</script>
<br><br>
<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <p><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
            <div class="col-lg-12" style="padding:30px;border:3px solid green;margin-top:-100px;">
                <form method="POST" action="<?= base_url("Transaksi_Ctrl/checkout_alamat") ?>">
                    <h4>Data diri anda : </h4><br>
                    <?php if (!empty($user->nama_user)) { ?>
                        <input type="hidden" name="nama_user" class="form-control" value="<?= $user->nama_user ?>" required>
                    <?php } else { ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Nama <span class="text-danger"> *</span></label>
                                <input type="text" name="nama_user" class="form-control" value="<?= $user->nama_user ?>" required>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($user->telp_user)) { ?>
                        <input type="hidden" class="form-control" name="telp_user" value="<?= $user->telp_user ?>" required>
                    <?php } else { ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Telp <span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" name="telp_user" value="<?= $user->telp_user ?>" required>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($user->provinsi_user)) { ?>
                        <input type="hidden" name="provinsi_user" class="form-control" id="provinsiUserHide" value="<?php echo $user->provinsi_user; ?>" readonly>
                    <?php } else { ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Provinsi <span class="text-danger"> *</span></label><br>
                                <?php if (($user->provinsi_user == '')) { ?>
                                    <select name="provinsi_user" id="provinsi_user" class="form-control theSelect1" onchange="cekOngkir()" required>
                                        <option value="">-- Pilih Provinsi --</option>
                                        <?php foreach ($getProvinsi as $row) { ?>
                                            <option value="<?php echo $row->nama; ?>"><?php echo $row->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <input type="text" name="provinsi_user" class="form-control" id="provinsiUserHide" value="<?php echo $user->provinsi_user; ?>" readonly>
                                <?php } ?>

                            </div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($user->kota_user)) { ?>
                        <input type="hidden" name="kota_user" class="form-control" value="<?php echo $user->kota_user; ?>" readonly>
                    <?php } else { ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Kabupaten <span class="text-danger"> *</span></label><br>
                                <?php if (($user->kota_user == '')) { ?>
                                    <select name="kota_user" id="kota_user" class="form-control theSelect2" onchange="cekOngkir()" required>
                                        <option value="">-- Pilih Kabupaten --</option>
                                        <?php foreach ($getKabupaten as $row) { ?>
                                            <option value="<?php echo $row->nama; ?>"><?php echo $row->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <input type="text" name="kota_user" class="form-control" value="<?php echo $user->kota_user; ?>" readonly>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($user->kecamatan_user)) { ?>
                        <input type="hidden" name="kecamatan_user" class="form-control" value="<?php echo $user->kecamatan_user; ?>" readonly>
                        <input type="hidden" name="id_kecamatan" class="form-control" value="<?php echo $user->id_kecamatan; ?>" readonly>
                    <?php   } else { ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Kecamatan <span class="text-danger"> *</span></label><br>
                                <?php if (($user->kecamatan_user == '')) { ?>

                                    <select name="id_kecamatan" id="id_kecamatan" class="form-control theSelect3" onchange="cekOngkir()" required>
                                        <option value="">-- Pilih Kecamatan --</option>
                                        <?php foreach ($getKecamatan as $row) { ?>
                                            <option value="<?php echo $row->id; ?>"><?php echo $row->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <input type="text" name="kecamatan_user" class="form-control" value="<?php echo $user->kecamatan_user; ?>" readonly>
                                    <input type="hidden" name="id_kecamatan" class="form-control" value="<?php echo $user->id_kecamatan; ?>" readonly>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($user->alamat_user)) { ?>
                        <input type="hidden" name="alamat_user" class="form-control" value="<?= $user->alamat_user ?>" required>

                    <?php } else { ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Alamat Lengkap<span class="text-danger"> *</span></label>
                                <input type="text" name="alamat_user" class="form-control" value="<?= $user->alamat_user ?>" required>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($user->kode_pos)) { ?>
                        <input type="hidden" class="form-control" name="kode_pos" value="<?= $user->kode_pos ?>" required>
                    <?php  } else { ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Kode Pos<span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" name="kode_pos" value="<?= $user->kode_pos ?>" required>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="varchar">Jenis Logistik Pengiriman<span class="text-danger"> *</span></label><br>
                            <select name="kurir_pengiriman" id="kurir_pengiriman" class="form-control" required>
                                <option value="">Pilih Logistik Pengiriman</option>
                                <?php foreach ($getKurir as $r) { ?>
                                    <?php if ($getByIdPembayaran->id_kurir == $r->id) { ?>
                                        <option value="<?php echo $r->id; ?>" selected>--<?php echo $r->nama; ?>--</option>
                                    <?php } else { ?>
                                        <option value="<?php echo $r->id; ?>">--<?php echo $r->nama; ?>--</option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <?php if ((!empty($user->kecamatan_user)) && (!empty($user->kota_user) && (!empty($user->provinsi_user)))) {
                        echo 'Anda telah melengkapi data diri, catatan transaksi anda telah disimpan, silahkan klik lanjutkan untuk menyelesaikan pembayaran.';
                    } ?>

                    <hr>
                    <h4>Catatan Belanja anda : </h4><br>
                    <table cellpadding="5">
                        <tr style="font-size:17px;">

                        </tr>
                        <tr style="font-size:17px;">
                            <th>Total Belanja</th>
                            <th>Rp. <?php echo number_format($total->total, 0, ",", "."); ?></th>
                        </tr>
                        <!-- <tr style="font-size:17px;">
                            <th>Total Biaya Pengiriman</th>
                            <th>Rp. <?php echo number_format($user->ongkir, 0, ",", "."); ?></th>
                        </tr>
                        <tr style="font-size:17px;">
                            <th>Kurir Pengiriman</th>
                            <th></th>
                        </tr> -->
                        <input type="hidden" name="total_belanja" id="total_belanja" value="<?php echo $total->total; ?>">
                        <!-- <tr style="font-size:17px;">
                            <th>Total Pembayaran</th>
                            <th>Rp. <input type="text" id="bayar" name="totalBayar"></th>
                        </tr> -->
                        <tr>
                            <th>
                                <div style="text-align: right;">
                                    <br>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="window.location='<?php echo base_url('Main_Ctrl/keranjang') ?>'">Kembali</button>
                                    <button type="submit" class="btn btn-sm btn-success" id="checkout">Lanjutkan !</button>
                                </div>
                            </th>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Featured Section End -->
<script>
    $(".theSelect1").select2({
        placeholder: "Pilih Provinsi",
        width: 300,
    });

    $(".theSelect2").select2({
        placeholder: "Pilih Kabupaten",
        width: 300,
    });

    $(".theSelect3").select2({
        placeholder: "Pilih Kecamatan",
        width: 300,
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_skema').change(function() {
            var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
            var csrf_hash = ''
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>administrator/unit_elemen/getJSONskema",
                method: "POST",
                data: {
                    id: id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                async: false,
                dataType: 'JSON',
                success: function(resp) {
                    data = resp.result
                    var html = '';
                    var i;
                    html += '<option>--Pilih Unit Kompetensi--</option>';
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id + '">' + data[i].judul_unit + '</option>';
                    }
                    $('#id_unit_kompetensi').html(html);
                }
            });
        });
    });
</script>



<?php $this->load->view('templates/footer_belanja'); ?>