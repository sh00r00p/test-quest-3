<?php

$ip = Helper::getIpAddr();
$students = $content;

$groups = array();
$group_id = array();
$group_title = array();
foreach($students as $student){
  if(!in_array($student->group_id, $group_id)) $group_id[] = $student->group_id; 
  if(!in_array($student->group_title, $group_title)) $group_title[] = $student->group_title; 
}
$groups = array_combine($group_id, $group_title);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Add student</title>
    <link href="/style.css" rel="stylesheet" media="all" />
  </head>
  <body>
    <div class="form">
      <div class="header"><p>Add new student</p></div>
      <div class="nav">
          <nav>
            <button><a href="/">List</a></button>
            <button><a href="/default/top">Top</a></button>
          </nav>
        </div>
      <form id="new_students" action="" method="post">
        <div class="fieldlist">
          <div class="field">
            <input type="text" name="name" placeholder="Name" required>
          </div>
          <div class="field">
            <input type="text" name="surname" placeholder="Surname" required>
          </div>
          <div class="field">
            <select name="group" placeholder="Group" required>
              <?php foreach($groups as $key=>$value) : ?>
                  <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
              <?php endforeach; ?>
              </select>
          </div>
          <div class="field">
            <input type="date" name="birth_date" placeholder="Birth date" required>
          </div>
          <div class="field">
            <input type="email" name="email" placeholder="E-mail" required>
          </div>
          <div class="controls">
            <input type="submit" name="submit" value="Submit">
            <input type="hidden" name="ip" value="<?php echo $ip; ?>">
            <input type="hidden" name="date" value="<?php echo date('d-m-Y H:i:s');?>">
          </div>
        </div>

      </form>
      <div id="result_id"></div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        
        $("#new_students").submit(function(){
          var form = $(this);  
          var data = form.serialize();
            $.ajax({ 
               type: 'POST',
               url: '/default/addRow',
               dataType: 'html', 
               data: data, 
                 beforeSend: function(data) {
                      form.find('input[type="submit"]').attr('disabled', 'disabled');
                    },
                 success: function(data){ 
                    if (data['error']) {
                      alert(data['error']); 
                    } else { 
                      //$('#result_id').html('Data is updated!');
                      $('#result_id').append(data);
                    }
                   },
                 error: function (xhr, ajaxOptions, thrownError) {
                      alert(xhr.status); 
                      alert(thrownError);
                   },
                 complete: function(data) { 
                      form.find('input[type="submit"]').prop('disabled', false);
                   }
                            
                 });
            this.reset();

          return false;

        });

  });
    </script>
  </body>
</html>