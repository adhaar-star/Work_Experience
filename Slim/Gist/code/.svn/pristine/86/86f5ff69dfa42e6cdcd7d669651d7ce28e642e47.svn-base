<?php
$env['system7'] = array(
    'debug' => TRUE,
    'domain' => '192.168.1.112',
    'domain_url' => 'http://192.168.1.112/gist2/',
    'path' => '/gist2/',
    'file_upload_path' => '/var/www/html/gist2/code/',
    'profile_upload_path' => '/var/www/html/gist2/code/assets/images/',
    'base_url' => 'http://192.168.1.112/gist2/',
);

$env['prologicphpsrvr'] = array(
    'debug' => TRUE,
    'domain' => 'prologiclocal.com',
    'domain_url' => 'http://prologiclocal.com/gist/',
    'path' => '/gist/',
    'file_upload_path' => '/var/www/projects/gist/',
    'profile_upload_path' => '/var/www/projects/gist/assets/images/',
    'base_url' => 'http://prologiclocal.com/gist/',
);

$env['php-sys'] = array(
    'debug' => TRUE,
    'domain' => '192.168.1.217',
    'domain_url' => 'http://192.168.1.217/gist2/',
    'path' => '/gist2/',
    'file_upload_path' => '/var/www/html/gist2/code/',
    'profile_upload_path' => '/var/www/html/gist2/code/assets/images/',
    'base_url' => 'http://192.168.1.217/gist2/',
);

$env['box310.bluehost.com'] = array(
    'debug' => TRUE,
    'domain' => 'yourgist.com',
    'domain_url' => 'https://yourgist.com/',
    'path' => '/',
    'file_upload_path' => '/home2/myworkst/public_html/domains/yourgist.com/',
    'profile_upload_path' => '/home2/myworkst/public_html/domains/yourgist.com/assets/images/',
    'base_url' => 'https://yourgist.com/',
);

$env['production'] = array(
    'debug' => FALSE,
);

$env = $env[gethostname()];
$config['base_assets_url'] = $env['base_url'] . 'assets/';
$config['base_api_url'] = $env['base_url'] . 'api/';
$config['base_admin_url'] = $env['base_url'] . 'admin/';
$config['base_assets_admin_url'] = $env['base_url'] . 'assets/admin/';
$config['base_api_mobile_url'] = $config['base_api_url'] . 'mobile/';
$config = $config + $env;
return $config;
