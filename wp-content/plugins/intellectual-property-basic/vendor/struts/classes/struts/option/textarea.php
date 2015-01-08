<?php

class IProperty_Struts_Option_Textarea extends IProperty_Struts_Option_Text {
	public function input_html() {
		$id = esc_attr( $this->html_id() );
		$name = esc_attr( $this->html_name() );
		$value = esc_html( $this->value() );

		echo "<textarea id='$id' name='$name'/>$value</textarea>";
	}
}