<?php
namespace Deployer;

require 'recipe/common.php';

// プロジェクト名
set('application', 'local-deploy');

// プロジェクトリポジトリ
set('repository', 'https://github.com/deployphp/deployer.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);

// デフォルトのステージ（環境）
set('default_stage', 'develop');

// 現在のディレクトリ位置を保存
set('current_dir', realpath(''));

// ロールバックできる世代数 
set('keep_releases', 3);

// localhost for dev
localhost('local-dev')
    ->stage('develop')
    ->set('branch', 'next')
    ->set('deploy_path', get('current_dir').'/dev')
    ;

// localhost for pro
localhost('local-pro')
    ->stage('production')
    ->set('branch', 'master')
    ->set('deploy_path', get('current_dir').'/pro')
    ;

// Tasks
desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
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
