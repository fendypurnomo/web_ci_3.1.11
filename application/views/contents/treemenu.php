<?php
$this->tree_menu->setFolderImage('https://assets.local/assets/img/ci3-img/treemenu/');
//$this->tree_menu->addToArray(100, 'Tree Menu', 0);

foreach ($treemenu as $rows) {
	$this->tree_menu->addToArray($rows['treemenu_id'], $rows['treemenu_name'], $rows['parent'], base_url() . 'web/' . $rows['treemenu_id']);
}

$this->tree_menu->writeCSS();
$this->tree_menu->writeJavascript();
$this->tree_menu->drawTree();
