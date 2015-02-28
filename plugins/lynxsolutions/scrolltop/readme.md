# Scroll To Top Plugin

This plugin adds a 'Scroll to top' integration features to [OctoberCMS](http://octobercms.com).

## Details

### Available options: 
* **Speed**: Time in milliseconds it takes for the scroll to end
* **Size**: Size of the button in pixels
* *Position Options*
  * **Position**: Where you want to button to appear( bottom-right/bottom-left/top-right/top-left )
  * **Unit**: The measurement unit you want to use to position the button
  * **Units from Left/Right**: Units from the Side (right or left, depending on your selection of positioning)
  * **Units from Top/Bottom**: Units from Top/Bottom (depending on your selection of positioning)
* *Color Options*:
  * **Arrow Color**: CSS color attribute of the arrow
  * **Arrow Hover Color**: CSS color attribute of the arrow when the user hovers over it
  * **Background Color**: CSS color attribute of the background
  * **Background Hover Color**: CSS color attribute of the background when the user hovers over it

## Documentation
It is a pretty simple plugin, so not much to talk about. It adds the **scrollToTop** object to the page, which contains all the information the Component needs to function as you customized it.

### Quickstart guide:
1. Go to the 'System' tab in October, and install the plugin using the **LynxSolutions.Scrolltop** code.
2. After installation has finished a new component will appear in under Octobers 'CMS > Components' tab. You have the option to add this to only one page, or add it to a layout making it appear on all pages that use the layout. Whichever you chose the instructions are the same.
3. Open the your selected page/layout, and add the component to it. 
4. Add this small code anywhere on the page/layout: 
``` {% component 'ScrollTop' %} ``` Be sure to use the correct alias, if you haven't changed it, then it should be 'ScrollTop'. The position of the code doesn't really count, since the arrow has a fixed position.
5. That's it. You now have a working 'Scroll to Top' button on your page. It has no outside dependencies, so you don't have to worry about anything else.

### Colors:
The Component requires you to add the hex color codes you prefer.
This free online application can help you with that: http://www.colorpicker.com/