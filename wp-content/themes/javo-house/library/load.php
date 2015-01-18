<?php
	// bootstrap navigation walker for menus
	require_once JAVO_SYS_DIR."/functions/wp_bootstrap_navwalker.php";

	/** Ajax Process **/
	require_once "process.php";

	/** Shortcodes **/
	require_once JAVO_SCS_DIR."/sc-javo-main-search.php";
	require_once JAVO_SCS_DIR."/sc-properties.php";
	require_once JAVO_SCS_DIR."/sc-javo-property.php";
	require_once JAVO_SCS_DIR."/sc-agents.php";
	require_once JAVO_SCS_DIR."/sc-main-jumbotron.php";
	require_once JAVO_SCS_DIR."/sc-javo-property-fancy.php";
	require_once JAVO_SCS_DIR."/sc-javo-item-price.php";

	/** Widgets **/
	require_once JAVO_WG_DIR."/wg-javo-search.php";
	require_once JAVO_WG_DIR."/wg-javo-recent-post.php";
	require_once JAVO_WG_DIR."/wg-javo-recent-photos.php";
	require_once JAVO_WG_DIR."/wg-javo-contact-us.php";

	/** Admin Panel **/
	require_once JAVO_ADM_DIR."/post-meta-box.php";
	require_once JAVO_ADM_DIR."/edit-post-list-column.php";
	require_once JAVO_ADM_DIR."/javo-custom-tax.php";

	/** Classes **/
	require_once JAV_CLS_DIR."/list-view-button.php";
	require_once JAV_CLS_DIR."/javo-post-class.php";
	require_once JAV_CLS_DIR."/javo_array.php";
	require_once JAV_CLS_DIR."/javo-get-option.php";