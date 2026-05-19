<?php
$envFile = __DIR__ . '/../../.env';
if (!file_exists($envFile)) {
    header('Content-Type: text/html; charset=utf-8');
    die('.env ファイルが見つかりません。.env.example を参考に .env を作成してください。');
}

// INI_SCANNER_RAW: パスワードに '#' や '=' が含まれても値が破損しない
$env = parse_ini_file($envFile, false, INI_SCANNER_RAW);

return [
    'host'     => $env['DB_HOST'] ?? 'localhost',
    'dbname'   => $env['DB_NAME'] ?? '',
    'user'     => $env['DB_USER'] ?? '',
    'password' => $env['DB_PASS'] ?? '',
];
