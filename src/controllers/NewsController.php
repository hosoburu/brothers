<?php
require_once __DIR__ . '/../models/NewsModel.php';
require_once __DIR__ . '/../models/MemberModel.php';
require_once __DIR__ . '/../common/security/csrf.php';
require_once __DIR__ . '/../common/GeminiClient.php';

class NewsController {
    private NewsModel $newsModel;
    private MemberModel $memberModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->newsModel   = new NewsModel();
        $this->memberModel = new MemberModel();
    }

    public function showForm(): void {
        if (isset($_SESSION['mail']) && isset($_SESSION['password_hash'])) {
            require_once __DIR__ . '/../common/security/security_core.php';
        }
        if (empty($_SESSION['login_flag'])) {
            header('Location: /auth/form.php');
            exit;
        }
        $members   = $this->memberModel->getAll();
        $csrfToken = csrf_token();
        require __DIR__ . '/../views/news/form.php';
    }

    public function confirm(): void {
        if (empty($_SESSION['login_flag'])) {
            header('Location: /auth/form.php');
            exit;
        }
        csrf_validate();
        $nameId      = (int) ($_POST['name_id']     ?? 0);
        $explanation = $_POST['explanation'] ?? '';
        $hyperlink   = $_POST['hyperlink']   ?? '';
        $postedDate  = $_POST['posted_date'] ?? date('Y-m-d');

        $errorFlg = ($nameId === 0) || empty($explanation) || empty($postedDate);

        // バリデーション通過後にGeminiで文章を整形する。失敗時は入力テキストをそのまま使う。
        if (!$errorFlg) {
            $generated = (new GeminiClient())->generateNewsText($explanation);
            if ($generated !== null) {
                $explanation = $generated;
            }
        }

        $_SESSION['news_params'] = compact('nameId', 'explanation', 'hyperlink', 'postedDate');

        $members   = $this->memberModel->getAll();
        $csrfToken = csrf_token();
        require __DIR__ . '/../views/news/confirm.php';
    }

    public function finish(): void {
        if (empty($_SESSION['login_flag'])) {
            header('Location: /auth/form.php');
            exit;
        }
        csrf_validate();
        if (empty($_SESSION['news_params'])) {
            header('Location: /news/form.php');
            exit;
        }
        $p = $_SESSION['news_params'];

        $newId = $this->newsModel->getNextId();
        $this->newsModel->insert(
            $newId,
            (int) ($p['nameId']      ?? 0),
            $p['explanation'] ?? '',
            $p['hyperlink']   ?? '',
            $p['postedDate']  ?? date('Y-m-d')
        );

        unset($_SESSION['news_params']);
        require __DIR__ . '/../views/news/finish.php';
    }
}
