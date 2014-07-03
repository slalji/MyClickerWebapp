$(document).ready
    (function()
    {
        //initialize
        if ($.cookie("stu")){
        var student = $.cookie("stu"); //"student" COOKIE  
            $("input[name=studentID]").val(student) ; //FILLS WITH "student" COOKIE*/
        }
            
         $("button[name=submit]").prop("disabled", true);
         $("label[class=session_msg]").hide();        
         $("label[class=student_msg]").hide(); 
         
         
         // click answer buttons, check input text
         $("input:radio").click(function(){
           if (($('input#inputsession').val() !='') && ($("input[name=studentID]").val() !='' )){
               $("button[name=submit]").prop("disabled", false); 
                $("label[class=student_msg]").hide();
               $("label[class=session_msg]").hide();
               
           } 
           else{
               $("label[class=session_msg]").show();
               $("label[class=student_msg]").show();
           }
           if (($('input#inputsession').val() =='') && ($("input[name=studentID]").val() !='' )){
               $("button[name=submit]").prop("disabled", true);
               $("label[class=student_msg]").hide();
               $("label[class=session_msg]").show();
           } 
            if (($('input#inputsession').val() !='') && ($("input[name=studentID]").val() =='' )){
               $("button[name=submit]").prop("disabled", true);
               $("label[class=student_msg]").show();
               $("label[class=session_msg]").hide();
           }
           
           
      }); 
      
      //after student text input, check answer checked
      $("input[name=studentID]").keyup(function(){
           if ($('input#inputsession').val() ==''){
               $("label[class=session_msg]").show();
              
           }
           if ($("input[name=studentID]").val() ==''){
               $("label[class=student_msg]").show();
           }
            if ($("input[name=studentID]").val() !=''){
               $("label[class=student_msg]").hide();
           } 
           if ($("input[name=studentID]").val().length <=3){
               $("label[class=student_msg]").show();
           }
           
           else if($("input:radio").is(':checked')){
               $("button[name=submit]").prop("disabled", false); 
               $("label[class=session_msg]").hide();
               $("label[class=student_msg]").hide();
           }
            
               
      }); 
      //remember student number      
     
      
      
});


 



