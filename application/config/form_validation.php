<?php
$config = array(
		'home/signup' => array(
				array(
						'field' => 'username',
						'label' => 'lang:Username',
						'rules' => 'trim|required|min_length[5]|max_length[20]|xss_clean'
				),
				array(
						'field' => 'email',
						'label' => 'lang:Email',
						'rules' => 'callback_email_check'
				)
			),
		'newPost/createNewPost' => array(
				array( 	'field' => 'descriptionTextarea',
						'label' => 'lang:Description',
						'rules' => 'trim|required|min_length[5]|max_length[200]|xss_clean'
				),
				array(
						'field' => 'price',
						'label' => 'lang:Price',
						'rules' => 'required'
				)
		)
	);