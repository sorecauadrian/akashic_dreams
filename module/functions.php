<?php
	function valid_text($post, $text_error, $text, $string)
	{
		if (!isset($post) || empty(trim($post)))
			$text_error = "please enter a " . $string . ".";
		else
			$text = $post;
	}
	function valid_value($post, $value_error, $value, $string, $min, $max)
	{
		if (!isset($post) || $post < $min || $post > $max || !is_int($post))
			$value_error = "please evaluate correctly your " . $string . ".";
		else
			$value = $post;
	}