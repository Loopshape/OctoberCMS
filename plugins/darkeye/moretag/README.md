#_"More"_ Tag support for October CMS
Plugin for October CMS that provides a Twig filter to implement a "ReadMore" tag.

##Installation
1. Check out this repository to the `plugins` directory of your October setup.
2. Exist and login again at the backend to refresh October's plugin cache.

Or you can get it seamessly installed in your October project visiting the [October Marketplace](http://octobercms.com/plugin/darkeye-moretag "More Tag Plugin").

##Usage
Insert the _More_ tag into your blog posts, articles... like:
```
Blah blah introduction to the topic...
<!--more Continue Reading-->
More text here that only will be seen when displaying the full article...
```
And apply the `untilMore` Twig filter on you layout, partial or page:
```
<p class="excerpt">{{ post.content_html|untilMore('post'|page({'slug': post.slug})) }}</p>
```
which results in:  

Blah blah introduction to the topic...  
<a href="">Continue Reading</a>
##Features
######Custom link message
The message to appear at the end of the introductory text is customizable at the time of writing the own text. Inserting whatever message you want after the **more** word.  
```
<!--more MESSAGE-->
```
If no message is supplied the link will not be visible.

######Custom link destination
The page to which the _Read More_ link has to point can be set by passing the URL to the argument of the `untilMore` filter.
```
post.content_html|untilMore(URL)
```
If no URL is supplied then an ellipsis is shown.