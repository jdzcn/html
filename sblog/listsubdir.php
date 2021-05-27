<?php
$dir = new DirectoryIterator('.');
foreach ($dir as $fileinfo) {
    if ($fileinfo->isDir() && !$fileinfo->isDot()) {
        echo $fileinfo->getFilename().'<br>';
    }
}
?>