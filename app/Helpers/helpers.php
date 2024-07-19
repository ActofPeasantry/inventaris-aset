<?php
function monthNameArray()
{
    $result = [
        0 => "--Semua Bulan--", 1 => 'Januari', 2 => "Februari", 3 => "Maret", 4 => "April",
        5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober",
        11 => "November", 12 => "Desember"
    ];
    return $result;
}

function breadcrumb($pages)
{
    $result = '';
    $n = count($pages);
    $i = 1;

    foreach ($pages as $key => $value) {
        if ($i == $n) {
            $result .= '<li class="breadcrumb-item active">' . $key . '</li>';
        } else {
            $result .= '<li class="breadcrumb-item">' . '<a href="' . $value . '">' . $key . '</a>' . '</li>';
        }
        $i++;
    }
    // dd($result);
    return $result;
}
