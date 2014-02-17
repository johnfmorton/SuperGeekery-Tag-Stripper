# There are 3 primary ways to use The SuperGeekery Tag Stripper. 
	
## 1. **exp:tagstripper:stripAllTags**

Removes all HTML tags. Ignores all arguments passed in.
	
###BEFORE EXAMPLE (wrapped in the appropriate EE tag):
		
`{exp:tagstripper:stripAllTags}
<h1>Example of exp:tagstripper:stripAllTags</h1>
<h2>This is an h2 tag.</h2>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a>
<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
{/exp:tagstripper:stripAllTags}`
	
###AFTER EXAMPLE:
	
`Example of exp:tagstripper:stripAllTags
This is an h2 tag.
A photo of my computer.`
	
	
## 2. **exp:tagstripper:tagsToSave tags='h1|span|img'** 

Removes all HTML tags except those tags passed in through a 'tags' parameter. Multiple tags are passed in separated by the pipe | character, sometimes referred to as the OR operator. The 'tags' parameter is optional, so it in essence operates like exp:tagstripper:stripAllTags. The 'tags' parameter can also take a regexp range, for example, passing in 'h[1-3]' would strip out h1, h2, h3, but not touch h4, h5, etc.
	
###BEFORE EXAMPLE (wrapped in the appropriate EE tag):

`{exp:tagstripper:tagsToSave tags="h1"}
<h1>Example of exp:tagstripper:tagsToSave tags="h1"</h1>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a>
<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
{/exp:tagstripper:tagsToSave}`


###AFTER EXAMPLE:

`<h1>Example of exp:tagstripper:tagsToSave tags="h1"</h1>
A photo of my computer.`


## 3. **exp:tagstripper:tagsToStrip tags='img|a'**

Removes specified HTML tags passed in through a 'tags' parameter. Multiple tags are passed in separated by the pipe | character, sometimes referred to as the OR operator. The 'tags' parameter is optional, but if you're not going to strip out any tags, you probably should just not use this plug-in. :)

###BEFORE EXAMPLE (wrapped in the appropriate EE tag):

`{exp:tagstripper:tagsToStrip tags='img|a'}
<h1>Example of exp:tagstripper:tagsToStrip tags='img|a'</h1>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a>
<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
{/exp:tagstripper:tagsToStrip}`

###AFTER EXAMPLE:

`<h1>Example of exp:tagstripper:tagsToStrip tags='img|a'</h1>
A photo of my <strong>computer</strong>.`

Stripping the non-breaking space character.

###BEFORE EXAMPLE:

`{exp:tagstripper:stripAllTags stringNbsp='true'}
		<p>&nbsp;I don't need no stinking non-breaking space character.</p>
{/exp:tagstripper:stripAllTags}`

###AFTER EXAMPLE: 

`<p>I don't need no stinking non-breaking space character.</p>`


##HTML Special Character encoding.

Since this add-on is sometimes used to generate meta data, a lone quote mark, ' or ", can cause errors. You can use the 'escapeHTMLchars' by setting its value to 'true' (as of version 1.0.2 of SuperGeekery Tagstripper) to encode HTML special character to their HTML entities. The ampersand, double quote, single quote, less than, and greater than characters become &amp; , &quot; , &#039; , &lt; , and &gt; . 

###BEFORE EXAMPLE:

`{exp:tagstripper:stripAllTags escapeHTMLchars='true'}
	<h1>A foot is 12" long.</h1>
{/exp:tagstripper:stripAllTags}`

###AFTER EXAMPLE:

`A foot is 12&quot; long.`

##Removing the non-breaking space special characters from HTML

To any of the ExpressionEngine tags above, you may also add the 'stripNbsp' parameter set to 'true' or 'yes' to have the non-breaking space HTML entity removed from your text.

Version notes:

1.0.3 - supports removal of non-breaking space character
1.0.2 - support for NSM Addon Updater; 
		added HTML Special Character encoding
1.0.1 - cleaned up some code comments
1.0 - initial release