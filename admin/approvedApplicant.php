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
                    Approved Applicants for Trekking
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
                                <th>Trip Starting On</th>
                                <th>Trip Ending On</th>
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

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#applicantList').DataTable({
            responsive: true
        });
    });
</script>
