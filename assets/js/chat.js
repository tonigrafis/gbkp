var $messages = $(".messages-content"),
    d, h, m,
    i = 0;

var myName = "";
var target = "";
var sender = "";
function getNama() {
	myName=prompt("Masukkan Nama Anda:");
	myName=myName==null?'':myName.replace(/([^a-zA-Z ])/g, "");
	if(myName.length<3){
		getNama();
	}else{
		myName=myName.trim().replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()});
		localStorage.setItem("nama_konsumen", myName);
		localStorage.setItem("token_chat", $("#sender").val());
	}
}
$(document).ready(function() {
	myName = localStorage.getItem("nama_konsumen");
	if(myName == null || myName == "" || myName == " ") {
		getNama();
	}
	$messages.mCustomScrollbar();
	const target = $("#target").val();
	const sender = localStorage.getItem("token_chat");
	
	firebase.database().ref("messages/"+target+"/"+sender).on("child_added", function (snapshot) {
		var chat = snapshot.val();
		if((((chat.receiver == target) && (chat.sender == sender)) || ((chat.receiver == sender) && (chat.sender == target))) && chat.status == 1) {
			if(snapshot.val().sender == sender){
				$('<div xdatelist="'+(new Date(snapshot.val().timestamp*-1).getDate())+'" class="message message-personal" data-position="'+snapshot.val().timestamp+'"><div id="message-' + snapshot.key + '">'+snapshot.val().message+'<button class="btn-delete" data-id="'+snapshot.key+'" onclick="deleteMessage(this);"><i class="fa fa-trash" aria-hidden="true"></i></button></div></div>').appendTo($('.mCSB_container')).addClass('new');
				$('.message-input').val(null);
			}else{
				if(snapshot.val().sender != sender){
					if(snapshot.val().sound==0){
						firebase.database().ref("messages/"+target+"/"+sender).child(snapshot.key).update({ sound: "1"});
						new_message_audio_play();
					}
				}
				$('<div xdatelist="'+(new Date(snapshot.val().timestamp*-1).getDate())+'" class="message new" data-position="'+snapshot.val().timestamp+'"><div id="message-'+snapshot.key+'">'+snapshot.val().message+'</div></div>').appendTo($('.mCSB_container')).addClass('new');
			}
			$('<div class="timestamp">'+ new Date(snapshot.val().timestamp*-1).toLocaleString('id').split(".").join(":")+'</div>').appendTo($('.message:last'));
		}
		updateScrollbar();
	});
	
	$("#close_chitchat").click(function() {
		firebase.database().ref("messages/"+target+"/"+sender).off("child_added");
	});
});
			
function updateScrollbar() {
	$messages.mCustomScrollbar("update").mCustomScrollbar('scrollTo', 'bottom', {
		scrollInertia: 10,
		timeout: 0
	});
	$(".mCSB_container div.new").sort(function(a, b) {
		return $(b).data("position") - $(a).data("position");
	}).appendTo(".mCSB_container");
}

function insertMessage() {
	msg = $('.message-input').val();
	if ($.trim(msg) == '') {
		return false;
	}
	sendMessage();
}

$('.message-submit').click(function() {
	insertMessage();
});
