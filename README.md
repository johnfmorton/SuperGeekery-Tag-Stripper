# SuperGeekery Tag Stripper

Inspired by (and pretty much directly ripped from) the Javascript "ify" version by Dustin Diaz <http://www.dustindiaz.com/basement/ify.html>.

Also uses John Gruber's URL-matching regex <http://daringfireball.net/2009/11/liberal_regex_for_matching_urls>

Email Michael with questions, feedback, suggestions, bugs, etc. michael@michaelrog.com

## Installation

1. From your project's addon directory (e.g., `system/user/addons/`), clone the project as `tagstripper`. Note that the plugin directory must be named "tagstripper" to work.

## There are 3 primary ways to use The SuperGeekery Tag Stripper

### 1\. **exp:tagstripper:stripAllTags**

Removes all HTML tags. Ignores all arguments passed in.

#### BEFORE EXAMPLE (wrapped in the appropriate EE tag)

```mustache
{exp:tagstripper:stripAllTags}
<h1>Example of exp:tagstripper:stripAllTags</h1>
<h2>This is an h2 tag.</h2>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a>
<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
{/exp:tagstripper:stripAllTags}
```

#### AFTER EXAMPLE

```mustache
Example of exp:tagstripper:stripAllTags
This is an h2 tag.
A photo of my computer.
```

### 2\. **exp:tagstripper:tagsToSave tags='h1|span|img'**

Removes all HTML tags except those tags passed in through a 'tags' parameter. Multiple tags are passed in separated by the pipe | character, sometimes referred to as the OR operator. The 'tags' parameter is optional, so it in essence operates like exp:tagstripper:stripAllTags. The 'tags' parameter can also take a regexp range, for example, passing in 'h[1-3]' would strip out h1, h2, h3, but not touch h4, h5, etc.

#### BEFORE EXAMPLE (wrapped in the appropriate EE tag)

```mustache
{exp:tagstripper:tagsToSave tags="h1"}
<h1>Example of exp:tagstripper:tagsToSave tags="h1"</h1>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a>
<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
{/exp:tagstripper:tagsToSave}
```

#### AFTER EXAMPLE

```mustache
<h1>Example of exp:tagstripper:tagsToSave tags="h1"</h1>
A photo of my computer.
```

### 3\. **exp:tagstripper:tagsToStrip tags='img|a'**

Removes specified HTML tags passed in through a 'tags' parameter. Multiple tags are passed in separated by the pipe | character, sometimes referred to as the OR operator. The 'tags' parameter is optional, but if you're not going to strip out any tags, you probably should just not use this plug-in. :)

#### BEFORE EXAMPLE (wrapped in the appropriate EE tag)

```mustache
{exp:tagstripper:tagsToStrip tags='img|a'}
<h1>Example of exp:tagstripper:tagsToStrip tags='img|a'</h1>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a>
<img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
{/exp:tagstripper:tagsToStrip}
```

#### AFTER EXAMPLE

```mustache
<h1>Example of exp:tagstripper:tagsToStrip tags='img|a'</h1>
A photo of my <strong>computer</strong>.
```

### HTML Special Character encoding

Since this add-on is sometimes used to generate meta data, a lone quote mark, ' or ", can cause errors. You can use the 'escapeHTMLchars' by setting its value to 'true' (as of version 1.0.2 of SuperGeekery Tagstripper) to encode HTML special character to their HTML entities. The ampersand, double quote, single quote, less than, and greater than characters become & , " , ' , < , and > .

#### BEFORE EXAMPLE

```mustache
{exp:tagstripper:stripAllTags escapeHTMLchars='true'}
    <h1>A foot is 12" long.</h1>
{/exp:tagstripper:stripAllTags}
```

#### AFTER EXAMPLE

```mustache
A foot is 12" long.
```

### Removing the non-breaking space special characters from HTML

To any of the ExpressionEngine tags above you may also add the 'stripNbsp' parameter set to 'true' or 'yes' to have the non-breaking space HTML entity removed from your text.

Stripping the non-breaking space character.

#### BEFORE EXAMPLE

```mustache
{exp:tagstripper:stripAllTags stripNbsp='true'}
    <p> I don't need no stinking non-breaking space character.</p>
{/exp:tagstripper:stripAllTags}
```

#### AFTER EXAMPLE

```mustache
I don't need no stinking non-breaking space character.
```

### Removing line breaks from text

To any of the ExpressionEngine tags above you may also add the 'stringLineBreaks' parameter set to 'true' or 'yes' to have the line breaks removed. This is helpful if you stripped all the paragraph tags but also wanted to remove the line breaks that might still be in the text. This is useful for automated meta data generation.

#### BEFORE EXAMPLE

```mustache
{exp:tagstripper:stripAllTags stripLineBreaks='true'}
    <p>I don't need no stinking paragraph tags removed which leave left over line breaks.</p>
    <p>Line breaks can make for messy meta data.</p>
    <h2>I say, <em>Out!</em></h2>
{/exp:tagstripper:stripAllTags}
```

#### AFTER EXAMPLE

```mustache
I don't need no stinking paragraph tags removed which leave left over line breaks. Line breaks can make for messy meta data. I say, Out!
```

## Version notes

1.0.5

- added support to remove line breaks

1.0.4

- fixed non-breaking space function
- added better documentation for non-breaking space

1.0.3

- supports removal of non-breaking space character

1.0.2

- support for NSM Addon Updater
- added HTML Special Character encoding

1.0.1

- cleaned up some code comments

1.0

- initial release
