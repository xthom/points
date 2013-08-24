<?php

class Graph {

  private $points;

  public $x = array();

  public function __construct(array $points = NULL) {
    $this->points = new PointCollection($points);
  }


  public function addPoint(Point $newPoint)
  {
    if (!$this->points->exists($newPoint)) {
      $this->points->add($newPoint);
    }
  }


  public function getTrace(Point $pointFrom, Point $pointTo)
  {
    $traces = array();

    $this->addPointToTrace($traces, new Trace($pointFrom, $pointTo), $pointFrom);

    return $traces;
  }


  private function addPointToTrace(&$traces, Trace $trace, Point $point) 
  {
    if (!$this->points->exists($point)) {
      throw new Exception(sprintf('Graph::addPointToTrace: Point "%s" is not assigned with the graph', 
        $point->getName()));
    }
    
    try {
      $trace->addPoint($point);

    } catch (TraceEndException $e) {
      $traces[] = $trace;
      return;

    } catch (TracePointExistsException $e) {
      $endTrace = TRUE;
    }

    if (isset($endTrace) || $point->getTargets()->count() == 0) {
      return;
    }

    foreach ($point->getTargets() as $target) {
      $this->addPointToTrace($traces, clone $trace, $target);
    }

  }

}