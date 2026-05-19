<?php
// セッション単位で1トークンを維持する（リロード毎に再生成するとconfirm→finishが壊れる）
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // CSPRNG: 64文字の予測不可能なトークン
    }
    return $_SESSION['csrf_token'];
}

function csrf_validate(): void {
    $token = $_POST['csrf_token'] ?? '';
    // hash_equals: タイミング攻撃を防ぐ定数時間比較（strcmp系は長さで処理時間が変わる）
    if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        http_response_code(403);
        exit('不正なリクエストです。');
    }
}
