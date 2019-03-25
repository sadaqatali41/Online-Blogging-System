<?php
	$config = array(
			'add_article_rules' => array(
											array(
													'field'=>'title',
													'label'=>'Title',
													'rules'=>'required|min_length[3]|max_length[25]'
												),
											array(
													'field'=>'body',
													'label'=>'Title Description',
													'rules'=>'required|max_length[300]'


												)


										),
									
			'admin_login' => array(
										array(
												'field'=>'uname',
												'label'=>'User Name',
												'rules'=>'required|min_length[6]|max_length[10]'
											),
										array(
												'field'=>'pwd',
												'label'=>'Password',
												'rules'=>'required',
											)
								)
					);

?>