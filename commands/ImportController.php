<?php
namespace app\commands;

use app\models\Loan;
use app\models\User;
use Yii;
use yii\console\Controller;

/**
 * This command imports the user.json and loan.json to DB.
 */
class ImportController extends Controller
{
    public function actionIndex()
    {
        // User
        $data = json_decode(file_get_contents(\Yii::$app->basePath.'/users.json'), true);

        $columnNameArray=['id', 'first_name', 'last_name', 'email', 'personal_code', 'phone', 'active', 'dead', 'lang'];
        $insertCount = Yii::$app->db->createCommand()
            ->batchInsert(
                'user', $columnNameArray, $data
            )
            ->execute();

        echo $insertCount . ' users has been added.' . PHP_EOL;

        // Loan
        $data = json_decode(file_get_contents(\Yii::$app->basePath.'/loans.json'), true);

        foreach ($data as &$loan) {
            $loan['start_date'] = date('Y/m/d H:i:s', $loan['start_date']);
            $loan['end_date'] = date('Y/m/d H:i:s', $loan['end_date']);
            $loan['status'] = boolval(intval($loan['status']));
        }

        $columnNameArray = ['id', 'user_id', 'amount', 'interest', 'duration', 'start_date', 'end_date', 'campaign', 'status'];
        $insertCount = Yii::$app->db->createCommand()
            ->batchInsert(
                'loan', $columnNameArray, $data
            )
            ->execute();

        echo $insertCount . ' loans has been added.' . PHP_EOL;
    }
}
