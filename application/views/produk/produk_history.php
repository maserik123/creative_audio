<script>
    function komentar(id) {
        save_method = 'update';
        $('#myModal').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('Main_Ctrl/getTransaksiById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id_transaksi"]').val(data.id_transaksi);

                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }
</script>

<style>
    .scroll {
        display: block;
        /* border: 1px solid red; */
        padding: 5px;
        margin-top: 5px;
        /* width: 300px; */
        /* height: 50px; */
        overflow: scroll;
    }

    .auto {
        display: block;
        border: 1px solid red;
        padding: 5px;
        margin-top: 5px;
        width: 300px;
        height: 50px;
        overflow: auto;
    }
</style>
<?php
$this->load->view('templates/header_belanja');
$level = $this->session->userdata('level');
?>
<!-- Featured Section Begin -->
<br><br>
<section class="featured spad">
    <div class="container">
        <div class="row">
            <p><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
            <div class="col-lg-12 scroll" style="padding:30px;border:3px solid green;margin-top:-100px;min-height:300px;">
                <h3>Riwayat Belanja</h3>
                <br>
                <small><?php if ($this->session->flashdata('kosong')) { ?>
                        <div style="color:red;text-align:right;"> <?php echo $this->session->flashdata('kosong'); ?></div>
                    <?php  } else if ($this->session->flashdata('success')) { ?>
                        <div style="color:success;text-align:right;"> <?php echo $this->session->flashdata('success'); ?></div>
                    <?php } ?>
                </small>
                <hr>
                <table width="100%">
                    <tr>
                        <th style="font-size: 13px;">Nama Barang</th>
                        <th style="font-size: 13px;">Foto</th>
                        <th style="font-size: 13px;">Jumlah</th>
                        <th style="font-size: 13px;">Total Bayar</th>
                        <th style="font-size: 13px;">Tgl Bayar</th>
                        <th style="font-size: 13px;">Feedback</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($history as $u) {
                        $kode = $u->id_transaksi;
                        $query = $this->db->query("SELECT * FROM tbl_transaksi a,tbl_produk b WHERE a.id_produk=b.id_produk AND id_pembayaran='" . $u->id_pembayaran . "' AND a.id_pembayaran != 1")->result();
                    ?>
                        <tr>
                            <!-- <th>Nama Penerima</th> -->
                            <!-- <th width="25%">Alamat Pengiriman</th> -->
                            <!-- <th>Nomor Resi</th> -->
                            <!-- <th>Total Bayar</th> -->
                            <!-- <th>Kurir</th> -->
                            <!-- <th>Status Pengiriman</th> -->
                            <!-- <th>Tgl Bayar</th> -->
                        </tr>
                        <tr>
                            <!-- <td><?= $u->nama_user ?></td> -->
                            <!-- <td><?= $u->alamat_user ?>, Prov. <?= $u->provinsi_user ?>, Kota. <?= $u->kota_user ?>, Kode Pos : <?= $u->kode_pos ?>, Telp. <?= $u->telp_user ?></td> -->
                            <!-- <td><?= $u->nomor_resi ?></td> -->
                            <!-- <td>Rp. <?php echo number_format($u->total_pembayaran, 0, ",", "."); ?></td> -->
                            <!-- <td><?php echo $u->kurir_pengiriman ?></td> -->
                            <!-- <td><?= $u->status_pembayaran ?></td> -->
                            <!-- <td><?= $u->tgl_pembayaran ?></td> -->
                        </tr>

                        <?php
                        foreach ($query as $y) {
                        ?>
                            <tr>
                                <td style="font-size: 13px;"><?= $y->nama_produk ?></td>
                                <td style="font-size: 13px;"><img src="<?php echo base_url('uploads/'); ?><?= $y->foto_produk ?>" width="50px" height="50px"></td>
                                <td style="font-size: 13px;"><?= $y->qty_transaksi ?></td>
                                <td style="font-size: 13px;">Rp. <?php echo number_format($u->total_transaksi, 0, ",", "."); ?></td>
                                <td style="font-size: 13px;"><?= tgl_indo($u->tgl_pembayaran); ?></td>

                                <td style="font-size: 13px;">
                                    <?php if ($y->komentar == '') { ?>
                                        <?php
                                        echo $y->komentar;
                                        ?>

                                        <button class="btn btn-info btn-sm" type="button" onclick="komentar(<?php echo $y->id_transaksi; ?>)" style="font-size:11px;"><span class="fa fa-comment"></span></button>
                                    <?php } else { ?>
                                        <?php echo $y->komentar; ?> <br>
                                    <?php } ?>
                                </td>
                            </tr>

                        <?php } ?>
                        <!-- <tr>
                            <th colspan="7">
                                <hr>
                            </th>
                        </tr> -->
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Berikan Feedback</h4><br>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo base_url('Main_Ctrl/addComments') ?>" method="post" id="form_komentar">
                <div class="modal-body">
                    <small>Silahkan berikan feedback dari produk yang anda beli !</small><br>
                    <input type="hidden" name="id_transaksi" id="id_transaksi">
                    <div class="form-group">
                        <textarea name="komentar" id="komentar" cols="30" rows="10" class="form-control" placeholder="Berikan komentar anda disini..."></textarea>
                        <input type="hidden" name="no_comment" id="no_comment">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak, Terimakasih !</button>
                    <button type="submit" class="btn btn-primary" onclick="alert('Apakah anda sudah yakin ?')"><span class="fa fa-save"></span> Kirim Komentar</button>
                </div>
            </form>
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