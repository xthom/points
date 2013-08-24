<?php

class Point {

  private $x;

  private $y;

  private $name;

  private $targets;


  public function __construct($name, $x, $y)
  {
    $this->name = $name;
    $this->x = $x;
    $this->y = $y;
    $this->targets = new PointCollection;
  }


  public function getName()
  {
    return $this->name;
  }


  public function getCoords()
  {
    return array($this->x, $this->y);
  }


  public function addTarget(Point $point)
  {
    if (!$this->targets->exists($point)) {
      $this->targets->add($point);
    }
  }


  public function getTargets()
  {
    return $this->targets;
  }

}