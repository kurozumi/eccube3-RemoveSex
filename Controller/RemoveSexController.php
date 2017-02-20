<?php

/*
 * This file is part of the RemoveSex
 *
 * Copyright (C) 2017 性別削除プラグイン for EC-CUBE3
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\RemoveSex\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;

class RemoveSexController
{

    /**
     * RemoveSex画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Application $app, Request $request)
    {

        // add code...

        return $app->render('RemoveSex/Resource/template/index.twig', array(
            // add parameter...
        ));
    }

}
