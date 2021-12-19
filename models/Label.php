<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "label".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property int $origin_country_id
 * @property string $location
 * @property int $is_active
 *
 * @property Country $originCountry
 */
class Label extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'label';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'origin_country_id', 'location'], 'required'],
            [['origin_country_id', 'is_active'], 'integer'],
            [['name', 'created_at', 'location'], 'string', 'max' => 255],
            [['origin_country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['origin_country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'origin_country_id' => 'Origin Country ID',
            'location' => 'Location',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * Gets query for [[OriginCountry]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOriginCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'origin_country_id']);
    }
}
