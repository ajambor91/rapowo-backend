<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = [
        '_twig_error_test' => [['code', '_format'], ['_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], []],
        '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], []],
        '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], []],
        '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], []],
        '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], []],
        '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], []],
        '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], []],
        '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception::showAction'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception::cssAction'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        'app_apiclose_texts_addtext' => [[], ['_controller' => 'App\\Controller\\ApiClose\\TextsController::addText'], [], [['text', '/api/texts/add-text']], [], []],
        'app_apiclose_texts_edittext' => [['id'], ['_controller' => 'App\\Controller\\ApiClose\\TextsController::editText'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/texts/edit']], [], []],
        'app_apiclose_texts_removetext' => [['id'], ['_controller' => 'App\\Controller\\ApiClose\\TextsController::removeText'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/texts/remove']], [], []],
        'app_apiclose_texts_addcomment' => [['id'], ['_controller' => 'App\\Controller\\ApiClose\\TextsController::addComment'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/texts/add-comment']], [], []],
        'app_apiclose_texts_editcomment' => [['id'], ['_controller' => 'App\\Controller\\ApiClose\\TextsController::editComment'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/texts/editComment']], [], []],
        'app_apiclose_texts_deletecomment' => [['id'], ['_controller' => 'App\\Controller\\ApiClose\\TextsController::deleteComment'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/texts/delete-comment']], [], []],
        'app_apiclose_texts_settextrating' => [['id'], ['_controller' => 'App\\Controller\\ApiClose\\TextsController::setTextRating'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/texts/set-text-rating']], [], []],
        'app_apiclose_texts_setcommentrating' => [['id'], ['_controller' => 'App\\Controller\\ApiClose\\TextsController::setCommentRating'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/texts/set-comment-rating']], [], []],
        'app_apiclose_user_editprofile' => [['id'], ['_controller' => 'App\\Controller\\ApiClose\\UserController::editProfile'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/user/edit']], [], []],
        'app_apiopen_texts_gettexts' => [[], ['_controller' => 'App\\Controller\\ApiOpen\\TextsController::getTexts'], [], [['text', '/texts/get']], [], []],
        'app_apiopen_texts_gettext' => [['id'], ['_controller' => 'App\\Controller\\ApiOpen\\TextsController::getText'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/texts/get-text']], [], []],
        'app_security_security_registeruser' => [[], ['_controller' => 'App\\Controller\\Security\\SecurityController::registerUser'], [], [['text', '/security/register']], [], []],
        'app_security_security_checkemail' => [[], ['_controller' => 'App\\Controller\\Security\\SecurityController::checkEmail'], [], [['text', '/security/check-email']], [], []],
        'app_security_security_checknick' => [[], ['_controller' => 'App\\Controller\\Security\\SecurityController::checkNick'], [], [['text', '/security/check-nick']], [], []],
        'app_security_security_checkpassword' => [[], ['_controller' => 'App\\Controller\\Security\\SecurityController::checkPassword'], [], [['text', '/security/check-password']], [], []],
        'app_security_security_login' => [[], ['_controller' => 'App\\Controller\\Security\\SecurityController::login'], [], [['text', '/security/login']], [], []],
        'app_security_security_recoverpassword' => [[], ['_controller' => 'App\\Controller\\Security\\SecurityController::recoverPassword'], [], [['text', '/security/password-recover']], [], []],
        'activation' => [['hash'], ['_controller' => 'App\\Controller\\Security\\SecurityController::sendRegisterMessage'], [], [['variable', '/', '[^/]++', 'hash', true], ['text', '/security/activation']], [], []],
    ];
        }
    }

    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && null !== $name) {
            do {
                if ((self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
                    unset($parameters['_locale']);
                    $name .= '.'.$locale;
                    break;
                }
            } while (false !== $locale = strstr($locale, '_', true));
        }

        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
