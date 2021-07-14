<?php
require_once("connexion.php");
	if (isset($_GET['status']) and $_GET['status'] == 'loadInfo') {
		$id_musique = $_GET['id_musique'];
		$select_musique = mysqli_query($conn,"SELECT * FROM MUSIQUE WHERE ID_MUSIQUE='$id_musique'");
		$row = mysqli_fetch_assoc($select_musique);
		$merchantref = rand();
		$our_url = 'localhost/';
		$Json_data = array(
			'merchantId'=>4011,
			'description'=>$row['TITRE_MUSIQUE'],
			'language'=>'FR',
			'merchantRef'=>$merchantref,
			'currency'=>'USD',
			'amount'=>$row['PRIX_MUSIQUE'], 
			'successUrl'=>$our_url.'UserPayment.php?id_musique='.$id_musique.'&status=success',
			'failedUrl'=>$our_url.'UserPayment.php?id_musique='.$id_musique.'&status=fail',
			'cancelledUrl'=>$our_url.'UserPayment.php?id_musique='.$id_musique.'&status=cancel',
			'redirectUrl'=>$our_url.'UserPayment.php?id_musique='.$id_musique.'&status=redirect' 
		);
		$send_json =  json_encode($Json_data);

		$url = 'https://apps.ub-pay.net/test/merchantController/requestPayment';
		$options = array(
			'http' => array(
				'method' => 'POST',
				'content' => $send_json,
				'header' => "Content-Type: application/json\r\n".
							"Accept: application/json\r\n"
			)
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url,false,$context);
		$response = json_decode($result,true);
		echo json_encode($response);
	}else if(isset($_GET['status']) and $_GET['status'] == 'success'){

		$response = json_decode($_GET['status'],true);
		echo json_encode($response);

	}else if (isset($_GET['status']) and $_GET['status'] == 'fail') {

		$response = json_decode($_GET['status'],true);
		echo json_encode($response);

	}else if (isset($_GET['status']) == 'cancel') {

		$response = json_decode($_GET['status'],true);
		echo json_encode($response);

	}else if (isset($_GET['status']) and $_GET['status'] == 'redirect') {
		
		$response = json_decode($_GET['status'],true);
		echo json_encode($response);
	}
?>