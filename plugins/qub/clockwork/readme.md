# Clockwork integration plugin

This plugin adds [Clockwork Developer Tools](https://github.com/itsgoingd/clockwork) integration plugin for [OctoberCMS](http://octobercms.com).

To add your controller's runtime to timeline, add following to your base controller's constructor:

```php
$this->beforeFilter(function()
{
	Event::fire('clockwork.controller.start');
});

$this->afterFilter(function()
{
	Event::fire('clockwork.controller.end');
});
```

Clockwork also comes with a facade, which provides an easy way to add records to the Clockwork log and events to the timeline. You can use alias:

```php
use Clockwork\Support\Laravel\Facade as Clockwork
```

Now you can use the following commands:

```php
Clockwork::startEvent('event_name', 'Event description.'); // event called 'Event description.' appears in Clockwork timeline tab

Clockwork::info('Message text.'); // 'Message text.' appears in Clockwork log tab
Log::info('Message text.'); // 'Message text.' appears in Clockwork log tab as well as application log file

Clockwork::info(array('hello' => 'world')); // logs json representation of the array
Clockwork::info(new Object()); // logs string representation of the objects if the object implements __toString magic method, logs json representation of output of toArray method if the object implements it, if neither is the case, logs json representation of the object cast to array

Clockwork::endEvent('event_name');
```

Also you can use functions inside a Twig template

```twig
{{ info(var) }} // appears in Clockwork log tab
{{ startEvent('event_name', 'Event description.') }} // event called 'Event description.' appears in Clockwork timeline tab
{{ endEvent('event_name') }}
```