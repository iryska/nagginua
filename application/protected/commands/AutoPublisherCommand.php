<?php

/**
 * Created by PhpStorm.
 * User: godson
 * Date: 28.03.14
 * Time: 10:31
 */
class AutoPublisherCommand extends CConsoleCommand
{
    public function run($args)
    {
        $getNews    = Yii::app()->db->createCommand(
            "
                        SELECT group_hash, group_concat(id) AS ids, count(id) AS cnt
                        FROM pending_news
                        WHERE
                            processed = 1
                            AND status = 'pending'
                        GROUP BY group_hash
                        HAVING cnt < 7
                        ORDER BY group_hash ASC, cnt DESC"
        );
        $dataReader = $getNews->query();
        while (($row = $dataReader->read()) !== false) {
            $newsId   = explode(",", $row['ids']);
            $newsId[] = $row['group_hash'];

            $getOneNews = Yii::app()->db->createCommand(
                "
                                SELECT id, length(search_content) AS len
                                FROM pending_news
                                WHERE id IN (" . implode(",", $newsId) . ")
                ORDER BY len DESC, id ASC
                LIMIT 1"
            );

            $dr = $getOneNews->query();
            if (($result = $dr->read()) !== false) {
                if ($pn = PendingNews::model()->findByPk($result['id'])) {
                    $wp = new Wordpress();
                    if ($wp->createPost($pn->title, $pn->content, "publish")) {
                        $pn->status = 'approved';
                        $pn->save();

                        $newsId = array_unique($newsId);
                        $key    = array_search($result['id'], $newsId);
                        if ($key !== false) {
                            unset($newsId[$key]);
                        }
                        if ($newsId && !empty($newsId)) {
                            PendingNews::model()->updateAll(
                                array("status" => "rejected"),
                                "id IN(" . implode(",", $newsId) . ")"
                            );
                        }
                    }
                }
            }
        }
    }
} 