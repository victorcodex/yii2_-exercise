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
    /** @var integer */
    private $age;

    /** @var \DateTime */
    private $birthDate;

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
     * Calculates age by personal code
     *
     * @return int
     */
    public function getAge()
    {
        if ($this->age) {
            return $this->age;
        }

        $this->age = $this->getBirthDate()->diff(new \DateTime())->y;

        return $this->age;
    }

    /**
     * Calculate birth date by personal code
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        if ($this->birthDate) {
            return $this->birthDate;
        }

        $centuryCode = substr($this->personal_code, 0, 1);
        if ($centuryCode < 3) {
            $century = 19;
        } elseif ($centuryCode < 5) {
            $century = 20;
        } else {
            $century = 21;
        }

        $this->birthDate = new \DateTime(($century - 1) . substr($this->personal_code, 1, 6));

        return $this->birthDate;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::class, ['userId' => 'id']);
    }
}
