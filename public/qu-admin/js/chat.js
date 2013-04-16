
/*
 *
 * WebSocket
 *
 * */
$.ajax({url:"http://qumodules.com/server.php"});


var url = 'ws://46.16.58.120:9000';
//var url = 'ws://127.0.0.1:9000';

socket = new WebSocket(url);

socket.onopen = function(evt) {
    $('.chat .iconb').css('color','#6ecc00');
    console.log("WebSocket connected");
};
socket.onclose = function(evt) {
    console.log("DISCONNECTED " + evt.data);
};
socket.onerror = function(evt) {
    console.log('ERROR ' + evt.data);
};
socket.onmessage = function(evt){

    eval('var sMsg='+evt.data);

    var message = sMsg.msg.split("|");

    if(message[0] == 'chat')
    {
        var mChat = $(".mChat");

        mChat.append('<span class="userC"><strong>' + message[1] + '</strong>: '  +  message[2] + '</span><br>');
        play_sound('/qu-admin/audio/chat.mp3');
        $('.chat-pos').css('display','block');
        mChat.scrollTop(mChat[0].scrollHeight);
        return;
    }
    if(message[0] == 'clients') {

        $('.numConnect').html(message[1]);
        $('.chat-pos').attr('id',sMsg.id);

        var user = sMsg.users.split(",");

        socket.send('users' + '|' + user);

        var en2 = '';
        for(var i2 in user)
        {

            en2 += '<span class="userC">' + user[i2] + '</span><br>';
        }

        $('.list-chat').html(en2);
    }
    if(message[0] == 'users') {

        var f = message[1].split(",");
        var en = '';
        for(var i in f)
        {
            en += '<span class="userC">' + f[i] + '</span><br>';
        }
        $('.list-chat').html(en);
    }



};


/*
 *
 * Get Message
 *
 * */

function Chat(){


    var texChat = $('.textChat');
    var message = texChat.attr('value');
    var id  = 'id' + $('body').attr('id');
    var idF = $('.chat-pos').attr('data-name');
    var chat;

    if(message)
    {
        texChat.scrollTop =  texChat.scrollHeight;
        if(idF != ''){  id = idF; }
        texChat.attr('value','');
        $('.mChat').append('<strong>' + id + '</strong>: '  +   message  + '<br>');
        play_sound('/qu-admin/audio/chat.mp3');

        chat =  'chat' +'|'+ id +'|'+   message;

        var mChat = $(".mChat");
        mChat.scrollTop(mChat[0].scrollHeight);
    }

    return chat;
}


/*
 *
 * Click actions
 *
 * */

$(".chat-btn").bind('click',function(){
    socket.send(Chat());
    return false;
});

$(".textChat").keypress(function(e) {
    if (e.which == 13) {
        socket.send(Chat());
    }
});

$(".close-chat").bind('click',function(){
    $('.chat-pos').css('display','none');
});

$("a.chat").bind('click',function(){
    $('.chat-pos').css('display','block');
    var texChat = $('.textChat');
    texChat.scrollTop =  texChat.scrollHeight;
});



var chatPos = $('.chat-pos');
chatPos.resizable();
chatPos.draggable({ handle: "h5" });
$(".mChat").scrollTop($(".mChat")[0].scrollHeight);

/*
 *
 * LOAD AUDIO
 *
 * */

function html5_audio(){
    var a = document.createElement('audio');
    return !!(a.canPlayType && a.canPlayType('audio/mpeg;').replace(/no/, ''));
}

var play_html5_audio = false;
if(html5_audio()) play_html5_audio = true;


function play_sound(url){
    if(play_html5_audio){
        var snd = new Audio(url);
        snd.load();
        snd.play();
    }else{
        $("#sound").remove();
        var sound = $("<embed id='sound' type='audio/mpeg' />");
        sound.attr('src', url);
        sound.attr('loop', false);
        sound.attr('hidden', true);
        sound.attr('autostart', true);
        $('body').append(sound);
    }
}

