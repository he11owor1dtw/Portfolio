<?php
include_once "../api/db.php";

if (!isset($_SESSION['user'])) {
  // 如果未登入，將用戶重新導向到index.php
  echo "<script>alert('請先登入'); window.location.href = '../index.php';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../js/bootstrap.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/bootstrap.js"></script>
  <title>投票結果</title>
  <style>
    body {
      font-family: fantasy;
      font-style: italic;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" id="top">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">
        <i class="fa-solid fa-camera-retro"></i>
        &nbsp;iShot
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" aria-current="page" href="../index.php">iHome</a></li>
          <li class="nav-item"><a class="nav-link" href="../back/mem.php">iMember</a></li>
          <li class="nav-item"><a class="nav-link" href="../back/voteidx.php">iVote</a></li>
          <li class="nav-item"><a class="nav-link" href="../back/admin.php">iAdmin</a></li>
        </ul>
        <!-- <button class="btn btn-light" style="font-style: italic;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">iLogin</button>      </div> -->
      </div>
  </nav>
  <!-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5>會員登入</h5>
    </div>
    <div class="offcanvas-body">
      <div class="container text-center">
        <form action="./api/check.php" method="post">
          <div class="form-outline">
            <?php
            if (isset($_GET['error'])) {
              echo "<script>alert('帳號或密碼錯誤')</script>";
            }
            ?>
            <?php
            if (isset($_SESSION['user'])) {
              echo "歡迎光臨 " . $_SESSION['user'];
              echo "&nbsp;";
              echo "<br>";
              echo "<a href='../api/logout.php' class='btn btn-dark' style='font-size:15px'>登出</a>";
            ?>
            <?php
            } else {
            ?>
              <label for="account" class="form-label">帳號 Account</label>
              <input type="text" name="acc" id="acc" class="form-control">
          </div>
          <div class="form-outline mb-4">
            <label for="password" class="form-label">密碼 Password</label>
            <input type="password" name="pw" id="pw" class="form-control">
          </div>
          <div class="btn-custom">
            <button type="submit" class="btn btn-primary" value="登入">登入</button>
            <button type="button" class="btn btn-danger" value="離開">離開</button>
          </div>
        </form>

        <div class="mt-1">
          <a href="../front/forget.php">忘記密碼?</a>
        </div>
      <?php
            };
      ?>
      </div>
    </div>
  </div>
  </div> -->

  <?php
  $subject = $Que->find($_GET['id']);
  ?>
  <div class='container'>
    <header class="p-3">
      <h2 class="text-center"><?= $subject['text']; ?></h>
    </header>
    <ul class="list-group col-6 mx-auto">
      <?php
      $opts = $Que->all(['subject_id' => $_GET['id']]);
      foreach ($opts as $idx => $opt) {
        $div = ($subject['count'] > 0) ? $subject['count'] : 1;
        $rate = round($opt['count'] / $div, 3);
      ?>
        <li class="list-group-item list-group-item-action d-flex">
          <div class="col-6">
            <?= $idx + 1; ?>.
            <?= $opt['text']; ?>
          </div>
          <div class="col-6 d-flex">
            <div class="col-8 bg-secondary" style="width:<?= $rate * 0.667 * 100; ?>%"></div>
            <div class="col-4">&nbsp;&nbsp; <?= $opt['count'] ?>票(<?= $rate * 100; ?>%)</div>
          </div>
        </li>
      <?php
      }
      ?>
    </ul>
    <button class="btn btn-primary d-block mx-auto mt-3" onclick="location.href='../back/voteidx.php'">返回</button>
  </div>
</body>

</html>