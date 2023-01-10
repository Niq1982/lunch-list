<?php

namespace LunchList;

class LunchListDay
{
    public \DateTime $date;
    private string $menu;

    public function __set($key, $value)
    {
        if ($key === 'menu') {
            $this->menu = $value;
            return;
        }
    }

    public function __get($key)
    {
        if ($key === 'menu') {
            return !empty($this->menu) ? $this->menu : apply_filters('lunch_list/no_lunch', '');
        }
    }

    public function formattedDate($format)
    {
        return \wp_date($format, $this->date->getTimestamp());
    }
}
