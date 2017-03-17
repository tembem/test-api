<?php

return [

    // Tasks
    //
    // Here you can define in the `before` and `after` array, Tasks to execute
    // before or after the core Rocketeer Tasks. You can either put a simple command,
    // a closure which receives a $task object, or the name of a class extending
    // the Rocketeer\Abstracts\AbstractTask class
    //
    // In the `custom` array you can list custom Tasks classes to be added
    // to Rocketeer. Those will then be available in the command line
    // with all the other tasks
    //////////////////////////////////////////////////////////////////////

    // Tasks to execute before the core Rocketeer Tasks
    'before' => [
        'setup'   => [],
        'deploy'  => [],
        'cleanup' => [],
    ],

    // Tasks to execute after the core Rocketeer Tasks
    'after'  => [
        'setup'   => [],
        'deploy'  => [
            'cd public && bower install',
            'npm install',
            'gulp --production',
            'cp .env.staging .env',
            'chmod 775 -R storage bootstrap/cache',
            'php artisan migrate',
            'php artisan db:seed',
            'php artisan optimize',
            'php artisan config:cache',
            'apigen generate --source app --destination api --template-theme bootstrap -q',
            'sudo /usr/sbin/service php7.0-fpm restart'
        ],
        'cleanup' => [],
    ],

    // Custom Tasks to register with Rocketeer
    'custom' => [],

];
