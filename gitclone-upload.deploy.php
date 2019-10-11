<?php
namespace Deployer;

require 'recipe/common.php';

//------
// 設定項目
//---------

// Project name
set('application', 'PHP Deployer SAMPLEXXX Project');

// Default stage
set('default_stage', 'develop');
set('keep_releases', 3);
set('shared_dirs', [
    
]);

set('upload_files', [
    './working/',
]);

set('working_dir', './working');

// Project repository
set('repository', 'https://github.com/tecokimura/my-php-deployer.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', [
    'smarty/cache',
    'smarty/templates_c'
]);
set('allow_anonymous_stats', false);


// Hosts develop
host('dev.samplexxx.com')
    ->stage('develop')
    ->set('deploy_path', '/home/aaa/www/ccc')
    ->set('branch', 'develop')
    ;

// // Hosts production
host('samplexxx.com')
    ->stage('production')
    ->set('deploy_path', '/home/aaa/www/bbb')
    ->set('branch', 'master')
    ;

task('deploy', [
    'local:git-clone',
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    // 'deploy:update_code',
    'deploy:upload_file',
    'deploy:shared',
    'deploy:writable',
    // 'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'local:cleanup-git-clone',
    'success'
]);


task('deploy:upload_file', function () {
    $appFiles = get('upload_files'); 
    foreach ($appFiles as $file) {
        upload("./{$file}", "{{release_path}}/");
        
        if (isVerbose()) {
            writeln("Upload ./{$file} -> {{release_path}}/");
        }
    }
    
})->desc('Upload file');



task('local:git-clone', function () {
    writeln('git clone to '.get('working_dir'));
    runLocally('if [ ! -d {{working_dir}} ]; then mkdir -p {{working_dir}}; fi');
    runLocally('git clone -b '.get('branch').' '.get('repository').' '.get('working_dir'));

    if (isVerbose()) {
        writeln('git clone -b '.get('branch').' '.get('repository'));
    }
})->desc('git clone to localhost');


task('local:cleanup-git-clone', function () {
    runLocally('rm -rf '.get('working_dir'));
})->desc('cleanup working_dir on localhost');


// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
after('deploy:failed', 'local:cleanup-git-clone');

