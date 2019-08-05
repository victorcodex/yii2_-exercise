<?php
namespace app\components;

use yii\validators\Validator;

class PersonalCodeValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (strlen($model->$attribute) !== 11) {
            $this->addError($model, $attribute, 'The personal code must be 11 digits.');

            return;
        }

        try {
            $gender = substr($model->$attribute, 0, 1);
            if ($gender < 1 || $gender > 6) {
                throw new \Exception();
            }

            if ($gender < 3) {
                $century = 19;
            } elseif ($gender < 5) {
                $century = 20;
            } else {
                $century = 21;
            }

            $birthDate = new \DateTime(($century - 1) . substr($model->$attribute, 1, 6));
            if ($birthDate > new \DateTime() || $birthDate < new \DateTime('1900-01-01')) {
                throw new \Exception();
            }
        } catch (\Exception $exception) {
            $this->addError($model, $attribute, 'Invalid personal code.');
        }
    }
}
