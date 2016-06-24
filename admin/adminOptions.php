<?php
$updateMsg = 0;
if (isset($_REQUEST['update']) && $_REQUEST['update'] == 'Y') {
    update_option("dhaulagiri_registration_instructions", $_REQUEST['dhaulagiri_registration_instructions']);
    update_option("dhaulagiri_itinerary_options", $_REQUEST['dhaulagiri_itinerary_options']);
    update_option("dhaulagiri_package_options", $_REQUEST['dhaulagiri_package_options']);
    update_option("dhaulagiri_terms_conditions", $_REQUEST['dhaulagiri_terms_conditions']);
    update_option("dhaulagiri_paypal_button", $_REQUEST['dhaulagiri_paypal_button']);
    update_option("dhaulagiri_itinerary_page_id", $_REQUEST['dhaulagiri_itinerary_page_id']);
    update_option("dhaulagiri_package_page_id", $_REQUEST['dhaulagiri_package_page_id']);
    update_option("dhaulagiri_how_it_work_page_id", $_REQUEST['dhaulagiri_how_it_work_page_id']);
    $updateMsg = 1;
}
?>
<h1>Common settings for Dhaulagiri Trekkers:</h1>
<?php if ($updateMsg) { ?>
    <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
        <p><strong>Settings saved.</strong></p>
        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span>
        </button>
    </div>
<?php } ?>
<form action="" method="post" id="dhaulagiri_option_form">
    <input type="hidden" name="update" value="Y"/>

    <div>
        <label>Instruction For the Thank You Page:</label><br/>
        <textarea name="dhaulagiri_registration_instructions" cols="100"
                  rows="10"><?php echo get_option("dhaulagiri_registration_instructions", "") ?></textarea>
    </div>
    <div>
        <label>Itinerary Options (Enter each option with &lt;option&gt;&lt;/option&gt;):</label><br/>
        <textarea name="dhaulagiri_itinerary_options" cols="100"
                  rows="10"><?php echo get_option("dhaulagiri_itinerary_options", "") ?></textarea>
    </div>
    <div>
        <label>Package Options (Enter each option with &lt;option&gt;&lt;/option&gt;):</label><br/>
        <textarea name="dhaulagiri_package_options" cols="100"
                  rows="10"><?php echo get_option("dhaulagiri_package_options", "") ?></textarea>
    </div>
    <div>
        <label>Terms & Condition:</label><br/>
        <textarea name="dhaulagiri_terms_conditions" cols="100"
                  rows="10"><?php echo get_option("dhaulagiri_terms_conditions", "") ?></textarea>
    </div>
    <div>
        <label>Paypal Button URL:</label><br/>
        <textarea name="dhaulagiri_paypal_button" cols="100"
                  rows="10"><?php echo get_option("dhaulagiri_paypal_button", "") ?></textarea>
    </div>
    <div>
        <label>Itinerary Page ID:</label><br/>
        <input name="dhaulagiri_itinerary_page_id" value="<?php echo get_option("dhaulagiri_itinerary_page_id", "") ?>"/>
    </div>
    <div>
        <label>Package Page ID:</label><br/>
        <input name="dhaulagiri_package_page_id" value="<?php echo get_option("dhaulagiri_package_page_id", "") ?>"/>
    </div>
    <div>
        <label>"How It Work" Page ID:</label><br/>
        <input name="dhaulagiri_how_it_work_page_id" value="<?php echo get_option("dhaulagiri_how_it_work_page_id", "") ?>"/>
    </div>
    <?php submit_button(); ?>
</form>
<hr/>