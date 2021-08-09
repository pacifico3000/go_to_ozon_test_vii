<?php

$input = [10, -3, -12, -3, 42, -1, -7, 0, 3];

var_dump(maxInterval($input));

function maxInterval($input) {
    // массив имеет меньше двух элементов
    if (!isset($input[0]) || !isset($input[1])) {
        return [0, 0];
    }
    if (!isset($input[2])) {
        return [0, 1];
    }

    $first = 0;
    $last = 1;
    $dynamic = [];
    // сохраним начальный крайний случай
    $max = $input[0] + $input[1];
    foreach ($input as $key1 => $item1) {
        foreach ($input as $key2 => $item2) {
            if (($key2 - $key1) < 0) {
                continue;
            } else if (($key2 - $key1) === 0) {
                // здесь запоминаем значение элемента, чтобы от него отталкиваться в дальнейшем
                $dynamic[$key1][$key2] = $item2;
                if ($max < $dynamic[$key1][$key2]) {
                    $max = $dynamic[$key1][$key2];
                    $first = $key1;
                    $last = $key2;
                }
                continue;
            }
            
            // рассчитываем и запоминаем новые значения на основе старых
            $dynamic[$key1][$key2] = $dynamic[$key1][($key2-1)] + $item2;
            if ($max < $dynamic[$key1][$key2]) {
                $max = $dynamic[$key1][$key2];
                $first = $key1;
                $last = $key2;
            }
        }
    }

    return [$first, $last];
}
