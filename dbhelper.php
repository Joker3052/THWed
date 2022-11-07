<?php
require_once ('config.php');
session_start();
/**
 * insert, update, delete -> su dung function
 */
function execute($sql) {
	//create connection toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	//query
	mysqli_query($conn, $sql);

	//dong connection
	mysqli_close($conn);
}

/**
 * su dung cho lenh select => tra ve ket qua
 */
function executeResult($sql) {
	//create connection toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	//query
	$resultset = mysqli_query($conn, $sql) or die( mysqli_error($conn));
	$list      = [];
	while ($row = mysqli_fetch_array($resultset)) {
		$list[] = $row;
	}

	//dong connection
	mysqli_close($conn);

	return $list;
}