<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = $_POST['host'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $_POST['database'];

    // Bağlantı bilgilerini connect.php dosyasına kaydet
    $connect_file = fopen('../connect.php', 'w');
    if ($connect_file) {
        $content = <<<EOD
<?php
\$host = '$host';
\$username = '$username';
\$password = '$password';
\$database = '$database';
\$conn = new mysqli(\$host, \$username, \$password, \$database);

if (\$conn->connect_error) {
    die("Bağlantı hatası: " . \$conn->connect_error);
}
?>
EOD;
        if (fwrite($connect_file, $content) === false) {
            die("connect.php dosyasına yazılamadı.");
        }
        fclose($connect_file);

        // SQL tablolarını oluştur
        include 'sql.php';

        // Admin oluşturma sayfasına yönlendir
        header('Location: admin.php');
        exit();
    } else {
        die("connect.php dosyası açılamadı veya yazılamadı.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Başla</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../">Ana Sayfa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../register">Kayıt ol</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login">Giriş yap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../create">Konu oluştur</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h1>MySQL Bağlantı Bilgileri</h1>
    <form method="POST">
        <label for="host">Host:</label>
        <input type="text" name="host" required><br><br>
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Şifre:</label>
        <input type="password" name="password" required><br><br>
        <label for="database">Veritabanı Adı:</label>
        <input type="text" name="database" required><br><br>
        <input type="submit" value="Devam">
    </form>
    </div>
</body>
</html>
