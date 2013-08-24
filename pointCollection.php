<?php

class PointCollection implements Iterator
{

  private $iterator;

  private $points;

  
  public function __construct($points = array())
  {
    $this->iterator = 0;
    $this->points = $points;
  }


  public function getAll()
  {
    return $this->points;
  }


  public function add(Point $point)
  {
    $this->points[] = $point;
  }


  public function getPoint($name)
  {
    foreach ($this->points as $point) {
      if ($point->getName() == $name) {
        return $point;
      }
    }
    return NULL;
  }


  public function exists(Point $point)
  {
    foreach ($this->points as $element) {
      if ($element == $point) {
        return TRUE;
      }
    }
    return FALSE;
  }


  public function count()
  {
    return count($this->points);
  }


  /** Iterator interface **/

  public function rewind() {
    $this->iterator = 0;
  }


  public function current() {
    return $this->points[$this->iterator];
  }


  public function key() {
    return $this->iterator;
  }


  public function next() {
    ++$this->iterator;
  }


  public function valid() {
    return isset($this->points[$this->iterator]);
  }


}