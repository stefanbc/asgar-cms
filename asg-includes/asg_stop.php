<?php
    // Measure page load time
    $time = microtime();
    $time = explode(' ', $time);
    $time = $time[1] + $time[0];
    $finish = $time;
    $total_time = round(($finish - $start), 4);
    echo '<!-- generated in ' . $total_time . ' seconds. -->';
?>