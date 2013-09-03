<?php
class CExtActiveRecord extends CActiveRecord
{

  /**
   * Returns the command builder used by this AR.
   * @return CDbCommandBuilder the command builder used by this AR
   */
  public function getCommandBuilder()
  {
    return new CDbExtCommandBuilder(Yii::app()->db->getSchema());
  }

  private function insertExt($builder, $table, $command)
  {
    if(!$this->getIsNewRecord())
      throw new CDbException(Yii::t('yii','The active record cannot be inserted to database because it is not new.'));
    if($this->beforeSave())
    {
      Yii::trace(get_class($this).'.insert()','system.db.ar.CActiveRecord');
      if($command->execute())
      {
        $primaryKey=$table->primaryKey;
        if($table->sequenceName!==null)
        {
          if(is_string($primaryKey) && $this->$primaryKey===null)
            $this->$primaryKey=$builder->getLastInsertID($table);
          else if(is_array($primaryKey))
          {
            foreach($primaryKey as $pk)
            {
              if($this->$pk===null)
              {
                $this->$pk=$builder->getLastInsertID($table);
                break;
              }
            }
          }
        }
        $this->_pk=$this->getPrimaryKey();
        $this->afterSave();
        $this->setIsNewRecord(false);
        $this->setScenario('update');
        return true;
      }
    }
    return false;
  }

  public function insertUpdate($update, $runValidation=true, $attributes=null)
  {
    if(!$runValidation || $this->validate($attributes))
        if ($this->getIsNewRecord())
        {
              $builder=$this->getCommandBuilder();
                $table=$this->getMetaData()->tableSchema;
                $command=$builder->createInsertUpdateCommand($table,$this->getAttributes($attributes), $update);
              return $this->insertExt($builder, $table, $command);
        }
        else
            return $this->update($attributes);
  }

    public function insertIgnore($runValidation=true, $attributes=null)
  {
    if(!$runValidation || $this->validate($attributes))
        if ($this->getIsNewRecord())
        {
              $builder=$this->getCommandBuilder();
            $table=$this->getMetaData()->tableSchema;
            $command=$builder->createInsertIgnoreCommand($table,$this->getAttributes($attributes));
            return $this->insertExt($builder, $table, $command);
        }
        else
            return $this->update($attributes);
  }
}
?>
