
        <?php include "connection.php"; ?>
        <?php session_start();
        if ( 1 != true ){
        header("Location: index.php");
        } ?>
        <?php include "menu.php" ?>
        <?php include "control.php" ?>
        <div class="container">
        <form action="moveTest3.php" method="post">
        <input type="hidden" name="ID"  value="3" id="ID">
        <h2>Create Test For Lesson: Hello</h2>
    <div class="form-group">
      <label for="qust">Question:</label>
      <input type="text" name="qust" class="form-control" id="qust" >
    </div>
    <div class="form-group">
      <label for="A">A.</label>
      <input type="text" name="A" class="form-control" id="A" ><br>
      <label for="B">B.</label>
      <input type="text" name="B" class="form-control" id="B"><br>
      <label for="C">C.</label>
      <input type="text" name="C" class="form-control" id="C"><br>
      <label for="D">D.</label>
      <input type="text" name="D" class="form-control" id="D"><br>
      <label for="ra">Right Option:</label>
      <input type="text" name="ra" class="form-control" id="ra" pattern="[A-Da-d]{1}" title="type option A/B/C/D"><br>
      <button type="submit" class="btn btn-default" name="btnTest">Create</button>
    </div>
  </form>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Look Through The Test</button>
  <br><br><br><br>
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog" >
    <div class="modal-dialog" style="width:1000px">
      <!-- Modal content-->
      <div class="modal-content" style="width:1000px">
        <?php include "Test3.php" ?>
        <div class="modal-body">
          <p>The Test will be published when publish button is pressed.</p>
        </div>
        <div class="modal-footer">

        <form action="buttons.php?id=3" method="post">
        <a href="EditTest3.php"><button type="button"  class="btn btn-info btn-primary btn-lg">Edit The Test</button></a>
        <?php
        $stmt = $db->prepare("SELECT testPublished FROM lesson where ID = 3");
        $stmt -> execute();
        $x = $stmt -> fetch();
        if ( $x['testPublished'] != 1 )
                echo '<button type="submit" class="btn btn-info btn-primary btn-lg" name="btnPublish">Publish</button>';
        else
                echo '<button type="submit" class="btn btn-info btn-primary btn-lg" name="btnUnpublish">Unpublish</button>';
        ?>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
<?php include "footer.php"?>
        