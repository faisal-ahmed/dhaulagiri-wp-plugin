<!-- Bootstrap Core CSS -->
<link href="<?php echo getMyPluginUrl() ?>datatable/bower_components/bootstrap/dist/css/bootstrap.min.css"
      rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="<?php echo getMyPluginUrl() ?>datatable/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link
    href="<?php echo getMyPluginUrl() ?>datatable/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css"
    rel="stylesheet">

<!-- DataTables Responsive CSS -->
<!--<link
    href="<?php /*echo getMyPluginUrl() */?>datatable/bower_components/datatables-responsive/css/dataTables.responsive.css"
    rel="stylesheet">-->

<!-- Custom CSS -->
<link href="<?php echo getMyPluginUrl() ?>datatable/dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="<?php echo getMyPluginUrl() ?>datatable/bower_components/font-awesome/css/font-awesome.min.css"
      rel="stylesheet" type="text/css">

<script src="<?php echo getMyPluginUrl() ?>static/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.structure.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.theme.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>countrySelect/css/countrySelect.min.css"/>

<script src="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.min.js"></script>
<script src="<?php echo getMyPluginUrl() ?>countrySelect/js/countrySelect.min.js"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<?php if (isset($redirect_to)) { ?>
<script>
    setTimeout(function(){
        window.location.replace("<?php echo $redirect_to; ?>");
    }, 2000);
</script>
<?php } else { ?>
<div id="wrapper" style="padding: 10px; border-left: 0;">

    <div id="firstRow" class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 style="margin: 10px 5px;">Group Name: <?php echo $results[0]['group_name'] ?></h3>
                </div>
                <div class="panel-body">
                    <div class="images">
                        <h3 style="margin: 10px 5px;">Trekkers:</h3>
                        <?php foreach ($results as $key => $value) { ?>
                            <span class="chat-img pull-left">
                                <a href="javascript:void(0)" onclick="userDetail(<?php echo $value["id"]?>)">
                                    <img src="<?php echo $value["picture_url"]?>" alt="User Avatar" style="width: 100px; height: 100px; margin-right: 10px;" class="img-circle">
                                </a>
                            </span>
                        <?php } ?>
                    </div>
                </div>

                <?php foreach ($results as $key => $value) { ?>
                <div id="details<?php echo $value["id"]?>" class="panel panel-default" style="margin: 10px; display: none;">
                    <div class="panel-heading">
                        <strong>Trekker Name: <?php echo $value['full_name'] ?></strong>
                        <button onclick="closeCurrent();" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-4" style="text-align: center">
                            <img src="<?php echo $value["picture_url"]?>" alt="User Avatar" style="width: 80%; height: auto; margin-right: 10px;">
                        </div>
                        <div class="col-lg-8">
                            <div class="table-responsive">
                                <table class="table" style="margin-bottom: 0;">
                                    <tbody>
                                    <tr class="warning">
                                        <td style="width: 20%;">Nationality:</td>
                                        <td style="width: 80%;"><?php echo $value['nationality'] ?></td>
                                    </tr>
                                    <tr class="success">
                                        <td style="width: 20%;">Language:</td>
                                        <td style="width: 80%;"><?php echo $value['lang'] ?></td>
                                    </tr>
                                    <tr class="warning">
                                        <td style="width: 20%;">Age:</td>
                                        <td style="width: 80%;"><?php echo $value['age'] ?></td>
                                    </tr>
                                    <tr class="success">
                                        <td style="width: 20%;">Gender:</td>
                                        <td style="width: 80%;"><?php echo $value['gender'] ?></td>
                                    </tr>
                                    <tr class="warning">
                                        <td style="width: 20%;">Previous Hiking Experience:</td>
                                        <td><?php echo $value['prev_hiking_exp'] ?></td>
                                    </tr>
                                    <tr class="success">
                                        <td style="width: 20%;">Short Introduction:</td>
                                        <td style="width: 80%;"><?php echo $value['short_intro'] ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <strong>Group Details:</strong>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table" style="margin-bottom: 0;">
                                <tbody>
                                <tr class="danger">
                                    <td style="width: 20%;">Itinerary:</td>
                                    <td style="width: 80%;"><a target="_blank" href="<?php echo $itineraryPage ?>"><?php echo $results[0]['itinerary'] ?></a></td>
                                </tr>
                                <tr class="info">
                                    <td>Trip Start Date:</td>
                                    <td><?php echo $results[0]['trip_start'] ?></td>
                                </tr>
                                <tr class="danger">
                                    <td>Trip End Date:</td>
                                    <td><?php echo $results[0]['trip_end'] ?></td>
                                </tr>
                                <tr class="info">
                                    <td>Package:</td>
                                    <td><a target="_blank" href="<?php echo $packagePage ?>"><?php echo $results[0]['package'] ?></a></td>
                                </tr>
                                <tr class="danger">
                                    <td colspan="2"><a target="_blank" href="<?php echo $howItWorkPage ?>">How it works?</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <div>
                        <a class="submit_style_link" href="javascript:void(0)" onclick="window.history.back()" style="display: inline-block;">Back</a>&nbsp;&nbsp;
                        <a class="submit_style_link" href="javascript:void(0)" onclick="confirmRegistration();" style="display: inline-block;">Join This Group</a>&nbsp;&nbsp;
                        <a class="submit_style_link" href="<?php echo $form_booking_url ?>" style="display: inline-block;">Put Your Own Date</a>
                    </div>
                </div>
            </div>
        <!-- /.col-lg-12 -->
    </div>
    </div>
    <div id="secondRow" class="row" style="display: none;">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="group_name" value="<?php echo $results[0]['group_name'] ?>"/>
            <input type="hidden" name="itinerary" value="<?php echo $results[0]['itinerary'] ?>"/>
            <input type="hidden" name="package" value="<?php echo $results[0]['package'] ?>"/>
            <fieldset>
                <p>
                    <label for="full_name">Full Name:</label>
                    <input id="full_name" type="text" name="full_name" required/>
                </p>
                <p>
                    <label for="email">Email:</label>
                    <input id="email" type="email" name="email" required/>
                </p>
                <p>
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender" style="width: 35%;">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </p>
                <p>
                    <label for="picture">Picture of the Trekker:</label>
                    <input type="file" name="picture" id="picture" accept="image/*" required/>
                </p>
                <p>
                    <label for="age">Age:</label>
                    <input id="age" type="text" name="age" required/>
                </p>
                <p>
                    <label for="nationality">Nationality:</label><br/>
                    <input id="nationality" type="text" name="nationality" required/>
                </p>
                <p>
                    <label for="lang">Language:</label>
                    <input id="lang" type="text" name="lang" required/>
                </p>
                <p>
                    <label for="arriving_on">Arriving On:</label>
                    <input id="arriving_on" type="text" name="arriving_on" required/>
                </p>
                <p>
                    <label for="departing_on">Departing On:</label>
                    <input id="departing_on" type="text" name="departing_on" required/>
                </p>
                <p>
                    <label for="prev_hiking_exp">Previous Hiking Experience:</label>
                    <textarea id="prev_hiking_exp" name="prev_hiking_exp" required></textarea>
                </p>
                <p>
                    <label for="short_intro">Short Introduction:</label>
                    <textarea id="short_intro" name="short_intro" required></textarea>
                </p>
                <p>
                    <input type="submit" name="submit" id="submit" value="Confirm Registration"/>
                    <a class="submit_style_link" href="javascript:void(0)" onclick="confirmRegistration()">Cancel Registration</a>
                </p>
            </fieldset>
        </form>
    </div>
</div>
<?php } ?>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->

<script type="text/javascript">
    var currentSlideUp = '';
    var country = '';
    $(function() {
        $.get("http://ipinfo.io", function(response) {
            country = response.country;
            country = country.toLowerCase();

            $("#nationality").countrySelect({
                defaultCountry: country,
                //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                //preferredCountries: ['ca', 'gb', 'us', 'bd', 'np', 'in']
                preferredCountries: []
            });

        }, "jsonp");

        $( "#arriving_on" ).datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: 0
        });
        $( "#departing_on" ).datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: 0
        });
    });

    function userDetail(id){
        $("#details" + currentSlideUp).slideToggle();
        $("#details" + id).slideToggle();
        currentSlideUp = id;
    }

    function closeCurrent(){
        $("#details" + currentSlideUp).slideToggle();
        currentSlideUp = '';
    }

    function confirmRegistration(){
        $("#firstRow").slideToggle();
        $("#secondRow").slideToggle();
    }
</script>