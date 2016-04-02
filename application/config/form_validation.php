<?php
$config = array(
		'home/signup' => array(
				array(
						'field' => 'username',
						'label' => 'lang:Username',
						'rules' => 'trim|required|callback_username_check|min_length[5]|max_length[20]|xss_clean'
				),
				array(
						'field' => 'email',
						'label' => 'lang:Email',
						'rules' => 'trim|required|callback_email_check'
				),
				array(
						'field' => 'checkboxes-1',
						'label' => 'Agreement',
						'rules' => 'callback_agree_check'
				)
			),
		'newPost/createNewPost' => array(
				array( 	'field' => 'Adtitle',
						'label' => 'lang:title',
						'rules' => 'trim|required|min_length[10]|max_length[100]|xss_clean'
				),
				array( 	'field' => 'descriptionTextarea',
						'label' => 'lang:Description',
						'rules' => 'trim|required|min_length[10]|max_length[200]|xss_clean'
				),
				array( 	'field' => 'category-group',
						'label' => 'lang:Category',
						'rules' => 'required'
				),
				array(
						'field' => 'price',
						'label' => 'lang:Price',
						'rules' => 'callback_price_check'
				)
		),
		'home/updateProfile' => array(
				array( 	'field' => 'descriptionTextarea',
						'label' => 'lang:Description',
						'rules' => 'trim|required|min_length[10]|max_length[200]|xss_clean'
				),
				array( 	'field' => 'weChatID',
						'label' => 'weChatID',
						'rules' => 'trim|max_length[30]|xss_clean'
				),
				array( 	'field' => 'webSiteAddr',
						'label' => 'webSiteAddr',
						'rules' => 'trim|max_length[300]|xss_clean'
				)
		)
	);