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

2-Video (Generate Secure Passwords)

Now you can generate secure password thriugh str and it will be customized

you can use this command
Illuminate\Support\str::password()

you can also generate password like this and also pass length to it it will generate password of 10 length
str()->password(10)

if you want to disable numbers
str()->password(10, numbers: false)
