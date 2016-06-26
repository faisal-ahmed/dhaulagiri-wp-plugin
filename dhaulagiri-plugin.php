<?php
/*
Plugin Name: Dhaulagiri Trekking
Description: Custom Trekking Plugin for Dhaulagiri
Version: 0.1 BETA
Author: Mohammad Faisal Ahmed
*/

if ( ! defined( 'ABSPATH' ) )
    exit;

global $DB_TABLE;
global $the_page_title_list;
global $the_shortcode_content_list;

$DB_TABLE = "dhaulagiri_trekkers";
$the_page_title_list = array('Dhaulagiri Check Availability', 'Dhaulagiri Book Your Date', 'Dhaulagiri Trekkers Detail');
$the_shortcode_content_list = array('Dhaulagiri-Check-Availability', 'Dhaulagiri-Book-Your-Date', 'Dhaulagiri-Trekkers-Detail');


/* Runs when plugin is activated */
register_activation_hook(__FILE__,'dhaulagiri_plugin_install');

function dhaulagiri_plugin_install(){
    global $wpdb;

    //Create DB Tables
    create_db_tables();

    // Create Necessary Pages ---- Start //

    //Page: Check Availability
    //Page: Book Your Date
    //Page: Trekkers Detail
    global $the_page_title_list;
    global $the_shortcode_content_list;

    foreach ($the_page_title_list as $key => $the_page_title) {
        $the_shortcode_content = $the_shortcode_content_list[$key];
        $the_page = get_page_by_title($the_page_title);

        if (!$the_page) {

            // Create post object
            $_p = array();
            $_p['post_title'] = $the_page_title;
            $_p['post_content'] = "[$the_shortcode_content]";
            $_p['post_status'] = 'publish';
            $_p['post_type'] = 'page';
            $_p['comment_status'] = 'closed';
            $_p['ping_status'] = 'closed';
            $_p['post_category'] = array(1); // the default 'Uncatrgorised'

            // Insert the post into the database
            $the_page_id = wp_insert_post($_p);

        } else {
            // the plugin may have been previously active and the page may just be trashed...
            $the_page_id = $the_page->ID;

            //make sure the page is not trashed...
            $the_page->post_status = 'publish';
            $the_page_id = wp_update_post($the_page);

        }

        add_option("$the_shortcode_content", $the_page_id);
    }
    // Create Necessary Pages ---- End //
}

function create_db_tables(){
    global $wpdb;
    global $DB_TABLE;

    // create the ECPT metabox database table
    if($wpdb->get_var("show tables like '$DB_TABLE'") != $DB_TABLE)
    {
        $sql = "CREATE TABLE " . $DB_TABLE . " (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`full_name` VARCHAR(255) NOT NULL,
		`email` VARCHAR(255) NOT NULL,
		`picture_url` text,
		`nationality` VARCHAR(255),
		`group_name` VARCHAR(255),
		`age` VARCHAR(255),
		`lang` VARCHAR(255),
		`gender` VARCHAR(255),
		`arriving_on` VARCHAR(255),
		`departing_on` VARCHAR(255),
		`prev_hiking_exp` text,
		`short_intro` text,
		`itinerary` VARCHAR(255),
		`package` VARCHAR(255),
		`trip_start` VARCHAR(255),
		`trip_end` VARCHAR(255),
		`approved` VARCHAR(255) DEFAULT '0',
		UNIQUE KEY id (id)
		);";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}


function frontendUtils(){
    wp_enqueue_style('dhaulagiri-plugin', getMyPluginUrl() . "frontend/style.css");
    wp_enqueue_style('dhaulagiri-plugin-bootstrap', getMyPluginUrl() . "static/bootstrap.min.css");
}

function adminUtils(){
    wp_enqueue_style('dhaulagiri-plugin', getMyPluginUrl() . "style.css");
}

add_action( 'admin_menu', 'dhaulagiri_admin_menu' );

function dhaulagiri_admin_menu() {
    add_menu_page( 'Dhaulagiri Trekking', 'Dhaulagiri Trekking', 'manage_options', 'dhaulagiri-trekking', 'dhaulagiri_options', 'dashicons-tickets', 6 );
    add_submenu_page( 'dhaulagiri-trekking', 'Trekker Applications', 'Trekker Applications', 'manage_options', 'dhaulagiri-trekking/trekking_applicant.php', 'list_applicants' );
    add_submenu_page( 'dhaulagiri-trekking', 'Approved Applications', 'Approved Trekkers', 'manage_options', 'dhaulagiri-trekking/approved_applicant.php', 'approved_applicants' );
}

function dhaulagiri_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    adminUtils();
    include ("admin/adminOptions.php");
}

