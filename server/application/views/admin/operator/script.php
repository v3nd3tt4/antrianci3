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
            var nama_operator = $(this).attr('data-nama-operator');
            var username = $(this).attr('data-username');
            var level = $(this).attr('data-level');
            var id_meja = $(this).attr('data-id-meja');
            $('#uuid_operator').val(uuid);
            $('#id_meja').val(id_meja);
            $('#nama_operator').val(nama_operator);
            $('#username').val(username);
            $('#level').val(level);
            // $('.notif').html('Loading.....');
            
        });

        $(document).on('submit', '#form-tambah-operator', function(e){
            e.preventDefault();
            let myform = document.getElementById("form-tambah-operator");
            var data = new FormData(myform );
            $(':input[type="submit"]').prop('disabled', true);
            $('.notif').html('Loading.....');
            $.ajax({
                url: "<?=base_url()?>admin/operator/store",
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

        $(document).on('submit', '#form-update-operator', function(e){
            e.preventDefault();
            let myform = document.getElementById("form-update-operator");
            var data = new FormData(myform );
            $(':input[type="submit"]').prop('disabled', true);
            $('.notif').html('Loading.....');
            $.ajax({
                url: "<?=base_url()?>admin/operator/update",
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

        $(document).on('submit', '#form-hapus-operator', function(e){
            e.preventDefault();            
            $(':input[type="submit"]').prop('disabled', true);
            $('.notif').html('Loading.....');
            var uuid = $('#uuid_hapus').val();
            $.ajax({
                url: "<?=base_url()?>admin/operator/delete",
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