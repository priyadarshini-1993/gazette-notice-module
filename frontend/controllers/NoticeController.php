<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use common\services\GazetteService;

class NoticeController extends Controller
{
    public function actionIndex()
    {
        $service = new GazetteService();

        $page = Yii::$app->request->get('page', 1);
        $limit = 10;

        $data = $service->getNotices($page, $limit);

        $totalCount = $data['total'];
        $items = $data['items'];

        // Yii2 pagination
        $pagination = new Pagination([
            'totalCount' => $totalCount,
            'defaultPageSize' => $limit,
            'pageSize' => $limit,
            'page' => $page - 1,
            'pageSizeParam' => false,
        ]);

        return $this->render('index', [
            'items' => $items,
            'pagination' => $pagination,
        ]);
    }
}
