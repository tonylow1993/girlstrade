<?php
$config = array(
		'home/signup' => array(
				array(
						'field' => 'username',
						'label' => 'lang:Username',
						'rules' => 'trim|required|min_length[6]|max_length[20]|xss_clean'
				),
				array(
						'field' => 'email',
						'label' => 'lang:Email',
						'rules' => 'callback_email_check'
				)
			)
	);