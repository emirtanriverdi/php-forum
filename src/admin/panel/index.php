<?php
session_start();

if (!isset($_COOKIE["admin_cookie"])) {
    header("Location: ../"); // Kullanıcı girişi yoksa giriş sayfasına yönlendirme
    exit();
}

include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    
    // Kullanıcıyı silme işlemi
    $query = "DELETE FROM users WHERE id = '$user_id'";
    mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_topic'])) {
    $topic_id = $_POST['topic_id'];
    
    // Konuyu silme işlemi
    $query = "DELETE FROM topics WHERE id = '$topic_id'";
    mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_message'])) {
    $message_id = $_POST['message_id'];
    
    // Mesajı silme işlemi
    $query = "DELETE FROM messages WHERE id = '$message_id'";
    mysqli_query($conn, $query);
}

// Kullanıcıları, Konuları ve Mesajları Veritabanından Alın
$query_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $query_users);

$query_topics = "SELECT * FROM topics";
$result_topics = mysqli_query($conn, $query_topics);

$query_messages = "SELECT * FROM messages";
$result_messages = mysqli_query($conn, $query_messages);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <!-- Bootstrap CSS dosyasını ekleyin -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../../">Ana Sayfa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../../register">Kayıt ol</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../login">Giriş yap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../create">Konu oluştur</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h1>Kullanıcılar</h1>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php while ($user = mysqli_fetch_assoc($result_users)) : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo $user['username']; ?>
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Sil</button>
                                    </form>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h1>Konular</h1>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php while ($topic = mysqli_fetch_assoc($result_topics)) : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo $topic['topic_title']; ?>
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="topic_id" value="<?php echo $topic['id']; ?>">
                                        <button type="submit" name="delete_topic" class="btn btn-danger btn-sm">Sil</button>
                                    </form>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h1>Mesajlar</h1>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php while ($message = mysqli_fetch_assoc($result_messages)) : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo $message['message']; ?>
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                        <button type="submit" name="delete_message" class="btn btn-danger btn-sm">Sil</button>
                                    </form>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
    <p>Eğer admin iseniz giriş yaptığınız halde kayıt ol ve giriş yap sayfalarına erişebilirsiniz.</p>
    </div>
    <!-- Bootstrap JS dosyasını ekleyin -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>