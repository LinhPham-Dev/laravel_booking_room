<?php
if (!function_exists('dateToSearch')) {
    function dateToSearch($date)
    {
        return date("Y-m-d H-i-s", strtotime($date));
    }
}
