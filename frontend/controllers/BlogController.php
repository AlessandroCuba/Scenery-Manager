<?php

namespace frontend\controllers;

use yeesoft\post\models\Post;
use yeesoft\page\models\Page;
use yii\data\Pagination;
use Yii;

class BlogController extends \yii\web\Controller
{
    public function actionIndex($slug = 'blog')
    {
        // display home page
        if (empty($slug) || $slug == 'blog') {
            $this->layout = 'blog';
            $query = Post::find()->where(['status' => Post::STATUS_PUBLISHED]);
            $countQuery = clone $query;

            $pagination = new Pagination([
                'totalCount' => $countQuery->count(),
                'defaultPageSize' => Yii::$app->settings->get('reading.page_size', 10),
            ]);

            $posts = $query->orderBy('published_at DESC')->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('index', [
                'posts' => $posts,
                'pagination' => $pagination,
            ]);
        }

        //try to display action from controller
        try {
            return $this->runAction($slug);
        } 
        catch (\yii\base\InvalidRouteException $ex) {
            
        }

        //try to display static page from datebase
        $page = Page::getDb()->cache(function ($db) use ($slug) {
            return Page::findOne(['slug' => $slug, 'status' => Page::STATUS_PUBLISHED]);
        }, 3600);

        if ($page) {
            //$this->layout = 'blog';
            $pageAction = new PageAction($slug, $this, [
                'slug'   => $slug,
                'page'   => $page,
                'view'   => $page->view,
                'layout' => $page->layout,
            ]);

            return $pageAction->run();
        }

        //try to display post from datebase
        $post = Post::getDb()->cache(function ($db) use ($slug) {
            return Post::findOne(['slug' => $slug, 'status' => Post::STATUS_PUBLISHED]);
        }, 3600);

        if ($post) {
            $this->layout = 'blog';
            $postAction = new PostAction($slug, $this, [
                'slug'   => $slug,
                'post'   => $post,
                'view'   => $post->view,
                'layout' => 'blog', //$post->layout,
            ]);

            return $postAction->run();
        }

        //if nothing suitable was found then throw 404 error
        throw new \yii\web\NotFoundHttpException('Page not found.');
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
