<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2017/07/27
 * Time: 14:55
 */

namespace SizukuBBS\Controllers;

use SizukuBBS\Models\Category;

class TopController extends BaseController
{

    public function index()
    {
        $categories = Category::find_many();

        $content = $this->twig->render('index.twig', [
            'categories' => $categories
        ]);

        $this->response($content);
    }
}
