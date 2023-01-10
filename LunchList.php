<?php

namespace LunchList;

class LunchList
{
    public array $days = [
        'monday' => false,
        'tuesday' => false,
        'wednesday' => false,
        'thursday' => false,
        'friday' => false,
        'saturday' => false,
        'sunday' => false,
    ];

    public string $title;

    public function __construct($weekNumber, $year)
    {
        // Get rid of prepending zeros etc
        $weekNumber = intval($weekNumber);
        $year = intval($year);

        $this->title = "{$weekNumber}/{$year}";
        // Get the lunch list by week number and year
        $lunchListPost = get_page_by_title($this->title, OBJECT, 'lunch_list');
        if (!$lunchListPost) {
            return;
        }

        // Check if ACF exists
        if (!function_exists('get_field')) {
            return;
        }

        // Map lunch values to days
        foreach (array_keys($this->days) as $day) {
            $this->days[$day] = get_field($day, $lunchListPost);
        }
    }

    public function __get($key)
    {
        if (in_array($key, array_keys($this->days))) {
            return $this->days[$key] ?: apply_filters('lunch_list_no_lunch', '');
        }

        if ($key === 'today') {
            return $this->today() ?: apply_filters('lunch_list_no_lunch', '');;
        }
    }

    public static function getTodaysLunch()
    {
        $lunchList = self::getThisWeeksLunchList();
        return $lunchList->today();
    }

    public static function getThisWeeksLunchList()
    {
        $date = new \DateTime();
        return new static($date->format('W'), $date->format('o'));
    }

    public function today()
    {
        $date = new \DateTime();
        return $this->days[strtolower($date->format('l'))];
    }
}
