<script src="<?=base_url()?>assets/socket.io.min.js"></script>
<script>
$(document).ready(function() {
    var socket = io.connect('http://localhost:3000');

    $(document).on('click', '.btn-selanjutnya', function(e) {
        e.preventDefault();
        var nomor_antrian = $('#nomor_data_antrian').val();
        var keterangan_meja = $('#keterangan_meja').val();
        var kode_meja = $('#kode_meja').val();
        var counter = $('#counter').html();

        // $('#message-tbody tbody').find("tr").remove();

        $.ajax({
            url: "<?=base_url()?>operator/panggilan/next",
            data: {
                nomor_antrian: nomor_antrian
            },
            dataType: 'JSON',
            type: 'POST',
            success: function(response) {
                $("#message-tbody").load(location.href + " #message-tbody");
                if (response.status == 'success') {
                    var id_meja = response.id_meja;
                    var nomor_antrian_aktif = response.nomor_antrian_aktif;
                    $('#nomor_data_antrian').val(response.next_antrian);
                    $('#counter').html(kode_meja + response.next_antrian);
                    // $('#message-tbody tbody').append(response.list_antrian);
                    socket.emit('sentSound', {
                        sound: 'Nomor antrian, ' + kode_meja + response.next_antrian + ', silahkan menuju, meja ' + keterangan_meja,
                        id_meja: id_meja, 
                        nomor_antrian_aktif: response.next_antrian
                    });

                    socket.emit('sentNomorAntrian', {
                        nomor_antrian_aktif: response.next_antrian,
                        kode_meja:kode_meja
                    });
                } else {
                    alert(response.text);
                    // $('#message-tbody tbody').append(response.list_antrian);
                }

                // do something with the result
            }
        });
    });

    $(document).on('click', '.btn-panggil', function(e) {
        e.preventDefault();
        $("#message-tbody").load(location.href + " #message-tbody");

        var nomor_antrian = $('#nomor_data_antrian').val();
        var keterangan_meja = $('#keterangan_meja').val();
        var kode_meja = $('#kode_meja').val();
        if (nomor_antrian == 0) {
            alert('Tidak ada antrian selanjutnya');
        } else {
            socket.emit('sentSound', {
                sound: 'Nomor antrian, ' + kode_meja + nomor_antrian +
                    ', silahkan menuju, meja ' +
                    keterangan_meja,
            });

            socket.emit('sentNomorAntrian', {
                nomor_antrian_aktif: nomor_antrian,
                kode_meja:kode_meja
            });
        }

    });

    socket.on('message', function(data) {
        var actualContent = $("#message-tbody tbody").html();
        var rowCount = $('#message-tbody>tbody tr').length;
        var no = rowCount + 1;
        var newMsgContent = '<tr> <td>' + no + '.</td> <td>' + data.name + '</td> <td>' + data.message +
            '</td></tr>';
        var content = newMsgContent + actualContent;
        console.log(data.message);

        $("#message-tbody").load(location.href + " #message-tbody");
        if(data.id_meja == <?=$this->session->userdata('id_meja')?>){
            // $("#message-tbody>tbody").append(newMsgContent);
        }
        
    });
});
</script>