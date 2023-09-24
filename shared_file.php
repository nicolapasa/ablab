<?php

$file = fopen("./exreader/cane.xls","w+");

$lock="./exreader/.~lock.cane.xls#";
//.~lock.cane
if (file_exists($lock))
{
    echo "Excel $file is locked.";
}
else
{
    echo "Excel $file is free.";
}
//unlink("./simple.css");