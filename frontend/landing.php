<div id="dhaulagiri_plugin">
    <link href="<?php echo getMyPluginUrl() ?>static/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="<?php echo getMyPluginUrl() ?>calendar/css/bootstrap-year-calendar.css" rel="stylesheet"
          type="text/css">

    <div class="panel panel-default" style="margin-top:10px;">
        <div class="panel-heading">Calendar</div>
        <div class="panel-body">
            <div class="calendar-full"></div>
        </div>
    </div>

    <form method="post" action="<?php echo $nextPageUrl ?>" id="monthSelectForm">
        <input type="hidden" name="month" id="monthSelect"/>
        <input type="hidden" name="year" id="yearSelect"/>
    </form>

    <script src="<?php echo getMyPluginUrl() ?>static/jquery-1.11.3.min.js"></script>
    <script src="<?php echo getMyPluginUrl() ?>static/bootstrap.min.js"></script>
    <script src="<?php echo getMyPluginUrl() ?>calendar/js/bootstrap-year-calendar.js"></script>
    <script>
        $('.calendar-full').calendar({
            minDate: new Date(new Date().getFullYear(), 0, 1),
            maxDate: new Date(new Date().getFullYear(), 11, 31),
        });

        $(function(){
            $('.months-container div, .months-container div .old').click(function(event) {
                var parent = $(this).parents(".month-container");
                var monthSerial = parent.index();
                $("#monthSelect").val(monthSerial);
                $("#yearSelect").val(new Date().getFullYear());
                $("#monthSelectForm").submit();
            });
        });
    </script>
</div>