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
        return (int)(clone $this->dateTime)->format('d');
    }

    /**
     * Get the weekday (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getWeekDay()
    {
        return (int)(clone $this->dateTime)->format('N');
    }

    /**
     * Get the first weekday of this month (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getFirstWeekDay()
    {
        return (int)(clone $this->dateTime)
            ->modify('first day of this month')
            ->format('N');
    }

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     *
     * @return int
     */
    public function getFirstWeek()
    {
        return (int)(clone $this->dateTime)
            ->modify('first day of this month')
            ->format('W');
    }

    /**
     * Get the number of days in this month
     *
     * @return int
     */
    public function getNumberOfDaysInThisMonth()
    {
        return (int)(clone $this->dateTime)
            ->modify('last day of this month')
            ->format('d');
    }

    /**
     * Get the number of days in the previous month
     *
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth()
    {
        return (int)(clone $this->dateTime)
            ->modify('last day of previous month')
            ->format('d');
    }

    /**
     * Get the calendar array
     *
     * @return array
     */
    public function getCalendar()
    {
        $firstDayOfMonth = (clone $this->dateTime)->modify('first day of this month');

        $calendarDay = (clone $firstDayOfMonth)->modify('first monday of this week');

        $calendar = [];

        for ($w=0; $w<$this->getNumberOfWeeksInThisMonth(); $w++) {
            $week = [];
            $weekNo = (int)$calendarDay->format('W');


            $shouldHighlight = $this->shouldHighlight($calendarDay);

            for ($i=0; $i<7; $i++) {
                $week[(int)$calendarDay->format('d')] = $shouldHighlight;

                $calendarDay->modify('+1 day');
            }

            $calendar[$weekNo] = $week;

        }

        return $calendar;
    }

    private function getNumberOfWeeksInThisMonth()
    {
        $firstDay = (clone $this->dateTime)
            ->modify('first day of this month')
            ->modify('first monday of this week');

        $lastDay  = (clone $this->dateTime)
            ->modify('last day of this month')
            ->modify('sunday');

        return $lastDay->diff($firstDay, true)->days/7;
    }

    private function shouldHighlight(DateTimeInterface $day)
    {
        return (
            $this->dateTime >= (clone $day)->modify('+1 week') &&
            $this->dateTime < (clone $day)->modify('+2 week')
        );
    }
}