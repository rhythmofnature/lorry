<?php

namespace app\modules\business\controllers;

use Yii;
use app\modules\business\models\Trips;
use app\modules\business\models\TripsSearch;
use app\modules\business\models\MaterialTypes;
use app\modules\business\models\BalanceSheet;
use app\modules\business\models\VehicleDetails;
use app\modules\business\models\DriverDetails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use mPDF;
/**
 * TripsController implements the CRUD actions for Trips model.
 */
class TripsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Trips models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TripsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trips model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Trips model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Trips();

        if (Yii::$app->request->post()) {
                        $trip_count=1;
                        for($i=1;$i<=$trip_count;$i++){
                            $model = new Trips();
                            $model->load(Yii::$app->request->post());
                            $material_id=$model->material_id;
                            /*$material_type=MaterialTypes::findOne($material_id);
                            $model->measurement_type=$material_type->measurement_type;*/
                            $model->date_of_travel = date("Y-m-d H:i:s",strtotime($model->date_of_travel));
                            $model->buyer_amount=$model->buyer_amount_total-$model->vehicle_rent;
                            $model->save();
			}
			
            	return $this->redirect(['index']);
			
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Trips model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
     $count = BalanceSheet::find()->where(['trip_id'=>$id,'status'=>'closed'])->count();
     if($count > 0){
            Yii::$app->session->setFlash('delete',"Cannot update, Bill generated already for this trip ");
            return $this->redirect(['index']);
        }   
    
    
        $model = $this->findModel($id);
		if (Yii::$app->request->post()) {
			$model->load(Yii::$app->request->post());
			BalanceSheet::deleteAll('trip_id = :trip_id', [':trip_id' => $model->id]);
			$model->trip_count = 1;
			$material_id=$model->material_id;
			/*$material_type=MaterialTypes::findOne($material_id);
			$model->measurement_type=$material_type->measurement_type;*/
			$model->date_of_travel = date("Y-m-d H:i:s",strtotime($model->date_of_travel));
			if($model->save()){
            	return $this->redirect(['index']);
			}else{
				return $this->render('view', [
                'model' => $model,
            ]);
			}

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
          //  return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Trips model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        
        $count = BalanceSheet::find()->where(['trip_id'=>$id,'status'=>'closed'])->count();
        if($count==0){
            
            $this->findModel($id)->delete();
            BalanceSheet::deleteAll('trip_id = :trip_id', [':trip_id' => $id]);
            return $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('delete',"Cannot delete, Bill generated already for this trip ");
                return $this->redirect(['index']);
            }
            
            
    }
    
    public function actionPrint($id){
        $model = $this->findModel($id);
        $html = $this->renderPartial('print', ['model' =>$model]);
        $imgSrc = Yii::$app->urlManager->createAbsoluteUrl('site/loadimage');
        $mpdf = new mPDF('utf-8', 'A4',0,'',15,15,25,16,4,9,'P');
        $mpdf->WriteHTML('<watermarkimage src='.$imgSrc.' alpha="0.33" size="50,30"/>');
        $mpdf->showWatermarkImage = false;
        $mpdf->WriteHTML($html);
        $mpdf->Output($title.'.pdf', "I");  
    }    

    /**
     * Finds the Trips model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Trips the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Trips::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAjax()
    {
     $vehicle_id =  $_POST['vehicle_id'];
     $return = array(
                    "driver_name"=>'',
                    "driver_phone"=>'',
                    "owner_name"=>'',
                    "owner_phone"=>''
                    );     
     
     if(!$vehicle_id) {echo json_encode($return);exit;}
     list($v_name,$v_number) = explode(" - ",$vehicle_id);
     
     $return = array(
                    "driver_name"=>'',
                    "driver_phone"=>'',
                    "owner_name"=>'',
                    "owner_phone"=>''
                    );
     
     $v_details = VehicleDetails::find()->where(['name' => $v_name,'vehicle_number'=>$v_number])->one();
     
     if($v_details)
     {
     $return["owner_name"] = $v_details->owner_name;
     $return["owner_phone"] = $v_details->owner_phone;
     
     $d_details = DriverDetails::find()->where(['customer_type' => 3,'vehicle'=>$v_details->id])->one();   
     if($d_details)
     {
      $return["driver_name"] = $d_details->name;
      $return["driver_phone"] = $d_details->phone;
     }
     }
     echo json_encode($return);
    }
}
