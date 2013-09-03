<?php
class CDbExtCommandBuilder extends CDbCommandBuilder
{
  public function createInsertUpdateCommand($table,$data,$update)
  {
    $this->ensureTable($table);
    $fields=array();
    $values=array();
    $updates=array();
    $placeholders=array();
    $i=0;
    foreach($data as $name=>$value)
    {
      if(($column=$table->getColumn($name))!==null && ($value!==null || $column->allowNull))
      {
        $fields[]=$column->rawName;
        if($value instanceof CDbExpression)
        {
          $placeholders[]=$value->expression;
          foreach($value->params as $n=>$v)
            $values[$n]=$v;
        }
        else
        {
          $placeholders[]=self::PARAM_PREFIX.$i;
          $values[self::PARAM_PREFIX.$i]=$column->typecast($value);
          $i++;
        }
      }
    }
        foreach($update as $name=>$value)
    {
      if(($column=$table->getColumn($name))!==null && ($value!==null || $column->allowNull))
      {
        if($value instanceof CDbExpression)
        {
          $updates[]=$column->rawName.'='.$value->expression;
        }
        else
        {
          $updates[]=$column->rawName.'='.self::PARAM_PREFIX.$i;
          $values[self::PARAM_PREFIX.$i]=$column->typecast($value);
          $i++;
        }
      }
    }
    if($fields===array())
    {
      $pks=is_array($table->primaryKey) ? $table->primaryKey : array($table->primaryKey);
      foreach($pks as $pk)
      {
        $fields[]=$table->getColumn($pk)->rawName;
        $placeholders[]='NULL';
      }
    }
    $sql="INSERT INTO {$table->rawName} (".implode(', ',$fields).') VALUES ('.implode(', ',$placeholders).') ';
    $sql.='ON DUPLICATE KEY UPDATE '.implode(', ', $updates);
    $command=$this->getDbConnection()->createCommand($sql);

    foreach($values as $name=>$value)
      $command->bindValue($name,$value);

    return $command;
  }

  public function createInsertIgnoreCommand($table,$data)
  {
    $this->ensureTable($table);
    $fields=array();
    $values=array();
    $placeholders=array();
    $i=0;
    foreach($data as $name=>$value)
    {
      if(($column=$table->getColumn($name))!==null && ($value!==null || $column->allowNull))
      {
        $fields[]=$column->rawName;
        if($value instanceof CDbExpression)
        {
          $placeholders[]=$value->expression;
          foreach($value->params as $n=>$v)
            $values[$n]=$v;
        }
        else
        {
          $placeholders[]=self::PARAM_PREFIX.$i;
          $values[self::PARAM_PREFIX.$i]=$column->typecast($value);
          $i++;
        }
      }
    }
    if($fields===array())
    {
      $pks=is_array($table->primaryKey) ? $table->primaryKey : array($table->primaryKey);
      foreach($pks as $pk)
      {
        $fields[]=$table->getColumn($pk)->rawName;
        $placeholders[]='NULL';
      }
    }
    $sql="INSERT IGNORE INTO {$table->rawName} (".implode(', ',$fields).') VALUES ('.implode(', ',$placeholders).')';
    $command=$this->getDbConnection()->createCommand($sql);

    foreach($values as $name=>$value)
      $command->bindValue($name,$value);

    return $command;
  }
}
?>
