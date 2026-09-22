<?php
/**
 * Loader stub. WordPress only auto-loads files placed directly in
 * mu-plugins/, not files inside subfolders - so this stub is what actually
 * gets picked up, and it requires the real plugin from its own folder.
 *
 * Deploy both this file AND the human-review-widgets/ folder directly
 * inside wp-content/mu-plugins/.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/human-review-widgets/human-review-widgets.php';
