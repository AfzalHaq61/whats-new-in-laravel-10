<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('npm', function () {

    $process = Process::start('npm run build');

    while($process->running()) {
        $this->info('working....');

        sleep(1);
    }

    $process->wait();

    $this->info('All Done!');
});

Artisan::command('fake', function () {

    Process::fake(['git log' => 'git fake log']);

    $this->info(Process::run('git log')->output());
    $this->info(Process::run('npm run build')->output());

});

Artisan::command('test', function () {

    Process::fake(['git log' => 'git fake log']);

    Process::run('git log');

    Process::assertRanTimes('npm run build');

});
