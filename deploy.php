<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'jobsfactory.pl');

// Project repository
set('repository', 'git@github.com:MichalStrzelczyk/jobsfactory-web.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', []);
set('keep_releases', 3);

// Hosts

host('root@digitalfarm.pl')
    ->stage('production')
    ->set('deploy_path', '/var/www/{{application}}/api');
    

// Tasks
task('environmentFile', function () {
    $from = '{{deploy_path}}/config.php';
    $to = '{{release_path}}/config/config.php';

    run("cp $from $to");
})->onStage('production');

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'environmentFile',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
