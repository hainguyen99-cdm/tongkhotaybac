<?php
/**
 * This file includes the files and directories inside of ./inc folder.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trending_mag_inc_path = get_template_directory() . '/inc';

require_once "{$trending_mag_inc_path}/after-setup-theme.php";
require_once "{$trending_mag_inc_path}/breadcrumbs.php";
require_once "{$trending_mag_inc_path}/register-widget-areas.php";

require_once "{$trending_mag_inc_path}/template-tags.php";

require_once "{$trending_mag_inc_path}/customizer/customizer.php";

require_once "{$trending_mag_inc_path}/classes/class-trending-mag-load-assets.php";
require_once "{$trending_mag_inc_path}/classes/class-trending-mag-dynamic-assets.php";
require_once "{$trending_mag_inc_path}/classes/class-trending-mag-widget-post-lists.php";


require_once "{$trending_mag_inc_path}/template-functions/load-template-functions.php";

require_once "{$trending_mag_inc_path}/tgm-plugin/tgmpa-hook.php";
