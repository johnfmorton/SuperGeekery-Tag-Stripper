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

	public function tagsToStrip($str = '')
	{
		$tags = $this->EE->TMPL->fetch_param('tags');
		$escapeChar = $this->EE->TMPL->fetch_param('escapeHTMLchars');
		$stripNbsp = $this->EE->TMPL->fetch_param('stripNbsp');
		$stripLineBreaks = $this->EE->TMPL->fetch_param('stripLineBreaks');

		if ($str == '')
		{
			$str = $this->EE->TMPL->tagdata;
		}

		$patterns = ' {</?(?:'.$tags.')+((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)/(?)>}';

		$replacements = '';

		$result = preg_replace($patterns, $replacements, $str);

		if ($stripNbsp == 'yes' || $stripNbsp == 'true')
		{
			$result = $this->strip_nbsp($result);
		}

		if ($escapeChar == 'true' || $escapeChar == 'yes')
		{
			$result = htmlspecialchars($result, ENT_QUOTES);
		}

		if ($stripLineBreaks == 'true' || $stripLineBreaks == 'yes')
		{
			$result = $this->strip_linebreaks($result);
		}

		return $result;
	}

	public function tagsToSave($str = '')
	{
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
			$str = $this->strip_nbsp($str);
		}

		$patterns = ' {</?\\w+(?<!'.$tags.')((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)/(?)>}';

		$replacements = '';

		$result = preg_replace($patterns, $replacements, $str);

		if ($escapeChar == 'true' || $escapeChar == 'yes')
		{
			$result = htmlspecialchars($result, ENT_QUOTES);
		}

		if ($stripLineBreaks == 'true' || $stripLineBreaks == 'yes')
		{
			$result = $this->strip_linebreaks($result);
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

		$patterns = '{</?\\w+((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)/(?)>}';

		$replacements = '';

		$result = preg_replace($patterns, $replacements, $str);

		if ($stripNbsp == 'yes' || $stripNbsp == 'true')
		{
			$result = $this->strip_nbsp($result);
		}

		if ($stripLineBreaks == 'true' || $stripLineBreaks == 'yes')
		{
			$result = $this->strip_linebreaks($result);
		}

		if ($escapeChar == 'true' || $escapeChar == 'yes')
		{
			$result = htmlspecialchars($result, ENT_QUOTES);
		}

		return $result;
	}

	public static function usage()
	{
		return Info::usage();
	}

	public static function versions()
	{
		return Info::versions();
	}

	private function strip_linebreaks($broken_string)
	{
		$clean_string = preg_replace('/[\r\n]+/', " ", $broken_string);
		$clean_string = preg_replace('/[ \t]+/', ' ', $clean_string);

		return $clean_string;
	}

	private function strip_nbsp($spaced_string)
	{
		return preg_replace('(&nbsp;)', '', $result);
	}
}
// END Tagstripper class

/* End of file pi.tagstripper.php */