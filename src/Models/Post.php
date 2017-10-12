<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2017/07/25
 * Time: 19:48
 */

namespace SizukuBBS\Models;


class Post extends \Model
{
    public static $_table = 'posts';
    public static $_id_column = 'id';

    public function threads()
    {
        return $this->belongs_to('\SizukuBBS\Models\Thread', 'id');
    }
}
