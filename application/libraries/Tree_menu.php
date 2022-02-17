<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
This is one of the free scripts from www.dhtmlgoodies.com
You are free to use this script as long as this copyright message is kept intact
(c) Alf Magne Kalleland, http://www.dhtmlgoodies.com - 2005
*/
class Tree_menu
{

	var $elementArray = array();
	var $nameOfCookie = "treemenu_expanded"; // Name of the cookie where the expanded nodes are stored.
	var $folderimage = "";

	function setFolderImage($folder)
	{
		$this->folderimage = $folder;
	}

	function writeCSS()
	{
?>
		<style type="text/css">
			#treemenu li {
				list-style-type: none;
				font-family: arial;
				font-size: 12px;
			}

			#treemenu_topNodes {
				margin: 0 0 0 0;
				padding: 0 0 0 0;
			}

			#treemenu_topNodes ul {
				margin: 0 0 0 20px;
				padding: 0 0 0 0;
				display: none;
			}

			#treemenu .tree_link {
				line-height: 12px;
				padding-left: 5px;
			}

			#treemenu a {
				color: #000000;
				text-decoration: none;
			}

			.activeNodeLink {
				background-color: #316AC5;
				color: #ffffff;
				font-weight: bold;
			}

			.tree_link,
			tree_node {
				vertical-align: -2px;
			}
		</style>
	<?php
	}

	function writeJavascript()
	{
	?>
		<script type="text/javascript">
			/**
					Folder Tree - PHP
					Copyright (C) 2005 - 2009  DTHMLGoodies.com, Alf Magne Kalleland

					This library is free software; you can redistribute it and/or
					modify it under the terms of the GNU Lesser General Public
					License as published by the Free Software Foundation; either
					version 2.1 of the License, or (at your option) any later version.

					This library is distributed in the hope that it will be useful,
					but WITHOUT ANY WARRANTY; without even the implied warranty of
					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
					See the GNU Lesser General Public License for more details.

					You should have received a copy of the GNU Lesser General Public License along with this library; if not,
					write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

					Dhtmlgoodies.com., hereby disclaims all copyright interest in this script written by Alf Magne Kalleland.

					Alf Magne Kalleland, 2005 - 2009
					Owner of DHTMLgoodies.com
				*/
			var plusNode = '<?php echo $this->folderimage; ?>treemenu_plus.gif';
			var minusNode = '<?php echo $this->folderimage; ?>treemenu_minus.gif';
			var nameOfCookie = '<?php echo $this->nameOfCookie; ?>';

			<?php
			$cookieValue = "";

			if (isset($_COOKIE[$this->nameOfCookie])) $cookieValue = $_COOKIE[$this->nameOfCookie];
			echo "var initExpandedNodes =\"" . $cookieValue . "\";\n";
			?>

			/* These cookie functions are downloaded from http://www.mach5.com/support/analyzer/manual/html/General/CookiesJavaScript.htm */
			function Get_Cookie(name) {
				var start = document.cookie.indexOf(name + "=");
				var len = start + name.length + 1;

				if ((!start) && (name != document.cookie.substring(0, name.length))) return null;
				if (start == -1) return null;

				var end = document.cookie.indexOf(";", len);

				if (end == -1) end = document.cookie.length;
				return unescape(document.cookie.substring(len, end));
			}

			// This function has been slightly modified
			function Set_Cookie(name, value, expires, path, domain, secure) {
				expires = expires * 60 * 60 * 24 * 1000;
				var today = new Date();
				var expires_date = new Date(today.getTime() + (expires));
				var cookieString = name + "=" + escape(value) +
					((expires) ? "; expires=" + expires_date.toGMTString() : "") +
					((path) ? "; path=" + path : "") +
					((domain) ? "; domain=" + domain : "") +
					((secure) ? "; secure" : "");
				document.cookie = cookieString;
			}

			function expandAll() {
				var treeObj = document.getElementById('treemenu');
				var images = treeObj.getElementsByTagName('img');

				for (var no = 0; no < images.length; no++) {
					if (images[no].className == 'tree_plusminus' && images[no].src.indexOf(plusNode) >= 0) expandNode(false, images[no]);
				}
			}

			function collapseAll() {
				var treeObj = document.getElementById('treemenu');
				var images = treeObj.getElementsByTagName('img');

				for (var no = 0; no < images.length; no++) {
					if (images[no].className == 'tree_plusminus' && images[no].src.indexOf(minusNode) >= 0) expandNode(false, images[no]);
				}
			}

			function expandNode(e, inputNode) {
				if (initExpandedNodes.length == 0) initExpandedNodes = ",";
				if (!inputNode) inputNode = this;
				if (inputNode.tagName.toLowerCase() != 'img') inputNode = inputNode.parentNode.getElementsByTagName('img')[0];

				var inputId = inputNode.id.replace(/[^\d]/g, '');
				var parentUl = inputNode.parentNode;
				var subUl = parentUl.getElementsByTagName('ul');

				if (subUl.length == 0) return;
				if (subUl[0].style.display == '' || subUl[0].style.display == 'none') {
					subUl[0].style.display = 'block';
					inputNode.src = minusNode;
					initExpandedNodes = initExpandedNodes.replace(',' + inputId + ',', ',');
					initExpandedNodes = initExpandedNodes + inputId + ',';
				} else {
					subUl[0].style.display = '';
					inputNode.src = plusNode;
					initExpandedNodes = initExpandedNodes.replace(',' + inputId + ',', ',');
				}
				Set_Cookie(nameOfCookie, initExpandedNodes, 60);
			}

			function initTree() {
				// Assigning mouse events
				var parentNode = document.getElementById('treemenu');
				var lis = parentNode.getElementsByTagName('li'); // Get reference to all the images in the tree

				for (var no = 0; no < lis.length; no++) {
					var subNodes = lis[no].getElementsByTagName('ul');
					if (subNodes.length > 0) {
						lis[no].childNodes[0].style.visibility = 'visible';
					} else {
						lis[no].childNodes[0].style.visibility = 'hidden';
					}
				}

				var images = parentNode.getElementsByTagName('img');
				for (var no = 0; no < images.length; no++) {
					if (images[no].className == 'tree_plusminus') images[no].onclick = expandNode;
				}

				var aTags = parentNode.getElementsByTagName('a');
				var cursor = 'pointer';

				if (document.all) cursor = 'hand';
				for (var no = 0; no < aTags.length; no++) {
					aTags[no].onclick = expandNode;
					aTags[no].style.cursor = cursor;
				}

				var initExpandedArray = initExpandedNodes.split(',');

				for (var no = 0; no < initExpandedArray.length; no++) {
					if (document.getElementById('plusMinus' + initExpandedArray[no])) {
						var obj = document.getElementById('plusMinus' + initExpandedArray[no]);
						expandNode(false, obj);
					}
				}
			}

			window.onload = initTree;
		</script>
<?php
	}

	/* This function adds elements to the array */
	function addToArray($id, $name, $parentID, $url = "", $target = "", $imageIcon = "treemenu_folder.gif")
	{
		if (empty($parentID)) $parentID = 0;
		$this->elementArray[$parentID][] = array($id, $name, $url, $target, $imageIcon);
	}

	function drawTree()
	{
		echo "<div class=\"row\">";
		echo "<div class=\"col-md-8 offset-md-2 col-lg-6 offset-lg-3\">";
		echo "<h3>Treemenu</h3>";
		echo "<div class=\"card shadow-sm\">";
		echo "<div class=\"card-body\">";
		echo "<div id=\"treemenu\">";
		echo "<ul id=\"treemenu_topNodes\">";

		for ($no = 0; $no < count($this->elementArray[0]); $no++) {
			$urlAdd = "";
			if ($this->elementArray[0][$no][2]) {
				$urlAdd = " href=\"" . $this->elementArray[0][$no][2] . "\"";
				if ($this->elementArray[0][$no][3]) $urlAdd .= " target=\"" . $this->elementArray[0][$no][3] . "\"";
			}
			echo "<li class=\"tree_node\" id=\"node_" . $this->elementArray[0][$no][0] . "\"><img id=\"plusMinus" . $this->elementArray[0][$no][0] . "\" class=\"tree_plusminus\" src=\"" . $this->folderimage . "treemenu_plus.gif\"><img src=\"" . $this->folderimage . $this->elementArray[0][$no][4] . "\"><a class=\"tree_link\"$urlAdd>" . $this->elementArray[0][$no][1] . "</a>";
			$this->drawSubNode($this->elementArray[0][$no][0]);
			echo "</li>";
		}
		echo "</ul>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	}

	private function drawSubNode($parentID)
	{
		if (isset($this->elementArray[$parentID])) {
			echo "<ul>";

			for ($no = 0; $no < count($this->elementArray[$parentID]); $no++) {
				$urlAdd = "";
				if ($this->elementArray[$parentID][$no][2]) {
					$urlAdd = " href=\"" . $this->elementArray[$parentID][$no][2] . "\"";
					if ($this->elementArray[$parentID][$no][3]) $urlAdd .= " target=\"" . $this->elementArray[$parentID][$no][3] . "\"";
				}
				echo "<li class=\"tree_node\"><img class=\"tree_plusminus\" id=\"plusMinus" . $this->elementArray[$parentID][$no][0] . "\" src=\"" . $this->folderimage . "treemenu_plus.gif\"><img src=\"" . $this->folderimage . $this->elementArray[$parentID][$no][4] . "\"><a class=\"tree_link\"$urlAdd>" . $this->elementArray[$parentID][$no][1] . "</a>";
				$this->drawSubNode($this->elementArray[$parentID][$no][0]);
				echo "</li>";
			}
			echo "</ul>";
		}
	}
}
