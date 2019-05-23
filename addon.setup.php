<?php if (!defined('BASEPATH')) { exit ('No direct script access allowed.'); };

require_once (PATH_THIRD . '/tagstripper/config.php');

return array(
    'author' => $config['author'],
    'author_url' => $config['author_url'],
    'name' => $config['name'],
    'description' => $config['description'],
    'version' => $config['version'],
    'namespace' => 'Tagstripper'
);