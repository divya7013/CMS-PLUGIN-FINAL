<?php
/*
Plugin Name: Solentro Custom Text Widget
Plugin URI: #
Description: Custom Text Widget plugin use to put multiple text values in single widget area.
Version: 1.0
Author: Solentro
Author URI: #
License: GPL2 
*/

class CustomTextWidget extends WP_Widget
{
    public function __construct() {
        parent::__construct("custom_text_widget", "Solentro Custom Text Widget",
            array("description" => "To use multiple pre-define text area."));
    }

    public function form($instance) {
        $title = "";
        $text = "";

        if (!empty($instance)) {
            $title = $instance["title"];
            $text = $instance["text"];
        }

        $fieldId = $this->get_field_id("title");
        $fieldName = $this->get_field_name("title");
        echo "<p>";
        echo '<label for="' . $fieldId . '">Title:</label><br/>';
        echo '<input class="widefat" id="' . $fieldId . '" type="text" name="' .
            $fieldName . '" value="' . $title . '"/><br/>';
        echo "</p>";

        $textId = $this->get_field_id("text");
        $textName = $this->get_field_name("text");
        echo "<p>";
        echo '<label for="' . $textId . '">Text:</label><br/>';
        echo '<textarea class="widefat" id="' . $textId . '" name="' . $textName .
            '">' . $text . '</textarea>';
        echo "</p>";    
    }

    public function update($newInstance, $oldInstance) {
        $values = array();
        $values["title"] = htmlentities($newInstance["title"]);
        $values["text"] = htmlentities($newInstance["text"]);
        return $values;
    }

    public function widget($args, $instance) {
        $title = $instance["title"];
        $text = $instance["text"];

        echo "<h2 class='widget-title'>$title</h2>";
        echo "<p>$text</p>";
    }
}


/* ------ Widget Init --------- */
add_action("widgets_init",
    function () { register_widget("CustomTextWidget"); });
