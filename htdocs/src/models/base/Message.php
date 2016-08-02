<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "message".
 *
 * @property integer $id
 * @property string $id_phone
 * @property integer $id_case
 * @property integer $id_sender_type
 * @property integer $id_message_type
 * @property string $message
 * @property string $sent
 *
 * @property \app\models\Cases $idCase
 * @property \app\models\MessageType $idMessageType
 * @property \app\models\SenderType $idSenderType
 * @property string $aliasModel
 */
abstract class Message extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_case', 'id_sender_type', 'id_message_type'], 'integer'],
            [['sent', 'sid'], 'safe'],
            [['id_phone'], 'string', 'max' => 15],
            [['message'], 'string', 'max' => 50],
            [['id_case'], 'exist', 'skipOnError' => true, 'targetClass' => Cases::className(), 'targetAttribute' => ['id_case' => 'id']],
            [['id_message_type'], 'exist', 'skipOnError' => true, 'targetClass' => MessageType::className(), 'targetAttribute' => ['id_message_type' => 'id']],
            [['id_sender_type'], 'exist', 'skipOnError' => true, 'targetClass' => SenderType::className(), 'targetAttribute' => ['id_sender_type' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_phone' => Yii::t('app', 'Id Phone'),
            'id_case' => Yii::t('app', 'Id Case'),
            'id_sender_type' => Yii::t('app', 'Id Sender Type'),
            'id_message_type' => Yii::t('app', 'Id Message Type'),
            'message' => Yii::t('app', 'Message'),
            'sid' => Yii::t('app', 'Message sid'),
            'sent' => Yii::t('app', 'Sent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCase()
    {
        return $this->hasOne(\app\models\Cases::className(), ['id' => 'id_case']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageType()
    {
        return $this->hasOne(\app\models\MessageType::className(), ['id' => 'id_message_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenderType()
    {
        return $this->hasOne(\app\models\SenderType::className(), ['id' => 'id_sender_type']);
    }



    /**
     * @inheritdoc
     * @return MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\MessageQuery(get_called_class());
    }


}
