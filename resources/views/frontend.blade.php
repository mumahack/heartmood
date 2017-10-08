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
    var player = null;
    function yourFunction() {
        // do whatever you like here
        $.getJSON('getvalue', function (data) {
            newVideo = currentVideo;
            switch (parseInt(data.heartbeat)) {
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

            if (newVideo != currentVideo) {
                console.log("need to play following video"+currentVideo);
                currentVideo = newVideo;
                var myVideoPlayer = player;
                console.log(myVideoPlayer);
                myVideoPlayer.media.youTubeApi.loadVideoById(currentVideo);
                myVideoPlayer.media.load();
                myVideoPlayer.media.play();
            }


        });

        setTimeout(yourFunction, 1000);
    }


    $(document).ready(function () {

        player = new MediaElementPlayer('youtube1', {

        });
        yourFunction();


    });

</script>
Heartbeat:
<div id="heartbeat"></div>
<div id=""></div>


<video id="youtube1" width="640" height="360">
    <source src="http://www.youtube.com/watch?v=nOEw9iiopwI" type="video/youtube">
</video>
