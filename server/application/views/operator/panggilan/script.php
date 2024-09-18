<script src="<?=base_url()?>assets/socket.io.min.js"></script>
<script>
$(document).ready(function() {
    var socket = io.connect('http://192.168.76.130:3000');
    var isSoundPlaying = false;

    function updateButtonState() {
        $('.btn-selanjutnya, .btn-panggil').prop('disabled', isSoundPlaying);
    }

    socket.on('soundPlayingStatus', function(status) {
        isSoundPlaying = status;
        updateButtonState();
        if (!isSoundPlaying) {
            refreshTable();
        }
    });

    function requestPlaySound(soundData) {
        if (!isSoundPlaying) {
            socket.emit('requestPlaySound', soundData);
        }
    }

    function refreshTable() {
        $("#message-tbody").load(location.href + " #message-tbody > *", function() {
            console.log("Table refreshed");
            // Setelah refresh, tambahkan kembali kelas 'selected' jika ada
            var selectedNomor = $('#nomor_data_antrian').val();
            $('.antrian-row[data-nomor="' + selectedNomor + '"]').addClass('selected');
        });
    }

    $(document).on('click', '.btn-panggil', function(e) {
        e.preventDefault();
        if (isSoundPlaying) {
            return;
        }

        var nomor_antrian = $('#nomor_data_antrian').val();
        var keterangan_meja = $('#keterangan_meja').val();
        var kode_meja = $('#kode_meja').val();
        var id_meja = $('#id_meja').val();

        if(nomor_antrian == 0){
            alert('Tidak ada antrian selanjutnya');
        }else{
            $.ajax({
                url: "<?=base_url()?>operator/panggilan/panggil",
                data: { 
                    nomor_antrian: nomor_antrian,
                    id_meja: id_meja
                },
                dataType: 'JSON',
                type: 'POST',
                success: function(response) {
                    if (response.status == 'success') {
                        requestPlaySound({
                            sound: 'Nomor antrian, ' + kode_meja + nomor_antrian + ', silahkan menuju, meja ' + keterangan_meja,
                            id_meja: id_meja,
                            nomor_antrian_aktif: nomor_antrian
                        });

                        socket.emit('sentNomorAntrian', {
                            nomor_antrian_aktif: nomor_antrian,
                            kode_meja: kode_meja
                        });

                        refreshTable();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    });

    $(document).on('click', '.btn-selanjutnya', function(e) {
        e.preventDefault();
        if (isSoundPlaying) {
            return;
        }

        var nomor_antrian = $('#nomor_data_antrian').val();
        var keterangan_meja = $('#keterangan_meja').val();
        var kode_meja = $('#kode_meja').val();
        var id_meja = $('#id_meja').val();

        $.ajax({
            url: "<?=base_url()?>operator/panggilan/next",
            data: { 
                nomor_antrian: nomor_antrian,
                id_meja: id_meja
            },
            dataType: 'JSON',
            type: 'POST',
            success: function(response) {
                if (response.status == 'success') {
                    $('#nomor_data_antrian').val(response.next_antrian);
                    $('#counter').html(kode_meja + response.next_antrian);
                    
                    requestPlaySound({
                        sound: 'Nomor antrian, ' + kode_meja + response.next_antrian + ', silahkan menuju, meja ' + keterangan_meja,
                        id_meja: id_meja,
                        nomor_antrian_aktif: response.next_antrian
                    });

                    socket.emit('sentNomorAntrian', {
                        nomor_antrian_aktif: response.next_antrian,
                        kode_meja: kode_meja
                    });

                    refreshTable();
                } else if (response.status == 'finished') {
                    alert(response.message);
                    // Don't change the counter or nomor_data_antrian when finished
                    refreshTable();
                } else {
                    refreshTable();
                    alert(response.message);
                }
            }
        });
    });

     // Tambahkan event listener untuk baris tabel antrian
     $(document).on('click', '.antrian-row', function() {
        var nomorAntrian = $(this).data('nomor');
        var kodeMeja = $('#kode_meja').val();
        
        $('#nomor_data_antrian').val(nomorAntrian);
        $('#counter').html(kodeMeja + nomorAntrian);
        
        // Highlight baris yang dipilih
        $('.antrian-row').removeClass('selected');
        $(this).addClass('selected');

        // Panggil fungsi untuk memanggil nomor antrian
        panggilAntrian(nomorAntrian);
    });

    function panggilAntrian(nomorAntrian) {
        if (isSoundPlaying) {
            alert('Mohon tunggu sampai panggilan selesai sebelum memanggil nomor baru.');
            return;
        }

        var keterangan_meja = $('#keterangan_meja').val();
        var kode_meja = $('#kode_meja').val();
        var id_meja = $('#id_meja').val();

        $.ajax({
            url: "<?=base_url()?>operator/panggilan/panggil",
            data: { 
                nomor_antrian: nomorAntrian,
                id_meja: id_meja
            },
            dataType: 'JSON',
            type: 'POST',
            success: function(response) {
                if (response.status == 'success') {
                    requestPlaySound({
                        sound: 'Nomor antrian, ' + kode_meja + nomorAntrian + ', silahkan menuju, meja ' + keterangan_meja,
                        id_meja: id_meja,
                        nomor_antrian_aktif: nomorAntrian
                    });

                    socket.emit('sentNomorAntrian', {
                        nomor_antrian_aktif: nomorAntrian,
                        kode_meja: kode_meja
                    });

                    refreshTable();
                } else {
                    alert(response.message);
                }
            }
        });
    }

    socket.on('message', function(data) {
        refreshTable();
    });
});
</script>