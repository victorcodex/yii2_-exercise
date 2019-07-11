<?php
namespace app\commands;

use app\models\Loan;
use app\models\User;
use yii\console\Controller;

/**
 * This command imports the user.json and loan.json to DB.
 */
class ImportController extends Controller
{
    public function actionIndex()
    {
        $data = json_decode(file_get_contents(\Yii::$app->basePath.'/users.json'), true);

        $users = [];
        foreach ($data as $user) {
            $userId = $user['id'];
            unset($user['id']);

            $users[$userId] = new User();
            $users[$userId]->attributes = $user;
            $users[$userId]->save();

            echo $users[$userId]->email . '. The User added.' . PHP_EOL;
        }

        $data = json_decode(file_get_contents(\Yii::$app->basePath.'/loans.json'), true);

        foreach ($data as $loan) {
            unset($loan['id']);
            $loan['user_id'] = $users[$loan['user_id']]->id;

            $loan['start_date'] = date('Y/m/d H:i:s', $loan['start_date']);
            $loan['end_date'] = date('Y/m/d H:i:s', $loan['end_date']);

            $model = new Loan();
            $model->attributes = $loan;
            $model->save();
        }
    }
}
