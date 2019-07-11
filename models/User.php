<?php

namespace app\models;

use app\components\PersonalCodeValidator;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $personal_code
 * @property int $phone
 * @property bool $active
 * @property bool $dead
 * @property string $lang
 *
 * @property Loan[] $loans
 */
class User extends \yii\db\ActiveRecord
{
    private $age;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'personal_code', 'phone'], 'required'],
            [['first_name', 'last_name', 'lang'], 'string'],
            [['email'], 'email'],
            [['personal_code', 'phone'], 'integer'],
            [['active', 'dead'], 'boolean'],
            [['personal_code'], PersonalCodeValidator::class],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'personal_code' => 'Personal Code',
            'phone' => 'Phone',
            'active' => 'Active',
            'dead' => 'Dead',
            'lang' => 'lang',
        ];
    }

    /**
     * @return int
     */
    public function getAge()
    {
        if ($this->age) {
            return $this->age;
        }

        $birthDateString = sprintf(
            '%s-%s-%s',
            substr($this->personal_code, 1, 2),
            substr($this->personal_code, 3, 2),
            substr($this->personal_code, 5, 2)
        );
        $birthDate = new \DateTime($birthDateString);

        $this->age = $birthDate->diff(new \DateTime())->y;

        return $this->age;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::class, ['userId' => 'id']);
    }
}
