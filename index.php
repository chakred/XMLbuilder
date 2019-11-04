<?php

require 'XmlBuilder/Builder.php';


$builder = new XmlBuilder\Builder;
$rows = $builder->openFile('frp.csv');
$dom = new DomDocument('1.0', 'UTF-8');

$builder->prepareXMLStructure($rows, $dom);
