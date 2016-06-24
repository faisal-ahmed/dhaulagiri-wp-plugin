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

<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.structure.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.theme.min.css"/>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<div id="wrapper" style="padding: 10px; border-left: 0;">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Persons Applied for Trekking
                </div>

                <div class="panel-body" style="display: <?php echo isset($updated) ? "block" : "none"; ?>">
                    <div class="alert alert-success alert-dismissable" style="margin-bottom: 0;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Record has been updated successfully.
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table id="applicantList" class="table table-striped table-bordered table-hover" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th>Group Name</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Age</th>
                                    <th>Language</th>
                                    <th>Gender</th>
                                    <th>Nationality</th>
                                    <th>Arriving On</th>
                                    <th>Departing On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($results as $row => $result) { ?>
                                <tr class="gradeX" role="row">
                                    <td><?php echo $result['group_name'] ?></td>
                                    <td><?php echo $result['full_name'] ?></td>
                                    <td><?php echo $result['email'] ?></td>
                                    <td><?php echo $result['age'] ?></td>
                                    <td><?php echo $result['lang'] ?></td>
                                    <td><?php echo $result['gender'] ?></td>
                                    <td><?php echo $result['nationality'] ?></td>
                                    <td><?php echo $result['arriving_on'] ?></td>
                                    <td><?php echo $result['departing_on'] ?></td>
                                    <td>
                                        <a id="updateID<?php echo $result['id'] ?>" href="javascript:void(0);" onclick="update(<?php echo $result['id'] ?>)">Update Record</a>
                                    </td>
                                </tr>
                                <tr class="gradeX" role="row">
                                    <td colspan="10" style="padding: 0;">
                                        <form action="" method="post" id="statusForm">
                                            <input type="hidden" id="approve_status" name="approve_status" value="0">
                                            <input type="hidden" name="id" value="<?php echo $result['id'] ?>">
                                            <div style="display: none; padding: 8px;" id="update<?php echo $result['id'] ?>">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon" style="width: 120px;">Trip Start Date</span>
                                                <input type="text" class="form-control" name="trip_start" id="trip_start" placeholder="Trip Start Date" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon" style="width: 120px;">Trip End Date</span>
                                                <input type="text" class="form-control" name="trip_end" id="trip_end" placeholder="Trip End Date" required>
                                            </div>
                                            <p>
                                                <input type="submit" onclick="submitStatusForm(1);" class="btn btn-primary" value="Approve Applicant"/>
                                                <input type="submit" onclick="submitStatusForm(2);" class="btn btn-danger" value="Reject Applicant"/>
                                            </p>
                                        </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>

<!-- jQuery -->
<script src="<?php echo getMyPluginUrl() ?>datatable/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo getMyPluginUrl() ?>datatable/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo getMyPluginUrl() ?>datatable/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo getMyPluginUrl() ?>datatable/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo getMyPluginUrl() ?>datatable/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo getMyPluginUrl() ?>datatable/dist/js/sb-admin-2.js"></script>

<!--<script src="<?php /*echo getMyPluginUrl() */?>static/jquery-1.11.3.min.js"></script>-->
<script src="<?php echo getMyPluginUrl() ?>datepicker/jquery-ui.min.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#applicantList').DataTable({
            responsive: true
        });
        $( "#trip_start" ).datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: 0
        });
        $( "#trip_end" ).datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: 0
        });
    });

    function update(id){
        $("#update" + id).slideToggle();
    }

    function submitStatusForm(val){
        $("#approve_status").val(val);
    }
</script>
