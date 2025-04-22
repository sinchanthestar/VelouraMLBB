<?php
error_reporting(0);

require '../mainconfig.php';

$orders = mysqli_query($db, "SELECT * FROM orders WHERE provider_id = '1' AND status IN ('Pending', 'Processing') ORDER BY rand() LIMIT 20");
while ($order = mysqli_fetch_array($orders)) {
	$provider = mysqli_query($db, "SELECT * FROM provider WHERE id = 1");
	if (mysqli_num_rows($provider) == 0) {
		print("ID: ".$order['id'].", Provider tidak ditemukan!<br />");
	} else {
		$provider = mysqli_fetch_assoc($provider);
		$post_api = array(
		    'api_id' => $provider['api_id'],
			'api_key' => $provider['api_key'],
			'id' => $order['provider_order_id']
		);
		$curl = post_curl($provider['api_url_status'], $post_api);
		$result = json_decode($curl, true);
		if (isset($result['status']) AND $result['status'] == true) {
			if ($result['data']['status'] == 'Success') {
				$status = 'Success';
			} elseif ($result['data']['status'] == 'Error') {
				$status = 'Error';
			} elseif ($result['data']['status'] == 'Partial') {
				$status = 'Partial';
			} elseif ($result['data']['status'] == 'Processing') {
				$status = 'Processing';
			} else {
				$status = 'Pending';
			}
			$start_count = (isset($result['data']['start_count'])) ? $result['data']['start_count'] : 0;
			$remains = (isset($result['data']['remains'])) ? $result['data']['remains'] : 0;
			$query_update = "UPDATE orders SET status = '".$status."', start_count = '".$start_count."', remains = '".$remains."', api_status_log = '".$curl."', updated_at = '".date('Y-m-d H:i:s')."' WHERE id = '".$order['id']."'";
			mysqli_query($db, $query_update);
			print("ID: ".$order['id'].", ID API: ".$order['provider_order_id'].", STATUS: $status, SC: $start_count, R: $remains | Response: ".$curl."<br />");
		} else {
			print("ID: ".$order['id'].", Cek status gagal | Response: ".$curl."!<br />");
		}
	}
}