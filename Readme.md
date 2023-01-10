# A lunch list plugin for WordPress

See this as a starting point for your own lunch list plugin. Clone and code yourself a nice lunch list. Plugin requires ACF to be installed in your site


## Adding lunch lists

This creates a custom post type for lunch lists. The lunch list for a certain week is resolved from the lunch list title: set the title as ISO week number / year. So for example use title `2/2023` to set the second week of year 2023 lunch list.

## Hooks

### Set the days when lunch is served
```php
add_filter('lunch_list/set_lunch_days', function ($days) {
    return [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
    ];
});
```

### Set the "no lunch served" text
```php
// Set a default text for a day that has no lunch
add_filter('lunch_list/no_lunch', function () {
    return '<p>No lunch served</p>';
});
```

## Template usage

### Get today's lunch

```php
<h2>Todays lunch:</h2>
<?php echo wp_kses_post(\LunchList\LunchList::getTodaysLunch()); ?>
```

### Get the current weeks lunch list

```php
<?php $lunchList = \LunchList\LunchList::getThisWeeksLunchList(); ?>
```

### Get a lunch list for certain week manually
```php
<?php $lunchList = new \LunchList\LunchList(2, 2023); ?>

<h2>Todays lunch</h2>
<?php echo wp_kses_post($lunchList->today); ?>

<h2>Wednesdays lunch</h2>
<?php echo wp_kses_post($lunchList->wednesday); ?>
```

## Blocks

There are two example blocks, the other is for displaying today's lunch, the other is for weekly lunch list. Build your own styles to make it fancier