<?php
class SearchController extends Controller
{
    /**
     * @var string index dir as alias path from <b>application.</b>  , default to <b>runtime.search</b>
     */
    private $_indexFiles = 'runtime.search';
    /**
     * (non-PHPdoc)
     * @see CController::init()
     */
    public function init(){
        Yii::import('application.vendors.*');
        require_once('Zend/Search/Lucene.php');
        parent::init(); 
    }
 
    /**
     * Search index creation
     */
    public function actionCreate()
    {
        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
 
        $posts = Post::model()->findAll();
        foreach($posts as $post){
            $doc = new Zend_Search_Lucene_Document();
 
            $doc->addField(Zend_Search_Lucene_Field::Text('title',
                                          CHtml::encode($post->title), 'utf-8')
            );
 
            $doc->addField(Zend_Search_Lucene_Field::Text('link',
                                            CHtml::encode($post->url)
                                                , 'utf-8')
            );   
 
            $doc->addField(Zend_Search_Lucene_Field::Text('content',
                                          CHtml::encode($post->content)
                                          , 'utf-8')
            );
 
 
            $index->addDocument($doc);
        }
        $index->commit();
        echo 'Lucene index created';
    }
 
    public function actionSearch()
    {
        $this->layout='column2';
         if (($term = Yii::app()->getRequest()->getParam('q', null)) !== null) {
            $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles));
            $results = $index->find($term);
            $query = Zend_Search_Lucene_Search_QueryParser::parse($term);       
 
            $this->render('search', compact('results', 'term', 'query'));
        }
    }
}


