$(document).ready(function(){
        //define variables
var editmode = false ;
var i_d = "";
    
    // define functions 
    
    
    //When clicking on any note with it's delete
    function clickingOnNotes(){
let NoteCollection = document.querySelectorAll('.animatedBox');
let DeleteCollection = document.querySelectorAll('#delete');
// Clicking on a note to update it 
NoteCollection.forEach(oneNote => {
  oneNote.addEventListener('click', (note) => {
        editmode = true;
        let attributes = {};
          attributes.number_of_lines1 = note.target.getAttribute("number_of_lines");
          attributes.number_of_words = note.target.getAttribute("number_of_words");
          attributes.number_of_letters = note.target.getAttribute("number_of_letters");
          i_d = note.target.getAttribute("i_d");
          attributes.text = note.target.getAttribute("text");
      
              $("#area").val(attributes.text);
              $("#Slines").text(attributes.number_of_lines1);
              $("#Swords").text(attributes.number_of_words);
              $("#Sletters").text(attributes.number_of_letters);
 
        showHide(['#main','#done','#deleteNote'],['#noteRowContainer','#addNewNote']);
  });
});    
        
// Clicking on a deleteNote to Remove it        
 DeleteCollection.forEach(DeleteNote => {
  DeleteNote.addEventListener('click', (deleteNoteElent) => {
          i_d = deleteNoteElent.target.getAttribute("i_d");
      console.log(i_d);
      console.log(deleteNoteElent.target.attributes);
      
            let data = {};
            data.id = i_d;
          $.ajax({
            url: "ajax/deleteNormalNote.php",
            method: "POST",
              data: data,
            success: function(data){
                    fetchNotes();
                editmode = false ;
                 if(data == 'done'){
                     $("#area").val("");
                 }},
            error: function(){
                          console.log("Error In Ajax");
            }
            });

  });
});    
        
    }
    
    // fetching notes
    function fetchNotes(){
   $("#noteRowContainer").html("");
         $.ajax({
        url: "ajax/fetchingNote.php",
        success: function(data){
            data = JSON.parse(data);
            if(data.length > 0){
                let div = "";
                data.forEach(arr => {
                     div += `
    <div class="noteRow" >                        
                  <div class="note" > 
                  <div class="gradient-border animatedBox " i_d="${arr[0]}" text="${arr[1]}" number_of_lines="${arr[2]}" number_of_letters="${arr[3]}" number_of_words="${arr[4]}">
               <div class="container-fluid textWrap"> ${arr[1]}</div>
                      <span class="dateOfNote">${arr[5]}</span><br>
                       </div>
                  </div>
                    <div id="delete" >
                        <div class="btnD" ><span class="noselectD" >delete</span><div class="circleD" i_d="${arr[0]}"></div></div>
                  </div>
    </div>
`;
                }); //for each
               $("#noteRowContainer").html(div);
                clickingOnNotes();
                
                
            }else{
             let div =   `
    <div class="noteRow" style="margin-top:250px;">                        
                  <div class="note" > 
                  <div class="gradient-border animatedBox ">
               <div class="container-fluid textWrap"> <p>Sorry you don't have any Notes .. Create one to see your notes</p></div>
                       </div>

    </div>
`;
                 $("#noteRowContainer").html(div);
            }
        },
        error: function(){
                      console.log("Error In Ajax");

        }
        }); // Ajax call
    }
   
    
    
    
    
function showHide(a,b){
    b.forEach(element => $(element).hide());
    a.forEach(element => $(element).show());
}//showHide function
    
    function countWords(v) {
    var matches = v.match(/\S+/g) ;
    return matches?matches.length:0;
}

    
                    // to Fetch the data from the database 
    
                            fetchNotes();


// Clicking on addNewNote
$("#addNewNote").click(function(){
      showHide(['#main','#done','#deleteNote'],['#noteRowContainer','#addNewNote']);
        $("#area").focus();
        $.ajax({
        url: "ajax/createnote.php",
        success: function(data){
         if(data == 'done'){
             $("#area").val("");
         }
        },
        error: function(){
                      console.log("Error In Ajax");

        }
        }); // Ajax call
    });// When clicking on addNewNote 
    
// Clicking on SavingNote
$("#done").click(function(){
        showHide( ['#noteRowContainer','#addNewNote'],['#main','#done','#deleteNote']);
        let area = {};
        area.Val = $("#area").val();
        area.Length = area.Val.length;
        area.Words = countWords(area.Val);
        let linesSplit = $("#area").val().split("\n");
        area.Line =   linesSplit.length;

    
    if(editmode == false){
            $.ajax({
            url: "ajax/savingnote.php",
            method: "POST",
            data: area,
            success: function(data){
                    fetchNotes();
                $("#area").val("");
            },
            error: function(){
                          console.log("Error In Ajax");

            }
            }); // Ajax call
    }else if(editmode == true){
        editmode = false;
        area.i_d = i_d;
            $.ajax({
            url: "ajax/updateNote.php",
            method: "POST",
            data: area,
            success: function(data){
                    fetchNotes();
                i_d = "";
             $("#area").text("");
              $("#Slines").text("0");
              $("#Swords").text("0");
              $("#Sletters").text("0");
                
            },
            error: function(){
                          console.log("Error In Ajax");
            }

        });
  }
    
})
    
// Clicking on daleteNote after addNote
$("#deleteNote").click(function(){
   showHide( ['#noteRowContainer','#addNewNote'],['#main','#done','#deleteNote']);
     $("#area").val("");
    if( editmode == false){
          $.ajax({
            url: "ajax/deleteAfterAdd.php",
            method: "POST",
            success: function(data){
                    fetchNotes();
                 if(data == 'done'){
                     $("#area").val("");
                 }},
            error: function(){
                          console.log("Error In Ajax");
            }
            }); // Ajax call
    }else if ( editmode == true){ 
        let data = {};
        data.id = i_d;
          $.ajax({
            url: "ajax/deleteNormalNote.php",
            method: "POST",
              data: data,
            success: function(data){
                    fetchNotes();
                editmode = false ;
                 if(data == 'done'){
                     $("#area").val("");
                 }},
            error: function(){
                          console.log("Error In Ajax");
            }
            });
    }
  
});// When clicking on Save
 
    
    
// Clicking on RED delete beside the note
$("#delete").click(function(){
    $("#delete").targe
    $.ajax({
    url: "ajax/deleteAfterAdd.php",
    method: "POST",
    success: function(data){
            fetchNotes();
        editmode = false ;
         if(data == 'done'){
             $("#area").val("");
         }},
    error: function(){
                  console.log("Error In Ajax");
    }
    }); // Ajax call
});// When clicking on Save


    // When Typing in the textarea
$("textarea").focus(function(){
    $(this).keyup(function(){

    let linesSplit = $("#area").val().split("\n");
    $("#Slines").text(linesSplit.length);
    $("#Swords").text(countWords($("#area").val()));
    $("#Sletters").text($("#area").val().length - linesSplit.length+1);       
        
    })
});
    
  

    


    
})// on ready

