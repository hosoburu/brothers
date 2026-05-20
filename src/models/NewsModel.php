<?php
require_once __DIR__ . '/Database.php';

class NewsModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll(): array {
        // LEFT OUTER JOIN: メンバーが削除されてもニュースレコードは残す
        $sql = "SELECT n.id, m.name, m.img, n.explanation, n.hyperlink, n.posted_date
                FROM t_news AS n
                LEFT OUTER JOIN t_member AS m ON n.name_id = m.id
                ORDER BY n.id DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNextId(): int {
        $row = $this->db->query("SELECT COALESCE(MAX(id), 0) + 1 AS next_id FROM t_news")->fetch(PDO::FETCH_ASSOC);
        return (int) $row['next_id'];
    }

    public function insert(int $id, int $nameId, string $explanation, string $hyperlink, string $postedDate): void {
        $sql = "INSERT INTO t_news (id, name_id, explanation, hyperlink, posted_date)
                VALUES (:id, :name_id, :explanation, :hyperlink, :posted_date)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id'          => $id,
            ':name_id'     => $nameId,
            ':explanation' => $explanation,
            ':hyperlink'   => $hyperlink,
            ':posted_date' => $postedDate,
        ]);
    }
}
