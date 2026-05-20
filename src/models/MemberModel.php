<?php
require_once __DIR__ . '/Database.php';

class MemberModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll(): array {
        return $this->db->query("SELECT * FROM t_member ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM t_member WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 入力フォームの「現在の最大ID」表示用（登録には使わない）
    public function getMaxId(): int {
        $row = $this->db->query("SELECT MAX(id) AS id FROM t_member")->fetch(PDO::FETCH_ASSOC);
        return (int) ($row['id'] ?? 0);
    }

    // INSERT用の次ID採番: COALESCE でテーブルが空のとき MAX が NULL になるケースを回避
    public function getNextId(): int {
        $row = $this->db->query("SELECT COALESCE(MAX(id), 0) + 1 AS next_id FROM t_member")->fetch(PDO::FETCH_ASSOC);
        return (int) $row['next_id'];
    }

    public function insert(int $id, array $params): void {
        $sql = "INSERT INTO t_member
                    (id, name, explanation, img, atk, def, spd, hp, mp, skill1, skill2, skill3, skill4, skill5, skill6, catchphrase)
                VALUES
                    (:id, :name, :explanation, :img, :atk, :def, :spd, :hp, :mp, :skill1, :skill2, :skill3, :skill4, :skill5, :skill6, :catchphrase)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_merge([':id' => $id], $params));
    }

    // $stat はホワイトリスト照合済みのカラム名のみ受け取る（SQL インジェクション対策）
    public function getOrderedBy(string $stat): array {
        $allowed = ['atk', 'def', 'spd', 'hp', 'mp'];
        if (!in_array($stat, $allowed, true)) {
            $stat = 'atk';
        }
        return $this->db->query("SELECT * FROM t_member ORDER BY {$stat} DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(int $id, array $params): void {
        $sql = "UPDATE t_member
                SET name=:name, explanation=:explanation, atk=:atk, def=:def, spd=:spd,
                    hp=:hp, mp=:mp, skill1=:skill1, skill2=:skill2, skill3=:skill3,
                    skill4=:skill4, skill5=:skill5, skill6=:skill6, catchphrase=:catchphrase
                WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_merge($params, [':id' => $id]));
    }
}
