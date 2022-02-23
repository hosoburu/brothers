<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>broters</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/spm.css" type="text/css" media="screen and (max-width: 375px)">
    <link rel="icon" href="img/fabicon.ico">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="css/slick/slick.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/slick/slick-theme.css" media="screen" />
    <script src="css/slick/slick.min.js"></script>
    <script src="js/common.js"></script>

</head>

<body>
    <div class="wrapper">
        <?php include('php/common/header.php'); ?>
        <section>
            <h2 class="heading-title">BROTHERSとは？</h2>
            <!-- https://digipress.info/tech/how-to-include-youtube-vimeo-video-with-autoplay-slick-js/ -->
            <!-- https://www.will3in.co.jp/frontend-blog/article/shrink-webpage-with-iframe-responsive/ -->
            <div class="slider">
                <div class="pc">
                    <div class="frame">
                        <iframe class="embed-player slide-media" src="https://www.youtube.com/embed/aqQcaak6GSw" width="1280" height="800" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="pc">
                    <div class="frame">
                        <iframe class="embed-player slide-media" src="https://www.youtube.com/embed/X06h5gA0RZs" width="1280" height="800" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
            <div class="text_area">
                <p>
                    BROTHERSとは超ゆるふわ特殊生命体であり、起源は1994年。<br>
                    人間がごく普通のヌイグルミと共に生活をしていたのだが、ある日突然、魂が宿り始めた。<br>
                    しかし、魂は元から遠い時空の彼方に宿り続けていたのだが、人間界からの時空干渉が原因により人間界とヌイグルミ国が繋がったのであった。<br>
                    ヌイグルミ国では長年にわたり、悪の組織から王国を守べく日々戦争が絶え間なく行われていたのだが、人間界からの干渉を受けた事で様々な技術革新が行われた。<br>
                    その結果、ヌイグルミ王国は悠久の平和を手に入れることに成功したのだ。<br>人間界にはその恩恵として癒しと平和のエネルギーがヌイグルミ王国より供給され、今日に至るまで友好な相互関係が築かれつつある。
                </p>
            </div>
            <?php include('php/common/footer.php'); ?>
        </section>
    </div>
</body>

</html>

<script>
    jQuery(function($) {
        $(window).on('load resize', function() {
            var pc_w = $('.pc .frame').width() / 1280;
            $('.pc iframe').css('transform', 'scale(' + pc_w + ')');
        });
    });
</script>