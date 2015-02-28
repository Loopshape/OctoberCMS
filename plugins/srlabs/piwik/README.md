piwik-plugin
============

Piwik Analytics plugin for October CMS.  Inspired by the [Google Analytics Plugin]
(rainlab/googleanalytics-plugin) from RainLab


## Instructions

1. Install the plugin via the October CMS backend.
2. Add your site configuration details to the Piwik Plugin configuration page. (Under the 'Misc' section of the
System Settings page in the Backend.
3. Add the Piwik Component to your master layout. 'CMS' => 'Layouts' => 'default.html'.
4. Add ```{% component 'piwik' %}``` to the content of the default layout, preferably after your script
tags but before the closing ```</body>``` tag.
5.  Save the file.

You can also add the component to the file manually.  For Example:

	[piwik]
	==
	<html>
	<head>
		<title>{{ this.page.title }}</title>
		<meta name="author" content="October CMS">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	{% styles %}
    	<link href="{{ [
    	    'assets/css/theme.css'
    	]|theme }}" rel="stylesheet">
	</head>
	<body>
 		<header>
 			<h1>Header</h1>
 			<hr />
 		</header>

 		<!-- Content -->
        <section id="layout-content">
            {% page %}
        </section>

        <!-- Footer -->
        <footer id="layout-footer">
            {% partial "footer" %}
        </footer>

        <!-- Scripts -->
        <script src="{{ [
            'assets/js/jquery.js',
            'assets/js/app.js'
        ]|theme }}"></script>
        {% framework extras %}
        {% scripts %}
        {% component 'piwik' %}
	</body>
	</html>