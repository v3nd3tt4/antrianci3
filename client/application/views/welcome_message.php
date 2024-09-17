<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

        <div class="col-md-5 col-sm-12 col-xs-12">
            <div class="row">
                <?php 
                $hari_ini = date('Y-m-d');
                foreach($meja->result() as $r){
                $this->db->select_max('nomor_data_antrian');
				$this->db->from('tb_data_antrian');
				$this->db->where(array('id_meja'=>$r->id_meja, 'tanggal_data_antrian' => $hari_ini, 'status_data_antrian'=>'selesai dipanggil'));   
                $this->db->limit('1');
                $nomor_antrian_aktif=$this->db->get();
                ?>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-6 mb-4">
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
                                <h1 style="margin:0px" class="<?=$r->kode_meja?>">
                                    <?=$nomor_antrian_aktif->num_rows()==0?'-':$nomor_antrian_aktif->row()->nomor_data_antrian===NULL?'-':$r->kode_meja.($nomor_antrian_aktif->row()->nomor_data_antrian)?>
                                </h1>
                            </center>
                            <hr>
                            <center>
                                Nomor Antrian
                            </center>
                        </div>
                    </div>
                </div>
                <?php }?>
                <!-- load file audio bell antrian -->
                <audio id="tingtung" autoplay="true" muted="true" src="./assets/audio/tingtung.mp3"></audio>
                <audio id="outwav" autoplay="true" muted="true" src="./audio/new/out.wav"></audio>

            </div>
        </div>
        <div class="col-md-7 col-sm-12 col-xs-12">
        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/sqNpPj-HWOE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
            
        </div>

    </div>

</div>
<!-- / Content -->