<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use yii\web\Controller;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class PostController extends Controller{
	
	public $enableCsrfValidation = false;
	
	public function actionAddPost(){
		$post= new Post();
		$post->title="这是一条新标题";
		$post->content="这是一段新内容";
		$post->author="张三";
		$post->update_time=time();
		$post->create_time=time();
		if($post->save()){
			echo 'add success';
		}else{
			echo 'add error';
		}
	}
	
	public function actionGetPost(){
		return $this->render('getpost');
	}
	
	public function actionSelectPost(){
		p($_POST);
		$post=Post::find()
		//->where(['title'=>$_POST['title']])
		->all();
		//oa($post);
		$data=ArrayHelper::toArray($post);
		p($data);
		/* $modelList=new ArrayObject($post);
		$result=array();
		foreach($modelList as $model){
			$result[]=$model->attributes;
		} 
		
		p($result);
		die;*/
		//p($post);
		//p((array)$post);
		die;
	}
	
	public function actionUpdatePost($id){
		
	}
	
	public function actionDeletePost($id){
		
	}
	public function actionView($id){
		if($model === null){
			throw new NotFoundHttpException;
		}
		
		return $this->render('view',[
			'model'=>$model,
		]);
	}
	
	public function actionCreate(){
		
		$model = new Post();
		
		if($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view','id'=>$model->id]);
		}else{
			return $this->render('create',['model'=>$model,
			]);
		}
	}
}