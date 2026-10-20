<?php
$dirs = [
    '/tmp/storage/app',
    '/tmp/storage/app/public',
    '/tmp/storage/app/reports',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

if (getenv('MYSQL_ATTR_SSL_CA')) {
    file_put_contents('/tmp/ca.pem', getenv('MYSQL_ATTR_SSL_CA'));
}

require __DIR__ . '/../public/index.php';