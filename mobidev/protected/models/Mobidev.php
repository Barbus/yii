<?php

/**
 * This is the model class for table "tbl_mobidev".
 *
 * The followings are the available columns in table 'tbl_mobidev':
 * @property integer $id
 * @property string $name
 * @property string $owner
 * @property string $description
 * @property string $homepage
 * @property integer $watchers
 * @property integer $forks
 * @property integer $open_issues
 * @property string $url
 * @property string $created
 * @property integer $like
 */
class Mobidev extends CExtActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_mobidev';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('name, owner, watchers, forks', 'required'),
			//array('name', 'length', 'max'=>32),
			array('name, owner, homepage, url, created', 'length', 'max'=>128, 'on' => 'insert'),
			array('name, owner, description, homepage, watchers, forks, open_issues, url, created', 'safe'),
			//array('name, owner, description, homepage, watchers, forks, like', 'required'),
			array('watchers, forks, open_issues, like', 'numerical', 'integerOnly'=>true),
			array('name, owner, homepage, url, created', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			//array('id, name, owner, description, homepage, watchers, forks, like', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'owner' => 'Owner',
			'description' => 'Description',
			'homepage' => 'Homepage',
			'watchers' => 'Watchers',
			'forks' => 'Forks',
			'open_issues' => 'Open_issues',
			'url' => 'Url',
			'created' => 'Created',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('owner',$this->owner,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('homepage',$this->homepage,true);
		$criteria->compare('watchers',$this->watchers);
		$criteria->compare('forks',$this->forks);
		$criteria->compare('open_issues',$this->open_issues);
		$criteria->compare('url',$this->url);
		$criteria->compare('created',$this->created);
		$criteria->compare('like',$this->like);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mobidev the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
