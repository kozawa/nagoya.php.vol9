<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
$data = [
    [
        'id' => 1,
        'parent_id' => 0,
        'value' => '親1',
    ],
    [
        'id' => 2,
        'parent_id' => 0,
        'value' => '親2',
    ],
    [
        'id' => 3,
        'parent_id' => 1,
        'value' => '子1-1',
    ],
    [
        'id' => 4,
        'parent_id' => 1,
        'value' => '子1-2',
    ],
    [
        'id' => 5,
        'parent_id' => 2,
        'value' => '子2-1',
    ],
];

$structure_depth = 0;
$cur_parent_id = $top_parent_id;
$data_array = array();
foreach ($data as $id=>$rec) {
    if ($rec[parent_id] == $cur_parent_id) {
        $rec_temp = array('id' => $rec[id],
            'parent_id' => $rec[parent_id],
            'value' => $rec[value],
            'structure_depth' => $structure_depth);
        array_push($data_array, $rec_temp);
        $grandparentid = $cur_parent_id;
        $cur_parent_id = $rec[id];
        $structure_depth++;
        foreach ($data as $id=>$rec2) {
            if ($rec2[parent_id] == $cur_parent_id) {
                $rec_temp = array('id' => $rec2[id],
                    'parent_id' => $rec2[parent_id],
                    'value' => $rec2[value],
                    'structure_depth' => $structure_depth);
                array_push($data_array, $rec_temp);
            }
        }
        $cur_parent_id = $grandparentid;
        $structure_depth--;
    }
}

$last_depth = 0;

echo '<ul>';
foreach ($data_array as $id=>$rec3) {
    if ($last_depth < $rec3[structure_depth]) {
        echo '<ul>';
    }
    if ($last_depth > $rec3[structure_depth]) {
        echo '</ul>';
    }
    echo '<li>'.$rec3[value].'</li>';
    $last_depth = $rec3[structure_depth];
}
echo '</ul>';


?>
    </body>
</html>
