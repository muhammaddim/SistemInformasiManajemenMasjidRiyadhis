<?php
include_once "library/database.php";

if (!isset($_GET['id'])) {
    header("Location: agenda.php");
    exit;
}

$id = $_GET['id'];
$stmt = $koneksi->prepare("SELECT judul, jam_awal, jam_akhir, tgl_awal, tgl_akhir, keterangan FROM tbl_agenda WHERE id_agenda = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($judul, $jamawal, $jamakhir, $tglawal, $tglakhir, $keterangan);
$stmt->fetch();
?>

<form action="library/update-agenda.php" method="post"
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <h1>Edit Agenda</h1>
        </div>
    </div>
    <hr />
    <div class="col-lg-12">
        <div class="box">
            <header class="dark">
                <div class="icons"><i class="icon-edit"></i></div>
                <h5 class="text-warning">Edit Agenda Kegiatan</h5>
            </header>
            <div class="body">
                <form class="form-horizontal" action="library/update-agenda.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-4">Nama Kegiatan</label>
                        <div class="col-lg-7">
                            <input name="judul" class="form-control" type="text" value="<?php echo $judul; ?>" required/>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-lg-4">Pukul</label>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <input name="jamawal" class="form-control" type="time" value="<?php echo $jamawal; ?>" required/>
                                <span class="input-group-addon"><i class="icon-time"></i></span>
                            </div>
                        </div>
                        <label class="control-label col-lg-1">s/d</label>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <input name="jamakhir" class="form-control" type="time" value="<?php echo $jamakhir; ?>" required/>
                                <span class="input-group-addon"><i class="icon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Tanggal</label>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <input name="tglawal" class="form-control" type="date" value="<?php echo $tglawal; ?>" required/>
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                        <label class="control-label col-lg-1">s/d</label>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <input name="tglakhir" class="form-control" type="date" value="<?php echo $tglakhir; ?>" required/>
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-lg-4">Keterangan</label>
                        <div class="col-lg-4">
                            <textarea name="keterangan" class="form-control" required><?php echo $keterangan; ?></textarea>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <a href="agenda.php" class="btn btn-md btn-grad btn-default"><i class="icon-reply"></i> Kembali</a>
                        <button type="submit" class="btn btn-md btn-grad btn-primary"><i class="icon-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
