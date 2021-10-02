<?php
if (!function_exists('dateToSearch')) {
    function dateToSearch($date)
    {
        return date("Y-m-d H-i-s", strtotime($date));
    }
}

if (!function_exists('dateBlog')) {
    function dateBlog($date)
    {
        return date(' j F Y', strtotime($date));
    }
}


if (!function_exists('dateComment')) {
    function dateComment($date)
    {
        return date('j F Y g:i A', strtotime($date));
    }
}
