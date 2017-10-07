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
                            <input id="TriSeaDefault" name="TriSea1" type="radio" value="1"/>
                            <label for="TriSeaDefault" class="label-success"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Heartbeat Normal
                        <div class="TriSea-technologies-Switch pull-right">
                            <input id="TriSeaPrimary" name="TriSea1" type="radio" value="2"/>
                            <label for="TriSeaPrimary" class="label-success"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Heartbeat Fast
                        <div class="TriSea-technologies-Switch pull-right">
                            <input id="TriSeaSuccess" name="TriSea1" type="radio" value="3"/>
                            <label for="TriSeaSuccess" class="label-success"></label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("input[type='radio']").change(function () {
            //$(this).val();

            $val = $("input[name='TriSea1']:checked").val();
            $.post("setvalue", {name: "heartbeat", value: $val})
                .done(function (data) {
                    //alert( "Data Loaded: " + data );
                });


            //alert($val);
        });
    });
</script>
