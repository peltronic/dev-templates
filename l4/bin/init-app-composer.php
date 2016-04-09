<?php
$file = "./test.txt";
$fh = fopen($file,'r+');

// string to put username and passwords
$filestrOut = '';

while(!feof($fh)) {

    $linestr = fgets($fh);
    $tabindents = preg_match_all('/\t/', $linestr, $matches);
    $linestr = preg_replace('/\t/','    ', $linestr); // replace tabs with spaces

    if ( preg_match('/"classmap":/', $linestr, $matches) ) {
        $filestrOut .= $linestr;
        $filestrOut .= str_repeat(" ", 4*($tabindents+1));
        $filestrOut .= '"app/modules/site",'."\n";
        $filestrOut .= str_repeat(" ", 4*($tabindents+1));
        $filestrOut .= '"app/modules/admin",'."\n";
        $filestrOut .= str_repeat(" ", 4*($tabindents+1));
        $filestrOut .= '"app/modules/api",'."\n";
    } else {
        $filestrOut .= $linestr;
    }

}
// using file_put_contents() instead of fwrite()
file_put_contents('./test.txt', $filestrOut);

fclose($fh); 

//var_dump($linestr); continue;
//print_r($matches);
//print_r($n);
//print_r($linestr); 
//continue;
//print_r($linestr.': '.$matches); continue;
        //print_r($matches);
