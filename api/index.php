<?php
if (getenv('MYSQL_ATTR_SSL_CA')) {
    file_put_contents('/tmp/ca.pem', getenv('MYSQL_ATTR_SSL_CA'));
}

require __DIR__ . '/../public/index.php';