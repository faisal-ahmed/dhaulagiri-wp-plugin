<div id="dhaulagiri_plugin_page_two">

    <div class="calendar-single"></div><br/><br/>

    <form method="post" action="<?php echo $form_booking_url ?>" id="monthSelectForm">
        <p>
            <a class="submit_style_link" href="#" onclick="window.history.back()">Back</a>&nbsp;&nbsp;
            <input type="submit" value="Book Your Date"/>
        </p>
    </form>

    <link href='<?php echo getMyPluginUrl() ?>fullcalendar/fullcalendar.css' rel='stylesheet' />
    <link href='<?php echo getMyPluginUrl() ?>fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src='<?php echo getMyPluginUrl() ?>fullcalendar/lib/moment.min.js'></script>
    <script src='<?php echo getMyPluginUrl() ?>fullcalendar/lib/jquery.min.js'></script>
    <script src='<?php echo getMyPluginUrl() ?>fullcalendar/fullcalendar.min.js'></script>
    <script>

        $(document).ready(function() {

            $('.calendar-single').fullCalendar({
                header: {
                    left: '',
                    center: 'title',
                    right: ''
                },
                defaultDate: new Date(new Date().getFullYear(), <?php echo $month ?>, 1),
                editable: true,
                eventLimit: true,
                events: [
                    <?php foreach ($results as $key => $result) { ?>
                        {
                            title: '<?php echo $result['group_name'] ?>',
                            start: '<?php list($dd, $mm, $yyyy) = explode("-", $result['trip_start']); echo "$yyyy-$mm-$dd"; ?>',
                            url: '<?php echo "$trekker_detail_url?g=" . $result['group_name']; ?>'
                        },
                    <?php } ?>
                ]
            });

        });

    </script>
</div>