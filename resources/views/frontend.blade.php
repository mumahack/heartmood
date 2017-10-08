<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script>

    function yourFunction(){
        // do whatever you like here
        $.getJSON('getvalue', function (data) {
            $('#heartbeat').html( data.heartbeat);
        });

        setTimeout(yourFunction, 1000);
    }




    $(document).ready(function () {
        yourFunction();
    });
</script>
Heartbeat:
<div id="heartbeat"></div>
<div id=""></div>