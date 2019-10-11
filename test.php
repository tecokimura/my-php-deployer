<?php
namespace Deployer;

require 'recipe/common.php';

// Tasks

desc('Deploy your project');
task('test', [
    'deploy:info',
    // 'deploy:prepare',
    // 'deploy:lock',
    // 'deploy:release',
    // 'deploy:update_code',
    // 'deploy:shared',
    // 'deploy:writable',
    // 'deploy:vendors',
    // 'deploy:clear_paths',
    // 'deploy:symlink',
    // 'deploy:unlock',
    // 'cleanup',
    'success'
]);


