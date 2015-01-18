<?php
/**
 * Javo Themes functions and definitions
 *
 *
 * @package WordPress
 * @subpackage Javo_House
 * @since Javo Themes 1.0
 */


@error_reporting(E_ALL);
@ini_set("log_errors", 1);
@ini_set("error_log", $_SERVER['DOCUMENT_ROOT']."/error.log");



// Path Initialize
$javo_appPath = pathinfo(__FILE__);
$javo_site_url = get_site_url();
define("JAVO_APP_PATH", $javo_appPath['dirname']);     // Get Theme Folder URL : hosting absolute path
define("JAVO_SITE_URL", $javo_site_url);
define("JAVO_THEME_DIR", get_template_directory_uri());   // Get http URL : ex) http://www.abc.com/
define("JAVO_SYS_DIR", JAVO_APP_PATH."/library");       // Get Library path
define("JAVO_TP_DIR", JAVO_APP_PATH."/templates");   // Get Tempate folder
define("JAVO_ADM_DIR", JAVO_SYS_DIR."/admin");   // Administrator Page
define("JAVO_SCS_DIR", JAVO_SYS_DIR."/shortcodes");   // Shortcodes folder
define("JAVO_IMG_DIR", JAVO_THEME_DIR."/images");   // Images folder
define("JAVO_WG_DIR", JAVO_SYS_DIR."/widgets");	// Widgets Folder
define("JAVO_HDR_DIR", JAVO_SYS_DIR."/header");	// Get Headers
define("JAV_CLS_DIR", JAVO_SYS_DIR."/classes");	// Classes

// Includes : Basic or default functions and included files
require_once JAVO_SYS_DIR."/define.php";        // defines
require_once JAVO_SYS_DIR."/load.php";      // loading functions, classes, shotcode, widgets
require_once JAVO_SYS_DIR."/enqueue.php";     // enqueue js, css
require_once JAVO_SYS_DIR."/wp_init.php";      // post-types, taxonomies
require_once JAVO_ADM_DIR."/theme-settings.php";   // theme options
require_once JAVO_ADM_DIR."/meta-options.php";   // theme screen options tab.

/* Custom code goes below this line. */