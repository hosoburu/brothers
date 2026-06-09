<?php

class GeminiClient {
    private string $apiKey;
    private string $endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent';

    public function __construct() {
        $env = parse_ini_file(__DIR__ . '/../../.env', false, INI_SCANNER_RAW);
        $this->apiKey = $env['GEMINI_API_KEY'] ?? '';
    }

    // $userPrompt をニュース文として整形して返す。$catchphrase が渡された場合は文中に自然に混ぜる。失敗時は null。
    public function generateNewsText(string $userPrompt, string $catchphrase = ''): ?string {
        if (empty($this->apiKey)) {
            return null;
        }

        $catchphraseInstruction = '';
        if ($catchphrase !== '') {
            $catchphraseInstruction = 'また、投稿者の口癖は「' . $catchphrase . '」です。この口癖を文末など自然な箇所に1回だけ組み込んでください。';
        }

        $systemInstruction = 'あなたはゲームギルド「BROTHERS」のニュース担当です。'
            . 'ユーザーが入力したメモをもとに、ニュース投稿文を2〜3文で自然な日本語に整えてください。'
            . '箇条書き・markdown・見出しは使わず、平文のみで出力してください。'
            . $catchphraseInstruction;

        $body = json_encode([
            'system_instruction' => [
                'parts' => [['text' => $systemInstruction]],
            ],
            'contents' => [
                ['parts' => [['text' => $userPrompt]]],
            ],
            'generationConfig' => [
                'maxOutputTokens' => 300,
                'temperature'     => 0.7,
                // gemini-flash-latest は thinking モデルのため内部思考でトークンを使い切らないよう無効化
                'thinkingConfig'  => ['thinkingBudget' => 0],
            ],
        ]);

        $ch = curl_init($this->endpoint);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $body,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'X-goog-api-key: ' . $this->apiKey,
            ],
            CURLOPT_TIMEOUT        => 15,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false || $httpCode !== 200) {
            return null;
        }

        $data = json_decode($response, true);
        return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
    }
}
