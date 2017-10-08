<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<link href="{{ asset('/css/switches.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <h2 class="panel-heading" style="text-align:center;">Backend</h2>

                <ul class="list-group">
                    <li class="list-group-item">
                        Heartbeat Slow
                        <div class="TriSea-technologies-Switch pull-right">
                            <input id="heartbeat1" class="heartbeat" name="heartbeat" type="radio" value="1"/>
                            <label for="heartbeat1" class="label-success"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Heartbeat Normal
                        <div class="TriSea-technologies-Switch pull-right">
                            <input id="heartbeat2"  class="heartbeat" name="heartbeat" type="radio" value="2"/>
                            <label for="heartbeat2" class="label-success"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Heartbeat Fast
                        <div class="TriSea-technologies-Switch pull-right">
                            <input id="heartbeat3" class="heartbeat" name="heartbeat" type="radio" value="3"/>
                            <label for="heartbeat3" class="label-success"></label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <h2 class="panel-heading" style="text-align:center;">Backend</h2>

                <ul class="list-group">
                    <li class="list-group-item">
                       Green Light
                        <div class="TriSea-technologies-Switch pull-right">
                            <input id="lightswitch1" class="lightswitch" name="lightswitch" type="radio" value="1"/>
                            <label for="lightswitch1" class="label-success"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Red Light
                        <div class="TriSea-technologies-Switch pull-right">
                            <input id="lightswitch2" class="lightswitch" name="lightswitch" type="radio" value="2"/>
                            <label for="lightswitch2" class="label-success"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Red (Flashing)
                        <div class="TriSea-technologies-Switch pull-right">
                            <input id="lightswitch3" class="lightswitch" name="lightswitch" type="radio" value="3"/>
                            <label for="lightswitch3" class="label-success"></label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>



<?php
        /*
Leer Befehl: FSOC070255
Grün : FSOC066255
Rot : FSOC067255
Trigger : FSOC068255
        */
?>

<input type="text" id="debugvalue" value="FSOC070255"/>
<button id="debugbutton" value="">Debug</button>


<script src="mediaelement/mediaelement-and-player.min.js"></script>
<link rel="stylesheet" href="mediaelement/mediaelementplayer.css"/>


<script src="plugins/speed/speed.min.js"></script>
<script src="plugins/speed/speed-i18n.js"></script>
<link rel="stylesheet" href="plugins/speed/speed.min.css">

<script>



</script>
Heartbeat:
<div id="heartbeat"></div>
<div id=""></div>


<video id="youtube1" width="640" height="360">
    <source src="http://www.youtube.com/watch?v=nOEw9iiopwI" type="video/youtube">
</video>


<script>
    $(document).ready(function () {

        player = new MediaElementPlayer('youtube1', {

        });



    });


    var currentVideo = null;
    var player = null;

    function setValue(name, value) {
        $.post("setvalue", {name: name, value: value})
            .done(function (data) {
                //alert( "Data Loaded: " + data );
            });
    }
    $(document).ready(function () {
        $("input.heartbeat").change(function () {
            //$(this).val();

            $val = $("input.heartbeat:checked").val();
            setValue('heartbeat', $val);






            //alert($val);
        });

        $("input.lightswitch").change(function () {
            //$(this).val();

            $val = $("input.lightswitch:checked").val();

            switch (parseInt($val)) {
                case 1:
                    setValue('command', "FSOC066255");
                    break;
                case 2:
                    setValue('command', "FSOC067255");
                    break;
                case 3:
                    setValue('command', "FSOC068255");
                    break;
            }

            newVideo = currentVideo;
            switch (parseInt($val)) {
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
            //$('#heartbeat').html(data.heartbeat);

            if (newVideo != currentVideo) {
                console.log("need to play following video"+currentVideo);
                currentVideo = newVideo;
                var myVideoPlayer = player;
                console.log(myVideoPlayer);
                myVideoPlayer.media.youTubeApi.loadVideoById(currentVideo);
                myVideoPlayer.media.load();
                myVideoPlayer.media.play();
            }







            //alert($val);
        });


        $("#debugbutton").on('click', function () {
            var value = $('#debugvalue').val();
            console.log(value);
            setValue('command', value);
        });
    });
</script>