function list_applicants() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    global $wpdb;
    global $DB_TABLE;

    if (isset($_REQUEST['approve_status'])) {
        /*$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $DB_TABLE WHERE approved = 1 AND group_name = '%s'", $_REQUEST['group_name']), ARRAY_A);

        if (count($results) > 0) {
            foreach ($results as $key => $value) {
                $message = "A new member just joined";
            }
        }*/

        $data = array(
            'trip_start' => $_REQUEST['trip_start'],
            'trip_end' => $_REQUEST['trip_end'],
            'approved' => $_REQUEST['approve_status'],
        );
        $wpdb->update( $DB_TABLE, $data, array('id' => $_REQUEST['id']) );
    }

    $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $DB_TABLE WHERE approved = 0"), ARRAY_A);

    echo '<div class="wrap">';
    echo '<p><h2>The Applicants</h2></p>';
    include ("admin/listApplicant.php");
    echo '</div>';
}

function approved_applicants() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    global $wpdb;
    global $DB_TABLE;

    $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $DB_TABLE WHERE approved = 1"), ARRAY_A);

    echo '<div class="wrap">';
    echo '<p><h2>The Applicants</h2></p>';
    include ("admin/approvedApplicant.php");
    echo '</div>';
}

function getMyPluginUrl(){
    return plugins_url() . "/dhaulagiri-plugin/";
}

/* For frontend --- Start */
add_shortcode("Dhaulagiri_Trekkers", "dhaulagiri_trekkers_func");

function dhaulagiri_trekkers_func() {
    frontendUtils();
    $nextPageUrl = get_permalink(get_option("Dhaulagiri-Check-Availability"));
    ob_start();
    include ("frontend/landing.php");
    return ob_get_clean();
}

add_shortcode("Dhaulagiri-Trekker-Home-Section", "dhaulagiri_trekkers_home_page");

function dhaulagiri_trekkers_home_page() {
    frontendUtils();
    $trekker_detail_url = get_permalink(get_option("Dhaulagiri-Trekkers-Detail"));
    global $wpdb;
    global $DB_TABLE;

    $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $DB_TABLE WHERE approved = 1"), ARRAY_A);

    ob_start();
    include ("frontend/homePage.php");
    return ob_get_clean();
}

add_shortcode("Dhaulagiri-Check-Availability", "dhaulagiri_trekkers_availability");

function dhaulagiri_trekkers_availability() {
    frontendUtils();
    $form_booking_url = get_permalink(get_option("Dhaulagiri-Book-Your-Date"));
    $trekker_detail_url = get_permalink(get_option("Dhaulagiri-Trekkers-Detail"));
    $month = $_REQUEST['month'];
    $monthForDB = $month+1;
    $year = $_REQUEST['year'];
    if ($monthForDB < 10) {
        $monthForDB = "0$monthForDB";
    }
    if (!isset($year) || $year == '' || $year == NULL){
        $year = date("Y");
    }
    global $wpdb;
    global $DB_TABLE;

    $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $DB_TABLE WHERE approved = 1 AND trip_start LIKE %s group by group_name", "%-$monthForDB-$year"), ARRAY_A);

    ob_start();
    include ("frontend/availability.php");
    return ob_get_clean();
}

add_shortcode("Dhaulagiri-Book-Your-Date", "dhaulagiri_trekkers_date_booking");

function dhaulagiri_trekkers_date_booking() {
    frontendUtils();
    $form_booking_url = get_permalink(get_option("Dhaulagiri-Book-Your-Date"));
    $trekker_detail_url = get_permalink(get_option("Dhaulagiri-Trekkers-Detail"));
    $termsConditionPage = get_permalink( get_option("dhaulagiri_terms_conditions_page_id") );
    if ($_REQUEST['booking'] == 'Y'){
        insert_data_into_db();
        $redirect_to =  get_option("dhaulagiri_paypal_button");
        echo "<h3>" . get_option("dhaulagiri_registration_instructions") . "</h3>";
    }
    ob_start();
    include ("frontend/form.php");
    return ob_get_clean();
}

