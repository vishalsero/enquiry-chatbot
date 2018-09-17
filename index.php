<html>
<head>
	<title>AcademiaERP AI</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    var accessToken ="995ce29ef2c649ad81f723e34b1cee0d";
	function makeid() {
               var text = "";
               var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
               for (var i = 0; i < 5; i++)
                   text += possible.charAt(Math.floor(Math.random() * possible.length));
               return text;
           }
           var sessionID = makeid();
    var baseUrl = "https://api.dialogflow.com/v1/";
	
 $(document).ready(function() {
$("#program").change(function(){
     var program = this.value;
     console.log(program);
  
  });

});
	
	function programChange(program){
    	 console.log(program);
  
  };	
		
		
	}
    $(document).ready(function() {
        $("#input").keypress(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                send();
this.value = '';
            }
        });
        $("#rec").click(function(event) {
            switchRecognition();
        });
    });
    var recognition;
    function startRecognition() {
        recognition = new webkitSpeechRecognition();
        recognition.onstart = function(event) {
            updateRec();
        };
        recognition.onresult = function(event) {
            var text = "";
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                text += event.results[i][0].transcript;
            }
            setInput(text);
            stopRecognition();
        };
        recognition.onend = function() {
            stopRecognition();
        };
        recognition.lang = "en-US";
        recognition.start();
    }
    function stopRecognition() {
        if (recognition) {
            recognition.stop();
            recognition = null;
        }
        updateRec();
    }
    function switchRecognition() {
        if (recognition) {
            stopRecognition();
        } else {
            startRecognition();
        }
    }
    function setInput(text) {
        $("#input").val(text);
        send();
    }
    function updateRec() {
	 //$("#rec").text(recognition ? "Stop" : "Speak");
	 //$("#rec").img(recognition ? "<img src='images/mic.png'/>" : "<img src='mic-recording.png'/>");
	//console.log(recognition,"recognition");
	if(recognition)
	 $('#imgMic').attr('src', 'mic-recording.png');
	 else
	 $('#imgMic').attr('src', 'mic.png');
    }
function send() {
        var text = $("#input").val();
   $("#response").append("<div class='user-request'>"+text+"</div>");
	
	//$("#response").text(conversation.join(""));
	
        $.ajax({
            type: "POST",
            url: baseUrl + "query?v="+sessionID,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + accessToken
            },
            data: JSON.stringify({ query: text, lang: "en", sessionId: sessionID }),
            success: function(data) {
                var respText = data.result.fulfillment.speech;
                //console.log("Respuesta: " + respText);
                setResponse(respText);
                $('.b-agent-demo_result').animate({scrollTop: $('.b-agent-demo_result').prop("scrollHeight")}, 500);
		$("#input").val("");
            },
            error: function() {
                setResponse("Internal Server Error");
            }
        });
    }
    function setResponse(val) {
	    //Edit "AI: " to change name
       // conversation.push("AI: " + val + '\r\n');
	 val = val.replace(/(?:\r\n|\r|\n)/g, '<br>');
	   $("#response").append("<span class='ai-response'>"+val+"</span>");
		
	}
    var conversation = [];
</script>
  <style type="text/css">
		bot.body { width: 500px; margin: 0 auto; margin-top: 20px; }
		bot.div {  position: absolute; }
		bot.input { width: 400px; }
		bot.button { width: 50px; }
		
		.b-agent-demo_result {
			overflow-y: auto;
			background: white; 
			top: 110px; bottom: 55px;
			position: inherit;
			height: 250px;
		}
		
		.b-agent-demo_result-table {
			    -- height: 100%;
				min-height: 210px;
				width: 100%;
				
		}
		
		.chat-box{
			width: 301px;
		}
		
		.chat-box .header{
			width: 100%; 
			height: 40px; 
			background: #333;
		}
		
		.logo{
			width: 23px; height: 28px; padding: 6px 0 0 10px; display: inline-block;
		}
		
		.title{
			color: #fff;
			font-size: 16px;
			position: relative;
			top: -7px;
			left: 5px;
		}
		
		.arrow{
			position: relative;
			top: 16px;
			right: 12px;
			float: right;
		}
		
		.ask-me{
			width: 260px;
			height: 40px;
			text-indent: 10px;
			border:0;
		}
		
		.speak-btn{
			background: none;
			border: 0;
			position:relative;
			top: 5px;
			left: 7px;
			cursor: pointer;
			outline: 0;
		}
		
		
		 .user-request {
    background-color: #efefef;
    float: left;
    margin-right: 15px;
    margin-top: 15px;
    margin-left: 15px;
	    display: inline-block;
    padding: 15px 25px;
    border-radius: 3px;
    border: 1px solid #eee;
    margin-bottom: 5px;
    font-size: 16px;
    clear: both;
	font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;
}
					
.ai-response {
    color: #ffffff;
    background-color: #a5d175;
    float: right;
    margin-top: 15px;
    margin-right: 15px;
    margin-left: 15px;
	    display: inline-block;
    padding: 15px 25px;
    border-radius: 3px;
    border: 1px solid #eee;
    margin-bottom: 5px;
    font-size: 16px;
    clear: both;
	font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;
}
		
	</style>
</head>
<body>
	<div class="bot chat-box">
	<div class="header" style="">
		<span class="logo"><img src="logo.png"/></span>
		<span class="title">Welcome to Academia - AI</span>
		<span class="arrow"><img src="arrow.png"/></span>
	</div>
	<div class="b-agent-demo_result" id="resultWrapper">
  <table class='b-agent-demo_result-table'>
  <tr>
	<td id="response"></td>
  </tr>
  </table>
  </div>
  <br />
  <div style="border: 1px solid #ccc;">
    <input id="input" type="text" placeholder="Ask me something..." autocomplete="off" class="ask-me" /><button id="rec" class="speak-btn"><img id='imgMic' src="mic.png"/></button>
 </div>
	</div>
</body>
</html>
