# Cookie law banner
This plugin adds a 'Cookielawbanner' integration features to [OctoberCMS](http://octobercms.com).


### Available options: 
* **backgroundColor**: Color Background
* **textColor**: Text Color Background 
* **Duration**: Cookie Duration in days
* **Time**: Banner Display Duration 
* **Title**: Title on the message on the banner cookie law 
* **Text**: Message on the banner cookie law 
* **Textlink**: Message on the link
* **Link**:Link to page
* **Active**: Active 
* **Developer**: Development & Testing Mode



## Documentation
The plugin that provides simple 'Implied Consent' compliance with the EU Cookie Law (https://ico.org.uk/for_organisations/privacy_and_electronic_communications/the_guide/cookies). 

Full customisation and styling for the banner is available through the dedicated Settings page within the Admin Dashboard.

I initial release of the plugin also includes a helpful 'Testing/Development Mode' that keeps the banner in place on the front-end so that it can be styled and tested easily.
Full list of features and settings available:

    - Ready to use banner design that's both responsive and retina compatible.
    - Testing/Development mode for convenient testing and styling.
    - Set the number of days before the banner is shown again to the same user.
    - Set how many seconds the banner should be displayed for, before fading out.
    - Dynamically select and link your banner to an existing CMS page that elaborates on Privacy and Cookies.
    - Customise the short message displayed within the Cookie Banner.
    - Modify and choose to migrate the banner's default CSS onto your own stylesheet.


### Quickstart guide:
1. Go to the 'System' tab in October, and install the plugin using the **CGGStudio.Cookielawbanner** code.
2. After installation has finished a new component will appear in under Octobers 'CMS > Components' tab. You have the option to add this to only one page, or add it to a layout making it appear on all pages that use the layout. Whichever you chose the instructions are the same.
3. Open the your selected page/layout, and add the component to it. 
4. Add this small code anywhere on the page/layout: 
``` {% component 'Cookielawbanner' %} ``` Be sure to use the correct alias, if you haven't changed it, then it should be 'Cookielawbanner'. The position of the code doesn't really count, since the arrow has a fixed position.
5. That's it. You now have a working 'Cookielawbanner' button on your page. It has no outside dependencies, so you don't have to worry about anything else.

### Colors:
The Component requires you to add the hex color codes you prefer.
This free online application can help you with that: http://www.colorpicker.com/



