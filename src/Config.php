<?php

use Noodlehaus\Config as ConfigBase;

class Config extends ConfigBase {

  protected function getDefaults() {
    
    return [
      'dev' => getenv('APP_MODE') != 'production',
      'database' => [
        'driver' => getenv('APP_DB_DRIVER') ? : 'pdo_sqlite',
        'charset' => getenv('APP_DB_CHARSET') ? : 'utf8',
        'path' => getenv('APP_SQLITE_FILE') ? : __DIR__ . '/../app.db',
        'host' => getenv('APP_DB_HOST'),
        'user' => getenv('APP_DB_USER'),
        'password' => getenv('APP_DB_PASSWORD'),
        'dbname' => getenv('APP_DB_NAME'),
      ]
    ];
  }
}