<?php
$filename = 'new/';
if (is_writable($filename)) {
    echo 'The file is writable';
} else {

    echo 'The file is not writable';
chmod("new/", 0777);
    if (is_writable($filename)) {
    echo 'The file is writables';
} else {
    
    echo 'The file is not writable';
    
}
}


$filename = 'assets';
if (is_writable($filename)) {
    echo 'The file is writable';
} else {

    echo 'The file is not writable';
chmod("assets/", 0777);
    if (is_writable($filename)) {
    echo 'The file is writables';
} else {
    
    echo 'The file is not writable';
    
}
}
?>