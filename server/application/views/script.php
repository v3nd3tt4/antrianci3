<script src="<?=base_url()?>assets/jquery-2.1.4.min.js"></script>
<script src="<?=base_url()?>assets/socket.io.min.js"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
<script>
var socket = io.connect('http://192.168.56.130:3000');
var isSoundPlaying = false;

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
            onend: function() {
                playBellOut(id_meja, nomor_antrian_aktif);
            }
        }
    );
}

function playBellOut(id_meja, nomor_antrian_aktif) {
    var bellOut = new Audio('./audio/new/out.wav');
    bellOut.onloadedmetadata = function() {
        var duration = bellOut.duration * 1000; // Konversi ke milidetik
        bellOut.play();
        
        // Tunggu sampai suara bell out selesai
        setTimeout(function() {
            isSoundPlaying = false;
            socket.emit('soundFinished');
            updateSuccess(id_meja, nomor_antrian_aktif);
        }, duration);
    };
}

socket.on('sentSound', function(data) {
    var s = data.sound;
    var id_meja = data.id_meja;
    var nomor_antrian_aktif = data.nomor_antrian_aktif;

    isSoundPlaying = true;
    socket.emit('soundStarted');

    var bell = new Audio('./assets/audio/tingtung.mp3');
    
    bell.onloadedmetadata = function() {
        var bellDuration = bell.duration * 1000; // Konversi ke milidetik
        bell.play();
        
        // Tunggu sampai bell awal selesai sebelum memulai suara utama
        setTimeout(function() {
            read(s, id_meja, nomor_antrian_aktif);
        }, bellDuration + 500); // Tambah 500ms untuk jeda kecil
    };
});

socket.on('sentNomorAntrian', function(data) {
    $('.' + data.kode_meja).html(data.kode_meja + data.nomor_antrian_aktif);
});

// Tambahkan ini untuk menangani status suara
socket.on('soundPlayingStatus', function(status) {
    isSoundPlaying = status;
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