<?php
    if ($msg == 'test') {
        sm($chatID, "test ok");
    }

    if ($msg == '?dev') {
        sm($chatID, "This userbot is powered by YOUR NAME");
    }
    
    if ($msg == '?ver') {
        sm($chatID, "USERBOT VERSION, LIKE: VERSION 1.0");
    }
}

if(stripos($msg, '.sm') === 0 and $userID == YOUR ID){
    $exp = explode(" ", $msg, 3);
    sm($exp[1], $exp[2]);
  }

if(stripos($msg, '!auth') === 0 and $userID == YOUR ID){
sm($chatID, 'MESSAGE');
            sleep(0.6);
            sm($chatID, 'MESSAGE');
        }
        
if($msg == 'myid'){
sm($chatID, "Ecco il tuo ID: <code>$userID</code>");
}

if($msg == 'chatid'){
sm($chatID, "Ecco l'ID del gruppo: <code>$chatID</code>");
}

if(stripos($msg, '<riavvia') === 0 and $userID == YOUR ID){
sm($chatID, "<code>⚙RIAVVIO...</code>\n ╠<i>✅Riavvio Completato!</i>\n ╚<i>✅Nessun Errore Trovato!</i>");
}

if($msg == "del" and isset($update['update']['message']["reply_to_msg_id"]) and $userID == YOUR ID){
$MadelineProto->channels->deleteMessages(['channel' => $chatID, 'id' => [$update['update']['message']["reply_to_msg_id"], $update['update']['message']["id"]]]);
}

if($msg == "delall" and isset($update['update']['message']["reply_to_msg_id"]) and $userID == YOUR ID){
      $messages_Messages = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$update['update']['message']["reply_to_msg_id"]], ]);
      $suserID = $messages_Messages['messages'][0]['from_id'];
      $MadelineProto->channels->deleteUserHistory(['channel' => $chatID, 'user_id' => $suserID]);
      $MadelineProto->channels->deleteMessages(['channel' => $chatID, 'id' => [$update['update']['message']["id"]]]);
      }
      


// es: flood 100 Storm by @cancr
if (0 === strpos($msg, 'flood ') and $userID == YOUR ID)
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
if (0 === strpos($msg, 'nome ') and $userID == YOUR ID)
	{
	$nome = str_replace('nome ', '', $msg);
	$MadelineProto->account->updateProfile(['first_name' => $nome]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Ho cambiato nome in ' . $nome]);
	}
//cambia bio    
if (0 === strpos($msg, 'bio ') and $userID == YOUR ID)
	{
	$bio = str_replace('bio ', '', $msg);
	$MadelineProto->account->updateProfile(['about' => $bio]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Ho cambiato la bio in ' . $bio]);
	}
    
//cambia username
if (0 === strpos($msg, 'username ') and $userID == YOUR ID)
	{
	$tag = str_replace('username ', '', $msg);
	$MadelineProto->account->updateUsername(['username' => $tag]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Ho Cambiato l'username in @$tag"]);
	}
    
    

//ubot limitato?
if(0 === strpos($msg, 'check') and $userID == YOUR ID)
	{
	sm(178220800, "/start");
	}
$idchat = "-1001436272141"; //mettere l'id della chat dove il bot mandera il resoconto
if (stripos($msg, "Good news") === 0 and $userID == 178220800) //don't change this id
	{
	sm($idchat, "Non sono limitato.");
	}
if (stripos($msg, "Dear") === 0 and $userID == 178220800) //don't change this id
	{
	sm($idchat, "Sono limitato.");
}
//ban
if(0 === strpos($msg, 'ban') and $userID == YOUR ID)
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
