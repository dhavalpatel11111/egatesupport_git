<html>
<?php foreach($contracts as $contract){ ?>
<div>
	<div class="col-md-4">
		<div style="width:100%;font-size:10px">
			<div style="width:68%;float:left;padding-top:8px;padding-left:10px">
				<div><span style="color:red;"> SKU </span> : <?= $contract['sku'] ?> </div>
				<div><span> TAG </span> : <?= $contract['tag'] ?> </div>
			</div>
			<div style="width:30%;float:right;margin-right:-10px">
				<img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?= $contract['sku'] ?>" title="QR code" />
			</div>
			
			<div style="width:100%;padding-left:10px;padding-top:-10px;">
				<div><span> Model </span> : <?= $contract['model_name'] ?> </div>
				<div><span> Loc </span> : <?= $contract['cname'] ?> </div>
				<div><span> CT No </span> : <?= $contract['contractno'] ?> </div>
			</div>
			<div style="width:100%;">
				<div style="width:20%;float:left;padding-top:10px">
					<img src="https://chart.googleapis.com/chart?chs=60x60&cht=qr&chl=<?= $contract['serial'] ?>" title="QR code" />
				</div>
				<div style="width:59%;float:left;text-align:center;">
					<div style="padding-top:15px;"><?= $contract['serial'] ?> </div>
					<div><span> Caseserial No </span> : <?= $contract['caseserial'] ?> </div>
				</div>
				<div style="width:20%;float:left;padding-top:10px">
					<img src="https://chart.googleapis.com/chart?chs=60x60&cht=qr&chl=<?= $contract['caseserial'] ?>" title="QR code" />
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<table>
			<TR>
				<th style="padding-left:10px;padding-right:10px">Date</th>
				<th style="font-size:8px;padding-left:10px;padding-right:10">Description</th>
				<th style="font-size:8px">Checked By</th>
				<th style="padding-left:10px;padding-right:10px">Date</th>
				<th style="font-size:8px;padding-left:10px;padding-right:10">Description</th>
				<th style="font-size:8px">Checked By</th>
				<th style="padding-left:10px;padding-right:10px">Date</th>
				<th style="font-size:8px;padding-left:10px;padding-right:10">Description</th>
				<th style="font-size:8px">Checked By</th>
			</TR>
			<?php for($i=0;$i<6;$i++) { ?>
			<TR>
				<td style="text-align:center">/</td>
				<td></td>
				<td></td>
				<td style="text-align:center">/</td>
				<td></td>
				<td></td>
				<td style="text-align:center">/</td>
				<td></td>
				<td></td>
				
			</TR>
			<?php } ?>
		</table>
	</div>
</div>
<div style="width:100%;padding-top:5px;padding-bottom:5px;color:#b2b2b2">--------------------------------------------------------------------------------------------------------------------------------------------------------</div>
<?php } ?>
</html>

<style>
.col-md-4{ float:left; width:29.5%; border:1px solid #b2b2b2;height:148px;}
.col-md-8{ float:left; width:70%;}
table th, td{ border:1px solid #b2b2b2 !important;font-size:10px; }
table {  
    border-collapse: collapse;
	width:100%;
}
th, td {
    padding: 0;
	height:21px !important;
}
</style>