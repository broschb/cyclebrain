<?php
// auto-generated by sfRoutingConfigHandler
// date: 2009/06/28 10:39:34
return array(
'homepage' => new sfRoute('/', array (
  'module' => 'main',
  'action' => 'index',
), array (
), array (
)),
'default_symfony' => new sfRoute('/symfony/:action/*', array (
  'module' => 'default',
), array (
), array (
)),
'default_index' => new sfRoute('/:module', array (
  'action' => 'index',
), array (
), array (
)),
'default' => new sfRoute('/:module/:action/*', array (
), array (
), array (
)),
);