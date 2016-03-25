<?php
    function listFolderFiles($dir){
    $ffs = scandir($dir);
    echo '<table>';
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            echo "<tr>";
            $link = $dir . $ff;
            echo "<td><a href='{$link}'>$ff</a></td>";
            echo "<td>";
            //echo "<form action='index.php/get/download' method='get' enctype='multipart/form-data'>";
                //echo "<input type='submit' style='color:red;font-weight:bold' value='Download File' name='submit'></>";
            //echo "</form>";
            echo "<a href='index.php/download/{$ff}'> Download File </a>";
            if (is_dir($dir . '/' . $ff)) {
                listFolderFiles($dir . '/' . $ff);
            }
            echo '</td>';
            echo "</tr>";
        }
    }
    echo '</table>';
}

listFolderFiles('repository/');

