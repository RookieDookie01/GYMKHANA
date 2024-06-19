<?php
function escapeString($value) {
    global $mysqli;
    if (is_array($value)) {
        foreach ($value as &$element) {
            $element = escapeString($element);
        }
        unset($element);
    } else {
        $value = trim($value);
        $value = $mysqli->real_escape_string($value);
    }

    return $value;
}