add_shortcode("Dhaulagiri-Trekkers-Detail", "dhaulagiri_trekkers_trekker_detail");

function dhaulagiri_trekkers_trekker_detail() {
    frontendUtils();
    $form_booking_url = get_permalink(get_option("Dhaulagiri-Book-Your-Date"));
    $trekker_detail_url = get_permalink(get_option("Dhaulagiri-Trekkers-Detail"));
    $itineraryPage = get_permalink( get_option("dhaulagiri_itinerary_page_id") );
    $packagePage = get_permalink( get_option("dhaulagiri_package_page_id") );
    $howItWorkPage = get_permalink( get_option("dhaulagiri_how_it_work_page_id") );
    $PaymentDescriptionPage = get_permalink( get_option("dhaulagiri_payment_condition_page_id") );
    global $wpdb;
    global $DB_TABLE;

    if (isset($_REQUEST['group_name'])) {
        insert_data_into_db();
        $redirect_to =  get_option("dhaulagiri_paypal_button");
        echo "<h3>" . get_option("dhaulagiri_registration_instructions") . "</h3>";
    } else {
        $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $DB_TABLE WHERE approved = 1 AND group_name = '%s'", $_REQUEST['g']), ARRAY_A);
    }

    ob_start();
    include ("frontend/group_detail.php");
    return ob_get_clean();
}

function insert_data_into_db(){
    global $wpdb;
    global $DB_TABLE;

    $principal_applicant_picture_url = '';
    if (isset($_FILES['picture'])) {
        $file = wp_upload_bits($_FILES['picture']['name'], null, @file_get_contents($_FILES['picture']['tmp_name']));
        if (FALSE === $file['error']) {
            $principal_applicant_picture_url = $file['url'];
        }
    }

    $wpdb->insert($DB_TABLE, array(
        'group_name' => $_REQUEST['group_name'],
        'full_name' => $_REQUEST['full_name'],
        'email' => $_REQUEST['email'],
        'gender' => $_REQUEST['gender'],
        'itinerary' => $_REQUEST['itinerary'],
        'package' => $_REQUEST['package'],
        'picture_url' => $principal_applicant_picture_url,
        'age' => $_REQUEST['age'],
        'nationality' => $_REQUEST['nationality'],
        'lang' => $_REQUEST['lang'],
        'arriving_on' => $_REQUEST['arriving_on'],
        'departing_on' => $_REQUEST['departing_on'],
        'prev_hiking_exp' => $_REQUEST['prev_hiking_exp'],
        'short_intro' => $_REQUEST['short_intro'],
    ));

    if (trim($_REQUEST['additionalMember']) != '') {
        $additionalMember = explode(",", trim($_REQUEST['additionalMember']));

        foreach ($additionalMember as $key => $value) {
            $applicant_picture_url = '';
            if (isset($_FILES["picture$value"])) {
                $file = wp_upload_bits($_FILES["picture$value"]['name'], null, @file_get_contents($_FILES["picture$value"]['tmp_name']));
                if (FALSE === $file['error']) {
                    $applicant_picture_url = $file['url'];
                }
            }

            $wpdb->insert($DB_TABLE, array(
                //Group Common
                "group_name" => $_REQUEST["group_name"],
                'itinerary' => $_REQUEST['itinerary'],
                'package' => $_REQUEST['package'],
                'lang' => $_REQUEST['lang'],
                'arriving_on' => $_REQUEST['arriving_on'],
                'departing_on' => $_REQUEST['departing_on'],

                //Personal Info
                "full_name" => $_REQUEST["full_name$value"],
                "email" => $_REQUEST["email$value"],
                "gender" => $_REQUEST["gender$value"],
                "nationality" => $_REQUEST["nationality$value"],
                "picture_url" => $applicant_picture_url,
                "age" => $_REQUEST["age$value"],
                "prev_hiking_exp" => $_REQUEST["prev_hiking_exp$value"],
                "short_intro" => $_REQUEST["short_intro$value"],
            ));
        }
    }
}

/* For frontend --- End */