<?php

	function displayArrayWithKeys($array) {
		foreach ($array as $i => $x) {
			if (!is_array($x)) {
				echo "<strong>$i</strong> : $x <br/>";
			} else {
				displayArrayWithKeys($x);
			}
		}
	}