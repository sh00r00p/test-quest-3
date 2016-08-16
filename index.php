<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/helper.php';

$class = new Helper();
$ip = $class->getIpAddr();
$students = $class->getList();
$rates = $class->getRates();
$top = $class->getTop(10);

/*forming filters arrays*/
$surnames = array();
$parts = array();
$averages = array();
$groups = array();
$group_id = array();
$group_title = array();
foreach($students as $student){
  if(!in_array($student->student_surname, $surnames)) $surnames[] = $student->student_surname;
  if(!in_array($student->part, $parts)) $parts[] = $student->part;
  if(!in_array($student->part, $averages)) $averages[] = $student->average;
  if(!in_array($student->group_id, $group_id)) $group_id[] = $student->group_id; 
  if(!in_array($student->group_title, $group_title)) $group_title[] = $student->group_title; 
}
$groups = array_combine($group_id, $group_title);
/*forming filters arrays*/
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Students table</title>
    <style type="text/css" media="screen">
      .students, .students td, .students th { border: 1px solid #000; }
      .students td, .students th, .header, .fieldlist, #filter ul { text-align: center; }
      .students { width: 100%; border-collapse: collapse; } 
      .students td, .students th { padding: 5px; }
      .students th { background: #ccc; }
      body { font-family: sans-serif; }
      .field, #filter li { display: inline; }
      .add { padding: 10px 0 10px 0px; }
      .students .info { width: 25%; text-align: left; }
      .left { float: left; }
      .right { float: right; }
      td p span { width: 50%; }
      #list tr:first-child {display: table-row!important;}
    </style>
  </head>
  <body>
      <div class="table">
        <h2 class="header"><?php echo 'Students list'; ?></h2>
        <div id="filter">
          <ul>
            <li>
                <select name="" id="surname">
                    <option value="">Surname</option>
                  <?php foreach($surnames as $item) : ?>
                    <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
                  <?php endforeach; ?>
                </select>
            </li>
            <li>
                <select name="" id="group">
                    <option value="">Group</option>
                  <?php foreach($groups as $item) : ?>
                    <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
                  <?php endforeach; ?>
                </select>
            </li>
            <li>
                <select name="" id="part">
                    <option value="">Part</option>
                  <?php foreach($parts as $item) : ?>
                    <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
                  <?php endforeach; ?>
                </select>
            </li>
            <li>
                <select name="" id="average">
                    <option value="">Average</option>
                  <?php foreach($averages as $item) : ?>
                    <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
                  <?php endforeach; ?>
                </select>
            </li>
        </ul>

        </div>
        <table id="list" class="students">
          <tr>
            <th>Part</th>
            <th>Group</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Date of birth</th>
            <th>IP</th>
            <th>Registration time</th>
            <th>Subjects</th>
            <th>Rate</th>
            <th>Average</th>
            <th>Comment</th>
          </tr>
          <?php foreach($students as $item) : ?>
            <tr id="<?php echo $item->student_id; ?>" data-filter="<?php echo 's'.'-'.$item->student_surname . ' g-' . $item->group_title . ' p-' . $item->part . ' a-' . $item->average; ?>">
              <td><?php echo $item->part;?></td>
              <td>
                <form id="update" action="" method="post">
                  <select name="edit_group" class="update">
                  <?php foreach($groups as $key => $value) :?>
                    <option value="<?php echo $key?>" <?php echo ($key == $item->group_id) ? 'selected' : '' ;?>><?php echo $value?></option>
                  <?php endforeach; ?>
                  </select>
                  <div class="controls">
                      <input type="submit" name="submit" value="Save edit group">
                      <input type="hidden" name="task" value="update">
                      <input type="hidden" id="student_id" name="student_id" value="">
                    </div>
                </form>
              </td>
              <td><?php echo $item->student_name;?></td>
              <td><?php echo $item->student_surname;?></td>
              <td><?php echo $item->student_email;?></td>
              <td><?php echo $item->student_birth;?></td>
              <td><?php echo $item->student_ip;?></td>
              <td><?php echo $item->student_time;?></td>
              <td>
                <?php foreach($rates as $k=>$v) : ?>
                        <?php if(($v->student_id === $item->student_id) && ($v->part === $item->part)) echo $v->subject_name . '<br>';?>
                  <?php endforeach; ?> 
              </td>
              <td>
                <?php foreach($rates as $k=>$v) : ?>
                        <?php if(($v->student_id === $item->student_id) && ($v->part === $item->part)) echo $v->rate . '<br>'; ?>
                  <?php endforeach; ?>    
              </td>
              <td><?php echo $item->average;?></td>
              <td><?php echo $item->student_comment;?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
      
    <div class="form">
      <div class="header"><p>Add new student</p></div>
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
            <input type="hidden" name="task" value="add">
          </div>
        </div>

      </form>
      <div id="result_id"></div>
    </div>
    <div class="top">
      <h3 class="header"><?php echo '10 top rated students'; ?></h3>
      <table id="top-list" class="students">
        <tr>
          <th>Name</th>
          <th>Surname</th>
          <th>Average</th>
          <th>Group</th>
          <th>Email</th>
        </tr>
        <?php foreach($top as $value) :?>
        <tr>
          <td><?php echo $value->student_name;?></td>
          <td><?php echo $value->student_surname;?></td>
          <td><?php echo $value->average;?></td>
          <td><?php echo $value->group_title;?></td>
          <td><?php echo $value->student_email;?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        
        $("form").submit(function(){
          var form = $(this);  
          var data = form.serialize();
            $.ajax({ 
               type: 'POST',
               url: 'helper.php',
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


        //update group
          $(".update").on('change', function(){
            var id = $(this).closest('tr').attr('id');
            $('#update #student_id').val(id); 
          });


        //filter
          $('#filter select').change(function(){
              $('#list tr').show();
              $('#filter select').each(function(){
                  var val = this.value
                  if (val!='') {
                      val = this.id.valueOf()[0]+'-'+val;
                      $('#list tr:not([data-filter*="'+val+'"])').hide();
                  };
              });
          });

  });
    </script>
  </body>
</html>