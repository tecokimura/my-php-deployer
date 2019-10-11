<?php
namespace Deployer;

require 'recipe/common.php';

//------
// 設定項目
//---------

// Project name
set('application', 'PHP Deployer SAMPLE Project');

// Default stage
set('default_stage', 'develop');
set('keep_releases', 3);
set('shared_dirs', [
    
]);

set('upload_files', [
    './working/',
]);

// Project repository
set('repository', 'https://github.com/tecokimura/my-php-deployer');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', [
    
]);
set('allow_anonymous_stats', false);


// Hosts develop
// ~/.ssh/config を設定しておく
host('dev.xxxsample.com')
    ->stage('develop')
    ->set('deploy_path', '/home/aaa/bbb/ccc')
    ->set('branch', 'develop')
    ;

// Hosts stage
// ~/.ssh/config を設定しておく
host('stage.xxxsample.com')
    ->stage('stage')
    ->set('deploy_path', '/home/ddd/eee/fff')
    ->set('branch', 'stage')
    ;

// Hosts production
// ~/.ssh/config を設定しておく
host('xxxsample.com')
    ->stage('production')
    ->set('deploy_path', '/home/ddd/eee/fff')
    ->set('branch', 'master')
    ;

task('deploy', [
    'local:git-clone',
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);


// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

