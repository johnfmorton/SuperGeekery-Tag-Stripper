<?php

namespace JohnMorton\Tagstripper;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once (__DIR__ . '/constants.php');
use JohnMorton\Tagstripper\Constants;

require_once (__DIR__ . '/info.php');
use JohnMorton\Tagstripper\Info;

class Tagstripper {
	public $return_data = '';
	
	private $instructions;
	
	private $tagdata = '';

	public function __construct()
	{
		$this->tagdata = ee()->TMPL->tagdata;
		$this->instructions = $this->fetch_instructions();
	}

	public function tagsToStrip($str = '')
	{
		if ($str == '')
		{
			$str = $this->tagdata;
		}

		$patterns = ' {</?(?:'.$this->instructions['tags'].')+((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)(/?)>}';

		$replacements = '';

		$result = preg_replace($patterns, $replacements, $str);

		$result = $this->execute_instructions($result);

		return $result;
	}

	public function tagsToSave($str = '')
	{
		if ($str == '')
		{
			$str = $this->tagdata;
		}

		$patterns = ' {</?\\w+(?<!'.$this->instructions['tags'].')((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)(/?)>}';

		$replacements = '';

		$result = preg_replace($patterns, $replacements, $str);

		$result = $this->execute_instructions($result);

		return $result;
	}

	public function stripAllTags($str = '')
	{
		if ($str == '')
		{
			$str = $this->tagdata;
		}

		$patterns = '{</?\\w+((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)(/?)>}';

		$replacements = '';

		$result = preg_replace($patterns, $replacements, $str);

		$result = $this->execute_instructions($result);

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

	private function escape_special_chars($input)
	{
		return htmlspecialchars($input, ENT_QUOTES);
	}

	private function execute_instructions($text)
	{
		$result = $text;

		if ($this->instructions['stripNbsp'] == 'yes' || $this->instructions['stripNbsp'] == 'true')
		{
			$result = $this->strip_nbsp($result);
		}

		if ($this->instructions['escapeChar'] == 'true' || $this->instructions['escapeChar'] == 'yes')
		{
			$result = $this->escape_special_chars($result);
		}

		if ($this->instructions['stripLineBreaks'] == 'true' || $this->instructions['stripLineBreaks'] == 'yes')
		{
			$result = $this->strip_linebreaks($result);
		}

		return $result;
	}

	private function fetch_instructions()
	{
		$instructions = array(
			'escapeChar' => ee()->TMPL->fetch_param('escapeHTMLchars'),
			'stripNbsp' => ee()->TMPL->fetch_param('stripNbsp'),
			'stripLineBreaks' => ee()->TMPL->fetch_param('stripLineBreaks'),
			'tags' => ee()->TMPL->fetch_param('tags')
		);

		return $instructions;
	}

	private function strip_linebreaks($input)
	{
		$output = preg_replace('/[\r\n]+/', " ", $input);
		$output = preg_replace('/[ \t]+/', ' ', $output);

		return $output;
	}

	private function strip_nbsp($input)
	{
		return preg_replace('(&nbsp;)', '', $input);
	}
}
// END Tagstripper class

/* End of file pi.tagstripper.php */