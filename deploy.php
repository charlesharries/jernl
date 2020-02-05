<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/rsync.php';

// Project name
set('application', 'jernl');
set('ssh_multiplexing', true); // For perf

set('rsync_src', function () {
    return __DIR__;
});

add('rsync', [
    'exclude' => [
        '.git',
        '/.env',
        '/storage/',
        '/vendor/',
        '/node_modules/',
        '.github',
        'deploy.php'
    ]
]);

task('deploy:secrets', function () {
    file_put_contents(__DIR__ . '/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path') . '/shared');
});

host('jernl.space')
    ->hostname('178.62.57.103')
    ->stage('production')
    ->user('charles')
    ->set('deploy_path', '/var/www/jernl.space/html');

    after('deploy:failed', 'deploy:unlock'); // Unlock after failed deploy

    desc('Deploy the application');
    task('deploy', [
        'deploy:info',
        'deploy:prepare',
        'deploy:lock',
        'deploy:release',
        'rsync', // Deploy code & built assets
        'deploy:secrets', // Deploy secrets
        'deploy:shared',
        'deploy:vendors',
        'deploy:writable',
        'artisan:storage:link', // |
        'artisan:view:cache',   // |
        'artisan:config:cache', // | Laravel specific steps 
        'artisan:optimize',     // |
        'artisan:migrate',      // |
        'deploy:symlink',
        'deploy:unlock',
        'cleanup',
    ]);