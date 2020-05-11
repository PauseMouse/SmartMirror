<?php
    if(isset($ClockSize) === false)
    {
        $ClockSize = 350;
    }
    $margin = (360 - $ClockSize) / 2;
?>
<html>
<head>
    <style>
        body {
            margin : <?php echo $margin."px;" ?>
        }
    </style>
</head>
    <body>
        <?php
            echo "<iframe src='http://free.timeanddate.com/clock/i78qph2e/n1313/szw".$ClockSize."/szh".$ClockSize."/hocfff/hbw0/hfc000/cf100/hgr0/fav0/fiv0/mqcfff/mql15/mqw4/mqd94/mhcfff/mhl15/mhw4/mhd94/mmv0/hhcfff/hmcfff/hscfff' frameborder='0' width='".$ClockSize."' height='".$ClockSize."'></iframe>";
        ?>
    </body>
</html>