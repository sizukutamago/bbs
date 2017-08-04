<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2017/07/27
 * Time: 16:38
 */

namespace SizukuBBS\Controllers;

use Carbon\Carbon;
use SizukuBBS\models\Category;
use SizukuBBS\models\Post;
use SizukuBBS\models\Thread;
use Valitron\Validator;

class ThreadController extends BaseController
{

    public function showCategory($id)
    {
        $category = Category::find_one($id);

        $threads = $category->threads()->find_many();
        $content = $this->twig->render('category.twig', [
            'category' => $category,
            'threads' => $threads
        ]);

        $this->response($content);
    }

    public function showThread($id)
    {
        $thread = Thread::find_one($id);

        $posts = $thread->posts()->find_many();
        $content = $this->twig->render('thread.twig', [
            'thread' => $thread,
            'posts' => $posts
        ]);

        $this->response($content);
    }

    public function postMessage($id)
    {
        $v = new Validator($_POST);
        $v->rule('required', ['name', 'message'])->message('{field}は必須です');
        $v->labels(array(
            'name' => '名前',
            'message' => '投稿内容'
        ));

        if ($v->validate()) {

            $post = Post::create();
            $post->thread_id = $id;
            $post->name = $_POST['name'];
            $post->message = $_POST['message'];
            $post->user_hash_id = hash('crc32', Carbon::today() . $_SERVER['REMOTE_ADDR']);
            $post->ip_addr = $_SERVER['REMOTE_ADDR'];
            $post->save();

        }

        $thread = Thread::find_one($id);

        $posts = $thread->posts()->find_many();
        $content = $this->twig->render('thread.twig', [
            'thread' => $thread,
            'posts' => $posts,
            'v' => $v
        ]);

        $this->response($content);

    }

    public function showCreateThread()
    {
        $categories = Category::find_many();

        $content = $this->twig->render('create.twig', [
            'categories' => $categories
        ]);

        $this->response($content);

    }

    public function createThread()
    {
        $v = new Validator($_POST);
        $v->rule('required', ['category', 'title', 'name', 'message'])->message('{field}は必須です');
        $v->labels(array(
            'category' => 'カテゴリー',
            'title' => 'タイトル',
            'name' => '名前',
            'message' => '投稿内容'
        ));

        if ($v->validate()) {

            $thread = Thread::create();
            $thread->category_id = $_POST['category'];
            $thread->title = $_POST['title'];
            $thread->save();

            $post = Post::create();
            $post->thread_id = $thread->id;
            $post->name = $_POST['name'];
            $post->message = $_POST['message'];
            $post->user_hash_id = hash('crc32', Carbon::today() . $_SERVER['REMOTE_ADDR']);
            $post->ip_addr = $_SERVER['REMOTE_ADDR'];
            $post->save();

        }

        $categories = Category::find_many();

        $content = $this->twig->render('create.twig', [
            'categories' => $categories,
            'v' => $v
        ]);

        $this->response($content);
    }

}