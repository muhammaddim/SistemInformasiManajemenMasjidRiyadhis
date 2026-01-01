<?php  
include_once "library/database.php";
require_once("library/urut_id_ketua.php"); // Untuk auto ID, silakan sesuaikan jika sudah punya

?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <h1> Form Ketua </h1>
        </div>
    </div>
    <hr />
    <div class="col-lg-12">
        <div class="box">
            <header class="dark">
                <div class="icons"><i class="icon-user"></i></div>
                <h5>Input Data Ketua</h5>
            </header>
            <div class="body collapse in">
                <form class="form-horizontal" action="library/proses_simpan_ketua.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-lg-4">ID Ketua</label>
                        <div class="col-lg-4">
                            <input type="text" name="id_ketua" class="form-control" readonly value="<?php echo $id_ketua; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Nama Lengkap</label>
                        <div class="col-lg-4">
                        <input type="text" name="nama_ketua" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Alamat</label>
                        <div class="col-lg-4">
                            <textarea name="alamat_ketua" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">No HP</label>
                        <div class="col-lg-4">
                            <input type="text" name="nohp_ketua" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Username</label>
                        <div class="col-lg-4">
                            <input type="text" name="username_ketua" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Password</label>
                        <div class="col-lg-4">
                            <input type="password" name="password_ketua" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                                            <label class="control-label col-lg-4">Konfirmasi Password</label>
                                            <div class="col-lg-4">
                                                <input type="password" name="password2_ketua" class="form-control chzn-select" tabindex="2">      
                                            </div>
                                        </div>
                    <div style="text-align:center" class="form-actions no-margin-bottom"> 
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="icon-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
