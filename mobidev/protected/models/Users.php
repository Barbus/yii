<?php

/**
 * This is the model class for table "tbl_users".
 *
 * The followings are the available columns in table 'tbl_users':
 * @property integer $id
 * @property string $gravatar_id
 * @property string $login
 * @property string $fullname
 * @property string $company
 * @property string $blog
 * @property integer $followers
 * @property integer $like
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gravatar_id, login, followers', 'required'),
			array('followers, like', 'numerical', 'integerOnly'=>true),
			//array('gravatar_id, login, fullname, company, blog', 'length', 'max'=>64),
			array('gravatar_id, login, fullname, company, blog, followers, like', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, gravatar_id, login, fullname, company, blog, followers', 'safe', 'on'=>'search'),
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
			'gravatar_id' => 'Gravatar',
			'login' => 'Login',
			'fullname' => 'Fullname',
			'company' => 'Company',
			'blog' => 'Blog',
			'followers' => 'Followers',
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
		$criteria->compare('gravatar_id',$this->gravatar_id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('blog',$this->blog,true);
		$criteria->compare('followers',$this->followers);
		$criteria->compare('like',$this->like);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
