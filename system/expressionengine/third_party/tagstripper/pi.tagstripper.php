<?php

/*
=====================================================

SG Tag Stripper
a plug-in for ExpressionEngine 2
by John Morton
v1.02

inspired by (and pretty much directly ripped from) the Javascript "ify" version
by Dustin Diaz
>> http://www.dustindiaz.com/basement/ify.html

also uses John Gruber's URL-matching regex
>> http://daringfireball.net/2009/11/liberal_regex_for_matching_urls

email Michael with questions, feedback, suggestions, bugs, etc.
>> michael@michaelrog.com

=====================================================

Change log

v. 1.0.2

Added support for encoding of HTML special characters
Added support for NSM Addon Updater

v. 1.0.1

Minor clean up of comments

v. 1.0.0

Initial release


*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
						'pi_name'			=> 'SuperGeekery Tag Stripper',
						'pi_version'		=> '1.0.2',
						'pi_author'			=> 'John Morton',
						'pi_author_url'		=> 'http://supergeekery.com/',
						'pi_description'	=> 'Strips HTML tags, en masse, selectively, or by exception.',
						'pi_usage'			=> Tagstripper::usage()
					);

class Tagstripper {

var $return_data = "";

  function Tagstripper($str = '')
  {
	// fetch the data between Stripper tags
	$this->EE =& get_instance();
  }
	
	function tagsToStrip($str = '') {
		$tags = $this->EE->TMPL->fetch_param('tags');
		$escapeChar = $this->EE->TMPL->fetch_param('escapeHTMLchars');
		
		if ($str == '')
	    {
	      $str = $this->EE->TMPL->tagdata;
	    }
	
		$patterns = ' {</?(?:'.$tags.')+((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)/?>}';

		$replacements = '';
		
		$result = preg_replace($patterns, $replacements, $str);
		
		if ($escapeChar == 'true')
		{
			$result = htmlspecialchars($result, ENT_QUOTES);
		}
		
		return $result;
		
	}
	
	function tagsToSave($str = '') {
		$tags = $this->EE->TMPL->fetch_param('tags');
		$escapeChar = $this->EE->TMPL->fetch_param('escapeHTMLchars');
		
		if ($str == '')
	    {
	      $str = $this->EE->TMPL->tagdata;
	    }
			
		$patterns = ' {</?\\w+(?<!'.$tags.')((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)/?>}';
		
		$replacements = '';
		
		$result = preg_replace($patterns, $replacements, $str);
		
		if ($escapeChar == 'true')
		{
			$result = htmlspecialchars($result, ENT_QUOTES);
		}
		
		return $result;
		//return $patterns;
	}
	
	function stripAllTags($str = '')
	{
		$escapeChar = $this->EE->TMPL->fetch_param('escapeHTMLchars');
		if ($str == '')
	    {
	      $str = $this->EE->TMPL->tagdata;
	    }
	
		/*$patterns = ' /<[^<]+?>/i';*/
		$patterns = '{</?\\w+((\\s+\\w+(\\s*=\\s*(?:\".*?\"|\'.*?\'|[^\'\">\\s]+))?)+\\s*|\\s*)/?>}';
		
		$replacements = '';
		
		$result = preg_replace($patterns, $replacements, $str);
		
		if ($escapeChar)
		{
			$result = htmlspecialchars($result, ENT_QUOTES);
		}
		
		return $result;
	}
	
	/** ----------------------------------------
	/**  Plugin Usage
	/** ----------------------------------------*/
	function usage()
	{
	ob_start(); 
	?>

	There are 3 primary ways to use The SuperGeekery Tag Stripper. 
	
	1. exp:tagstripper:stripAllTags - Removes all HTML tags. Ignores all arguments passed in.
	
		BEFORE EXAMPLE (wrapped in the appropriate EE tag):
		
		{exp:tagstripper:stripAllTags}
		<h1>Example of exp:tagstripper:stripAllTags</h1>
		<h2>This is an h2 tag.</h2>
		<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a>
		<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
		{/exp:tagstripper:stripAllTags}
	
		AFTER EXAMPLE:
	
		Example of exp:tagstripper:stripAllTags
		This is an h2 tag.
		A photo of my computer.
	
	
	2. exp:tagstripper:tagsToSave tags='h1|span|img' - Removes all HTML tags except those tags passed in through a 'tags' parameter. Multiple tags are passed in separated by the pipe | character, sometimes referred to as the OR operator. The 'tags' parameter is optional, so it in essence operates like exp:tagstripper:stripAllTags. The 'tags' parameter can also take a regexp range, for example, passing in 'h[1-3]' would strip out h1, h2, h3, but not touch h4, h5, etc.
	
		BEFORE EXAMPLE (wrapped in the appropriate EE tag):
		
		{exp:tagstripper:tagsToSave tags="h1"}
		<h1>Example of exp:tagstripper:tagsToSave tags="h1"</h1>
		<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a>
		<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
		{/exp:tagstripper:tagsToSave}
	
	
		AFTER EXAMPLE:
		
		<h1>Example of exp:tagstripper:tagsToSave tags="h1"</h1>
		A photo of my computer.
	
	
	3. exp:tagstripper:tagsToStrip tags='img|a'- Removes specified HTML tags passed in through a 'tags' parameter. Multiple tags are passed in separated by the pipe | character, sometimes referred to as the OR operator. The 'tags' parameter is optional, but if you're not going to strip out any tags, you probably should just not use this plug-in. :)
	
		BEFORE EXAMPLE (wrapped in the appropriate EE tag):
		
		{exp:tagstripper:tagsToStrip tags='img|a'}
		<h1>Example of exp:tagstripper:tagsToStrip tags='img|a'</h1>
		<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a>
		<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
		{/exp:tagstripper:tagsToStrip}
	
		AFTER EXAMPLE:
		
		<h1>Example of exp:tagstripper:tagsToStrip tags='img|a'</h1>
		A photo of my <strong>computer</strong>.
		
	HTML Special Character encoding.
	
	Since this add-on is sometimes used to generate meta data, a lone quote mark, ' or ", can cause errors. You can use the 'escapeHTMLchars' by setting its value to 'true' (as of version 1.0.2 of SuperGeekery Tagstripper) to encode HTML special character to their HTML entities. The ampersand, double quote, single quote, less than, and greater than characters become &amp; , &quot; , &#039; , &lt; , and &gt; . 
		
		BEFORE EXAMPLE:
		
		{exp:tagstripper:stripAllTags escapeHTMLchars='true'}
			<h1>A foot is 12" long.</h1>
		{/exp:tagstripper:stripAllTags}
		
		AFTER EXAMPLE:
		
		A foot is 12&quot; long.
		
		Version notes:
		
		1.0.2 - support for NSM Addon Updater; 
				added HTML Special Character encoding
		1.0.1 - cleaned up some code comments
		1.0 - initial release
		
	<?php
	$buffer = ob_get_contents();
	
	ob_end_clean(); 

	return $buffer;
	}

} // END Tagstripper class

/* End of file pi.tagstripper.php */ 
/* Location: ./system/expressionengine/third_party/tagstripper/pi.tagstripper.php */