function getUrlVars(){
     
    var vars = [], hash;vars['ch'] =  "mychannel";
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
     
    return vars;
         
    }
  
$(document).ready(function () {
     var ch='mychannel'; //default
     var ch = getUrlVars()['ch'];     
     var id = PUBNUB.uuid();
// Initialize the PubNub API connection.
var pubnub = PUBNUB.init({
        publish_key   : 'pub-c-c684061f-e7da-4cb6-a77d-aab213c4392e',
        subscribe_key : 'sub-c-c4607170-5de8-11e3-bbb6-02ee2ddab7fe',
        message: "New Session"
    });
    //var message = messageContent.val();
var message ='';
   /* pubnub.publish({
        channel: ch,
        message: {
        username: ''+ch,
        text:  '' + PUBNUB.uuid()
        }
    });*/
 
// send button is defined on both ihammer and hammer
// enabling the click to send session id to both inputs
 
    var sendMessageButton = $('#sendMessageButton') 
 
// Handles all the messages coming in from pubnub.subscribe.
function handleMessage(message) {
 
inputchannel.value = message.username;
inputsession.value = message.text;
current.value = new Date().toLocaleString()  ;
 
 
// Scroll to bottom of page
// 
};
 
/* Compose and send a message when the user clicks our send message button.
sendMessageButton.click(function (event) {
//var message = messageContent.val();
var message ='';
    pubnub.publish({
        channel: ch,
        message: {
        username: ''+ch,
        text:  '' + PUBNUB.uuid()
        }
    });
});
$('#sendMessageButton').click(function (event) {
//var message = messageContent.val();
var message ='';
    pubnub.publish({
        channel: ch,
        message: {
        username: ''+ch,
        text:  '' + PUBNUB.uuid()
        }
    });
});
 */
 
 
// Subscribe to messages coming in from the channel.
pubnub.subscribe({
channel: ch,
message: handleMessage
});
});



