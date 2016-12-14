#! /usr/bin/php
<?php

$map = [
  '000' => [ null, null, null, '1', '2', '3', '4', '5', '6', '7', '8', '9'],
  '100' => [ '&', null, null, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'],
  '010' => [ null, '-', null, 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R'],
  '001' => [ null, null, '0', '/', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'],
  '101' => [ null, null, null, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'i'],
  '110' => [ null, null, null, 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'p', 'r'],
  '011' => [ null, null, null, null, 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'],
];

print "Enter 12 rows.\n";

$input_max_length = 0;
$input_list = [];
for ($i = 0; $i < 12; $i++) {
  $input = rtrim(fgets(STDIN));
  if (strlen($input) > $input_max_length) {
    $input_max_length = strlen($input);
  }
  $input_list[] = $input;
}

// 各行の長さを揃える
for ($i = 0; $i < 12; $i++) {
  if (strlen($input_list[$i]) < $input_max_length) {
    $input_list[$i] = str_pad($input_list[$i], $input_max_length, '0', STR_PAD_LEFT);
  }
}

print "\n";
for ($i = 0; $i < $input_max_length; $i++) {
  $punch = '';
  // 各行から同じカラムをピックアップ
  foreach ($input_list as $row) {
    $punch .= substr($row, $i, 1);
  }

  // header部
  $header = substr($punch, 0, 3);
  // bottom部
  $bottom = substr($punch, 3);

  // header部からマップを選択
  $map_target = $map[$header];

  if (intval($bottom) === 0) {
    // bottom部に、'1'がない
	$pos = strpos($punch, '1');
  } else {
	// bottom部には、1回しか、1が現れない
    $pos = strpos($bottom, '1');
	if ($pos !== false) {
	  $pos += 3;
	}
  }
  if ($pos !== false && $map_target[$pos] !== null) {
    print $map_target[$pos];
  } else {
    print '_';
  }
}
print "\n";
