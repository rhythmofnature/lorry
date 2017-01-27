<?php 
use yii\helpers\Html;
use app\modules\business\models\CustomerDetails;
use app\modules\business\models\BalanceSheet;
use app\modules\business\models\Transactions;
use app\modules\business\models\MaterialTypes;
?>
<html>
<head>
<title>Trip Details</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl;?>/css/print-receipt.css" media="screen, print, projection" />
</head>
<body>

<div id="pcr">
<?php $orgData = \app\models\Organization::find()->asArray()->one(); ?>

<table class="table table-bordered table-main">
<tr>
<td colspan=2 class="text-left padding-left padding-right" style="border-bottom:1px solid #000;height:80px">
<table>
<tr>
    <td rowspan=3><?php echo Html::img(Yii::$app->urlManager->createUrl('/site/loadimage'), []); ?></td>
    <td class="text-left org-title"><?php echo $orgData['org_name']; ?></td>
</tr>
<tr><td class="text-left org-address"><?php echo $orgData['org_address_line1']; ?></td></tr>
<tr><td class="text-left org-address">Mob: <?php echo $orgData['org_phone']; ?></td></tr>
</table>
</td>
</tr>
<tr><td colspan=2 class="text-right padding-right padding-right">Date: <?php echo date("m-d-Y",strtotime($model->date_of_travel)); ?></td>
</tr>
<tr><td colspan=2 style="height:30px;"></td>
</tr>
<tr>
<td colspan=2 class="text-left padding-left padding-right" style="border-bottom:1px solid #000;">
<table style="width:100%;" class="inner">
<tr>
<td  align="left" width="50%">Vehicle:</td>
<td align="left"><?= $model->vehicle_id ?></td>
</tr>
<tr>
<td  align="left">Vehicle Hire:</td>
<td align="left">
<?php echo $model->vehicle_rent;
if($model->size) 
{
if(!stristr($model->size,"ton")) $model->size .= " Ton";
echo " (".$model->size.")";
}
?></td>
</tr>
<tr>
<td  align="left">Load:</td>
<td align="left"><?= $model->material_id?></td>
</tr>
<tr>
<td  align="left">Lorry Owner Name & Phone Number:</td>
<td align="left">
<?php echo  $model->lorry_owner;
      if($model->lorry_owner_phone) echo ",".$model->lorry_owner_phone;
 ?>
</td>
</tr>
<tr>
<td  align="left">Lorry Driver Name & Phone Number:</td>
<td align="left">
<?php echo  $model->driver_id;
      if($model->driver_phone) echo ",".$model->driver_phone;
 ?>
</td>
</tr>
<tr>
<td  align="left" >Name of the party:</td>
<td align="left" ><?php
echo $model->buyer;
?></td>
</tr>
<tr>
<td  align="left" >Site Name:</td>
<td align="left" ><?php
echo $model->site_name;
if($model->kilometre) echo " (".$model->kilometre." KM)";
?>
</td>
</tr>
<tr>
<td  align="left" class="last">Other Details:</td>
<td align="left" class="last"><?= $model->buyer_trip_sheet_number ?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" colspan="2">
<div style="font-style: italic;font-size:9px">
Affiliated to Federation of kerala Lorry Transporting Agents Association.<br/>
<b>Note:</b> Check Lorry R.C.Book at your risk.We are not responsible for leakage and transit damage.If the lorry will be on accident on the way we are not responsible for any risk.Perubavoor Jurisdiction only.
</div>
</td>
</tr>
</table>	
</div>
<style>
.inner td
{
 border-bottom:1px solid #cfcfcf;
}

.inner td.last
{
 border-bottom:none;
}
</style>
</body>
</html>
