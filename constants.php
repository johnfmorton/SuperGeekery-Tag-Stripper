<?php 

namespace JohnMorton\Tagstripper;

if (!defined('BASEPATH')) { 
    exit ('No direct script access allowed.');
}

/**
* SuperGeekery TagStripper Config file
*
* @package			tagstripper-addon
* @version			1.1.0-alpha
* @author			John F Morton <john@johnfmorton.com>
* @link				http://supergeekery.com/geekblog/comments/expression_engine_2_plugin_supergeekery_tag_stripper_version_1.0
* @license			http://creativecommons.org/licenses/by-sa/3.0/
*/
class Constants 
{
    const NAME = 'SuperGeekery Tag Stripper';

    const AUTHOR = 'John Morton';

    const AUTHOR_URL = 'https://supergeekery.com/';

    const DESCRIPTION = 'Strips HTML tags, en masse, selectively, or by exception.';

    const DOCS_URL = 'https://github.com/johnfmorton/SuperGeekery-Tag-Stripper';
    
    const VERSION = '2.0.0-alpha';
}