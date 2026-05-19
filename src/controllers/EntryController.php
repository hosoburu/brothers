<?php
require_once __DIR__ . '/../models/MemberModel.php';

class EntryController {
    private MemberModel $memberModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->memberModel = new MemberModel();
    }

    public function showForm(): void {
        // DB照合でlogin_flagを更新してからアクセス制御
        if (isset($_SESSION['mail']) && isset($_SESSION['password_hash'])) {
            require_once __DIR__ . '/../common/security/security_core.php';
        }
        if (empty($_SESSION['login_flag'])) {
            header('Location: /auth/form.php');
            exit;
        }
        $maxId = $this->memberModel->getMaxId();
        require __DIR__ . '/../views/entry/form.php';
    }

    public function confirm(): void {
        $id          = $_POST['id']          ?? '';
        $name        = $_POST['name']        ?? '';
        $explanation = $_POST['explanation'] ?? '';
        $img         = $_POST['img']         ?? '';
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

        $_SESSION['register_params'] = compact(
            'name', 'explanation', 'img', 'atk', 'def', 'spd', 'hp', 'mp',
            'skill1', 'skill2', 'skill3', 'skill4', 'skill5', 'skill6'
        );

        $errorFlg = empty($id) || empty($name) || empty($atk) || empty($def)
                 || empty($spd) || empty($hp) || empty($mp) || empty($skill1);

        require __DIR__ . '/../views/entry/confirm.php';
    }

    public function finish(): void {
        $p     = $_SESSION['register_params'] ?? [];
        $newId = $this->memberModel->getNextId();

        $this->memberModel->insert($newId, [
            ':name'        => $p['name']        ?? '',
            ':explanation' => $p['explanation'] ?? '',
            ':img'         => $p['img']         ?? '',
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

        unset($_SESSION['register_params']);
        $memberName = $p['name'] ?? '';
        require __DIR__ . '/../views/entry/finish.php';
    }
}
