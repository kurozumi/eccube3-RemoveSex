<?php

/*
 * This file is part of the RemoveSex
 *
 * Copyright (C) 2017 性別削除プラグイン for EC-CUBE3
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\RemoveSex\ServiceProvider;

use Eccube\Application;
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Plugin\RemoveSex\Form\Type\RemoveSexConfigType;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

class RemoveSexServiceProvider implements ServiceProviderInterface
{

    public function register(BaseApplication $app)
    {
        // プラグイン用設定画面
        //$app->match('/'.$app['config']['admin_route'].'/plugin/RemoveSex/config', 'Plugin\RemoveSex\Controller\ConfigController::index')->bind('plugin_RemoveSex_config');

        // 独自コントローラ
        //$app->match('/plugin/[lower_code]/hello', 'Plugin\RemoveSex\Controller\RemoveSexController::index')->bind('plugin_RemoveSex_hello');

        // Form
        //$app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
        //    $types[] = new RemoveSexConfigType();
        //
        //    return $types;
        //}));

        // Repository

        // Service

        // メッセージ登録
        // $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
        // $app['translator']->addResource('yaml', $file, $app['locale']);

        // load config
        // プラグイン独自の定数はconfig.ymlの「const」パラメータに対して定義し、$app['[lower_code]config']['定数名']で利用可能
        // if (isset($app['config']['RemoveSex']['const'])) {
        //     $config = $app['config'];
        //     $app['[lower_code]config'] = $app->share(function () use ($config) {
        //         return $config['RemoveSex']['const'];
        //     });
        // }

        // ログファイル設定
        $app['monolog.logger.[lower_code]'] = $app->share(function ($app) {

            $logger = new $app['monolog.logger.class']('[lower_code]');

            $filename = $app['config']['root_dir'].'/app/log/[lower_code].log';
            $RotateHandler = new RotatingFileHandler($filename, $app['config']['log']['max_files'], Logger::INFO);
            $RotateHandler->setFilenameFormat(
                '[lower_code]_{date}',
                'Y-m-d'
            );

            $logger->pushHandler(
                new FingersCrossedHandler(
                    $RotateHandler,
                    new ErrorLevelActivationStrategy(Logger::ERROR),
                    0,
                    true,
                    true,
                    Logger::INFO
                )
            );

            return $logger;
        });

    }

    public function boot(BaseApplication $app)
    {
    }

}
