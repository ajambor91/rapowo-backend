<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'App\Controller\ApiClose\UserController' shared autowired service.

include_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ContainerAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ContainerAwareTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Controller/ControllerTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Controller/Controller.php';
include_once $this->targetDirs[3].'/src/Controller/BaseController.php';
include_once $this->targetDirs[3].'/src/Controller/ApiClose/UserController.php';

return $this->services['App\\Controller\\ApiClose\\UserController'] = new \App\Controller\ApiClose\UserController(($this->services['lexik_jwt_authentication.encoder'] ?? $this->load('getLexikJwtAuthentication_EncoderService.php')));
