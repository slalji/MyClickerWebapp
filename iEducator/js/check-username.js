 $(document).ready(function(){
           $("input[name=username]").change(function(){
           var username=$("input[name=username]").val();
          
             $.ajax({
                    type:"post",
                    url:"check.php",
                    data:"username="+username, 
                        success:function(data){
                        if(data <=0){
                            $("input[name=username]").css('background-color','#dcc1c1'); //red
                        }
                        else{
                            $("input[name=username]").css('background-color','#c1dcd0'); //green
                            exit;
                        }
                        
                    }
                 });
 
            });
            
            
         });
