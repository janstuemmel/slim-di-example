<?php

require __DIR__ . '/vendor/autoload.php';

$app = new \App;

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($app->getEntityManager());