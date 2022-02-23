<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="../../dk.png">
    <title>QRCode Generator</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <div align="center" style="margin-top: 50px;">
    <?php
    //library phpqrcode
    include "../lib/phpqrcode/qrlib.php";

    //direktory tempat menyimpan hasil generate qrcode jika folder belum dibuat maka secara otomatis akan membuat terlebih dahulu
    $tempdir = "../temp/"; 
    if (!file_exists($tempdir))
        mkdir($tempdir);

    //isi QRCode saat discan
    $isi_teks = "Dewan Komputer With Image";
    //direktori dan nama logo
    $logopath = 'dk.png';
    //namafile setelah jadi qrcode
    $namafile = "dewan-komputer.png";
    //kualitas dan ukuran qrcode
    $quality = 'H'; 
    $ukuran = 8; 
    $padding = 0;

    QRCode::png($isi_teks,$tempdir.$namafile,QR_ECLEVEL_H,$ukuran,$padding);
    $filepath = $tempdir.$namafile;
    $QR = imagecreatefrompng($filepath);

    $logo = imagecreatefromstring(file_get_contents($logopath));
    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);

    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);

    //besar logo
    $logo_qr_width = $QR_width/2.5;
    $scale = $logo_width/$logo_qr_width;
    $logo_qr_height = $logo_height/$scale;

    //posisi logo
    imagecopyresampled($QR, $logo, $QR_width/3.3, $QR_height/2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

    imagepng($QR,$filepath);

    echo '<h3>Cara Membuat QRCode Generator Menggunakan PHP – Part 2 (QRCode with Image)</h3>';
    echo '<h3>Library PHPQrcode</h3>';
    echo '<img src="'.$tempdir.$namafile.'" width="250px">';



    //Library Endroid
    require ('../lib/qcode-endroid/autoload.php');
    use Endroid\QrCode\ErrorCorrectionLevel;
    use Endroid\QrCode\LabelAlignment;
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Response\QrCodeResponse;

    //Isi dari QRCode Saat discan
    $isi_teks = "Dewan Komputer With Image";
    $namafile = "dewan-komputer2.png";
    $qrCode = new QrCode();
    // Set Text
    $qrCode->setText($isi_teks);
    $qrCode->setWriterByName('png');
    $qrCode->setMargin(10);
    $qrCode->setEncoding('UTF-8');
    $qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevel(ErrorCorrectionLevel::HIGH));
    // Set Color
    $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
    $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
    //Set Logo
    $qrCode->setLogoPath('dk.png');
    $qrCode->setLogoSize(100, 100);
    $qrCode->setRoundBlockSize(true);
    $qrCode->setValidateResult(false);
    $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);

    // Save it to a file
    $qrCode->writeFile($tempdir.$namafile);

    echo '<h3>Library Endroid</h3>';
    echo '<img src="../temp/'.$namafile.'" width="250px">';
    echo "<br/><br/>";
  ?>

    <a href="http://vivads.net/xAqG" target="_blank">
        <button class="download">Download Source Code</button>
    </a>
    <a href="https://dewankomputer.com/2019/01/07/cara-membuat-qrcode-generator-menggunakan-php-part-2-qrcode-with-image/"><p><< Kembali ke Tutorial</p></a>
</body>
</html>