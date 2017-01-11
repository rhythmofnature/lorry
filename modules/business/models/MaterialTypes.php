<?php

namespace app\modules\business\models;

use Yii;

/**
 * This is the model class for table "bur_material_types".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $measurement_type
 * @property string $status
 */
class MaterialTypes extends \yii\db\ActiveRecord
{
	public $customer;
	public static $measurementType = array(
        
        "1"=>"Feet",
        "2"=>"NUmber",
        "3"=>"Load"
    );
    public static $status = array(
        
        "1"=>"Active",
        "0"=>"In Active"
    );
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bur_material_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['customer'], 'safe'],
            
            [['measurement_type'], 'integer'],
            [['name'], 'string', 'max' => 250],
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
            'description' => 'Description',
            'measurement_type' => 'Measurement Type',
            'status' => 'Status',
        ];
    }
}
