<?php
$envFile = __DIR__ . '/../../.env';
if (!file_exists($envFile)) {
    die('.env ファイルが見つかりません。.env.example を参考に .env を作成してください。');
}

$env = parse_ini_file($envFile, false, INI_SCANNER_RAW);

return [
    'host'     => $env['DB_HOST'] ?? 'localhost',
    'dbname'   => $env['DB_NAME'] ?? '',
    'user'     => $env['DB_USER'] ?? '',
    'password' => $env['DB_PASS'] ?? '',
];
