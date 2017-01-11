<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\business\models\MaterialTypes;
use app\modules\business\models\DriverDetails;
use app\modules\business\models\VehicleDetails;
use app\modules\business\models\CustomerDetails;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\widgets\Select2

/* @var $this yii\web\View */
/* @var $model app\modules\business\models\Trips */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="col-xs-12 col-lg-12">
<div class="<?php echo $model->isNewRecord ? 'box-success' : 'box-info'; ?> box view-item col-xs-12 col-lg-12">
   <div class="vehicle-details-form">


    <?php $form = ActiveForm::begin(); ?>
    
    <div class="col-xs-12 col-lg-12 no-padding">
        <div class="col-xs-12 col-sm-6 col-lg-6">
        <?php 
        if(!isset($model->date_of_travel)){
            $model->date_of_travel=date("d-m-Y");
        }
        echo $form->field($model, 'date_of_travel')->widget(yii\jui\DatePicker::className(),
        [
            'clientOptions' =>[
                    'dateFormat' => 'dd-mm-yyyy',
                    'changeMonth'=> true,
                    'changeYear'=> true,
                    'autoSize'=>true,
                    'yearRange'=>'1900:'.(date('Y')+1)],
                    'options'=>[
                    'class'=>'form-control',
                    'placeholder' => $model->getAttributeLabel('date_of_travel'),'style'=>'width:400px'
                ],]) ?>
        </div>
        
        <div class="col-xs-12 col-sm-6 col-lg-6">
        <?= $form->field($model, 'site_name')->textInput(['maxlength' => 250,'style'=>'width:400px']) ?>
        </div>
    </div>
      
    <div class="col-xs-12 col-lg-12 no-padding">
        <div class="col-xs-12 col-sm-6 col-lg-6">
         <?php
            echo $form->field($model, 'buyer')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(CustomerDetails::find()->where(['status'=>1,'customer_type'=>2])->orderBy('name')->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Select Customer ...','style'=>'width:400px'],
            'pluginOptions' => [
            'allowClear' => true
            ],
            ]);
            ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-6">
         <?php
            echo $form->field($model, 'vehicle_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(VehicleDetails::find()->select(['id','concat(name," - ",vehicle_number) as name'])->where(['status'=>1])->orderBy('name')->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Select Vehicle ...','style'=>'width:400px','id'=>'vehicle-id'],
            'pluginOptions' => [
            'allowClear' => true
            ],
            ]);
            ?>        
        
        </div>
    </div>
      
    <div class="col-xs-12 col-lg-12 no-padding">
        <div class="col-xs-12 col-sm-6 col-lg-6">
        <?php echo $form->field($model, 'driver_id')->widget(DepDrop::classname(), 
        [
        'type'=>DepDrop::TYPE_SELECT2,
        'options'=>['id'=>'driver_id','style'=>'width:400px'],
        'data'=> ArrayHelper::map(DriverDetails::find()->where(['status'=>1,'customer_type'=>3])->all(), 'id', 'name'),
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
        'depends'=>['vehicle-id'],
        'placeholder'=>'Select driver',
        'url'=>Url::to(['/business/driver/driverlist'])
        ]
        ]);
        ?>   
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-6">
        <?= $form->field($model, 'material_id')
        ->dropDownList(
        ArrayHelper::map(MaterialTypes::find()->where(['status'=>1])->all(), 'id', function($model, $defaultValue) {
        return $model->name;
        }
        ),
        ['prompt'=>'Select Material','style'=>'width:400px']
        );?>
        </div>
    </div>

    <div class="col-xs-12 col-lg-12 no-padding">
        <div class="col-xs-12 col-sm-6 col-lg-6">
        <?= $form->field($model, 'size')->textInput(['maxlength' => 100,'style'=>'width:400px']) ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-6">
        <?= $form->field($model, 'buyer_trip_sheet_number')->textInput(['maxlength' => 20,'style'=>'width:400px']) ?>
        </div>
    </div>
    
    <div class="col-xs-12 col-lg-12 no-padding">
 
        <div class="col-xs-12 col-sm-6 col-lg-6">
        <?= $form->field($model, 'kilometre')->textInput(['maxlength' => 100,'style'=>'width:400px']) ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-6">
        <?= $form->field($model, 'vehicle_rent')->textInput(['style'=>'width:400px']) ?>
        </div>
    </div>    
    
       
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
</div></div>

