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
    <title>投票後台</title>
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
                <!-- <a class="btn btn-light" data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">iLogin</a> -->
            </div>
        </div>
    </nav>
    <!-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
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

    <header class="p-3">
        <h1 class="text-center">投票主題管理</h1>
    </header>

    <main class="container">
        <fieldset>
            <legend style="text-align: center;">
                新增投票
            </legend>
            <form action="../api/add_que.php" method="post">
                <div class="d-flex">
                    <div class="mx-auto">
                        <!-- 主題 -->
                        <div class="col bg-light p-2">
                            <label for="subject">投票名稱&nbsp;</label>
                            <input type="text" name="subject" id="">
                        </div>
                        <!-- 選項 -->
                        <div class="col bg-light p-2">
                            <label for="option" id="opt">投票選項&nbsp;</label> <!-- 給定id以便function定位 -->
                            <input type="text" name="option[]">
                            <input type="button" value="更多" onclick="more()">
                        </div>
                        <input type="submit" value="新增">
                        <input type="reset" value="清空">
                    </div>
                </div>
            </form>
            <hr>
            <legend style="text-align: center;">正在進行的投票</legend>
            <div class="col-8 mx-auto">
                <table class="table">
                    <tr>
                        <td>編號</td>
                        <td>主題內容</td>
                        <td>操作</td>
                    </tr>
                    <?php
                    $ques = $Que->all(['subject_id' => 0]);
                    foreach ($ques as $idx => $que) {
                    ?>
                        <tr>
                            <td><?= $idx + 1; ?></td>
                            <td><?= $que['text']; ?></td>
                            <td>
                                <!-- <a href="../api/show.php?id=<?= $que['id']; ?>" class="btn <?= ($que['display'] == 1) ? 'btn-info' : 'btn-secondary'; ?>">
                                    <?= ($que['display'] == 1) ? '顯示' : '隱藏'; ?>
                                </a> -->
                                <!-- <button class="btn btn-success">編輯</button> -->
                                <a href="../api/del.php?id=<?= $que['id']; ?>">
                                    <button class="btn btn-danger">刪除</button>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </fieldset>
    </main>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>

    <script>
        function more() {
            let opt = `<div>
                        <label for="" id="opt">投票選項&nbsp;</label>
                        <input type="text" name="option[]">
                    </div>`
            $("#opt").before(opt)
        }
    </script>
</body>

</html>