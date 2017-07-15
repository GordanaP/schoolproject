<?php


function name($f_name, $l_name, $n)
{
    $f_name_init = strtolower(substr($f_name, 0, 1));
    $l_name_init = strtolower(substr($l_name, 0, 1));

    return $f_name_init . $l_name_init .$n;
}

function email($f_name, $l_name, $n)
{
    return strtolower($f_name) .'.'. strtolower($l_name) . $n . '@laraschool.com';
}


function selected($selected, $current)
{
    return $selected == $current ? 'selected' : '';
}


function checked($checked, $current)
{
    return $checked == $current ? 'checked' : '';
}