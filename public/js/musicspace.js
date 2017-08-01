/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    
     $( ".edit-award" ).click(function(e) {
            e.preventDefault();
            
            
        });
        
     $( "#add-award" ).click(function(e) {
            e.preventDefault();
            
            
       });  
        
    $("#filter-award").keyup(function () {
    //split the current value of searchInput
    var data = this.value.split(" ");
    //create a jquery object of the rows
    var jo = $("#award-filtered-table").find("tr");
    if (this.value == "") {
        jo.show();
        return;
    }
    //hide all the rows
    jo.hide();

    //Recusively filter the jquery object to get results.
    jo.filter(function (i, v) {
        var $t = $(this);
        for (var d = 0; d < data.length; ++d) {
            if ($t.is(":contains('" + data[d] + "')")) {
                return true;
            }
        }
        return false;
    })
    //show the rows that match.
    .show();
})
        
     var lastclickedrow;   
     $(".award-row").click(function(){
         
         
         $("#editnewaward").empty();
                  
         if(typeof(lastclickedrow) != 'undefined')
         lastclickedrow.toggleClass("info"); 
         
       
        
        $("#editnewaward").append("<div id = 'roweditcontainer'>");
        $("#editnewaward").append("<label class ='control-label'>Place</label>");
        $("#editnewaward").append("<input class = 'form-control' type ='text' name='place' value = '' />");
        $("#editnewaward").append("<label class ='control-label'>Win On</label>");
        $("#editnewaward").append("<input class = 'form-control' type ='date' name='dateDelivery' value = ''/>");
        $("#editnewaward").append("</div>");
        
        $(this).toggleClass("info"); 
        
        lastclickedrow = $(this);
        
     });  
     
     $("#addaward-modal-ok").click(function(){
         
         var place ="";
         var dateDelivery="";
         $("#editnewaward :input").each(function (k,el){
             
             if($(this).attr("name") == "place"){
                 place = $(this).val();
             }
             
             if($(this).attr("name") == "dateDelivery"){
                 dateDelivery = $(this).val();
             }
             
          
             
         });
          var idAward = lastclickedrow.attr("data-id");
          console.log(idAward);
          var idArtist = $(".awards-modal").attr("data-artistid");
         
       
         
         $.ajax({
         contentType: 'application/json; charset=utf-8',
         type: 'POST',
         url: '/mediadb/index.php?id='+ idArtist +'&controller=ArtistDetail&action=addaward',
         data: JSON.stringify({award_id:idAward, place:place, dateDelivery: dateDelivery }),
         
        
         success : function(msg){
             
             document.location.href = '/mediadb/index.php?id='+ idArtist +'&controller=ArtistDetail&action=edit';
             $("#addaward-modal-ok").focus();
         }
        
         });
         
     });
     
});