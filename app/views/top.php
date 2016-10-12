<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Students table</title>
    <link href="/style.css" rel="stylesheet" media="all" />
  </head>
  <body>
    <div class="top">
      <h3 class="header"><?php echo '10 top rated students'; ?></h3>
      <div class="nav">
          <nav>
            <a href="/">List</a>
            <a href="/default/add">Add</a>
          </nav>
        </div>
      <table id="top-list" class="students">
        <tr>
          <th>Name</th>
          <th>Surname</th>
          <th>Average</th>
          <th>Group</th>
          <th>Email</th>
        </tr>
        <?php foreach($content as $value) :?>
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
  </body>
</html>