<?php
  $inputFile = fopen($argv[1], 'r');
  $outputFile = fopen('scoring.csv', 'w');
  $arr = array();

  class Contact {
    public $score;
    public $contactInfo;

    public function __construct($d) {
      $this -> contactInfo = $d;
      $this -> score = explode(",", $d)[2];
    }
  }

  function sortByScore($a, $b) {
    if ($a -> score == $b -> score) return 0;
    return ($a > $b) ? -1 : 1;
  }

  while($val = fgets($inputFile)) {
    array_push($arr, new Contact($val));
  }

  usort($arr, sortByScore);

  for($i = 0; $i < count($arr); $i++) {
    fwrite($outputFile, $arr[$i] -> contactInfo);
  }

  fclose($inputFile);
  fclose($outputFile);
?>