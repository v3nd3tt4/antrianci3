<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-tambah', function(e){
            e.preventDefault();
            $('#modal-tambah').modal('show');
        });

        $(document).on('click', '.btn-hapus', function(e){
            e.preventDefault();
            $('#modal-hapus').modal('show');
            var uuid = $(this).attr('data-uuid');
            $('#uuid_hapus').val(uuid);
        });

        $(document).on('click', '.btn-edit', function(e){
            e.preventDefault();
            $('#modal-edit').modal('show');
            var uuid = $(this).attr('data-uuid');
            var nomor_meja = $(this).attr('data-nomor-meja');
            var kode_meja = $(this).attr('data-kode-meja');
            var keterangan_meja = $(this).attr('data-keterangan-meja');
            $('#uuid_meja').val(uuid);
            $('#nomor_meja').val(nomor_meja);
            $('#kode_meja').val(kode_meja);
            $('#keterangan_meja').val(keterangan_meja);
            // $('.notif').html('Loading.....');
            
        });

        $(document).on('submit', '#form-tambah-meja', function(e){
            e.preventDefault();
            let myform = document.getElementById("form-tambah-meja");
            var data = new FormData(myform );
            $(':input[type="submit"]').prop('disabled', true);
            $('.notif').html('Loading.....');
            $.ajax({
                url: "<?=base_url()?>admin/meja/store",
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                dataType:'JSON',
                type: 'POST',
                success: function (response) {
                    if(response.status == 'success'){
                        $('.notif').html(response.text);
                        location.reload();
                    }else if(response.status == 'failed'){
                        $('.notif').html(response.text);
                        $(':input[type="submit"]').prop('disabled', false);
                    }
                    // do something with the result
                }
            });
        });

        $(document).on('submit', '#form-update-meja', function(e){
            e.preventDefault();
            let myform = document.getElementById("form-update-meja");
            var data = new FormData(myform );
            $(':input[type="submit"]').prop('disabled', true);
            $('.notif').html('Loading.....');
            $.ajax({
                url: "<?=base_url()?>admin/meja/update",
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                dataType:'JSON',
                type: 'POST',
                success: function (response) {
                    if(response.status == 'success'){
                        $('.notif').html(response.text);
                        location.reload();
                    }else if(response.status == 'failed'){
                        $('.notif').html(response.text);
                        $(':input[type="submit"]').prop('disabled', false);
                    }
                    // do something with the result
                }
            });
        });

        $(document).on('submit', '#form-hapus-meja', function(e){
            e.preventDefault();            
            $(':input[type="submit"]').prop('disabled', true);
            $('.notif').html('Loading.....');
            var uuid = $('#uuid_hapus').val();
            $.ajax({
                url: "<?=base_url()?>admin/meja/delete",
                data: {uuid:uuid},                
                dataType:'JSON',
                type: 'POST',
                success: function (response) {
                    if(response.status == 'success'){
                        $('.notif').html(response.text);
                        location.reload();
                    }else if(response.status == 'failed'){
                        $('.notif').html(response.text);
                        $(':input[type="submit"]').prop('disabled', false);
                    }
                    // do something with the result
                }
            });
        });
    });
</script>