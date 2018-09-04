<?php
namespace Calendar;


use DateTimeInterface;

class Calendar implements CalendarInterface
{
    private $dateTime;

    /**
     * @param DateTimeInterface $dateTime
     */
    public function __construct(DateTimeInterface $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * Get the day
     *
     * @return int
     */
    public function getDay()
    {
        return (int)$this->dateTime->format('d');
    }

    /**
     * Get the weekday (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getWeekDay()
    {
        return (int)$this->dateTime->format('N');
    }

    /**
     * Get the first weekday of this month (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getFirstWeekDay()
    {
        return (int)$this->dateTime->modify('first day of this month')->format('N');
    }

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     *
     * @return int
     */
    public function getFirstWeek()
    {
        return (int)$this->dateTime->modify('first day of this month')->format('W');
    }

    /**
     * Get the number of days in this month
     *
     * @return int
     */
    public function getNumberOfDaysInThisMonth()
    {
        return (int)$this->dateTime->modify('last day of this month')->format('d');
    }

    /**
     * Get the number of days in the previous month
     *
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth()
    {
        return (int)$this->dateTime->modify('last day of previous month')->format('d');
    }

    /**
     * Get the calendar array
     *
     * @return array
     */
    public function getCalendar()
    {
        // TODO: Implement getCalendar() method.
    }
}