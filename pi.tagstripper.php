<?php

namespace JohnMorton\Tagstripper;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once (PATH_THIRD.'tagstripper/constants.php');
use JohnMorton\Tagstripper\Constants;

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

/** ----------------------------------------
** Plugin Usage
** ----------------------------------------*/
public static function usage()
{
ob_start();
?>

There are 3 primary ways to use The SuperGeekery Tag Stripper.

1. exp:tagstripper:stripAllTags - Removes all HTML tags. Ignores all arguments passed in.

BEFORE EXAMPLE (wrapped in the appropriate EE tag):

{exp:tagstripper:stripAllTags}
<h1>Example of exp:tagstripper:stripAllTags</h1>
<h2>This is an h2 tag.</h2>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo
	of my <strong>computer</strong>.</a>
<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75"
	alt="My Monitors Rock" />
{/exp:tagstripper:stripAllTags}

AFTER EXAMPLE:

Example of exp:tagstripper:stripAllTags
This is an h2 tag.
A photo of my computer.


2. exp:tagstripper:tagsToSave tags='h1|span|img' - Removes all HTML tags except those tags passed in through a 'tags'
parameter. Multiple tags are passed in separated by the pipe | character, sometimes referred to as the OR operator.
The 'tags' parameter is optional, so it in essence operates like exp:tagstripper:stripAllTags. The 'tags' parameter
can also take a regexp range, for example, passing in 'h[1-3]' would strip out h1, h2, h3, but not touch h4, h5, etc.

BEFORE EXAMPLE (wrapped in the appropriate EE tag):

{exp:tagstripper:tagsToSave tags="h1"}
<h1>Example of exp:tagstripper:tagsToSave tags="h1"</h1>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo
	of my <strong>computer</strong>.</a>
<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75"
	alt="My Monitors Rock" />
{/exp:tagstripper:tagsToSave}


AFTER EXAMPLE:

<h1>Example of exp:tagstripper:tagsToSave tags="h1"</h1>
A photo of my computer.


3. exp:tagstripper:tagsToStrip tags='img|a'- Removes specified HTML tags passed in through a 'tags' parameter.
Multiple tags are passed in separated by the pipe | character, sometimes referred to as the OR operator. The 'tags'
parameter is optional, but if you're not going to strip out any tags, you probably should just not use this plug-in.
:)

BEFORE EXAMPLE (wrapped in the appropriate EE tag):

{exp:tagstripper:tagsToStrip tags='img|a'}
<h1>Example of exp:tagstripper:tagsToStrip tags='img|a'</h1>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo
	of my <strong>computer</strong>.</a>
<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75"
	alt="My Monitors Rock" />
{/exp:tagstripper:tagsToStrip}

AFTER EXAMPLE:

<h1>Example of exp:tagstripper:tagsToStrip tags='img|a'</h1>
A photo of my <strong>computer</strong>.



## Stripping the non-breaking space character.

BEFORE EXAMPLE:

{exp:tagstripper:stripAllTags stringNbsp='true'}
<p>&nbsp;I don't need no stinking non-breaking space character.</p>
{/exp:tagstripper:stripAllTags}

AFTER EXAMPLE:

<p>I don't need no stinking non-breaking space character.</p>



## HTML Special Character encoding.

Since this add-on is sometimes used to generate meta data, a lone quote mark, ' or ", can cause errors. You can use
the 'escapeHTMLchars' by setting its value to 'true' (as of version 1.0.2 of SuperGeekery Tagstripper) to encode HTML
special character to their HTML entities. The ampersand, double quote, single quote, less than, and greater than
characters become &amp; , &quot; , &#039; , &lt; , and &gt; .

BEFORE EXAMPLE:

{exp:tagstripper:stripAllTags escapeHTMLchars='true'}
<h1>A foot is 12" long.</h1>
{/exp:tagstripper:stripAllTags}

AFTER EXAMPLE:

A foot is 12&quot; long.



