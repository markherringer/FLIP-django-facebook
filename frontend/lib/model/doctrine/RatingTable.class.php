<?php

class RatingTable extends Doctrine_Table
{
  public function getStates()
  {
    $column = $this->getColumnDefinition("rating");
    return array_values($column["values"]);
  }
}
