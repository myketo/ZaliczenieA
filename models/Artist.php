<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artist".
 *
 * @property int $id
 * @property string $name
 * @property string|null $alt_name
 * @property int $country_id
 * @property string $active_since
 *
 * @property Country $country
 */
class Artist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'country_id', 'active_since'], 'required'],
            [['country_id'], 'integer'],
            [['name', 'alt_name', 'active_since'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
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
            'alt_name' => 'Alt Name',
            'country_id' => 'Country ID',
            'active_since' => 'Active Since',
        ];
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
}
