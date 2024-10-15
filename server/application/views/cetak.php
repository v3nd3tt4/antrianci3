<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
    <script>
    var socket = io.connect('http://localhost:3000');
    socket.emit('message', {
        name: '<?=$nomor_antrian?>',
        message: 'belum dipanggil',
        id_meja: <?=$id_meja?>
    });
    </script>
    <style>
    @page {
        margin: 0
    }

    body {
        margin: 0;
        font-size: 8px;
        font-family: monospace;
    }

    td {
        font-size: 8px;
    }

    .sheet {
        margin: 0;
        overflow: hidden;
        position: relative;
        box-sizing: border-box;
        page-break-after: always;
    }

    /** Paper sizes **/
    body.struk .sheet {
        width: 58mm;
    }

    body.struk .sheet {
        padding: 2mm;
    }

    .txt-left {
        text-align: left;
    }

    .txt-center {
        text-align: center;
    }

    .txt-right {
        text-align: right;
    }

    /** For screen preview **/
    @media screen {
        body {
            background: #e0e0e0;
            font-family: monospace;
        }

        .sheet {
            background: white;
            box-shadow: 0 .5mm 2mm rgba(0, 0, 0, .3);
            margin: 5mm;
        }
    }

    /** Fix for Chrome issue #273306 **/
    @media print {
        body {
            font-family: monospace;
        }

        body.struk {
            width: 58mm;
            text-align: left;
        }

        body.struk .sheet {
            padding: 2mm;
        }

        .txt-left {
            text-align: left;
        }

        .txt-center {
            text-align: center;
        }

        .txt-right {
            text-align: right;
        }
    }
    </style>
    <script>
    var lama = 1000;
    t = null;

    function printOut() {
        window.print();
        t = setTimeout(self.close(), lama);
    }
    </script>
</head>

<!-- <body class="struk" onload="printOut()"> -->
<body class="struk">
    <section class="sheet">
        <?php

            echo '<table style="text-align: center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td> Pengadilan Tinggi Banjarmasin</td>
                    </tr>
                    <tr>
                        <td>Jalan Bina Praja Timur (Komplek Perkantoran Propinsi Kalimantan Selatan) Palam, Cempaka, Banjarbaru Kalimantan Selatan 70732</td>
                    </tr>
                    <tr>
                        <td>Telp : 0511-3354527 Fax : 0511-3364615</td>
                    </tr>
                </table>';
            
           echo '==========================================';
           echo '<center><p style="font-size: 32px">'.$nomor_antrian.'</p></center>';
           echo '<center><p>Meja '.$nama_meja.'</p></center>';

            $footer = '<center>Terima kasih atas kunjungan anda <br/> pt-banjarmasin.go.id<br/>'.TanggalIndo($tanggal_data_antrian).' '.date('H:i:s').'</center>';
            $starSpace = ( 32 - strlen($footer) ) / 2;
            $starFooter = @str_repeat('*', $starSpace+1);
            echo($starFooter. '&nbsp;'.$footer . '&nbsp;'. $starFooter."<br/><br/><br/><br/>");
            echo '<p>&nbsp;</p></center>';  
            
        ?>
    </section>

</body>

</html>