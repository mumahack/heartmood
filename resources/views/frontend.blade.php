<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script src="mediaelement/mediaelement-and-player.min.js"></script>
<link rel="stylesheet" href="mediaelement/mediaelementplayer.css"/>


<script src="plugins/speed/speed.min.js"></script>
<script src="plugins/speed/speed-i18n.js"></script>
<link rel="stylesheet" href="plugins/speed/speed.min.css">

<script>

    var currentVideo = null;
    function yourFunction() {
        // do whatever you like here
        $.getJSON('getvalue', function (data) {
            newVideo = currentVideo;
            switch (data.heartbeat) {
                case 1:
                    newVideo = "cLNjP1vkyYU";
                    break;
                case 2:
                    newVideo = "1TsVjvEkc4s";
                    break;
                case 3:
                    newVideo = "UXxRyNvTPr8";
                    break;
            }
            $('#heartbeat').html(data.heartbeat);

            if (newVideo !== currentVideo) {
                currentVideo = newVideo;
                var myVideoPlayer = new MediaElementPlayer('youtube1');
                myVideoPlayer.media.pluginApi.loadVideoById(currentVideo);
                myVideoPlayer.media.load();
                myVideoPlayer.media.play();
            }


        });

        setTimeout(yourFunction, 1000);
    }


    $(document).ready(function () {
        yourFunction();
        /*
         jQuery(document).ready(function($) {

         player = new MediaElementPlayer('youtube1', {
         defaultSpeed: 4.0,
         features: ['speed'],
         success: function (mediaElement, domObject) {
         //mediaElement.defaultSpeed = 0.5;
         mediaElement.load();
         mediaElement.play();
         }
         });



         });
         */
    });

</script>
Heartbeat:
<div id="heartbeat"></div>
<div id=""></div>


<video id="youtube1" width="640" height="360">
    <source src="http://www.youtube.com/watch?v=nOEw9iiopwI" type="video/youtube">
</video>
