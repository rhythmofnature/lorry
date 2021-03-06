<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\business\models\CustomerDetails;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\business\models\TripsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trips';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-xs-12">
  <div class="col-lg-4 col-sm-4 col-xs-12 no-padding"><h3 class="box-title"><i class="fa fa-th-list"></i> <?= $this->title ?></h3></div>
  <div class="col-xs-4"></div>
  <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
	<div class="col-xs-4 left-padding">
	
	</div>
	<div class="col-xs-4 left-padding">
	
	</div>
	<div class="col-xs-4 left-padding">
	<?= Html::a('ADD', ['create'], ['class' => 'btn btn-block btn-success']) ?>
	</div>
  </div>
</div>

<div class="col-lg-12">
    <?php if(Yii::$app->session->hasFlash('delete')): ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('delete') ?>
        </div>
    <?php endif; ?>
</div>


<div class="col-xs-12" style="padding-top: 10px;">
   <div class="box">
      <div class="box-body table-responsive">
	<div class="batches-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

	[
		'label' => 'Date',
		'attribute' => 'date_of_travel',
		 'filter' => \yii\jui\DatePicker::widget(['dateFormat' => 'dd-MM-yyyy','model'=>$searchModel,
        'attribute'=>'date_of_travel',]),
		 'format' => 'html',
		'value' => function ($searchModel,$key,$index){
		return  date("d-m-Y",strtotime($searchModel->date_of_travel));			
		},
 	    ],
	[
	'label'=>'Customer',
        'attribute'=>"buyer"
         ],
	 [
	 'label'=>'Vehicle',
         'attribute'=>"vehicle_id",
	  ],
	  [
	    'label'=>'Driver',
	    'attribute'=>"driver_id"
	  ],
	//'kilometre',
	//'vehicle_rent', 
	 [
	    'label'=>'Material',
	    'attribute'=>"material_id" 
         ],
 
           // 'size',
            // 'measurement_type',
             'site_name',
            // 'site_place',
            // 'kilometre',
            // 'vehicle_rent',
            // 'driver_amount',
            // 'merchant_amount',
            // 'buyer_amount',
            // 'buyer_amount_total',
            // 'buyer_trip_sheet_number',
            // 'seller_trip_sheet_number',
	    [
		    'class' => 'yii\grid\ActionColumn',
		    'template' => '{view} {update} {delete} {print}',
		    'buttons' => [
			    'print' => function ($url,$model,$key) {
				//return Html::a('<span class="fa fa-rupee"></span>',Yii::$app->homeUrl.'/business/customer/prices/?id='.$model->id);
				return Html::a('<i class="fa fa-print"></i>',['/business/trips/print','id'=>$model->id],['target'=>'_blank']);
			    },
		    ],
	    ],
        ],
    ]); ?>

</div>
      </div>
    </div>
</div>
