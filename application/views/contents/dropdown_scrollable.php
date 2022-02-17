<style>
	.dropdown-scrollable-wrapper {
		position: relative;
	}

	.dropdown-scrollable-wrapper ul {
		width: 200px;
		max-height: 250px;
		overflow-x: hidden;
		overflow-y: auto;
		margin: 1em;
		color: white;
		font-family: sans-serif;
		font-size: 16px;
	}

	.dropdown-scrollable-wrapper li {
		position: static;
		padding: 1em;
	}

	.dropdown-scrollable-wrapper li ul {
		margin: 0;
	}

	.dropdown-scrollable-wrapper li .dropdown-scrollable-wrapper {
		position: absolute;
		z-index: 10;
		display: none;
		left: 175px;
		cursor: auto;
	}

	li.dropdown-scrollable-parent:hover .dropdown-scrollable-wrapper {
		display: block;
	}

	.dropdown-scrollable-wrapper li .wrapper li {
		padding: 1em;
	}

	.dropdown-scrollable-wrapper li:nth-child(2n) {
		background: #0E8CE0;
	}

	.dropdown-scrollable-wrapper li:nth-child(2n+1) {
		background: #0064B3;
	}

	.dropdown-scrollable-wrapper li.dropdown-scrollable-parent {
		background: #00B99B;
		cursor: pointer;
	}
</style>

<div class="dropdown-scrollable-wrapper">
	<ul>
		<li>Menu 1</li>
		<li>Menu 2</li>
		<li>Menu 3</li>
		<li>Menu 4</li>
		<li class="dropdown-scrollable-parent">Menu 5
			<div class="dropdown-scrollable-wrapper">
				<ul>
					<li>Sub Menu 1</li>
					<li>Sub Menu 2</li>
					<li>Sub Menu 3</li>
					<li>Sub Menu 4</li>
					<li>Sub Menu 5</li>
				</ul>
			</div>
		</li>
		<li>Menu 6</li>
		<li>Menu 7</li>
		<li>Menu 8</li>
		<li>Menu 9</li>
		<li>Menu 10</li>
	</ul>
</div>

<script>
	$(function(){
		$('.dropdown-scrollable-parent').on('mouseover', function(){
			subMenuShow();
		});

		$('.parent').scroll(function(){
			subMenuShow();
		});
	});

	function subMenuShow(){
		var menuItem = $('.dropdown-scrollable-parent');
		var submenuWrapper = $('> .dropdown-scrollable-wrapper', menuItem);
		var menuItemPos = menuItem.position();
		submenuWrapper.css('top', menuItemPos.top);
	}
</script>
