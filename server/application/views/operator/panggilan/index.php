<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <center><?=$meja->row()->keterangan_meja?></center>
                        </div>
                        <div class="card-body">
                            <br>
                            <center>
                                <h1 style="font-size:100px" id="counter">
                                    <?php 
                                    $ant = 0;
                                    if($data_antrian2->num_rows()==0){
                                        if($data_antrian_all->num_rows() == 0){
                                            echo 0;
                                        }else{
                                            echo $meja->row()->kode_meja.$data_max_antrian->row()->nomor_data_antrian;
                                            $ant = $data_max_antrian->row()->nomor_data_antrian;
                                        }
                                    }else{
                                        echo $meja->row()->kode_meja.$data_antrian2->row()->nomor_data_antrian;
                                        $ant = $data_antrian2->row()->nomor_data_antrian;
                                    }
                                    
                                    // echo $data_antrian2->num_rows()==0?0:$meja->row()->kode_meja.$data_antrian2->row()->nomor_data_antrian
                                    ?>
                                    
                                </h1>
                                    <input type="hidden" name="id_meja" id="id_meja" value="<?=@$meja->row()->id_meja?>" >
                                    <input type="hidden" name="kode_meja" id="kode_meja" value="<?=@$meja->row()->kode_meja?>">
                                    <input type="hidden" name="keterangan_meja" id="keterangan_meja" value="<?=@$meja->row()->keterangan_meja?>">
                                    <input type="hidden" name="nomor_data_antrian" id="nomor_data_antrian" value="<?=$ant?>">
                            </center>
                        </div>
                        <hr>
                        <div class="card-footer">
                            <center>Nomor Antrian</center>
                             <!-- Meja <?=$meja->row()->nomor_meja?> 
                             <button class="btn btn-dark btn-selanjutnya"
                                style="float:right"><i class="menu-icon tf-icons bx bx-refresh btn-panggil" ></i> Selanjutnya</button>&nbsp;
                                <button class="btn btn-primary  btn-panggil" ><i class="menu-icon tf-icons bx bx-volume-full" ></i> Panggil</button>&nbsp;
                            -->

                        </div> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-4 col-xs-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <br>
                            <center>
                                <h1><i class="menu-icon tf-icons bx bx-volume-full" style="font-size:100px"></i></h1>
                            </center>
                            <button class="btn btn-info w-100 btn-panggil">Panggil</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4 col-xs-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <br>
                            <center>
                                <h1><i class="menu-icon tf-icons bx bx-refresh " style="font-size:100px"></i>
                                </h1>
                            </center>
                            <button class="btn btn-dark w-100 btn-selanjutnya">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <center>List Antrian</center>
                </div>
                <div class="card-body">
                    <br>
                    <ul id="messages"></ul>
                    <table class="table table-bordered" id="message-tbody">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Antrian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;foreach($data_antrian->result() as $r_no_antrian){
                            if($r_no_antrian->status_data_antrian == 'dicetak'){
                                $bg_color = "bg-warning";
                            }else if($r_no_antrian->status_data_antrian == 'dipanggil'){
                                $bg_color = "bg-success";
                            }else if($r_no_antrian->status_data_antrian == 'selesai dipanggil'){
                                $bg_color = "bg-secondary";
                            }
                            ?>
                            <tr class="<?=$bg_color?> text-white antrian-row" data-nomor="<?=$r_no_antrian->nomor_data_antrian?>" data-status="<?=$r_no_antrian->status_data_antrian?>">
                                <td><?=$no++?>.</td>
                                <td>
                                    <?=$meja->row()->kode_meja?><?=$r_no_antrian->nomor_data_antrian?>
                                </td>
                                <td>
                                    <?=$r_no_antrian->status_data_antrian?>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


</div>
<!-- / Content -->