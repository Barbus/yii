<?php
require_once('/home/kolya/public_html/second.my/yii/mobidev/protected/extensions/github-api/vendor/autoload.php');
require_once('/home/kolya/public_html/second.my/yii/mobidev/protected/extensions/FirePHPCore/FirePHP.class.php');
ob_start();

class SiteController extends Controller
{
    public $layout='column2';
    
    public function actionIndex()
    {             
        $firephp = FirePHP::getInstance(true);        
        $client = new Github\Client(); 
        if(isset($_GET['q']))
        {
        $get = $_GET['q'];      
        $repos = $client->api('repo')->find("$get", array('start_page' => 1), 1);        
        foreach ($repos['repositories'] as $value)
        {
        $arr_repo[] = array('name'=>$value['name'], 'owner'=>$value['owner'], 'description'=>$value['description'], 'homepage'=>$value['homepage'], 'watchers'=>$value['watchers'], 'forks'=>$value['forks'], 'open_issues'=>$value['open_issues'], 'url'=>$value['url'], 'created'=>$value['created']);       
        }        
        foreach($arr_repo as $k=>$v)
        {
        $name = $arr_repo[$k]['name'];                
        $find = Mobidev::model()->findByAttributes(array('name'=>$name));        
        $model = new Mobidev;        
        if (empty($find))
        $model->isNewRecord = true;
        else
        $model->isNewRecord = false;                
        $model->attributes=$arr_repo[$k];        
	if($model->validate())
        {
	  $model->save();
	}
	else
	{
	  echo CHtml::errorSummary($model);
	}	  
        }      
        }        
        $this->render('index');
        //$this->render('index', array('itemsProvider' => $itemsProvider));  
    }  	
	
	public function actionDetail()
	{
	   $firephp = FirePHP::getInstance(true);
	   /*
	   $client = new Github\Client();
	   $repo = $_GET['d1'];
	   $owner = $_GET['d2'];	   
	   $contributors = $client->api('repo')->contributors("$owner", "$repo");
	   $fullname = $client->api('repo')->show("$owner", "$repo");   
	   foreach ($contributors as $value)
	    {
	      $arr_cont[] = array('repo_name'=>$repo, 'login'=>$value['login'], 'html_url'=>$value['html_url']);       
	    }	    
	    $name = $arr_cont[0]['repo_name'];
	    
	    $update = Contributors::model()->updateAll(array('fullname'=>$fullname['full_name']),'repo_name="'.$name.'"');
	    $find = Contributors::model()->findByAttributes(array('repo_name'=>$name));	    
	   if (empty($find))
	    {
	   foreach($arr_cont as $k=>$v)
	    {	      	      	      
	      $model = new Contributors;	      	      
	      $model->attributes=$arr_cont[$k];        
	      if($model->validate())
		{
		  $model->save();
		}
	      else
		{
		  echo CHtml::errorSummary($model);
		}
		}
	    }
	    */
	   $this->render('detail');	   
	}
	
	public function actionUser()
	{	
	  $client = new Github\Client();
	  $firephp = FirePHP::getInstance(true);
	  
	  $get = $_GET['owner'];
	  $users = $client->api('user')->show("$get");
	  
	  $arr_users = array('gravatar_id'=>$users['gravatar_id'], 'login'=>$users['login'], 'fullname'=>$users['name'], 'company'=>$users['company'], 'blog'=>$users['blog'], 'followers'=>$users['followers']);
	  
	  $firephp->log($arr_users, 'arr_users');
	  $firephp->log($users, 'users');
	  /*
	  foreach ($users as $value)
	    {
	    $firephp->log($users, 'users');
	      $arr_users = array('gravatar_id'=>$value['gravatar_id'], 'login'=>$value['login'], 'fullname'=>$value['fullname'], 'followers'=>$value['followers']);
	      $firephp->log($arr_users, 'arr_users');
	    }
	    */
	  $name = $arr_users['login'];
	  $find = Users::model()->findByAttributes(array('login'=>$name));
	  
	  //foreach($arr_users as $k=>$v)
	  //  {	      
	      $model = new Users;
	      if (empty($find))
	  $model->isNewRecord = true;
	    else
	  $model->isNewRecord = false;
	      $model->attributes=$arr_users;        
	      if($model->validate())
		{
		  $model->save();
		}
	      else
		{
		  echo CHtml::errorSummary($model);
		}
	   // }
	    
	  //$post=Users::model()->findByAttributes(array('login'=>$get));
	  	  
	  $this->render('user');	
	}
	
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	 
	/* 
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
	*/
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionLike()
	  { 
	    $firephp = FirePHP::getInstance(true);
	    
	    $repo = $_GET['d1'];
	    $owner = $_GET['d2'];
	    
	    if(isset($_GET['like']))
	      {
		$post=Mobidev::model()->updateByPk($_GET['like'],array("like"=>'1'));
		$this->render('index');
	      }
	    if(isset($_GET['unlike']))
	      {
		$post=Mobidev::model()->updateByPk($_GET['unlike'],array("like"=>'0'));
		$this->render('index');
	      }	      
	    if(isset($_GET['like_user']))
	      {
		$post=Users::model()->updateByPk($_GET['like_user'],array("like"=>'1'));
		$this->redirect(array('user','owner'=>$owner));
	      }
	    if(isset($_GET['unlike_user']))
	      {
		$post=Users::model()->updateByPk($_GET['unlike_user'],array("like"=>'0'));
		$this->redirect(array('user','owner'=>$owner));
	      }
	      if(isset($_GET['like_detail']))
	      {
		$firephp->log($_GET, 'get');
		$post=Contributors::model()->updateByPk($_GET['like_detail'],array("like"=>'1'));
		$this->redirect(array('detail','d1'=>$repo, 'd2'=>$owner));
	      }
	    if(isset($_GET['unlike_detail']))
	      {
		$firephp->log($_GET, 'get');
		$post=Contributors::model()->updateByPk($_GET['unlike_detail'],array("like"=>'0'));
		$this->redirect(array('detail','d1'=>$repo, 'd2'=>$owner));
	      }
	  }
	
}