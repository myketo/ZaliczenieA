<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $name
 * @property string $capital
 * @property string $code
 *
 * @property Artist[] $artists
 * @property Label[] $labels
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'capital', 'code'], 'required'],
            [['name', 'capital'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 2],
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
            'capital' => 'Capital',
            'code' => 'Code',
        ];
    }

    /**
     * Gets query for [[Artists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArtists()
    {
        return $this->hasMany(Artist::className(), ['country_id' => 'id']);
    }

    /**
     * Gets query for [[Labels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLabels()
    {
        return $this->hasMany(Label::className(), ['origin_country_id' => 'id']);
    }
}
