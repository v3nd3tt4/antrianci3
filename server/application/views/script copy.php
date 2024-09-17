<script src="<?=base_url()?>assets/jquery-2.1.4.min.js"></script>
<script src="<?=base_url()?>assets/socket.io.min.js"></script>
<!-- <script src="<?=base_url()?>assets/responsivevoice.js"></script> -->
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
<script>
function updateSuccess(id_meja, nomor_antrian_aktif) {
    $.ajax({
        url: "<?=base_url()?>welcome/update_success1",
        data: {
            id_meja: id_meja,
            nomor_antrian_aktif: nomor_antrian_aktif
        },
        dataType: 'JSON',
        type: 'POST',
        success: function(response) {

            // do something with the result
        }
    });


}

function read(sound, id_meja, nomor_antrian_aktif) {

    responsiveVoice.speak(sound,
        "Indonesian Female", {
            pitch: 1,
            rate: 0.8,
            volume: 1,
            onend: updateSuccess(id_meja, nomor_antrian_aktif)
        }
    );

    // if(responsiveVoice.isPlaying()){

    // }else{
    //     updateSuccess(id_meja, nomor_antrian_aktif);
    // }
}
var socket = io.connect('http://localhost:3000');
socket.on('sentSound', function(data) {
    var s = data.sound;
    var id_meja = data.id_meja;
    var nomor_antrian_aktif = data.nomor_antrian_aktif;

    var bell = new Audio('./assets/audio/tingtung.mp3');
    var a = document.getElementById("tingtung").duration;
    // // mainkan suara bell antrian
    bell.pause();
    bell.currentTime = 0;
    bell.play();
    // // set delay antara suara bell dengan suara nomor antrian
    var durasi_bell = a * 800;
    // console.log(a);
    setTimeout(function() {
        read(s, id_meja, nomor_antrian_aktif);
    }, durasi_bell);

    setTimeout(() => {
        var bell1 = new Audio('./audio/new/out.wav');
        // var a = document.getElementById("outwav").duration;
        // // mainkan suara bell1 antrian
        bell1.pause();
        bell1.currentTime = 0;
        bell1.play();
    }, durasi_bell + 9500);




});

socket.on('sentNomorAntrian', function(data) {
    $('.' + data.kode_meja).html(data.kode_meja + data.nomor_antrian_aktif);
});
</script>
<style>
#layout-menu {

    display: none
}

.layout-menu-toggle>.nav-item {
    position: relative;
    flex: 1 0 auto;
    display: block
}
</style>