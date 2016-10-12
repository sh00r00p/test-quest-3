<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Edit student</title>
    <link href="/style.css" rel="stylesheet" media="all" />
  </head>
  <body>
      <div class="table">
        <h2 class="header">Edit student</h2>
        <div class="nav">
          <nav>
            <a href="/default/add">Add</a>
            <a href="/default/top">Top</a>
            <a href="/">List</a>
          </nav>
        </div>
        <table id="list" class="students">
          <tr>
            <th>Group</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Date of birth</th>
            <th>IP</th>
            <th>Registration time</th>
          </tr>
            <tr>
              <td>
                <form id="update" action="/default/update" method="post">
                  <select name="edit_group" class="update">
                  <?php foreach($data as $value) :?>
                    <option value="<?php echo $value->id?>" <?php echo ($value->id == $content->student_group_id) ? 'selected' : '' ;?>><?php echo $value->title; ?></option>
                  <?php endforeach; ?>
                  </select>
                  <div class="controls">
                      <input type="submit" name="submit" value="Save edit group">
                      <input type="hidden" name="task" value="update">
                      <input type="hidden" id="student_id" name="student_id" value="">
                    </div>
                </form>
              </td>
              <td><?php echo $content->student_name;?></td>
              <td><?php echo $content->student_surname;?></td>
              <td><?php echo $content->student_email;?></td>
              <td><?php echo $content->student_birth;?></td>
              <td><?php echo $content->student_ip;?></td>
              <td><?php echo $content->student_time;?></td>
            </tr>
        </table>
      </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

        //update group
          $(".update").on('change', function(){
            var id = $(this).closest('tr').attr('id');
            $('#update #student_id').val(id); 
          });
        });
    </script>
  </body>
</html>