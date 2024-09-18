<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <h5>Setting Meja
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
                                <th>Nomor Meja</th>
                                <th>Keterangan Meja</th>
                                <th>Kode Meja</th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;foreach($meja->result() as $r_meja){?>
                                <tr>
                                    <td><?=$no++?>.</td>
                                    <td><?=$r_meja->nomor_meja?></td>
                                    <td><?=$r_meja->keterangan_meja?></td>
                                    <td><?=$r_meja->kode_meja?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm btn-edit" data-uuid="<?=$r_meja->uuid_meja?>" data-nomor-meja="<?=$r_meja->nomor_meja?>" data-keterangan-meja="<?=$r_meja->keterangan_meja?>" data-kode-meja="<?=$r_meja->kode_meja?>">Edit</button>
                                        <button class="btn btn-danger btn-sm btn-hapus" data-uuid="<?=$r_meja->uuid_meja?>">Hapus</button>
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
                <h2 class="h6 modal-title">Tambah Meja</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-meja">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nomor Meja:</label>
                        <input type="number" class="form-control" name="nomor_meja" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Meja:</label>
                        <input type="text" class="form-control" name="kode_meja" required>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan:</label>
                        <input type="text" class="form-control" name="keterangan_meja" placeholder="Contoh: Pidana atau Perdata" required>
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
                <h2 class="h6 modal-title">Edit Meja</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-update-meja">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nomor Meja:</label>
                        <input type="hidden" class="form-control" name="uuid_meja" id="uuid_meja" required>
                        <input type="number" class="form-control" name="nomor_meja" id="nomor_meja" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Meja:</label>
                        <input type="text" class="form-control" name="kode_meja" id="kode_meja" required>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan:</label>
                        <input type="text" class="form-control" id="keterangan_meja" name="keterangan_meja" placeholder="Contoh: Pidana atau Perdata" required>
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
                <h2 class="h6 modal-title">Hapus Meja</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-hapus-meja">
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus data ini?</p>
                    <input type="hidden" name="uuid_meja" id="uuid_hapus">
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