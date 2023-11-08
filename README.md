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

5-Video (Laravel Pennant)

Its a first party package beacuse its not with laravel installation. but it is made by laravel core team. you can install it as a package.

here is a command.
composer require laravel/pennant

publish its files
php artisan vendor:publish

php artisan migrate

// it will add one table feature table which will maintain projects flags.
// when you want to show some fetures/code/sections of your projects to the some specific users or some pages of the project to the some specific users we can use pennant for it.

// added this funciton to user model if the user id is 1 this function will return 1 else 0
public function isAdmin() {
    // $this directly take user
    return $this->id == 1;

    //if you want to pass multiple ids
    return in_array($this->id, [1, 2]);

}

// add this to app service provider. define new-design for user when the user is admin this will return 1 else 0
public function boot(): void
{
    Feature::define('new-design', function(User $user) {
        return $user->isAdmin();
    });
}

// When we define it then we can use it like that. if the user is admin then it will be hsown other wise not
@feature('new-design')
    <!-- Styles -->
    <style>
        website styling
    </style>
@endfeature

// This will be add a row to feature table in database for the user. and the row will be added when this code is run. if the it give access then it will be true else false.

// you can login user like this in web page of the routes without register login page. just write these codes

it have no session jsut login one time
auth()->onceUsingId(2);

it will proper login having sessions and cookies.
auth()->loginUsingId(1);

// we can make lottery for it like this. when this is call generate a lottery it will 75% return 1 else 0.
Feature::define('dashboard-v2', function() {
    return Lottery::odds(3/4);
});

// make routes
Route::get('/dash', function () {
    // if the feature return 1 then it will go to the new dshbord routes else old dashbaord routes
    if(Feature::active('dashboard-v2')) {
        return redirect('/new-dashboard');
    }

    return 'dashboard';
});


Route::get('/new-dashboard', function () {
    return 'new-dashboard';
});


// we can use it in middelware just define it in middleware aliases like this
'feature' => EnsureFeaturesAreActive::class

just add middle ware liek this and add name of the feature after:
Route::get('/new-dashboard', function () {
    return 'new-dashboard';
})->middleware('feature:dashboard-v2');

if you want some pages not to access to everyown just add this middle ware






