<?php
require_once __DIR__ . "/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Bree+Serif&family=Margarine&family=Pacifico&family=Playwrite+NG+Modern:wght@100..400&display=swap');
    body {
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        background-color: rgb(235, 214, 171);
    }
    nav{
      font-family: "Bree Serif", serif;
  font-weight: 400;
  font-style: normal;
      background-color: rgb(232, 189, 97);
    }
    tbody{
     background-color: rgb(252, 242, 220);
    }
    svg{
      color: black;
      transition: 1px;
    }
    svg:hover{
      box-shadow: 1px 2px gray;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"><path fill="currentColor" d="M3 6a4 4 0 0 1 4-4h14v20H7a4 4 0 0 1-4-4zm2 8.535A3.982 3.982 0 0 1 7 14h12V4H7a2 2 0 0 0-2 2zM19 16H7a2 2 0 1 0 0 4h12zM10 6h7v2h-7z"/></svg>Library</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/dashboard.php">Dashboard</a>
        </li>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/buku/index.php">Buku</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Lainnya
          </a>
          <ul class="dropdown-menu dropdown-menu-end mt-2">
            <li><a class="dropdown-item" href="/genre/index.php">genre</a></li>
            <li><a class="dropdown-item" href="/pinjaman/index.php">Pinjaman</a></li>
            <li><a href=""></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/ulasan/index.php">Ulasan</a></li>
            <li><a class="dropdown-item" href="/user/index.php">User</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
</body>

</html>