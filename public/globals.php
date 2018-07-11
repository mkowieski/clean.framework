<?php
/**
 * Created by Mirosław Kowieski
 * Date: 2018-07-06 19:39
 */

class Globals {
    public static function basePath()
    {
        return dirname(__DIR__);
    }

    public static function asset($asset)
    {
        echo $asset;
    }
}


