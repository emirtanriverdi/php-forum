<?php
// connect.php dosyasını kontrol et
if (filesize('connect.php') === 0) {
    // connect.php dosyası boşsa install.php sayfasına yönlendir
    header('Location: install');
    exit;
}

session_start();

include('connect.php');

$user_id = null;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
}

$username = ""; // Varsayılan kullanıcı adı

if ($user_id !== null) {
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        htmlspecialchars($username = $user['username']);
    }
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoş Geldiniz</title>
    <!-- Bootstrap CSS dosyasını ekleyin -->
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <?php
                    if ($username !== "") {
                        echo "Hoş Geldiniz, " . $username . "!";
                    } else {
                        echo "Hoş Geldiniz!";
                    }
                    ?>
                </div>
                <div class="card-body">
                    <?php
                    if ($username !== "") {
                        echo '<a href="logout" class="btn btn-danger">Çıkış Yap</a>';
                    } else {
                        echo '<p>Kayıt olmadan sınırlı erişime sahipsiniz. Lütfen kayıt olun veya giriş yapın.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS dosyasını ekleyin -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>