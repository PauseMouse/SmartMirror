<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Smart Mirror - Build by the developers of Microsign.</title>
	<style>
	html, body {
		overflow: hidden;
		height: 100%;
		margin: 0;
	}
	.full-height-grid {
		height: 100%;
		display: grid;
		grid-template-columns: 360px 360px auto 360px 360px;
		grid-template-rows: 360px 360px 360px;
	}
	.grid-item {
	  border: 1px solid rgba(0, 0, 0, 0.8);
	}
	</style>
</head>
<body bgcolor="#000000">
	<div class="full-height-grid">
		<?php
		$cell = 0;
		$rowline = 0;
		$columnline = 0;
		for($row = 0; $row < $Rows; $row++)
		{
			//+1 is for the empty space in the middle.
			for($column = 0; $column < $Columns; $column++)
			{
				if($Debug == true)
				{
					echo "<div class='grid-item' style='border: 1px solid red;
						color: red;
						grid-column-start: ".($columnline + 1).";
						grid-column-end: ".($columnline + 2).";
						grid-row-start: ".($rowline + 1).";
						grid-row-end: ".($rowline + 2).";
					'>".$cell."</div>";
				}
				$cellSettings = null;
				$cellSettings = Settings::GetCellSettings($cell);
				if(isset($cellSettings) && $cellSettings !== null)
				{
					if(isset($cellSettings["ModuleName"]))
					{
						$collspan = isset($cellSettings["Colspan"]) ? intval($cellSettings["Colspan"]) : 1;
						$rowspan = isset($cellSettings["Rowspan"]) ? intval($cellSettings["Rowspan"]) : 1;
						$width = 360 * $collspan;
						$height = 360 * $rowspan;
						echo "<div class='grid-item' style='
							grid-column-start: ".($columnline + 1).";
							grid-column-end: ".($columnline + $collspan + 1).";
							grid-row-start: ".($rowline + 1).";
							grid-row-end: ".($rowline + + $rowspan + 1).";
						'>
						<iframe src='/SmartMirror/".$cellSettings["ModuleName"].(isset($cellSettings["MethodName"]) ? "/".$cellSettings["MethodName"] : "").(isset($cellSettings["UniqueName"]) ? "/?UniqueName=".$cellSettings["UniqueName"] : "")."' noresize scrolling=no frameborder=0 width=".$width." height=".$height."></iframe>
						</div>";
					}
				}
				$columnline++;
				$cell++;
			}
			$columnline = 0;
			$rowline++;
		}
		?>
	</div>
</body>
</html>