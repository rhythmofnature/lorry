<?php

namespace app\modules\business\models;

use Yii;

/**
 * This is the model class for table "bur_driver_details".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $dob
 * @property string $mobile
 * @property string $vehicle
 * @property string $earning_percentage
 * @property integer $status
 */
class DriverDetails extends \yii\db\ActiveRecord
{
    public static $status = array(
        
        "1"=>"Active",
        "0"=>"In Active"
    );
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bur_driver_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'dob', 'mobile', 'vehicle', 'earning_percentage'], 'required'],
            [['address'], 'string'],
            [['dob'], 'safe'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 250],
            [['mobile', 'vehicle'], 'string', 'max' => 15],
            [['earning_percentage'], 'string', 'max' => 10]
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
            'address' => 'Address',
            'dob' => 'Dob',
            'mobile' => 'Mobile',
            'vehicle' => 'Vehicle',
            'earning_percentage' => 'Earning Percentage',
            'status' => 'Status',
        ];
    }
}
