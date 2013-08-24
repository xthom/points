<?php

if (PHP_SAPI != 'cli') {
  header('content-type: text/plain');
}

include 'point.php';
include 'graph.php';
include 'trace.php';
include 'pointCollection.php';


// var 1
$points = array();
$points[] = $a = new Point('a', 1, 5);
$points[] = $b = new Point('b', 4, 4);
$points[] = $c = new Point('c', 5, 1);
$points[] = $d = new Point('d', -1, -5);
$points[] = $e = new Point('e', 7, 8);

$graph = new Graph($points);

// var 2
// $graph = new Graph;

// $a = new Point('a', 1, 5);
// $b = new Point('b', 4, 4);
// $c = new Point('c', 5, 1);
// $d = new Point('d', -1, -5);
// $e = new Point('e', 7, 8);

// $graph->addPoint($a);
// $graph->addPoint($b);
// $graph->addPoint($c);
// $graph->addPoint($d);
// $graph->addPoint($e);

$a->addTarget($b);
$a->addTarget($c);
$a->addTarget($d);

$b->addTarget($a);
$b->addTarget($c);
$b->addTarget($e);

$c->addTarget($d);

$d->addTarget($e);


try {
  $traces = $graph->getTrace($a, $e);

  foreach ($traces as $i => $trace) {
    printf("Trace #%d:\n", $i);
    printf(" - points: %s\n", implode(" -> ", $trace->getNamedTrace()));
    printf(" - distance: %.1f\n", $trace->getDistance());
  }

} catch (Exception $e) {

  echo 'Error: ' . $e->getMessage();

}

