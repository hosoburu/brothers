<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private UserModel $userModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new UserModel();
    }

    public function showLoginForm(): void {
        require __DIR__ . '/../views/auth/form.php';
    }

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }
        $mail = $_POST['mail'] ?? '';
        $pass = $_POST['pass'] ?? '';
        $member = $this->userModel->findByMail($mail);

        if ($member && password_verify($pass, $member['pass'])) {
            $_SESSION['name']          = $member['name'];
            $_SESSION['mail']          = $member['mail'];
            $_SESSION['password_hash'] = $member['pass'];
            echo json_encode(['status' => 'success', 'msg' => "ログインしました。\n1秒後にトップページに遷移します。"]);
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'メールアドレスもしくはパスワードが間違っています。']);
        }
        exit;
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
        header('Location: /index.php');
        exit;
    }

    public function showSignUpForm(): void {
        require __DIR__ . '/../views/auth/signUp.php';
    }

    public function register(): void {
        $name         = $_POST['name']        ?? '';
        $mail         = $_POST['mail']        ?? '';
        $pass         = password_hash($_POST['pass'] ?? '', PASSWORD_DEFAULT);
        $brotherspass = $_POST['brotherspass'] ?? '';

        $brothers = $this->userModel->findBrothersPass($brotherspass);
        if ($brothers === false) {
            $msg  = 'ブラザーズIDが違います。';
            $link = '<a href="/auth/signUp.php">戻る</a>';
        } else {
            $existing = $this->userModel->findByMail($mail);
            if ($existing !== false) {
                $msg  = '同じメールアドレスが存在します。';
                $link = '<a href="/auth/signUp.php">戻る</a>';
            } else {
                $this->userModel->create($name, $mail, $pass);
                $msg  = '会員登録が完了しました';
                $link = '<a href="/auth/form.php">ログインページへ</a>';
            }
        }
        require __DIR__ . '/../views/auth/userResult.php';
    }
}
