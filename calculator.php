<?php 

function explodeInput(String $input, $separator): array {
  return explode($separator, $input);
}

function getCasesChunk(array $cases, int $size): array { 
  return array_chunk($cases, $size);
}

function getHighestPosition(array $positions): int {
  return max($positions); 
}

function getColumnsCapacity($array): array {
  $maxHeight = getHighestPosition($array);

  return array_map(function($column) use ($maxHeight) {
    return $maxHeight - $column;
  }, $array);
}

function getCaseCapacity($array) {
  return array_reduce( $array, function($carry, $item) {
    $carry += $item;
    return $carry;
  },0);
}

function computeAllCasesCapacity(String $input): array{
    $inputArray = explodeInput($input, PHP_EOL);
    $tail = array_slice($inputArray, 1);
    $cases_chunk = getCasesChunk($tail, 2);
    $cases_capacity = [];
    
    foreach($cases_chunk as $case){
      $columns = array_map('intval', explodeInput($case[1], ' '));
      $columns_capacity = getColumnsCapacity($columns);
      $case_capacity[] = getCaseCapacity($columns_capacity); 
    }
    
    return $case_capacity;
}

function formatResult(array $array): String {
  return implode(PHP_EOL, $array);
}

$capacities = computeAllCasesCapacity('7
9
5 4 3 2 1 2 3 4 5
30
7 10 2 5 13 3 4 10 5 9 4 2 6 5 18 6 8 6 15 4 20 4 8 9 5 21 4 7 19 2
1
10
10
1 2 3 4 5 6 7 8 9 10
10
10 9 8 7 6 5 4 3 2 1
15
10 10 10 10 10 10 10 10 10 10 10 10 10 10 10
20
1 2 3 4 5 6 7 8 9 10 10 9 8 7 6 5 4 3 2 1');

echo(formatResult($capacities));

?>
