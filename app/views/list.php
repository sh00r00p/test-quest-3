<?php

/*forming filters arrays*/
$surnames = array();
$parts = array();
$averages = array();
$groups = array();
$group_id = array();
$group_title = array();
foreach($content as $student){
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
    <link href="style.css" rel="stylesheet" media="all" />
  </head>
  <body>
      <div class="table">
        <h2 class="header"><?php echo 'Students list'; ?></h2>
        <div class="nav">
        	<nav>
        		<button><a href="/default/add">Add</a></button>
        		<button><a href="/default/top">Top</a></button>
        	</nav>
        </div>
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
          <?php foreach($content as $item) : ?>
            <tr id="<?php echo $item->student_id; ?>" data-filter="<?php echo 's'.'-'.$item->student_surname . ' g-' . $item->group_title . ' p-' . $item->part . ' a-' . $item->average; ?>">
              <td><?php echo $item->part;?></td>
              <td>
                  <?php echo $item->group_title;?><br>
                  <button><?php echo'<a href="/default/edit/' . $item->student_id . '">Edit</a>'; ?></button>
              </td>
              <td><?php echo $item->student_name;?></td>
              <td><?php echo $item->student_surname;?></td>
              <td><?php echo $item->student_email;?></td>
              <td><?php echo $item->student_birth;?></td>
              <td><?php echo $item->student_ip;?></td>
              <td><?php echo $item->student_time;?></td>
              <td>
                <?php foreach($data as $k=>$v) : ?>
                        <?php if(($v->student_id === $item->student_id) && ($v->part === $item->part)) echo $v->subject_name . '<br>';?>
                  <?php endforeach; ?> 
              </td>
              <td>
                <?php foreach($data as $k=>$v) : ?>
                        <?php if(($v->student_id === $item->student_id) && ($v->part === $item->part)) echo $v->rate . '<br>'; ?>
                  <?php endforeach; ?>    
              </td>
              <td><?php echo $item->average;?></td>
              <td><?php echo $item->student_comment;?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

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