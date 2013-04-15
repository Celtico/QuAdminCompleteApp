
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
        $('.mCaht div').append('<span class="userC"><strong>' + message[1] + '</strong>: '  +  message[2] + '</span><br>');
        play_sound('/qu-admin/audio/chat.mp3');
        $('.chat-pos').css('display','block');
        return;
    }
    if(message[0] == 'clients') {

        $('body').attr('id', sMsg.id);
        $('.numConnect').html(message[1]);

    }
};


/*
 *
 * Get Message
 *
 * */

    function Chat(){

        var message = $('.textCaht').attr('value');
        var id = 'id' + $('body').attr('id');
        var idF = $('.chat-windows').attr('data-name');
        var chat;

        if(message)
        {
            if(idF != ''){  id = idF; }
            $('.textCaht').attr('value','');
            $('.mCaht div').append('<strong>' + id + '</strong>: '  +   message  + '<br>');
            play_sound('/qu-admin/audio/chat.mp3');

            chat =  'chat' +'|'+ id +'|'+   message;
        }

        return chat;
    }


/*
 *
 * Click actions
 *
 * */

    $(".chat-btn").bind('click',function(){
        // console.log(Chat());
        socket.send(Chat());
        return false;
    });

    $(".textCaht").keypress(function(e) {
        if (e.which == 13) {
            socket.send(Chat());
        }
    });

    $(".close-chat").bind('click',function(){
        $('.chat-pos').css('display','none');
    });

    $("a.chat").bind('click',function(){
        $('.chat-pos').css('display','block');
    });

    $( "#resizable" ).resizable().draggable();



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

