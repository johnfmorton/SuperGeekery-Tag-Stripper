<?php

namespace JohnMorton\Tagstripper;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once (__DIR__ . '/constants.php');
use JohnMorton\Tagstripper\Constants;

require_once (__DIR__ . '/info.php');
use JohnMorton\Tagstripper\Info;

class Tagstripper {
	public $return_data = "";

	public function Tagstripper($str = '')
	{
		// fetch the data between Stripper tags
		$this->EE =& get_instance();
	}

	public function tagsToStrip($str = '') {
		$tags = $this->EE->TMPL->fetch_param('tags');
		$escapeChar = $this->EE->TMPL->fetch_param('escapeHTMLchars');
		$stripNbsp = $this->EE->TMPL->fetch_param('stripNbsp');
		$stripLineBreaks = $this->EE->TMPL->fetch_param('stripLineBreaks');

		if ($str == '')
		{
			$str = $this->EE->TMPL->tagdata;
		}

		$patterns = ' {</?(?:'.$tags.')+((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)/?>}';

$replacements = '';

$result = preg_replace($patterns, $replacements, $str);

if ($stripNbsp == 'yes' || $stripNbsp == 'true')
{
$result = preg_replace('(&nbsp;)', '', $result);
}

if ($escapeChar == 'true' || $escapeChar == 'yes')
{
$result = htmlspecialchars($result, ENT_QUOTES);
}

if ($stripLineBreaks == 'true' || $stripLineBreaks == 'yes')
{
$result = preg_replace('/[\r\n]+/', " ", $result);
$result = preg_replace('/[ \t]+/', ' ', $result);
}

return $result;
}

public function tagsToSave($str = '') {
$tags = $this->EE->TMPL->fetch_param('tags');
$escapeChar = $this->EE->TMPL->fetch_param('escapeHTMLchars');
$stripNbsp = $this->EE->TMPL->fetch_param('stripNbsp');
$stripLineBreaks = $this->EE->TMPL->fetch_param('stripLineBreaks');

if ($str == '')
{
$str = $this->EE->TMPL->tagdata;
}

if ($stripNbsp == 'yes' || $stripNbsp == 'true')
{
$str = preg_replace('(&nbsp;)', '', $str);
}

$patterns = ' {</?\\w+(?<!'.$tags.')((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)/?>}';

$replacements = '';

$result = preg_replace($patterns, $replacements, $str);

if ($escapeChar == 'true' || $escapeChar == 'yes')
{
$result = htmlspecialchars($result, ENT_QUOTES);
}

if ($stripLineBreaks == 'true' || $stripLineBreaks == 'yes')
{
$result = preg_replace('/[\r\n]+/', " ", $result);
$result = preg_replace('/[ \t]+/', ' ', $result);
}

return $result;
}

public function stripAllTags($str = '')
{
$escapeChar = $this->EE->TMPL->fetch_param('escapeHTMLchars');
$stripNbsp = $this->EE->TMPL->fetch_param('stripNbsp');
$stripLineBreaks = $this->EE->TMPL->fetch_param('stripLineBreaks');

if ($str == '')
{
$str = $this->EE->TMPL->tagdata;
}

$patterns = '{</?\\w+((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)/?>}';

$replacements = '';

$result = preg_replace($patterns, $replacements, $str);

if ($stripNbsp == 'yes' || $stripNbsp == 'true')
{
$result = preg_replace('(&nbsp;)', '', $result);
}

if ($stripLineBreaks == 'true' || $stripLineBreaks == 'yes')
{
$result = preg_replace('/[\r\n]+/', " ", $result);
$result = preg_replace('/[ \t]+/', ' ', $result);
}

if ($escapeChar == 'true' || $escapeChar == 'yes')
{
$result = htmlspecialchars($result, ENT_QUOTES);
}

return $result;
}

public static function usage() {
return Info::usage();
}

public static function versions() {
return Info::versions();
}
}
// END Tagstripper class

$plugin_info = array(
'pi_name' => Constants::NAME,
'pi_version' => Constants::VERSION,
'pi_author' => Constants::AUTHOR,
'pi_author_url' => Constants::AUTHOR_URL,
'Documentation' => '<a href="'.Constants::DOCS_URL.'">'.Constants::DOCS_URL."</a>",
'pi_description' => Constants::DESCRIPTION,
'pi_usage' => Tagstripper::usage(),
'Versions' => Tagstripper::versions()
);
/* End of file pi.tagstripper.php */