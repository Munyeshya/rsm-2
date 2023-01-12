<?php
include '../connection.php';

if (isset($_POST['change'])) {
  $box=$_POST['check'];
  $let=$_POST['let'];
  // $query=mysqli_query($conn,"SELECT * from try where i='$box' ");
  // while ($fetch=mysqli_fetch_array($query)) {
  //   $allover=mysqli_query($conn,"UPDATE try set a='$let' where i='$box' ");
  //   if ($allover) {
  //     echo "done".$conn->error;
  //   }else{
  //     echo "wrong".$conn->error;
  //   }
  // }
}

  ?>
  <table border="1">
      <tr>
          <p>

              <tr>
                  <th>Size</th>
                  <th>Letter</th>
                  <th>Check</th>
                  <form method="post">
                  <th><input type="text" name="let"></th>
                  <th><input type="submit" name="change"></th>
              </tr>
              <?php
               $bring=mysqli_query($conn,"SELECT * from try ");
               while ($fetch=mysqli_fetch_array($bring)) {
                    ?>
                    <tr>
                    <td> <?php echo $fetch['i'] ?></td>
                    <td> <?php echo $fetch['a'] ?></td>
                    <td>
                      
                        <input type="checkbox" name="check" value="<?php echo $fetch['i'] ?>" >
                        </form>
                    </td>


                    <?php
                } 

              ?>
          </p>
          </th>
      </tr>
  </table>

  