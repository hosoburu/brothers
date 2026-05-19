<?php
require_once __DIR__ . '/../models/MemberModel.php';
require_once __DIR__ . '/../common/security/csrf.php';

class UpdateController {
    private MemberModel $memberModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
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
        $_SESSION['id'] = $_POST['id'] ?? $_SESSION['id'] ?? null;
        $id  = (int) $_SESSION['id'];
        $row = $this->memberModel->getById($id);

        $name        = $row['name']        ?? '';
        $explanation = $row['explanation'] ?? '';
        $atk         = $row['atk']         ?? '';
        $def         = $row['def']         ?? '';
        $spd         = $row['spd']         ?? '';
        $hp          = $row['hp']          ?? '';
        $mp          = $row['mp']          ?? '';
        $skill1      = $row['skill1']      ?? '';
        $skill2      = $row['skill2']      ?? '';
        $skill3      = $row['skill3']      ?? '';
        $skill4      = $row['skill4']      ?? '';
        $skill5      = $row['skill5']      ?? '';
        $skill6      = $row['skill6']      ?? '';

        $csrfToken = csrf_token();
        require __DIR__ . '/../views/update/form.php';
    }

    public function confirm(): void {
        if (empty($_SESSION['login_flag'])) {
            header('Location: /auth/form.php');
            exit;
        }
        csrf_validate();
        $id          = (int) ($_SESSION['id'] ?? 0);
        $name        = $_POST['name']        ?? '';
        $explanation = $_POST['explanation'] ?? '';
        $atk         = $_POST['atk']         ?? '';
        $def         = $_POST['def']         ?? '';
        $spd         = $_POST['spd']         ?? '';
        $hp          = $_POST['hp']          ?? '';
        $mp          = $_POST['mp']          ?? '';
        $skill1      = $_POST['skill1']      ?? '';
        $skill2      = $_POST['skill2']      ?? '';
        $skill3      = $_POST['skill3']      ?? '';
        $skill4      = $_POST['skill4']      ?? '';
        $skill5      = $_POST['skill5']      ?? '';
        $skill6      = $_POST['skill6']      ?? '';

        // SQLではなくパラメータをセッションに保存（SQLインジェクション対策）
        $_SESSION['update_params'] = compact(
            'name', 'explanation', 'atk', 'def', 'spd', 'hp', 'mp',
            'skill1', 'skill2', 'skill3', 'skill4', 'skill5', 'skill6'
        );

        $errorFlg  = empty($name) || empty($atk) || empty($def) || empty($spd)
                  || empty($hp) || empty($mp) || empty($skill1);
        $csrfToken = csrf_token();

        require __DIR__ . '/../views/update/confirm.php';
    }

    public function finish(): void {
        if (empty($_SESSION['login_flag'])) {
            header('Location: /auth/form.php');
            exit;
        }
        csrf_validate();
        $id = (int) ($_SESSION['id'] ?? 0);
        $p  = $_SESSION['update_params'] ?? [];

        $this->memberModel->update($id, [
            ':name'        => $p['name']        ?? '',
            ':explanation' => $p['explanation'] ?? '',
            ':atk'         => $p['atk']         ?? 0,
            ':def'         => $p['def']         ?? 0,
            ':spd'         => $p['spd']         ?? 0,
            ':hp'          => $p['hp']          ?? 0,
            ':mp'          => $p['mp']          ?? 0,
            ':skill1'      => $p['skill1']      ?? '',
            ':skill2'      => $p['skill2']      ?? '',
            ':skill3'      => $p['skill3']      ?? '',
            ':skill4'      => $p['skill4']      ?? '',
            ':skill5'      => $p['skill5']      ?? '',
            ':skill6'      => $p['skill6']      ?? '',
        ]);

        unset($_SESSION['update_params']);
        $name = $p['name'] ?? '';
        require __DIR__ . '/../views/update/finish.php';
    }
}
