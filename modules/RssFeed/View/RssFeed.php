<!DOCTYPE html>
<html lang="en">
<head>
<style>
    body {
        margin: 0;
    }
    #rssDiv {
        color: #ffffff;
    }
    a {
        color: #ffffff;
    }
    a:visited {
        color: #ffffff;
    }
    .feedEkList {
        list-style: none;
        margin-top: 0px;
        margin-block-start: 10px;
        margin-block-end: 0px;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 10px;
        padding-inline-end: 10px;
    }
    .feedEkList li {
        margin-top: 10px;
    }
</style>
</head>
<body>
	<div id="rssDiv"></div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="../modules/RssFeed/js/FeedEk.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
       		$('#rssDiv').FeedEk({
                FeedUrl: '<?php echo $FeedUrl; ?>', 
                MaxCount: <?php echo $MaxCount; ?>
			});
		});
	</script>
</body>
</html>
