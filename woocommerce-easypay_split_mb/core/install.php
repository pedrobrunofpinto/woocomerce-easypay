<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

global $wceasypay_db_version;
$wceasypay_db_version = '0.2';

//Create EasyPay tables
function wceasypay_activation_split_mb() {

	global $wpdb, $wceasypay_db_version;

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."easypay_split_mb (
						`id` int(11) NOT NULL auto_increment,
						`ep_user` varchar(15) default NULL,
						`ep_partner` varchar(15) default NULL,
						`ep_cin` varchar(9) default NULL,
						`ep_entity` varchar(7) default NULL,
						`ep_ref` varchar(13) default NULL,
						PRIMARY KEY (`id`)
					)  {$charset_collate};";


	$sql_2 = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."easypay_notifications (
							`ep_key` int(11) NOT NULL auto_increment,
							`ep_doc` varchar(50) default NULL,
							`ep_cin` varchar(20) default NULL,
							`ep_user` varchar(20) default NULL,
							`ep_status` varchar(20) default 'pending',
							`ep_entity` varchar(10) default NULL,
							`ep_reference` varchar(9) default NULL,
							`ep_value` double default NULL,
							`ep_date` datetime default NULL,
							`ep_payment_type` varchar(10) default NULL,
							`ep_value_fixed` double default NULL,
							`ep_value_var` double default NULL,
							`ep_value_tax` double default NULL,
							`ep_value_transf` double default NULL,
							`ep_date_transf` date default NULL,
							`t_key` varchar(255) default NULL,
							`notification_date` timestamp NULL default CURRENT_TIMESTAMP,
							PRIMARY KEY (`ep_key`),
							UNIQUE KEY `ep_doc` (`ep_doc`)
					)  {$charset_collate};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$wpdb->query($sql) or die("Error Creating Table!");
	  $wpdb->query($sql_2) or die("Error Creating Table!");
    add_option("wceasypay_db_version", $wceasypay_db_version);
}