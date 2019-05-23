<?php if (!defined('BASEPATH')) { exit ('No direct script access allowed.'); }

/**
* SuperGeekery TagStripper Config file
*
* @package			tagstripper-addon
* @version			1.1.0-alpha
* @author			John F Morton <john@johnfmorton.com>
* @link				http://supergeekery.com/geekblog/comments/expression_engine_2_plugin_supergeekery_tag_stripper_version_1.0
* @license			http://creativecommons.org/licenses/by-sa/3.0/
*/

if ( ! defined('TAG_STRIPPER_NAME')) {
	define('TAG_STRIPPER_NAME', 'SuperGeekery Tag Stripper');
	define('TAG_STRIPPER_AUTHOR', 'John Morton');
	define('TAG_STRIPPER_AUTHOR_URL', 'http://supergeekery.com/');
	define('TAG_STRIPPER_DESCRIPTION', 'Strips HTML tags, en masse, selectively, or by exception.');
	define('TAG_STRIPPER_PACKAGE', 'tagstripper');
	define('TAG_STRIPPER_VERSION', '1.1.0-alpha');
	define('TAG_STRIPPER_DOCS', 'https://github.com/johnfmorton/SuperGeekery-Tag-Stripper');
}

$config['name'] = TAG_STRIPPER_NAME;
$config['author'] = TAG_STRIPPER_AUTHOR;
$config['author_url'] = TAG_STRIPPER_AUTHOR_URL;
$config['description'] = TAG_STRIPPER_DESCRIPTION;
$config['version'] = TAG_STRIPPER_VERSION;
$config['docs'] = TAG_STRIPPER_DOCS;