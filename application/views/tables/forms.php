<?php
function makeaform($fields, $model, $nivel, $action, $tables, $user_id) {
	//$fields = $campos;
	foreach ($fields as $field){

		// campo clave
		if(
			$field->name==$model."_id"
			|| $field->name=="status"
			|| $field->name=="created"
			|| $field->name=="task_created"
			|| $field->name=="task_taken"
			|| $field->name=="task_completed"
			|| $field->name=="user_id"
			|| $field->name=="category_id"
			|| $field->name=="help_id"
            || $field->name=="verified"
            || $field->name=="token"
            || $field->name=="avatar"
            || $field->name=="task_started"
            || $field->name=="task_completed"
		) {
			$atribute = array(
			    'type'          => 	'hidden',
			    'name'          => 	$field->name,
			    'id'            => 	$field->name
			);
			echo form_input($atribute);
		} else {

			// begin boostrap
			echo '<div class="form-group" style="margin-bottom:10px;">';

			// label
			if(	$field->name!=$model."_id" || $field->name=="status" || $field->name!="user_id") {
				if (!preg_match("/_id/i", $field->name)) {
					echo form_label(traducir($field->name), $field->name, ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;']);
				} else {
					// Property_id -> Property
					echo form_label(traducir(substr(($field->name),0,-3)), $field->name, ['class'=>'col-md-3 control-label', 'style'=>'text-transform:Capitalize;']);
				}
			}
			// nombre/clase/etc
			$atributes = array(
			    'name'          => 	$field->name,
			    'id'            => 	$field->name,
			    'placeholder'   => 	traducir($field->name),
			    //'maxlength'     => 	$field->max_length,
			    'class'			=>	'form-control',
			    'autocomplete'	=> 	'off'
			);

			/*
			// campo requerido
			if($field->default!=null){
				$requerido = array('required' => 'true');
				array_push($atributes, $requerido);
			}
			*/

			// boostrap
			echo '	<div class="col-md-9">';
			// input/textare/file/password/hidden
			switch ($field->type) {
				case 'bigint':
					if($field->name!=$model."_id") {
						//if (!preg_match("/_id/i", $field->name)) {
						//	echo form_input($atributes);
						//} else {
							$selected = "";
                            $options = array(); //

							//Recibe el nombre de la tabla
							if(preg_match("/company_id/i", $field->name)){
								// $options = array( '0' => 'Seleccionar' );
								foreach ($tables['company'] as $table) {
									$options[$table['company_id']]=$table['name'].' - '.$table['company_id'];
								}
							}
							if(preg_match("/task_id/i", $field->name)){
								// $options = array( '0' => 'Seleccionar' );
								foreach ($tables['task'] as $table) {
									$options[$table['task_id']]=$table['title'].' - '.$table['task_id'];
								}
							}
                            if(preg_match("/quiz_id/i", $field->name)){
								// $options = array( '0' => 'Seleccionar' );
								//foreach ($tables['quiz'] as $table) {
								//	$options[$table['quiz_id']]=$table['question'].' - '.$table['quiz_id'];
								//}
							}
							if($nivel!=0){ // REVISAR
								$atributes['readonly'] = true;
							}
							//if($company_id!=''){
							//	$selected = $company_id;
							//}
							echo form_dropdown($atributes, $options, $selected);
						//}
					}
					break;
				case 'text':
					echo form_textarea($atributes);
					break;
				case 'char':
					$selected="";
					if($field->name=="level") {
						if($nivel==2){
							$selected = 2;
							$atributes['disabled'] = 'disabled';
						}
						$options = array( '0' => 'Administrador', '1' => 'Editor', '2' => 'Demo' );
					/*} else if($field->name=="status") {
						if($nivel==2){
							$atributes['disabled'] = 'disabled';
						}
						if($action=='new'){
							$atributes['disabled'] = 'disabled';
						}
						$options = array( '0' => 'NO', '1' => 'SI' );
					*/
					} else {
						$options = array( '0' => 'Seleccionar' );
					}

					if($nivel==1) {
						$selected = 1;
						unset($options[0]);
					}
					echo form_dropdown($atributes, $options, $selected);
					break;
				case 'varchar':
					if($field->name=="password") {
						if($nivel==2){
							$atributes['disabled'] = 'disabled';
						}
						echo form_password($atributes);
						echo '<span id="helpBlock" class="help-block">Dejar en blanco si no se va a actualizar</span>';
					} else if($field->name=="file") {
						if($action=='edit'){
							$atributes['disabled'] = 'disabled';
						}
						echo form_upload($atributes);
						echo '<span id="helpBlock" class="help-block">Formatos soportados JPG, PNG, GIF</span>';
					} else if($field->name=="image") {
						if($action=='edit'){
							$atributes['disabled'] = 'disabled';
						}
						echo form_input($atributes);
						echo '<small id="helpBlock" class="help-block">Ejemplo: http://mipaginaweb.com/images/logotipo.jpg</small>';
					} else {
						if($field->name=="email" && $action!="new") {
							if($nivel==2){
								$atributes['disabled'] = 'disabled';
							}
						}
						echo form_input($atributes);
						if($field->name=="coordinates") {
							echo '<span id="helpBlock" class="help-block">Puede ubicar las coordenadas con <a target="_blank" href="https://www.google.com/maps">Google Maps</a> o servicios como <a target="_blank" href="http://www.gps-coordinates.net/">gps-coordinates.net</a></span>';
						}
					}
					break;

				case 'timestamp':
					$datestring = '%Y-%m-%d %h:%i:%s';
					$time = time();
					//if($nivel==2){
					//	$atributes['disabled'] = 'disabled';
					//}
					//if($action=='new'){
						// si es fecha, deshabilito
					//	$atributes['readonly'] = 'true';
					//}
					$atributes['type'] = 'date';
					echo form_input($atributes);//, mdate($datestring, $time)
					//echo '<script>window.onload = function(){ $("#'.$field->name.'").datepicker(); }</script>';
					break;
				case 'datetime':
					$datestring = '%Y-%m-%d %h:%i:%s';
					$time = time();
					$atributes['type'] = 'date';
					echo form_input($atributes);//, mdate($datestring, $time)
					//echo '<script>window.onload = function(){ $("#'.$field->name.'").datepicker(); }</script>';
					break;
				case 'date':
					$datestring = '%Y-%m-%d %h:%i:%s';
					$time = time();
					$atributes['type'] = 'date';
					echo form_input($atributes);//, mdate($datestring, $time)
					//echo '<script>window.onload = function(){ $("#'.$field->name.'").datepicker(); }</script>';
					break;
				case 'decimal':
					echo form_input($atributes);
					break;
				case 'enum':
					echo form_dropdown($atributes, array('0' => 'NO', '1' => 'SI') );
					break;
                // case 'int':
				// 	if($field->name=="type") {
                //         $selected = "";
				// 		if($nivel==1){
				// 			$selected = 1;
				// 			$atributes['disabled'] = 'disabled';
				// 		}
				// 		$options = array( '0' => 'Administrador', '1' => 'Editor');
				// 	} else {
				// 		$options = array( '0' => 'Seleccionar' );
				// 	}
				// 	if($nivel==1) {
				// 		$selected = 1;
				// 		unset($options[0]);
				// 	}
				// 	echo form_dropdown($atributes, $options, $selected);
				// 	break;
				default:
					echo form_input($atributes);
					break;
			}
			echo ' </div>';//.col-md-9
			echo '</div>';//.form-group
		}
	}
}
?>
