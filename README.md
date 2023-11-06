# whats-new-in-laravel-10

1-Video (Native type Decleration)

Laravel 10 (There is a void class class direct to funciton and no decleration of schedule class in in it.)

/**
    * Define the application's command schedule.
*/
protected function schedule(Schedule $schedule): void
{
    //
}

Laravel 9 (Here is declearatin of schedule and the return type is void.)

/**
    * Define the application's command schedule.
    *
    * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
    * @return void
*/
protected function schedule(Schedule $schedule)
{
 //
}

