<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        
        <div class="col-12">
            <div class="row">
                <?php foreach($meja->result() as $r){?>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <?php $arr = array();?>
                    <div class="card">
                        <div class="card-header bg-dark text-white">
							<center>
							<?=$r->keterangan_meja?>                            
							</center>
                        </div>
                        <div class="card-body">
                            <br>
                            <center>
                                <a href="<?=base_url()?>ambil_antrian/cetak/<?=$r->uuid_meja?>"class="btn btn-info btn-lg" target="_blank">Ambil Antrian</a>
                            </center>
							<hr>
                            <center>
							Meja <?=$r->nomor_meja?>
                            </center>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>

    </div>

</div>
<!-- / Content -->