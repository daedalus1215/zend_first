<?php

namespace Debug\Service;

/**
 * Simple class that measures the time between start and stop calls
 * @author la
 */
class Timer
{
    /**
     * Start times.
     * @var array
     */
    protected $start;
    // Trying to render hte time on the page without messing with the logging
    // I figure the best way of doing it is saving the microtime, right when
    // we go to log.
    protected $savedTime;
    /**
     * Defines if the time must be presented as float.
     * @var boolean
     */
    protected $timeAsFloat;


    public function __construct($timeAsFloat = false)
    {
        $this->timeAsFloat = $timeAsFloat;
    }


    /**
     * Starts measuring the time.
     * @param string $key
     */
    public function start($key)
    {
        $this->start[$key] = microtime($this->timeAsFloat);
    }

    /**
     * Stops measuring time and returns the duration.
     * @param string $key
     * @return float|null the duration of the event.
     */
    public function stop($key)
    {
        if (!isset($this->start[$key])) {
            return null;
        }
        $this->savedTime = microtime($this->timeAsFloat) - $this->start[$key];
        // WHY WONT THIS PROPERTY CARRY DOWN TO GET TIME - I say this, because stop gets called first.
        return $this->savedTime;
    }


    public function getTime($key)
    {
        if (!isset($this->start[$key])) {
            return null;
        }
        $this->savedTime = microtime($this->timeAsFloat) - $this->start[$key];
        return $this->savedTime;
    }

}
