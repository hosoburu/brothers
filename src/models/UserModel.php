<?php
require_once __DIR__ . '/Database.php';

class UserModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function findByMail(string $mail): array|false {
        $stmt = $this->db->prepare("SELECT * FROM t_user WHERE mail = :mail");
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(string $name, string $mail, string $pass): void {
        $stmt = $this->db->prepare("INSERT INTO t_user(name, mail, pass) VALUES (:name, :mail, :pass)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':mail', $mail);
        $stmt->bindValue(':pass', $pass);
        $stmt->execute();
    }

    // 会員登録は招待コード(t_brothers.pass)を持つ者のみ可能
    public function findBrothersPass(string $brotherspass): array|false {
        $stmt = $this->db->prepare("SELECT * FROM t_brothers WHERE pass = :brotherspass");
        $stmt->bindValue(':brotherspass', $brotherspass);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
