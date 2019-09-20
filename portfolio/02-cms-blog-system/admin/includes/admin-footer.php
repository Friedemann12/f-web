</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>
    var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(div_box);
    $('#load-screen').delay(700).fadeOut(600, function () {
        $(this).remove();
    });
</script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    function loadUserOnline() {
        $.get("includes/functions.php?onlineusers=result", function (data) {

            $(".usersonline").text(data);

        })

    }

    setInterval(function () {

        loadUserOnline();


    }, 500);
</script>

</body>

</html>
