<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2017/07/27
 * Time: 16:38
 */

namespace SizukuBBS\Controllers;


class ThreadController extends BaseController
{

    public function showCategory($id)
    {
        $category = \Model::factory('\SizukuBBS\models\Category')->find_one($id);

        $threads = $category->threads()->find_many();
        $content = $this->twig->render('category.twig', [
            'category' => $category,
            'threads' => $threads
        ]);

        $this->response($content);
    }

    public function showThread($id)
    {
        $thread = \Model::factory('\SizukuBBS\models\Thread')->find_one($id);

        $posts = $thread->posts()->find_many();
        $content = $this->twig->render('thread.twig', [
            'thread' => $thread,
            'posts' => $posts
        ]);

        $this->response($content);
    }

    public function postMessage($id)
    {
        r($_SERVER);
    }

    public function showCreateThread()
    {

    }

    public function createThread()
    {

    }
}