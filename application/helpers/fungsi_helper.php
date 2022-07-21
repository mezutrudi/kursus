<?php

function check_already_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('id_users');
	if ($user_session) {
		redirect('home');
	}
}
function check_not_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('id_users');
	if (!$user_session) {
		redirect('auth');
	}
}
function check_admin()
{
	$ci = &get_instance();
	if ($ci->session->userdata('level') == "1") {
		redirect('home');
	} elseif ($ci->session->userdata('level') == "2") {
		redirect('home');
	} elseif ($ci->session->userdata('level') == "0") {
		redirect('home');
	}
}
