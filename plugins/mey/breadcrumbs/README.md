Mey Breadcrumb Plugin
=====================

Breadcrumbs allows you to build out the your pages structure and render breadcrumbs.
Its easy to set up your pages to take advantage of the new breadcrumbs, once the
plugin is installed you can access all breadcrumb settings from the 'Breadcrumbs'
tab on the pages CMS editor.

The component is intended to be registered on a layout rather than individual pages.
The component will build out an `ol` of breadcrumbs based on the settings you choose.
Available settings on the page are as follows.

* Hide Breadcrumbs
    * This will stop the breadcrumbs from rendering on a per page basis.
    * Default: "No"
* Remove From Breadcrumbs
    * This will add the remove the selected page from the breadcrumb list.
    However the breadcrumb component will still render all children of the
    current page.
    * Default: "No"
* Disabled
    * Add a 'disabled' class to the current breadcrumb list item. Also disable
    the link to the page.
    * Default: "No"
* Crumb Title (Optional)
    * The title of the breadcrumb entry if different from the page title.
* Crumb Title From Id (Optional)
    * Set the crumb title text for the page to the value of a particular element id.
    This is helpful for pages that get their title from some other plugin (Blog for instance)
    set this field to the value of a unique id on the page which has the value you
    want to be displayed for the crumb. This overrides both page title, and the crumb
    title field.
* Child Of
    * The parent of the current page. This will be the next crumb in the breadcrumb
    list. Set to "None" to indicated that the page is a root crumb.
    * Default="None".

The are settings that can be altered on the component itself also. These settings
change the classes that appear on the component itself. Available settings are as
follows.

* Breadcrumb Class
    * The class of the top level list (ol)
* Item class
    * The class of the individual breadcrumb items (li)
* Active class
    * The class of the lowest level ie: current crumb (li)
* Disabled class
    * The class to be added to the breadcrumb item (li) when it is marked as disabled.

