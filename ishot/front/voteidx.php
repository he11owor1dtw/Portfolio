<?php
include_once "../api/db.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iVote</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/js.js"></script>
  <script src="../js/jquery-3.4.1.min.js"></script>
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
      <a class="navbar-brand" href="#">
        <i class="fa-solid fa-camera-retro"></i>
        &nbsp;iShot
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" aria-current="page" href="../index.php">iHome</a></li>
          <li class="nav-item"><a class="nav-link" href="../front/mem.php">iMember</a></li>
          <li class="nav-item"><a class="nav-link" href="../front/voteidx.php">iVote</a></li>
          <li class="nav-item"><a class="nav-link" href="../back/voteadmin.php">iAdmin</a></li>
        </ul>
        <!-- <a class="btn btn-light" data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">iLogin</a> -->
      </div>
    </div>
  </nav>

  <header class="p-3">
    <h1 class="text-center">海外婚紗投票</h1>
  </header>
  <main class="container">
    <fieldset>
      <legend>
      </legend>
      <table class="table">
        <tr>
          <th>編號</th>
          <th>主題</th>
          <th>投票總數</th>
          <th>結果</th>
          <th>投票</th>
        </tr>
        <?php
        $ques = $Que->all(['subject_id' => 0, 'display' => 1]);
        foreach ($ques as $idx => $que) {
        ?>
          <tr>
            <td><?= $idx + 1; ?></td>
            <td><?= $que['text']; ?></td>
            <td><?= $que['count']; ?></td>
            <td>
              <a class='btn btn-dark' href="../back/result.php?id=<?= $que['id']; ?>">投票結果</a>
            </td>
            <td>
              <a class="btn btn-outline-secondary" href="vote.php?id=<?= $que['id']; ?>">我要投票</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </table>
    </fieldset>
  </main>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/bootstrap.js"></script>
</body>