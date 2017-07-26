<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2017/07/25
 * Time: 20:29
 */

namespace SizukuBBS\models;


class Thread extends \Model
{
    public static $_table = 'threads';
    public static $_id_column = 'id';

    public function posts()
    {
        return $this->has_many('\SizukuBBS\models\Post', 'thread_id');
    }

    public function category()
    {
        return $this->belongs_to('Category', 'id');
    }
}