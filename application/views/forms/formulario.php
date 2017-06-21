<?php
/*
	// comienza el formulario
	$model = $this->uri->segment(1);
	$action = $this->uri->segment(3);
	$nivel = $this->session->userdata('level');

	if($action=='edit'){
		$btn = "Actualizar";
		$ejecutar ="update"; //"update/".$this->uri->segment(4);
	} else {
		$btn = "Agregar nuevo";
		$ejecutar = "add";
	}
*/
	//echo form_open($model.'/'.$ejecutar, ['class'=>"form-horizontal", 'role'=>"form"]);
	//echo form_label($ejecutar.$this->uri->segment(3));
function makeaform($fields, $model, $nivel, $action, $btn, $tables, $property_id) {
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
			echo '<div class="form-group">';

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
							if(preg_match("/service_id/i", $field->name)){
								// $options = array( '0' => 'Seleccionar' );
								foreach ($tables as $table) {
									$options[$table['service_id']]=$table['type'];
								}
							}
							// if(preg_match("/category_id/i", $field->name)){
							// 	// $options = array( '0' => 'Seleccionar' );
							// 	foreach ($tables['category_id'] as $table) {
							// 		$options[$table['category_id']]=$table['title'].' - '.$table['category_id'];
							// 	}
							// }
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
					} else {
						$options = array( '0' => 'Seleccionar' );
					}
                    if(preg_match("/destination/i", $field->name)){
                        // $options = array( '0' => 'Seleccionar' );
                        foreach ($tables['countries'] as $table) {
                            $options[$table['code']]=$table['code'].' - '.$table['name'];
                        }
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
					echo form_dropdown($atributes, array('N' => 'NO', 'Y' => 'SI') );
					break;
                case 'int':
                    if($field->name!=$model."_id") {
                            $selected = "";
                            $options = array(); //

                            //Recibe el nombre de la tabla
                            if(preg_match("/service_id/i", $field->name)){
                                // $options = array( '0' => 'Seleccionar' );
                                foreach ($tables['service'] as $table) {
                                    $options[$table['service_id']]=$table['type'];
                                }
                            }
                            if($nivel!=0){ // REVISAR
                                $atributes['readonly'] = true;
                            }

                            echo form_dropdown($atributes, $options, $selected);
                    }
					break;
				default:
					echo form_input($atributes);
					break;
			}
			echo ' </div>';//.col-md-9
			echo '</div>';//.form-group
		}
	}

	// botonera
	echo '<div class="form-actions">';
	echo ' 	<div class="row">';
	echo ' 		<div class="col-md-offset-3 col-md-9">';
	echo form_submit('Submit', $btn, ['class'=>'btn blue', 'id'=> 'btn'.strtoupper($action) ]);
	// solo si es nuevo
	if($action=='new'){
		echo form_reset('reset', 'Borrar', ['class'=>'btn default']);
	}
	echo '   	</div>';
	echo '	</div>';
	echo '</div>';

	// cerrar formulario
	//echo form_close();
	//echo json_encode($fields);// test purpose
}
?>
