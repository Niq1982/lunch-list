<?php

namespace LunchList;

class LunchList
{
    public array $days = [];

    public string $title;

    public function __construct($weekNumber, $year)
    {
        $lunchDays = is_array(apply_filters('lunch_list/set_lunch_days', [])) ? apply_filters('lunch_list/set_lunch_days', []) : [];

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

        $date = new \DateTime('midnight');
        $date = $date->setISODate($year, $weekNumber, 1);

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

        $count = 1;
        // Map lunch values to days
        foreach (array_keys($this->days) as $day) {
            $dateOfDay = $date->setISODate($year, $weekNumber, $count);
            $this->days[$day] = [
                'menu' => get_field($day, $lunchListPost),
                'date' => $dateOfDay->getTimestamp(),
            ];

            $count++;
        }
    }

    public function getDay($key)
    {
        return [
            'menu' => !empty($this->days[$key]['menu']) ? $this->days[$key]['menu'] : apply_filters('lunch_list/no_lunch', ''),
            'date' => $this->days[$key]['date'],
        ];
    }

    public function __get($key)
    {
        if (in_array($key, array_keys($this->days))) {
            return $this->getDay($key);
        }

        if ($key === 'today') {
            return $this->today() ?: apply_filters('lunch_list/no_lunch', '');
        }
    }

    public static function getTodaysLunch()
    {
        $lunchList = self::getThisWeeksLunchList();
        return $lunchList->today()['menu'];
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
