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
<?php
$this->load->view('templates/header_belanja');
$level = $this->session->userdata('level');
?>
<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <p><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
            <div class="col-lg-12" style="padding:30px;border:3px solid green;margin-top:-100px;">
                <h3>Feedback Pembeli</h3>
                <br>
                <small><?php if ($this->session->flashdata('kosong')) { ?>
                        <div style="color:red;text-align:right;"> <?php echo $this->session->flashdata('kosong'); ?></div>
                    <?php  } else if ($this->session->flashdata('success')) { ?>
                        <div style="color:success;text-align:right;"> <?php echo $this->session->flashdata('success'); ?></div>
                    <?php } ?>
                </small>

                <hr>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <!-- <th><strong>Nama Akun</strong></th> -->
                            <th><strong>Nama Barang</strong></th>
                            <th><strong>Gambar Barang</strong></th>
                            <th><strong>Komentar</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listComment as $row) { ?>
                            <tr>
                                <!-- <td> <?php echo $row->nama_user; ?></td> -->
                                <td><?php echo $row->nama_produk; ?></td>
                                <td><img src="<?php echo base_url() ?>/uploads/<?php echo $row->foto_produk; ?>" alt="" srcset="" width="50px" height="50px"></td>
                                <td><?php echo ($row->komentar); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
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