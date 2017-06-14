<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_apply_transfer".
 *
 * @property integer $id
 * @property string $apply_id
 * @property integer $old_org_id
 * @property string $old_profession
 * @property integer $target_org_id
 * @property string $target_profession
 * @property string $entry_time
 * @property string $transfer_time
 * @property string $files
 * @property integer $created_at
 */
class ApplyTransfer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_apply_transfer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apply_id', 'old_org_id'], 'required'],
            [['old_org_id', 'target_org_id', 'created_at'], 'integer'],
            [['files'], 'string'],
            [['apply_id', 'old_profession', 'target_profession'], 'string', 'max' => 20],
            [['entry_time', 'transfer_time'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'apply_id' => 'Apply ID',
            'old_org_id' => 'Old Org ID',
            'old_profession' => 'Old Profession',
            'target_org_id' => 'Target Org ID',
            'target_profession' => 'Target Profession',
            'entry_time' => 'Entry Time',
            'transfer_time' => 'Transfer Time',
            'files' => 'Files',
            'created_at' => 'Created At',
        ];
    }
}