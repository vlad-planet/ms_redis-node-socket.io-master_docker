<?php
$redis = new Redis();
$redis->connect(
  'redis',
  6379
);
$redis->auth('security');
$redis->publish(
  'information',
  json_encode([
    'test' => 'success'
  ])
);

$redis->close();
