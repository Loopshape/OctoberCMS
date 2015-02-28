# Twitter integration plugin

This plugin adds Twitter integration features to the [OctoberCMS](http://octobercms.com).

This plugin allows you to add the following Components to your pages and layouts:

- A Twitter Favourites list*
- A Twitter Follow Button
- A Twitter Tweet Button
- A Twitter Embedded Tweet area
- A Twitter Embedded Timeline area

* Requires OAuth security

## Configuring

Some features of Twitter use OAuth security. In order to use the plugin you need create a Twitter API application.

1. Go to the [Twitter Developers website](https://apps.twitter.com/) to create a new application. You must be signed into Twitter in order to access the page.
2. Click the Create New App button.
3. Enter any application name, for example October Twitter Integration.
4. Provide a description for the application.
5. Enter the website URL where the Twitter integration is going to be used.
6. Read and agree to the "Rules of the Road"
7. After the application is created, navigate to the API Keys tab and click the "Create my access token" button. Generating the access token could take some time. Keep refreshing the page until you see the "Your access token" section with the token and token secret strings.
8. Return to the October back-end and navigate to the Settings page. 
9. Click Twitter icon. Enter the API access information from the Twitter application page to the Twitter settings page in October.
10. Save the settings.

## Displaying favorite Twitter messages

The plugin includes a component Favorites that lets you to output your favorite twitter messages on a page. Add the component to your page and render it with the component tag:

```php
{% component 'twitterFavorites' %}
```

You can manage the number of favorite messages with the component settings. If you don't like the default favorite messages markup, don't use the component tag and just write your own code:

```php
{% for favorite in twitterFavorites.all %}
    <blockquote>“{{ favorite.text_processed|raw }}”</blockquote>

    <p class="author">
        <img src="{{ favorite.user.profile_image_url_https }}"/>
        <span>{{ favorite.user.name }}</span>
        <a href="{{ 'http://twitter.com/'~favorite.user.screen_name }}">@{{ favorite.user.screen_name }}</a>
    </p>
{% endfor %}
```

See [Twitter favorites API documentation](https://dev.twitter.com/docs/api/1.1/get/favorites/list) for the information about available fields.
