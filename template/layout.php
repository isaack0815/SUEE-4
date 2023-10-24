<?php

function createFormInput($name, $type, $label, $value = '', $required = false) {
    $requiredHtml = $required ? 'required' : '';
    $labelHtml = $label ? "<label for='$name'>$label</label>" : '';
    $inputHtml = "<input type='$type' name='$name' id='$name' value='$value' $requiredHtml>";
    return "<div>$labelHtml $inputHtml</div>";
}

?>