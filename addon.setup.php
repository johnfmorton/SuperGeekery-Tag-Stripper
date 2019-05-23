<?php if (!defined('BASEPATH')) { exit ('No direct script access allowed.'); };

require_once (PATH_THIRD . '/tagstripper/constants.php');
use Tagstripper\Constants;

return array(
    'author' => Constants::AUTHOR,
    'author_url' => Constants::AUTHOR_URL,
    'name' => Constants::NAME,
    'description' => Constants::DESCRIPTION,
    'version' => Constants::VERSION,
    'namespace' => 'Tagstripper'
);