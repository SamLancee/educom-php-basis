<?php
$list =[0,1];
for($i=2;$i<22 ;$i++){
    $list[]=$list[$i-1] + $list[$i-2];

}

$reeks = implode(',',$list);
?>


<!doctype html>
<html>
    <head>
        <H2>Fibonacci Reeks</H2>
    </head>

    <body>
        <p><?php echo $reeks; ?><p>
    </body>

</html>