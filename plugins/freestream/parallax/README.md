Parallax plugin for OctoberCMS
=========

Manage and create multiple parallax sliders that you can view on any page.

Version
----

1.0.10

## How does it work?

The plugin creates a parallax by combining a selection of pages in your active theme. It can manage multiple parallax sliders that can be configured in it's own way.

## Implementation
Start with creating the pages you want in your parallax. `It's highly recommended that you have no layout create a new layout without the <html><header><body> blocks in the pages that will be used in your parallax due to it will otherwise create duplicate content`. After that go to the **Parallax** manager that is located in the top menu.

#### Manage paralaxes

Create a new parallax and start with giving it a name. The name will later be represented in a dropdown list of selectable parallaxes on the page that will hold the parallax. After that go to the **Pages** tab. Drag and drop all the pages you want to have in your parallax into the right square box called **Selected Pages**.

The selected page can be placed in two levels. The first level will create a vertical parallax and pages in a sub-level will create a horizontal slider. After the pages is selected save the parallax and to to **CMS** and the page that will hold the parallax.

#### Main page for the parallax

Add the component to the page and select a parallax from the dropdown.

##### Settings
There is a lot of settings that has been implemented. Read more about how these work on [fullPage].

* Vertical Centered
* Resize
* Scrolling Speed
* Menu
* Auto Scrolling
* Scroll Overflow
* CSS3
* Loop Bottom
* Loop Top
* Loop Horizontal
* Navigation
* NavigationPosition
* Slides Navigation
* Slides NavPosition
* Padding Top
* Padding Bottom
* Fixed Elements
* Normal Scroll Elements
* Normal Scroll Element Touch Threshold
* Keyboard Scrolling
* Touch Sensitivity
* Continuous Vertical
* Animate Anchor

##### Markup

The only thing that needs to be done is to add the component.

```php
{% component 'parallax' %}
```

Libraries
-----------

The plugin uses two JavaScript libraries.

* [FullPage] - A simple and easy to use plugin to create fullscreen scrolling websites.
* [Sortable] - Johnny have created a jQuery lib for nested sortable lists.

[fullPage]:https://github.com/alvarotrigo/fullPage.js
[sortable]:http://johnny.github.io/jquery-sortable/
