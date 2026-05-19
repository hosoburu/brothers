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
                ORDER BY n.id";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
