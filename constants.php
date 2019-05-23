<?php 

namespace JohnMorton\Tagstripper;

if (!defined('BASEPATH')) { 
    exit ('No direct script access allowed.');
}

class Constants {
    public const NAME = 'SuperGeekery Tag Stripper';

    public const AUTHOR = 'John Morton';

    public const AUTHOR_URL = 'https://supergeekery.com/';

    public const DESCRIPTION = 'Strips HTML tags, en masse, selectively, or by exception.';

    public const DOCS_URL = 'https://github.com/johnfmorton/SuperGeekery-Tag-Stripper';
    
    public const VERSION = '2.0.0-alpha';
}