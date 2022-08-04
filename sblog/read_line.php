<?php
function read_line($fileName) {
        $fp = fopen($fileName, 'r');
        fseek($fp, 23);
        $data = fread($fp, 100);
        fclose($fp);
        return explode("\n",$data)[0];
}
?>