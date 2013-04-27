/*
 *
 * WebSocket
 *
 * */
//$.ajax({url:"/wiserver.php"});


var url = 'ws://46.16.58.120:9000';
//var url = 'ws://127.0.0.1:9000';


socket = new WebSocket(url);

socket.onopen = function(evt)
{
    $('.chat .iconb').css('color','#6ecc00');
    log("WebSocket connected " + evt);
};
socket.onclose = function(evt)
{
    $('.chat .iconb').css('color','');
    log("WebSocket disConnected " + evt);
};
socket.onerror = function(evt) {
    log('WebSocket  error ' + evt);
};
socket.onmessage = function(evt){


    eval('var server='+evt.data);

    var dataPost     = $('.chat-pos');
    var lisChat      = $('.list-chat');
    var mChat        = $('.mChat');
    var numConnect   = $('.numConnect');
    var id_user      = dataPost.attr('id');
    var name         = dataPost.attr('data-name');
    var id_resource  = dataPost.attr('data-resource');

    log(server.type);

    if(server.type == 'onMessage'){

        log(server.message);

        mChat.append(
            '<span class="chat-send">' +
                '<span class="chat-date">' + server.date   +
                '<span class="iconb" data-icon=&#xe205;>' +
                '</span>' +
                '</span>' +
                '<span class="chat-name"><span class="iconb" data-icon=&#xe1e0;></span>' + server.name  + '</span>' +
                '<span class="chat-message"> '     + server.message   + '</span>' +
            '</span>'
        );

        dataPost.css('display','block');
        mChat.scrollTop(mChat[0].scrollHeight);
        play_sound('/qu-admin/audio/chat.mp3');


    }else if( server.type == 'listUsers' ) {

        numConnect.html(server.usersCount);

        log(server.usersCount);

        $.ajax({
            type: 'GET',
            url:"/chat/list",
            success: function(msg){
                lisChat.html(msg);
                WChat();
            }
        });

    }else if( server.type == 'onOpen' ) {


        socket.send( 'onOpen' +  '|||' );
        log(server.usersCount);

        dataPost.attr('data-resource',server.id_resource);
        id_user = dataPost.attr('id');

        if(!id_user)
        {
            dataPost.attr('id',server.id_resource);
            dataPost.attr('data-name',server.id_resource);
            dataPost.attr('data-resource',server.id_resource);

            name    = server.id_resource;
            id_user = server.id_resource;
        }

        var c = '';
        var client = '';
        var clients = server.clients;
        var i = '';
        var key = '';

        for(key in clients){
            client = clients[key];
            for(i in client){
                c += client[i]+',';
            }
        }

        $.ajax({
            type: 'POST',
            url:'/chat/list',
            data:'id_user='+   id_user   +'&name='+   name   +'&id_resource='+   server.id_resource  +'&clients='+ c,
            success: function(msg){
                mChat.load("/chat/messages/" + id_user);
                lisChat.html(msg);
            }
        });
    }
};

/*
* operate well at the beginning, but after awhile, it connect well, but  after it disconnected
* */

function log(data){
 //console.log(data);
}



/*
 *
 * Get Message
 *
 * */

function Chat(){

    var today = new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    var time =h+":"+m+":"+s;

    var texChat     = $('.textChat');
    var dataPost    = $('.chat-pos');
    var chatList    = $('.chat-list');

    var message      = texChat.attr('value');
    var id_user      = dataPost.attr('id');
    var name         = dataPost.attr('data-name');
    var id_resource  = dataPost.attr('data-resource');

    var id_user_parent           = chatList.attr('id');
    var name_parent         = chatList.attr('data-name');
    var id_resource_parent  = chatList.attr('data-resource');


    if(message){

        texChat.scrollTop =  texChat.scrollHeight;
        texChat.attr('value','');

        $('.mChat').append(
            '<span class="chat-send-local">' +
            '<span class="chat-date">'  + time   +
            '<span class="iconb" data-icon=&#xe205;></span>' +
            '</span>' +
            '<span class="chat-name"><span class="iconb" data-icon=&#xe1e0;></span>'          + name      + '</span>' +
            '<span class="chat-message"> '     + message   + '</span>' +
            '</span>'
        );

        play_sound('/qu-admin/audio/chat.mp3');

        /*

         sendMessage:

         - Send ajax save message (historic only) (vars $id_user + $name_parent , $id_resource_parent , $message )

         /// socketSend  $name,$id_resource_parent,$message

         */

        $.ajax({
            type: 'POST',
            url:'/chat/message',
            data:'id_user='+   id_user   +'&id_resource_parent='+  id_resource_parent  +'&message='+    message
        });

        socket.send('onMessage'  +'|'+  name  +'|'+  id_resource_parent  +'|'+  message);

        var mChat = $(".mChat");

        mChat.scrollTop(mChat[0].scrollHeight);
    }
}


/*
 *
 * Click actions
 *
 * */
var mChat = $(".mChat");
var chatPos = $('.chat-pos');

$(".chat-btn").bind('click',function(){
    Chat();
    return false;
});

$(".textChat").keypress(function(e) {
    if (e.which == 13) {
        Chat();
    }
});

$(".close-chat").bind('click',function(){
    $('.chat-pos').css('display','none');
});

$("a.chat").bind('click',function(){
    $('.chat-pos').css('display','block');
    var texChat = $('.textChat');
    mChat.scrollTop(mChat[0].scrollHeight);
});

chatPos.resizable();
chatPos.draggable({ handle: "h5" });


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
