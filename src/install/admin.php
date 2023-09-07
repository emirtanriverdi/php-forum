<?phpinclude '../connect.php';if ($_SERVER['REQUEST_METHOD'] === 'POST') {    $username = $_POST['username'];    $password = $_POST['password'];    // Parolayı hashle    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);    // Admin hesabını oluştur    $sql = "INSERT INTO `admin` (`username`, `password`) VALUES ('$username', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        // Admin account created successfully

        // Now, delete the files
        $filesToDelete = ['index.php', 'sql.php', 'admin.php'];

        foreach ($filesToDelete as $file) {
            if (file_exists($file)) {
                unlink($file); // Delete the file
            }
        }

        echo "Admin hesabı başarıyla oluşturuldu ve gerekli dosyalar silindi.";
    } else {
        echo "Admin hesabını oluştururken hata oluştu: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Oluştur</title>
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
    <h1>Admin Oluştur</h1>
    <form method="POST">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Şifre:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Oluştur">
    </form>
</div>
</body>
</html>
