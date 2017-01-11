<?php

namespace app\modules\business\models;

use Yii;

/**
 * This is the model class for table "bur_vehicle_details".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $vehicle_number
 * @property string $size
 * @property string $charge_per_km
 * @property string $status
 */
class VehicleDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public static $type = array(
        
        "1"=>"Lorry",
        "2"=>"Tipper",
        "3"=>"Other"
    );
    public static $status = array(
        
        "1"=>"Active",
        "0"=>"In Active"
    );
    public static function tableName()
    {
        return 'bur_vehicle_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'vehicle_number', 'size'], 'required'],
            [['type'], 'integer'],
            [['name', 'size'], 'string', 'max' => 250],
            [['vehicle_number'], 'string', 'max' => 12],
            [['charge_per_km'], 'string', 'max' => 15],
            [['status'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'vehicle_number' => 'Vehicle Number',
            'size' => 'Owner Name & Phone Number',
            'charge_per_km' => 'Charge Per Km',
            'status' => 'Status',
        ];
    }
}
