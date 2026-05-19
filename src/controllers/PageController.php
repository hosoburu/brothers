<?php
require_once __DIR__ . '/../models/NewsModel.php';
require_once __DIR__ . '/../models/MemberModel.php';

class PageController {
    public function index(): void {
        require __DIR__ . '/../views/pages/index.php';
    }

    public function news(): void {
        $newsModel = new NewsModel();
        $newsList  = $newsModel->getAll();
        require __DIR__ . '/../views/pages/news.php';
    }

    public function member(): void {
        $memberModel = new MemberModel();
        $members     = $memberModel->getAll();
        require __DIR__ . '/../views/pages/member.php';
    }

    public function history(): void {
        require __DIR__ . '/../views/pages/history.php';
    }

    public function faq(): void {
        require __DIR__ . '/../views/pages/faq.php';
    }

    public function front(): void {
        require __DIR__ . '/../views/pages/front.php';
    }
}
