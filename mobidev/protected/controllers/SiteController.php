<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/yii/mobidev/protected/extensions/github-api/vendor/autoload.php');

class SiteController extends Controller {

    public $layout = 'column2';

    public function actionIndex() {
        $client = new Github\Client();
        if (isset($_GET['q'])) {
            $get = $_GET['q'];
            $repos = $client->api('repo')->find("$get", array('start_page' => 1), 1);
            foreach ($repos['repositories'] as $value) {
                $arr_repo[] = array(
                    'name' => $value['name'],
                    'owner' => $value['owner'],
                    'description' => $value['description'],
                    'homepage' => $value['homepage'],
                    'watchers' => $value['watchers'],
                    'forks' => $value['forks'],
                    'open_issues' => $value['open_issues'],
                    'url' => $value['url'],
                    'created' => $value['created']);
            }            
            foreach ($arr_repo as $k => $v) {
                $name = $arr_repo[$k]['name'];
                $find = Mobidev::model()->findByAttributes(array('name' => $name));
                $model = new Mobidev;
                if (empty($find))
                    $model->isNewRecord = true;
                else
                    $model->isNewRecord = false;
                $model->attributes = $arr_repo[$k];
                if ($model->validate()) 
                    $model->save();
                else 
                    echo CHtml::errorSummary($model);                
            }            
        }
        $this->render('index');
    }

    public function actionDetail() {
        $client = new Github\Client();
        $repo = $_GET['d1'];
        $owner = $_GET['d2'];
        $contributors = $client->api('repo')->contributors("$owner", "$repo");
        $fullname = $client->api('repo')->show("$owner", "$repo");
        foreach ($contributors as $value) {
            $arr_cont[] = array(
                'repo_name' => $repo,
                'login' => $value['login'],
                'html_url' => $value['html_url']);
        }        
        $name = $arr_cont[0]['repo_name'];
        $find = Contributors::model()->findByAttributes(array('repo_name' => $name));
        if (empty($find)) {
            foreach ($arr_cont as $k => $v) {
                $model = new Contributors;
                $model->attributes = $arr_cont[$k];
                if ($model->validate())
                    $model->save();
                else
                    echo CHtml::errorSummary($model);                
            }            
            Contributors::model()->updateAll(array('fullname' => $fullname['full_name']), 'repo_name="' . $name . '"');
        }
        $this->render('detail');
    }

    public function actionUser() {
        $client = new Github\Client();
        $get = $_GET['owner'];
        $users = $client->api('user')->show("$get");
        $arr_users = array(
            'gravatar_id' => $users['gravatar_id'],
            'login' => $users['login'],
            'fullname' => $users['name'],
            'company' => $users['company'],
            'blog' => $users['blog'],
            'followers' => $users['followers']);
        $name = $arr_users['login'];
        $find = Users::model()->findByAttributes(array('login' => $name));
        $model = new Users;
        if (empty($find))
            $model->isNewRecord = true;
        else
            $model->isNewRecord = false;
        $model->attributes = $arr_users;
        if ($model->validate())
            $model->save();
        else
            echo CHtml::errorSummary($model);        
        $this->render('user');
    }    
    
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionLike() {
        if (isset($_GET['d1']))
            $repo = $_GET['d1'];
        if (isset($_GET['d2']))
            $owner = $_GET['d2'];

        if (isset($_GET['like'])) {
            $post = Mobidev::model()->updateByPk($_GET['like'], array("like" => '1'));
            $this->render('index');
        }
        if (isset($_GET['unlike'])) {
            $post = Mobidev::model()->updateByPk($_GET['unlike'], array("like" => '0'));
            $this->render('index');
        }
        if (isset($_GET['like_user'])) {
            $post = Users::model()->updateByPk($_GET['like_user'], array("like" => '1'));
            $this->redirect(array('user', 'owner' => $owner));
        }
        if (isset($_GET['unlike_user'])) {
            $post = Users::model()->updateByPk($_GET['unlike_user'], array("like" => '0'));
            $this->redirect(array('user', 'owner' => $owner));
        }
        if (isset($_GET['like_detail'])) {
            $post = Contributors::model()->updateByPk($_GET['like_detail'], array("like" => '1'));
            $this->redirect(array('detail', 'd1' => $repo, 'd2' => $owner));
        }
        if (isset($_GET['unlike_detail'])) {
            $post = Contributors::model()->updateByPk($_GET['unlike_detail'], array("like" => '0'));
            $this->redirect(array('detail', 'd1' => $repo, 'd2' => $owner));
        }
    }

}