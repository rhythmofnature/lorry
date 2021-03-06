<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\business\models\VehicleDetails;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\business\models\DriverDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-xs-12 col-lg-12">
  <div class="<?php echo $model->isNewRecord ? 'box-success' : 'box-info'; ?> box view-item col-xs-12 col-lg-12">
   <div class="driver-details-form">

    <?php $form = ActiveForm::begin([
			'id' => 'driver-details-form',
    ]); ?>
    
   <div class="col-xs-12 col-lg-12 no-padding">
    <div class="col-xs-12 col-sm-6 col-lg-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => 250]) ?>
    </div>

    <div class="col-xs-12 col-sm-6 col-lg-6">
       <?= $form->field($model, 'place')->textInput(['maxlength' => 250]) ?>
    </div>
   </div>  
     
   <div class="col-xs-12 col-lg-12 no-padding">
    <div class="col-xs-12 col-sm-6 col-lg-6">
    <?php
    echo $form->field($model, 'vehicle')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(VehicleDetails::find()->select(['id','concat(name," - ",vehicle_number) as name'])->where(['status'=>1])->orderBy('name')->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Select Vehicle ...','style'=>'width:400px','id'=>'vehicle-id'],
    'pluginOptions' => [
    'allowClear' => true
    ],
    ]);
    ?>        
    </div>

    <div class="col-xs-12 col-sm-6 col-lg-6">
    <?= $form->field($model, 'phone')->textInput(['maxlength' => 15]) ?>
    </div>
   </div> 
   
     	 <?= $form->field($model, 'status', ['template' => "{input}"])->hiddenInput(['value' => 1]); ?>
    	 <?= $form->field($model, 'customer_type', ['template' => "{input}"])->hiddenInput(['value' => 3]); ?>	
	
   
    <div class="form-group col-xs-12 col-sm-6 col-lg-4 no-padding">
	<div class="col-xs-6">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord  ? 'btn btn-block btn-success' : 'btn 
btn-block btn-info']) ?>
	</div>
	<div class="col-xs-6">
	<?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default btn-block']) ?>
	</div>
    </div>     
    
    
    <?php ActiveForm::end(); ?>
</div>
</div>
</div>    

