<?php

use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherTrait;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    use PhpMatcherTrait;

    public function __construct(RequestContext $context)
    {
        $this->context = $context;
        $this->staticRoutes = [
            '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
            '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
            '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
            '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
            '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
            '/api/texts/add-text' => [[['_route' => 'app_apiclose_texts_addtext', '_controller' => 'App\\Controller\\ApiClose\\TextsController::addText'], null, ['POST' => 0], null, false, false, null]],
            '/texts/get' => [[['_route' => 'app_apiopen_texts_gettexts', '_controller' => 'App\\Controller\\ApiOpen\\TextsController::getTexts'], null, null, null, false, false, null]],
            '/security/register' => [[['_route' => 'app_security_security_registeruser', '_controller' => 'App\\Controller\\Security\\SecurityController::registerUser'], null, ['POST' => 0], null, false, false, null]],
            '/security/check-email' => [[['_route' => 'app_security_security_checkemail', '_controller' => 'App\\Controller\\Security\\SecurityController::checkEmail'], null, ['POST' => 0], null, false, false, null]],
            '/security/check-nick' => [[['_route' => 'app_security_security_checknick', '_controller' => 'App\\Controller\\Security\\SecurityController::checkNick'], null, ['POST' => 0], null, false, false, null]],
            '/security/check-password' => [[['_route' => 'app_security_security_checkpassword', '_controller' => 'App\\Controller\\Security\\SecurityController::checkPassword'], null, ['POST' => 0], null, false, false, null]],
            '/security/login' => [[['_route' => 'app_security_security_login', '_controller' => 'App\\Controller\\Security\\SecurityController::login'], null, ['POST' => 0], null, false, false, null]],
            '/security/password-recover' => [[['_route' => 'app_security_security_recoverpassword', '_controller' => 'App\\Controller\\Security\\SecurityController::recoverPassword'], null, ['POST' => 0], null, false, false, null]],
        ];
        $this->regexpList = [
            0 => '{^(?'
                    .'|/_(?'
                        .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                        .'|wdt/([^/]++)(*:57)'
                        .'|profiler/([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:102)'
                                .'|router(*:116)'
                                .'|exception(?'
                                    .'|(*:136)'
                                    .'|\\.css(*:149)'
                                .')'
                            .')'
                            .'|(*:159)'
                        .')'
                    .')'
                    .'|/api/(?'
                        .'|texts/(?'
                            .'|edit(?'
                                .'|/([^/]++)(*:202)'
                                .'|Comment/([^/]++)(*:226)'
                            .')'
                            .'|remove/([^/]++)(*:250)'
                            .'|add\\-comment/([^/]++)(*:279)'
                            .'|delete\\-comment/([^/]++)(*:311)'
                            .'|set\\-(?'
                                .'|text\\-rating/([^/]++)(*:348)'
                                .'|comment\\-rating/([^/]++)(*:380)'
                            .')'
                        .')'
                        .'|user/edit/([^/]++)(*:408)'
                    .')'
                    .'|/texts/get\\-text/([^/]++)(*:442)'
                    .'|/security/activation/([^/]++)(*:479)'
                .')/?$}sDu',
        ];
        $this->dynamicRoutes = [
            38 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
            57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
            102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
            116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
            136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
            149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
            159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
            202 => [[['_route' => 'app_apiclose_texts_edittext', '_controller' => 'App\\Controller\\ApiClose\\TextsController::editText'], ['id'], ['POST' => 0], null, false, true, null]],
            226 => [[['_route' => 'app_apiclose_texts_editcomment', '_controller' => 'App\\Controller\\ApiClose\\TextsController::editComment'], ['id'], ['POST' => 0], null, false, true, null]],
            250 => [[['_route' => 'app_apiclose_texts_removetext', '_controller' => 'App\\Controller\\ApiClose\\TextsController::removeText'], ['id'], null, null, false, true, null]],
            279 => [[['_route' => 'app_apiclose_texts_addcomment', '_controller' => 'App\\Controller\\ApiClose\\TextsController::addComment'], ['id'], ['POST' => 0], null, false, true, null]],
            311 => [[['_route' => 'app_apiclose_texts_deletecomment', '_controller' => 'App\\Controller\\ApiClose\\TextsController::deleteComment'], ['id'], ['GET' => 0], null, false, true, null]],
            348 => [[['_route' => 'app_apiclose_texts_settextrating', '_controller' => 'App\\Controller\\ApiClose\\TextsController::setTextRating'], ['id'], ['POST' => 0], null, false, true, null]],
            380 => [[['_route' => 'app_apiclose_texts_setcommentrating', '_controller' => 'App\\Controller\\ApiClose\\TextsController::setCommentRating'], ['id'], ['POST' => 0], null, false, true, null]],
            408 => [[['_route' => 'app_apiclose_user_editprofile', '_controller' => 'App\\Controller\\ApiClose\\UserController::editProfile'], ['id'], ['POST' => 1], null, false, true, null]],
            442 => [[['_route' => 'app_apiopen_texts_gettext', '_controller' => 'App\\Controller\\ApiOpen\\TextsController::getText'], ['id'], null, null, false, true, null]],
            479 => [[['_route' => 'activation', '_controller' => 'App\\Controller\\Security\\SecurityController::sendRegisterMessage'], ['hash'], null, null, false, true, null]],
        ];
    }
}
