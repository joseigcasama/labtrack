<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<script src="assets/custom/js/jquery-1.11.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<div id="form-content">
     <form method="post" id="reg-form" autocomplete="off">
   
 <div class="form-group">
 <input type="text" class="form-control" name="txt_fname" id="lname" placeholder="First Name" required />
 </div>
    
 <div class="form-group">
 <input type="text" class="form-control" name="txt_lname" id="lname" placeholder="Last Name" required />
 </div>
    
 <div class="form-group">
 <input type="text" class="form-control" name="txt_email" id="lname" placeholder="Your Mail" required />
 </div>
    
 <div class="form-group">
 <input type="text" class="form-control" name="txt_contact" id="lname" placeholder="Contact No" required />
 </div>
    
 <hr />
    
 <div class="form-group">
 <button class="btn btn-primary">Submit</button>
 </div>
    
    </form> 

</div> 
<script>
$('#reg-form').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.ajax({
 url: 'add.php',
 type: 'POST',
 data: $(this).serialize(), // it will serialize the form data
        dataType: 'html'
    })
    .done(function(data){
       alert("Success");
    })
    .fail(function(){
 alert('Ajax Submit Failed ...'); 
    });
});
</script>