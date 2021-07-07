<?php
$this->load->view('templates/header_belanja');
$level = $this->session->userdata('level');
?>
<!-- Featured Section Begin -->
<br><br>
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="padding:30px;border:3px ;margin-top:-100px;min-height:300px;">
                <center>
                    <h3>Tentang Kami</h3>
                    <hr>
                    <p>
                        Creative Audio Pekanbaru berdiri sejak 2016
                        Alamat: Jl. Imam Munandar No.144, Tengkerang Labuai, Kec. Bukit Raya, Kota Pekanbaru, Riau 28126
                        Buka: Setiap hari mulai dari pukul 8 pagi hingga 6 sore
                        Telepon: 0812-7682-535
                    </p>
                </center>
            </div>
        </div>
    </div>
</section>
<!-- Featured Section End -->
<?php $this->load->view('templates/footer_belanja'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById("banner").style.display = "none";
        document.getElementById("kategori").style.display = "none";
    });
</script>