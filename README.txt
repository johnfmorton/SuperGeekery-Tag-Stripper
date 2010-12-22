To install the SuperGeekery Tag Stripper, place the folder 'tagstripper' in the following folder:

/system/expressionengine/third_party/

Example usage:

This code...


{exp:tagstripper:stripAllTags}
<h1>Example of exp:tagstripper:stripAllTags</h1>
<h2>This is an h2 tag.</h2> <a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a> <img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock"/> 
{/exp:tagstripper:stripAllTags}


will result in...


This is an h2 tag. A photo of my computer.




Another example:

This code...


{exp:tagstripper:tagsToSave tags="h1"}
<h1>Example of exp:tagstripper:tagsToSave tags="h1"</h1>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a> <img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
{/exp:tagstripper:tagsToSave}


will result in...


<h1>Example of exp:tagstripper:tagsToSave tags="h1"</h1>
A photo of my computer.


Another example:

This code...


{exp:tagstripper:tagsToStrip tags='img|a'}
<h1>Example of exp:tagstripper:tagsToStrip tags='img|a'</h1>
<a href="http://www.flickr.com/photos/morton/3969410575/" title="My Monitors Rock by John Morton, on Flickr">A photo of my <strong>computer</strong>.</a> <img src="http://farm3.static.flickr.com/2609/3969410575_0987891ac7_t.jpg" width="100" height="75" alt="My Monitors Rock" />
{/exp:tagstripper:tagsToStrip}


will result in...


<h1>Example of exp:tagstripper:tagsToStrip tags='img|a'</h1>
A photo of my <strong>computer</strong>.



The homepage of the project is:
http://supergeekery.com/geekblog/comments/expression_engine_2_plugin_supergeekery_tag_stripper_version_1.0

The Devot-ee page of this project is:
http://devot-ee.com/add-ons/supergeekery-tag-stripper/

The GITHub page of this project is:
https://github.com/johnfmorton/SuperGeekery-Tag-Stripper