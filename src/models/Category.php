<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2017/07/25
 * Time: 20:28
 */

namespace SizukuBBS\models;


class Category extends \Model
{
    public static $_table = 'categories';
    public static $_id_column = 'id';

    public function threads()
    {
        return $this->has_many('\SizukuBBS\models\Thread', 'category_id');
    }
}