<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'local-deploy-test');

// Project repository
set('repository', 'https://github.com/tecokimura/my-php-deployer.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);

set('default_stage', 'develop');

// localhost for dev
localhost('localhost-dev')
    ->stage('develop')
    ->set('deploy_path', '/Users/tecokimura/Documents/project/deployer-test/for-dev')
    ;

// localhost for pro
localhost('localhost-pro')
    ->stage('production')
    ->set('deploy_path', '/Users/tecokimura/Documents/project/deployer-test/for-pro')
    ;

// Tasks
desc('Deploy your project');
task('test', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    // 'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    // 'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
