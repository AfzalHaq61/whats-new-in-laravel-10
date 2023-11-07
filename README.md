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

3-Video (Quicker Project Scaffolding)
you can install laravel with breeze directly jsut one command and you project is made

laravel new laravel10 --pest --breeze

Due to pest command the test file will be differnet it will be pest files and it like javascript

4-Video (The New Process Facade)

There is new process facade in laravel 10. which will run commands which you give

use Illuminate\Support\Facades\Process;

Route::get('/', function () {
    return Process::run('ls -la')->output();
});

if there is no command this will give you blanck page
return Process::run('asda')->output();

This will give you the code in result
return Process::run('asda')->exitCode();

this will give you the error messege
return Process::run('asda')->errorOutput();

this will give you boolean of success
return Process::run('asda')->successful();

We can also use this in routes/console and then run command in terminal as php artisan test

Artisan::command('test', function () {
    $this->info(Process::run('npm run build')->output());
});

// If there is long process then it will take time so then we cal write our code like this
Artisan::command('test', function () {

    first of all we will start the command
    $process = Process::start('npm run build');

    // when the command is running then we will show a messege ok. and the messege will be shown after few secong we uses sleep method for it

    while($process->running()) {
        $this->info('working....');

        sleep(1);
    }

    // The process will wait until done
    $process->wait();

    // When done it will show done.
    $this->info('All Done!');
});

// we can fake the command like this
Artisan::command('test', function () {

    //we fake the git log command so it will not run the actual git lof command it will just give the result of fake
    Process::fake(['git log' => 'git fake log']);

    $this->info(Process::run('git log')->output());
    $this->info(Process::run('npm run build')->output());

});

// We can check whether command is run or not bu assertion, its runninf its etc like this
Artisan::command('test', function () {

    Process::fake(['git log' => 'git fake log']);

    Process::run('git log');

    Process::assertRanTimes('npm run build');

});