## Removing the non-breaking space special characters from HTML

To any of the ExpressionEngine tags above you may also add the ‘stripNbsp’ parameter set to ‘true’ or ‘yes’ to have
the non-breaking space HTML entity removed from your text.

Stripping the non-breaking space character.

BEFORE EXAMPLE:

{exp:tagstripper:stripAllTags stripNbsp='true'}
<p>&nbsp;I don't need no stinking non-breaking space character.</p>
{/exp:tagstripper:stripAllTags}

AFTER EXAMPLE:

I don't need no stinking non-breaking space character.
Removing line breaks from text

To any of the ExpressionEngine tags above you may also add the ‘stringLineBreaks’ parameter set to ‘true’ or ‘yes’ to
have the line breaks removed. This is helpful if you stripped all the paragraph tags but also wanted to remove the
line breaks that might still be in the text. This is useful for automated meta data generation.

BEFORE EXAMPLE

{exp:tagstripper:stripAllTags stripLineBreaks='true'}
<p>I don't need no stinking paragraph tags removed which leave left over line breaks.</p>
<p>Line breaks can make for messy meta data.</p>
<h2>I say, <em>Out!</em></h2>
{/exp:tagstripper:stripAllTags}

AFTER EXAMPLE:

I don't need no stinking paragraph tags removed which leave left over line breaks. Line breaks can make for messy meta
data. I say, Out!

<?php
	$buffer = ob_get_contents();
	
	ob_end_clean(); 

	return $buffer;
	}

	public static function versions()
	{
	ob_start(); 
	?>
Version notes:

<p>1.0.5 - Added option to remove line breaks</p>
<p>1.0.4 - FIXED removal of non-breaking space character</p>
<p>1.0.3 - Supports removal of non-breaking space character</p>
<p>1.0.2 - Support for NSM Addon Updater; Added HTML Special Character encoding</p>
<p>1.0.1 - Cleaned up some code comments</p>
<p>1.0 - Initial release</p>

<?php
	$buffer = ob_get_contents();
	
	ob_end_clean(); 

	return $buffer;
	}

} // END Tagstripper class

/*
=====================================================

SG Tag Stripper
a plug-in for ExpressionEngine 2
by John Morton
v1.06

inspired by (and pretty much directly ripped from) the Javascript "ify" version
by Dustin Diaz
>> http://www.dustindiaz.com/basement/ify.html

also uses John Gruber's URL-matching regex
>> http://daringfireball.net/2009/11/liberal_regex_for_matching_urls

email Michael with questions, feedback, suggestions, bugs, etc.
>> michael@michaelrog.com

=====================================================

Change log

v. 1.0.6 (2015 FEB 9)

Updated functions to "public static function" to prevent PHP warnings.

v. 1.0.5 (2014 FEB 17)

Remove line breaks option added.

v. 1.0.4 (2014 FEB 17)

Fixed broken non breaking space removal. Doh.

v. 1.0.3 (2012 NOV 16)

Added support for stripping out non breaking space characters that
can be generated by some WYSWYG systems

v. 1.0.2

Added support for encoding of HTML special characters
Added support for NSM Addon Updater

v. 1.0.1

Minor clean up of comments

v. 1.0.0

Initial release


*/
$plugin_info = array(
	'pi_name'			=> Constants::NAME,
	'pi_version'		=> Constants::VERSION,
	'pi_author'			=> Constants::AUTHOR,
	'pi_author_url'		=> Constants::AUTHOR_URL,
	'Documentation'	    => '<a href="'.Constants::DOCS_URL.'">'.Constants::DOCS_URL."</a>",
	'pi_description'	=> Constants::DESCRIPTION,
	'pi_usage'			=> Tagstripper::usage(),
	'Versions'			=> Tagstripper::versions()
);
/* End of file pi.tagstripper.php */ 
/* Location: ./system/expressionengine/third_party/tagstripper/pi.tagstripper.php */