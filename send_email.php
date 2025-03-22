<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Jika menggunakan Composer
// require 'path_ke_folder_PHPMailer/PHPMailerAutoload.php'; // Jika tanpa Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST["nama"]);
    $email = htmlspecialchars($_POST["email"]);
    $pesan = htmlspecialchars($_POST["pesan"]);

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'faridmusrizal@gmail.com'; // Ganti dengan email Anda
        $mail->Password   = 'gjpd ybhl ncyz crrv'; // Gunakan App Password jika pakai Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Pengirim & Penerima
        $mail->setFrom($email, $nama); // Email pengirim (dari form)
        $mail->addAddress('rikal.permana.17@gmail.com', 'Rancak Coding'); // Ganti dengan email tujuan

        // Konten Email
        $mail->isHTML(true);
        $mail->Subject = "Pesan dari $nama";
        $mail->Body    = "
            <h3>Pesan dari Formulir Kontak</h3>
            <p><strong>Nama:</strong> $nama</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Pesan:</strong><br>$pesan</p>
        ";
        $mail->AltBody = "Nama: $nama\nEmail: $email\nPesan: $pesan";

        // Kirim email
        $mail->send();
        echo "<script>
           
            window.location.href='index.html';
        </script>";
    } catch (Exception $e) {
        echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Akses tidak diperbolehkan.";
}
?>
