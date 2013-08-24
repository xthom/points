<?php

class Trace
{

  private $trace;

  private $from;

  private $to;

  public function __construct(Point $from, Point $to) {
    $this->trace = new PointCollection;
    $this->from = $from;
    $this->to = $to;
  }


  public function __clone() {
    $this->trace = clone $this->trace;
  }


  public function addPoint(Point $point)
  {
    if ($this->trace->exists($point)) {
      throw new TracePointExistsException;
    }

    $this->trace->add($point);

    if ($point == $this->to) {
      throw new TraceEndException;
    } 
  }


  public function getPoints()
  {
    return $this->trace;
  }


  public function getNamedTrace()
  {
    $namedTrace = array();
    foreach ($this->trace as $point) {
      $namedTrace[] = $point->getName();
    }
    return $namedTrace;
  }


  public function getDistance()
  {
    $distance = 0;
    $prevPoint = NULL;
    foreach ($this->trace as $point) {
      if (!$prevPoint) {
        $prevPoint = $point;
        continue;
      }
      list($x1, $y1) = $prevPoint->getCoords();
      list($x2, $y2) = $point->getCoords();
      $distance += round(sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2)), 2);
      $prevPoint = $point;
    }
    return $distance;
  }

}


class TraceEndException extends Exception {}

class TracePointExistsException extends Exception {}
