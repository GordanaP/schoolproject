<?php

use Carbon\Carbon;

function fullname($f_name, $l_name)
{
    return ucfirst($f_name) . ' ' . ucfirst($l_name);
}

function username($f_name, $l_name)
{
    $n = random_int(1000, 9999);
    $f_name_init = strtolower(substr($f_name, 0, 2));
    $l_name_init = strtolower(substr($l_name, 0, 1));

    return $f_name_init . $l_name_init . $n;
}

function email($f_name, $l_name)
{
    return strtolower($f_name) .'.'. strtolower($l_name);
}

function password($f_name, $l_name, $dob)
{
    $f_name_init = ucfirst(substr($f_name, 0, 1));
    $l_name_init = strtolower(substr($l_name, 0, 1));

    $dt = \Carbon\Carbon::parse($dob);

    $year = substr($dt->year, 2,2);

    if (strlen($dt->month) == 1) {
        $month = '0'.$dt->month;
    }
    else{
        $month = $dt->month;
    }

    if (strlen($dt->day) == 1) {
        $day = '0'.$dt->day;
    }
    else{
        $day = $dt->day;
    }

    return $f_name_init . $l_name_init . $year . $month . $day;
}

function slug($f_name, $l_name)
{
    return str_slug($f_name . '-' . $l_name);
}

function selected($selected, $current)
{
    return $selected == $current ? 'selected' : '';
}

function checked($checked, $current)
{
    return $checked == $current ? 'checked' : '';
}

function filename($id, $name)
{
    return $id.'-'.$name.'.jpg';
}

function minAge($age)
{
    return Carbon::today()->subYears($age)->format('Y-m-d');
}
