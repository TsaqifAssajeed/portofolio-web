<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST["to"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    try {
        // Pengaturan Server
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pengguna@example.com';
        $mail->Password = 'kata sandi';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Penerima
        $mail->setFrom('pengirim@example.com', 'Nama Pengirim');
        $mail->addAddress($to);

        // Isi
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        echo 'Email telah terkirim';
    } catch (Exception $e) {
        echo "Email gagal terkirim. Error: {$mail->ErrorInfo}";
    }
}
?>
