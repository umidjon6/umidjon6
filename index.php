<?php
/**
 *Author: Umid Coder
 *
 *Telegram : @Umid_Coder
 **/
error_reporting(0);
ob_start();
define('API_KEY','5102454298:AAHhOg-KAhCbpWWF_K9lbjE-V_jE6bqoOY8'); 
//==============================\\
if(true){
error_reporting(E_ALL & ~(E_NOTICE | E_USER_NOTICE | E_DEPRECATED));
ini_set('display_errors', 1);
}
function del($nomi){
   array_map('unlink', glob("$nomi"));
   }
//______________₩₩₩______________\\
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$u = json_decode(file_get_contents('php://input'));
$ms = $u->message;
$c = $ms->chat->id;
$t = $ms->text;
$m = $ms->message_id;
$botname = bot('getme',['bot'])->result->username;

if($t=="/start" or $t=="/start@$botname" or $t=="/Start@$botname" or $t=="$botname" or $t=="/Start" or $t=="/START"){
bot('sendMessage',[
'chat_id'=>$c,
    'message_id'=>$m,
'text'=>"*👋 Salom men guruhlarda kirdi-chiqdi xabarlarni oʻchiruvchi botman!*
*Istasangiz meni o'z guruhingizga qo'shing ✅*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
    [['text'=>"➕ Guruhga Qo'shish",'url'=>"http://t.me/$botname?startgroup=new"]]
    ]]);
]);
}

if($u->message->leaveChat or $u->message->new_chat_member or $u->message->new_chat_photo or $u->message->new_chat_title or $u->message->left_chat_member or $u->message->pinned_message){
    bot('deleteMessage',[
        'chat_id'=>$c,
        'message_id'=>$m,
    ]);
}

?>
