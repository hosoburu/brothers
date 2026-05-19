<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<div class="main">
    <header>
        <h1><a href="/index.php">BROTHERS</a></h1>
        <?php include(__DIR__ . '/../../common/security/security.php'); ?>
    </header>

    <nav>
        <input id="gnav-input" type="checkbox" class="gnav-hidden">
        <label id="gnav-btn" for="gnav-input"></label>
        <label id="gnav-black" for="gnav-input"></label>
        <div id="gnav-content">
            <ul class="gnav-list">
                <!-- <li><a href="front.php">TOP</a></li> -->
                <li><a href="/index.php">ブラザーズとは</a></li>
                <li><a href="/pages/news.php">お知らせ</a></li>
                <li><a href="/pages/member.php">メンバー</a></li>
                <li><a href="/pages/history.php">歴史</a></li>
                <?php if (isset($_SESSION['login_flag']) && $_SESSION['login_flag']) : ?>
                    <li><a href="/entry/form.php">団員募集</a></li>
                <?php else : ?>
                    <li><span style="color: lightgray;">団員募集</span></li>
                <?php endif; ?>
                <li><a href="/pages/faq.php">よくある質問</a></li>
            </ul>
        </div>
    </nav>

    <!-- モーダルのHTML -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>セッションが無効です。ログアウトしました。</p>
        </div>
    </div>

    <!-- モーダルのCSS -->
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
        }
    </style>
</div>
