// gets query data from HTML response
function getUrlVars(){
     
    var vars = [], hash;vars['ch'] =  "default";
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
     
    return vars;
         
    }
 // initialize start event
$(document).ready(function () {
     var ch='default'; //default
     if (getUrlVars()['ch'] !=''){
         ch = getUrlVars()['ch'];        
     } 
     var id = PUBNUB.uuid();     
     
// Initialize the PubNub API connection.
var pubnub = PUBNUB.init({
        publish_key   : 'pub-c-c684061f-e7da-4cb6-a77d-aab213c4392e',
        subscribe_key : 'sub-c-c4607170-5de8-11e3-bbb6-02ee2ddab7fe'
        
    });

 
// Handles all the messages coming in from pubnub.subscribe.
function handleMessage(message) {
 
inputchannel.value = message.user;
inputsession.value = message.txt;
 
};
 
// when start button pressed
//save input data into pubnub message
// and publish/broadcast on ch channel
$('#sendMessageButton').click(function (event) {

var message ='';
    pubnub.publish({
        channel: ch,
        message: {
        user: ''+ch,
        txt:  '' + PUBNUB.uuid()
        }
    });
});
 
 
 
// Subscribe to messages coming in from the channel.
//This is to show in the session inputbox
//for instructor's page
pubnub.subscribe({
channel: ch,
message: handleMessage
});
});



