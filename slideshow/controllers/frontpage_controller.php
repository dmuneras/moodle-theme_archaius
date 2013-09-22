<?php

require $CFG->dirroot . "/theme/archaius/slideshow/models/Slider.php";

function archaius_get_slider(){
	return ArchaiusSlider::Instance();
}