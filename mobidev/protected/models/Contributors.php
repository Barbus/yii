<?php

/**
 * This is the model class for table "tbl_contributors".
 *
 * The followings are the available columns in table 'tbl_contributors':
 * @property integer $id
 * @property string $repo_name
 * @property string $login
 * @property string $html_url
 * @property string $fullname
 * @property integer $like
 */
class Contributors extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_contributors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, html_url', 'required'),
			array('like', 'numerical', 'integerOnly'=>true),
			array('repo_name, login, html_url, fullname', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, repo_name, login, html_url, fullname, like', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'repo_name' => 'Repo',
			'login' => 'Login',
			'html_url' => 'Html Url',
			'fullname' => 'fullname',
			'like' => 'Like',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('repo_name',$this->repo_id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('html_url',$this->html_url,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('like',$this->like);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contributors the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
