<?php

namespace LunchList;

use LunchList\LunchListDay;

class LunchList
{
    public array $days = [];

    public string $title;

    public function __construct($weekNumber, $year)
    {
        // Get lunchdays to show from filter
        $lunchDays = is_array(apply_filters('lunch_list/set_lunch_days', [])) ? apply_filters('lunch_list/set_lunch_days', []) : [];

        // Filter the days according to the result
        $this->days = array_filter(
            [
                'monday' => null,
                'tuesday' => null,
                'wednesday' => null,
                'thursday' => null,
                'friday' => null,
                'saturday' => null,
                'sunday' => null,
            ],
            function ($day) use ($lunchDays) {
                return in_array($day, $lunchDays);
            },
            ARRAY_FILTER_USE_KEY
        );

        // Get rid of prepending zeros etc
        $weekNumber = intval($weekNumber);
        $year = intval($year);

        // Set the date to the week number
        $date = new \DateTime('midnight');
        $date = $date->setISODate($year, $weekNumber, 1);

        // Set the list title
        $this->title = "{$weekNumber}/{$year}";

        // Get the lunch list by week number and year
        $lunchListPost = get_page_by_title($this->title, OBJECT, 'lunch_list');

        // Check if ACF exists
        if (!function_exists('get_field')) {
            throw new \WP_Error('ACF is not installed');
        }

        $count = 1;

        // Map lunch values to days
        foreach (array_keys($this->days) as $day) {
            $this->days[$day] = new LunchListDay();
            $this->days[$day]->menu = $lunchListPost ? get_field($day, $lunchListPost) : false;
            $this->days[$day]->date = \DateTime::createFromInterface($date->setISODate($year, $weekNumber, $count));
            $count++;
        }
    }

    public function __get($key)
    {
        if (in_array($key, array_keys($this->days))) {
            return $this->days[$key];
        }

        if ($key === 'today') {
            return $this->today();
        }
    }

    public static function getTodaysLunch()
    {
        $lunchList = self::getThisWeeksLunchList();
        return $lunchList->today()->menu;
    }

    public static function getThisWeeksLunchList()
    {
        $date = new \DateTime('midnight');
        return new static($date->format('W'), $date->format('o'));
    }

    public function today()
    {
        $date = new \DateTime('midnight');
        return $this->days[strtolower($date->format('l'))];
    }
}
