<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2017/07/27
 * Time: 17:11
 */

namespace SizukuBBS\Controllers;


class BaseController
{

    public $twig;

    final public function __construct()
    {
        $basedir = dirname(__DIR__) . '/..';
        $loader = new \Twig_Loader_Filesystem($basedir . '/view');
        $this->twig = new \Twig_Environment($loader, [
            'cache' => $basedir . '/cache/twig',
            'debug' => true,
        ]);
    }

}