<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.aZJMQbn' shared service.

return $this->privates['.service_locator.aZJMQbn'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'textsRepository' => ['privates', 'App\\Repository\\TextsRepository', 'getTextsRepositoryService.php', true],
]);
