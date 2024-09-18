<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <h5>Setting Operator
                <button class="btn btn-primary btn-tambah" style="float:right">
                    <i class="tf-icons bx bx-plus"></i> Tambah
                </button>
            </h5><br>
            <div class="card">
                <div class="card-header ">

                </div>
                <div class="card-body">
                    <table class="table table-striped datatables">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>nama Meja</th>
                                <th>Nama Operator</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;foreach($operator->result() as $r_operator){?>
                            <tr>
                                <td><?=$no++?>.</td>
                                <td><?=$r_operator->keterangan_meja?></td>
                                <td><?=$r_operator->nama_operator?></td>
                                <td><?=$r_operator->username?></td>
                                <td><?=$r_operator->level?></td>
                                <td>
                                    <button class="btn btn-info btn-sm btn-edit"
                                        data-uuid="<?=$r_operator->uuid_operator?>"
                                        data-nama-operator="<?=$r_operator->nama_operator?>"
                                        data-username="<?=$r_operator->username?>" data-level="<?=$r_operator->level?>"
                                        data-id-meja="<?=$r_operator->id_meja?>">Edit</button>
                                    <button class="btn btn-danger btn-sm btn-hapus"
                                        data-uuid="<?=$r_operator->uuid_operator?>">Hapus</button>
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

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambah" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Tambah operator</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-operator">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label" for="">Meja:</label>
                        <select name="id_meja" id="" class="form-control" required>
                            <option value="">--pilih--</option>
                            <?php foreach($meja->result() as $r_meja){?>
                            <option value="<?=$r_meja->id_meja?>"><?=$r_meja->id_meja?> - <?=$r_meja->keterangan_meja?>
                            </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="">nama operator:</label>
                        <input type="text" class="form-control" name="nama_operator" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="">Username:</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="">Level:</label>
                        <select name="level" class="form-control" required>
                            <option value="">--pilih--</option>
                            <?php $arr = array('admin','operator');                            
                            foreach($arr as $k){?>
                            <option value="<?=$k?>"><?=$k?></option>
                            <?php }?>
                        </select>
                    </div>
                    <br>
                    <div class="notif"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Simpan</button>
                    <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Edit operator</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-update-operator">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label" for="">Meja:</label>
                        <select name="id_meja" id="id_meja" class="form-control" required>
                            <option value="">--pilih--</option>
                            <?php foreach($meja->result() as $r_meja){?>
                            <option value="<?=$r_meja->id_meja?>"><?=$r_meja->id_meja?> - <?=$r_meja->keterangan_meja?>
                            </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="">nama operator:</label>
                        <input type="hidden" class="form-control" name="uuid_operator" id="uuid_operator" required>
                        <input type="text" class="form-control" name="nama_operator" id="nama_operator" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="">Username:</label>
                        <input type="text" class="form-control" name="username" id="username" required disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="">Password:</label>
                        <input type="password" class="form-control" name="password" id="keterangan_operator">
                        <small>Isi hanya jika ingin mengganti password</small>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="">Level:</label>
                        <select name="level" id="level" class="form-control" required>
                            <option value="">--pilih--</option>
                            <?php $arr = array('admin','operator');                            
                            foreach($arr as $k){?>
                            <option value="<?=$k?>"><?=$k?></option>
                            <?php }?>
                        </select>
                    </div>
                    <br>
                    <div class="notif"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Simpan</button>
                    <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Hapus operator</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-hapus-operator">
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus data ini?</p>
                    <input type="hidden" name="uuid_operator" id="uuid_hapus">
                    <br>
                    <div class="notif"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Ya</button>
                    <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>