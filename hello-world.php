<?php
namespace Deployer;

require 'recipe/common.php';

//------
// 設定項目
//---------

// Project name
set('application', 'Hello World project');
set('message', 'Message HelloWorld!');

task('deploy', [
    'helloworld',
    'success'
]);

task('helloworld', function () {
    writeln("Hello World!");
    writeln(get('application'));
    writeln(get('message'));
})->desc('Hello World!');
