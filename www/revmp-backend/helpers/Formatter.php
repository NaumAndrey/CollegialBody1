<?php
/**
 * Created by PhpStorm.
 * User: futul
 * Date: 03.12.18
 * Time: 15:45
 */

namespace app\helpers;

class Formatter
{
    public static function renderQuery(\yii\db\ActiveQuery $query, $per_page, $current_page): array
    {
        $per_page = $per_page > 0 ? $per_page : 20;
        $current_page = $current_page > 0 ? $current_page : 1;
        $total_count = $query->count();
        $last_page = ceil(($total_count ?: 1) / (float)$per_page);
        $at_last_page = $current_page == $last_page;
        $base_path = \Yii::$app->request->hostInfo . '/' . \Yii::$app->request->pathInfo . '?per_page=' . $per_page;
        return [
            'data' => $query->limit($per_page)->offset($per_page * ($current_page - 1))->asArray()->all(),
            'links' => [
                'first' => $base_path,
                'last' => $base_path . '&current_page=' . $last_page,
                'prev' => $current_page === 1 ? null : $base_path . '&current_page=' . ($current_page - 1),
                'next' => $at_last_page ? null : $base_path . '&current_page=' . ($current_page + 1),
            ],
            'meta' => [
                'per_page' => (int)$per_page,
                'current_page' => (int)$current_page,
                'last_page' => $last_page,
                'from' => ($per_page * ($current_page - 1)) + ($total_count <=> 0),
                'to' => $at_last_page ? $total_count : ($per_page * $current_page) + 1,
                'total' => $total_count,
            ],
        ];
    }

    public static function dbNow($time = null): string
    {
        return \date('Y.m.d H:i:s', $time ?? \time());
    }
}