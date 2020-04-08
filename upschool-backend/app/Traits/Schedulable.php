<?php

//Don't forget to change the namespace!
namespace App\Traits;

use Cron\CronExpression;
use Illuminate\Support\Carbon;
use Illuminate\Console\Scheduling\ManagesFrequencies;

trait Schedulable
{

    use ManagesFrequencies;

    protected $expression = '* * * * *';

    protected $timezone;

    public function isDue()
    {
        $date = Carbon::now();

        if ($this->timezone) {
            $date->setTimezone($this->timezone);
        }

        return CronExpression::factory($this->expression)->isDue($date->toDateTimeString());
    }

    public function nextDue()
    {
        return Carbon::instance(CronExpression::factory($this->expression)->getNextRunDate());
    }

    public function lastDue()
    {
        return Carbon::instance(CronExpression::factory($this->expression)->getPreviousRunDate());
    }
}
