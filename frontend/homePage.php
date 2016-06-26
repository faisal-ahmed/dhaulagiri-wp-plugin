<script src="<?php echo getMyPluginUrl() ?>jcarousel/jquery.jcarousel.min.js"></script>
<!-- Shared assets -->
<!--<link rel="stylesheet" type="text/css" href="<?php /*echo getMyPluginUrl() */?>jcarousel/examples/_shared/css/style.css">-->

<!-- Example assets -->
<link rel="stylesheet" type="text/css" href="<?php echo getMyPluginUrl() ?>jcarousel/examples/ajax/jcarousel.ajax.css">

<script type="text/javascript" src="<?php echo getMyPluginUrl() ?>jcarousel/vendor/jquery/jquery.js"></script>
<script type="text/javascript" src="<?php echo getMyPluginUrl() ?>jcarousel/dist/jquery.jcarousel.min.js"></script>

<script type="text/javascript" src="<?php echo getMyPluginUrl() ?>jcarousel/examples/ajax/jcarousel.ajax.js"></script>

<div class="panel-body">
    <div class="images">
        <div class="jcarousel-wrapper">
            <div class="jcarousel">
                <ul style="left: 0; top: 0;"><li></li>
                    <?php foreach ($results as $key => $value) { ?>
                        <li>
                            <a target="_blank" href="<?php echo $trekker_detail_url ?>?g=<?php echo $value['group_name'] ?>">
                                <img src="<?php echo $value["picture_url"] ?>" alt="User Avatar" style="width: 150px; height: 150px;">
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
            <a href="#" class="jcarousel-control-next">&rsaquo;</a>
        </div>
    </div>
</div>

