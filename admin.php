<?php
session_start();
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

$showPopup = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    if ($user === 'indraganteng' && $pass === 'indra2005') {
        $_SESSION['login'] = true;
    } else {
        $showPopup = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <link href="https://cdn.tailwindcss.com" rel="stylesheet">
  <style>
    .popup-overlay {
      position: fixed; top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.85);
      display: flex; flex-direction: column;
      justify-content: center; align-items: center;
      z-index: 9999;
    }
    .popup-content {
      text-align: center;
      color: white;
    }
    .popup-content img {
      width: 280px;
      border-radius: 12px;
    }
    .popup-content p {
      margin-top: 12px;
      font-size: 20px;
      font-weight: bold;
    }
  </style>
</head>
<body class="bg-gray-100 p-10 font-sans">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <?php if (!isset($_SESSION['login'])): ?>
      <h2 class="text-2xl font-bold mb-4">Login Admin</h2>
      <form method="post">
        <input name="username" type="text" placeholder="Username" class="w-full mb-3 p-2 border rounded" required>
        <input name="password" type="password" placeholder="Password" class="w-full mb-3 p-2 border rounded" required>
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded">Login</button>
      </form>
    <?php else: ?>
      <form method="post">
        <button name="logout" class="text-sm text-red-500 float-right">Logout</button>
      </form>
      <h2 class="text-2xl font-bold mb-4">Tambah Proyek Baru</h2>
      <form action="proses.php" method="post">
        <input name="title" type="text" placeholder="Judul Proyek" class="w-full mb-3 p-2 border rounded" required>
        <input name="image" type="text" placeholder="URL Gambar" class="w-full mb-3 p-2 border rounded" required>
        <textarea name="desc" placeholder="Deskripsi Proyek" class="w-full mb-3 p-2 border rounded" required></textarea>
        <input name="link" type="text" placeholder="Link Website" class="w-full mb-3 p-2 border rounded" required>
        <input name="repo" type="text" placeholder="Link Kode (GitHub)" class="w-full mb-3 p-2 border rounded" required>
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded">Tambah Proyek</button>
      </form>
    <?php endif; ?>
  </div>

  <?php if ($showPopup): ?>
    <div class="popup-overlay">
      <div class="popup-content">
        <img src="https://i.imgur.com/EyP8lo9.png" alt="Meme">
        <p>yahahaha ngapain lu cok?</p>
      </div>
    </div>
  <?php endif; ?>
</body>
</html>
