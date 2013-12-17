<?php
    include_once('../database.inc.php');

    $json = array();
    $result = mysql_query("SELECT ind.name, ind.id,
        COALESCE(GROUP_CONCAT(job.industry_id), 'default_value') AS ind_id,
        COUNT(job.industry_id) AS industry_count
        FROM industries ind
        LEFT JOIN jobs job ON ind.id = job.industry_id
        AND job.approved='1'
        GROUP BY ind.id");

    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    echo json_encode($json);
?>