<?php

namespace model\dao;


class GoogleQRDAO
{
    public static function getQrImgUrl(String $var)
    {
        return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" . urlencode($var) . "&choe=UTF-8";
    }
}
