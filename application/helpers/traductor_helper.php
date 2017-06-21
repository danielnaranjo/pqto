<?php
// http://stackoverflow.com/a/24854930
// https://www.codeigniter.com/userguide3/general/helpers.html
if ( ! function_exists('traducir')) {
    function traducir($arg){
		$originales = array(

			'name'		=>	'nombre',
			'lastname'		=>	'apellido',
			'city'			=>	'ciudad',
			'country'		=>	'país',
			'type'			=>	'Tipo',
			'created'		=>	'fecha',
			'name'			=>	'nombre',
			'email'			=>	'e-mail',
			'address'		=>	'dirección',
			'province'		=>	'provincia',
			'account'		=>	'cuenta',
			'user'			=>	'Usuario',
			'type'			=>	'tipo',
			'amount'		=>	'monto',
			'number'		=>	'número',
			'price'			=>	'precio',
			'file'			=>	'archivo',
			'description'	=>	'descripción',
			'phone'			=>	'teléfono',
			'status'		=>	'estado',
			'image'			=>	'logotipo',
			'latitude'		=>	'latitud',
			'longitude'		=>	'longitud',
			'date'			=> 	'Fecha',
			'valid_from'	=>	'Valida desde',
			'valid_to'		=> 	'Valida hasta',
			'title' 		=> 	'Titulo',
			'requested'		=> 	'Solicitado',
			'registered'	=>	'Registrado',
            'category'		=>	'Categoria',
            'createdAt'		=>	'Creado',
            'updateAt'		=>	'Actualizado',
            'text'		=>	'Respuesta',
            'destination_id'		=>	'Destino',
            'destination'		=>	'Destino',
            'origin'		=>	'Origen',
            'service_id'		=>	'Servicio',
            'category_id'		=>	'Categoria',
            'from_id'		=>	'De',
            'comment'		=>	'comentario',
            'service' => 'Tipo de Servicio',
            'delivery' => 'Entregado',
            'auction' => 'Negociable',
            'package' => 'Envio',

		);
		return strtr( $arg, $originales );
    }
}
