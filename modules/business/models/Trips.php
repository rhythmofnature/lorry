<?php

namespace app\modules\business\models;

use Yii;

/**
 * This is the model class for table "bur_trips".
 *
 * @property integer $id
 * @property string $date_of_travel
 * @property integer $vehicle_id
 * @property integer $driver_id
 * @property integer $material_id
 * @property string $size
 * @property integer $measurement_type
 * @property string $site_name
 * @property string $site_place
 * @property string $kilometre
 * @property double $vehicle_rent
 * @property string $driver_amount
 * @property string $merchant_amount
 * @property string $buyer_amount
 * @property string $buyer_amount_total
 * @property string $buyer_trip_sheet_number
 * @property string $seller_trip_sheet_number
 */
class Trips extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $trip_count;
    public static function tableName()
    {
        return 'bur_trips';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_of_travel'], 'required'],
            [['date_of_travel','ready_merchant','ready_buyer','buyer', 'vehicle_id', 'driver_id', 'material_id','size','driver_phone','lorry_owner','lorry_owner_phone'], 'safe'],
            [['measurement_type'], 'integer'],
            [['vehicle_rent', 'driver_amount', 'merchant_amount', 'buyer_amount', 'buyer_amount_total'], 'number'],
            [['size', 'kilometre'], 'string', 'max' => 100],
            [['site_name', 'site_place'], 'string', 'max' => 250],
            [['buyer_trip_sheet_number', 'seller_trip_sheet_number'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant'=>'Merchant',
            'buyer'=>'Name of the party',
            'date_of_travel' => 'Date Of Travel',
            'vehicle_id' => 'Vehicle',
            'driver_id' => 'Driver',
            'material_id' => 'Load',
            'size' => 'Measurement (Ton)',
            'measurement_type' => 'Measurement Type',
            'site_name' => 'Site Name',
            'site_place' => 'Site Place',
            'kilometre' => 'Kilometer',
            'vehicle_rent' => 'Vehicle Hire',//Vehicle Rent
            'driver_amount' => 'Driver Amount',
            'merchant_amount' => 'Merchant Amount',
            'buyer_amount' => 'Customer Amount',
            'buyer_amount_total' => 'Customer Amount Total',
            'buyer_trip_sheet_number' => 'Other Details(Check posts etc)',
            'seller_trip_sheet_number' => 'Merchant Trip Sheet Number',
            'ready_merchant' =>'Ready cash to merchant',
            'ready_buyer' =>'Ready cash from customer'
        ];
    }


	public function getVehicles()
	{
	    return $this->hasOne(VehicleDetails::className(), ['id' => 'vehicle_id']);
	}

	public function getDriver()
	{
	    return $this->hasOne(DriverDetails::className(), ['id' => 'driver_id']);
	}

	public function getMaterial()
	{
	    return $this->hasOne(MaterialTypes::className(), ['id' => 'material_id']);
	}

	public function getMerchants()
	{
	    return $this->hasOne(CustomerDetails::className(), ['id' => 'merchant']);
	}

	public function getBuyers()
	{
	    return $this->hasOne(CustomerDetails::className(), ['id' => 'buyer']);
	}


}
