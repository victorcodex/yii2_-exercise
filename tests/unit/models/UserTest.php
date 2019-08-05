<?php
namespace tests\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @dataProvider personalCodeProvider
     *
     * @param string  $personalCode
     * @param integer $age
     */
    public function testUserAge($personalCode, $age)
    {
        $user = new User();
        $user->personal_code = $personalCode;

        $this->assertEquals($age, $user->getAge());
        $this->assertEquals($age >= 18 , $user->isAllowedToApplyLoan());
    }

    public function personalCodeProvider()
    {
        return [
            ['49005025465', (new \DateTime('1990-05-02'))->diff(new \DateTime('now'))->y],
            ['36609050333', (new \DateTime('1966-09-05'))->diff(new \DateTime('now'))->y],
            ['50905025465', (new \DateTime('2009-05-02'))->diff(new \DateTime('now'))->y],
        ];
    }
}
