//共通パーツ読み込み
$(function () {
  $("#header").load("common/header.html");
  $("#footer").load("common/footer.html");
});


// // https://digipress.info/tech/how-to-include-youtube-vimeo-video-with-autoplay-slick-js/
// //start
// $(".slider").slick({
//   autoplaySpeed: 4000,  // スライド表示時間
//   speed: 600,  // スライドの切り替え時間
//   lazyLoad: "progressive",  // バックグラウンドでスライド画像をロード
//   arrows: false,
//   dots: true
// });

// $(".slider").on("init", function (slick) {
//   // スライダーオブジェクトを取得
//   slick = $(slick.currentTarget);
//   // 動画スライドの再生(1枚目のスライドが動画である場合)
//   setTimeout(function () {
//     playPauseVideo(slick, "play");
//   }, 1000);
//   // iframeの埋め込み動画の表示サイズと位置を決定
//   resizePlayer(iframes, 16 / 9);
// });

// $(".slider").on("beforeChange", function (event, slick) {
//   slick = $(slick.$slider);
//   // 現在の動画スライドに対して一時停止させる(カレントが動画スライドである場合)
//   playPauseVideo(slick, "pause");
// });

// $(".slider").on("afterChange", function (event, slick) {
//   slick = $(slick.$slider);
//   // 現在の動画スライドに対して再生を開始(カレントが動画スライドである場合)
//   playPauseVideo(slick, "play");
// });

// function resizePlayer(iframes, ratio) {
//   if (!iframes[0]) return;
//   var win = $(".slider"),
//     width = win.width(),
//     playerWidth,
//     height = win.height(),
//     playerHeight,
//     ratio = ratio || 16 / 9;

//   iframes.each(function () {
//     var current = $(this);
//     if (width / ratio < height) {
//       playerWidth = Math.ceil(height * ratio);
//       current.width(playerWidth).height(height).css({
//         left: (width - playerWidth) / 2,
//         top: 0
//       });
//     } else {
//       playerHeight = Math.ceil(width / ratio);
//       current.width(width).height(playerHeight).css({
//         left: 0,
//         top: (height - playerHeight) / 2
//       });
//     }
//   });


//   function playPauseVideo(slick, control) {
//     var currentSlide, slideType, startTime, player, video;

//     // 現在のスライドを取得
//     currentSlide = slick.find(".slick-current");
//     // 現在のスライドのclass属性に指定の値から2番目のセレクタ(スライドのタイプ)を取得
//     slideType = currentSlide.attr("class").split(" ")[1];
//     // iframeオブジェクトを取得
//     player = currentSlide.find("iframe").get(0);
//     // 再生開始位置(data-video-start)を取得(vimeoのみ)
//     startTime = currentSlide.data("video-start");

//     if (slideType === "vimeo") {
//       // 現在のスライドがVimeoの場合
//       switch (control) {
//         case "play":
//           // 再生処理
//           break;
//         case "pause":
//           // 一時停止処理
//           break;
//       }
//     } else if (slideType === "youtube") {
//       // 現在のスライドがYouTubeの場合
//       switch (control) {
//         case "play":
//           // 再生処理
//           break;
//         case "pause":
//           // 一時停止処理
//           break;
//       }
//     } else if (slideType === "video") {
//       // 現在のスライドがvideoの場合

//       // videoオブジェクトを取得
//       video = currentSlide.children("video").get(0);
//       if (video != null) {
//         if (control === "play") {
//           // 再生
//           video.play();
//         } else {
//           // 一時停止
//           video.pause();
//         }
//       }
//     }
//   }

//   function postMessageToPlayer(player, command) {
//     if (player == null || command == null) return;
//     player.contentWindow.postMessage(JSON.stringify(command), "*");
//   }

//   // 再生開始位置の指定があり、初めて再生を行う場合のみ
//   if (startTime != null && !currentSlide.hasClass('started')) {
//     currentSlide.addClass('started');
//     // 再生開始位置をセット
//     postMessageToPlayer(player, {
//       "method": "setCurrentTime",
//       "value": startTime
//     });
//   }
//   // 再生開始
//   postMessageToPlayer(player, {
//     "method": "play",
//     "value": 1
//   });

//   postMessageToPlayer(player, {
//     "method": "pause",
//     "value": 1
//   });

//   postMessageToPlayer(player, {
//     "event": "command",
//     "func": "mute" // ミュート
//   });
//   postMessageToPlayer(player, {
//     "event": "command",
//     "func": "playVideo" // 再生
//   });

//   postMessageToPlayer(player, {
//     "event": "command",
//     "func": "pauseVideo"
//   });

// }
// // https://digipress.info/tech/how-to-include-youtube-vimeo-video-with-autoplay-slick-js/
// //end