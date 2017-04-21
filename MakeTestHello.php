

        <?php include "menu.php" ?>
        <?php include "control.php"?>
        <div class="container">
        <form action="moveTest3.php" method="post">
        <input type="hidden" name="ID"  value="3" id="ID">
        <h2>Lesson: Hello</h2>
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
      <input type="text" name="ra" class="form-control" id="ra"><br>
      <button type="submit" class="btn btn-default" name="btnTest">Create</button>
    </div>
  </form>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Look Through The Test</button>
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog" >
    <div class="modal-dialog" style="width:1000px">
      <!-- Modal content-->
      <div class="modal-content" style="width:1000px">
        <?php include "Test3.php"?>
        <div class="modal-body">
          <p>The Test will be published when publish button is pressed.</p>
        </div>
        <div class="modal-footer">

          <a href="EditTest3.php"><button type="button"  class="btn btn-info btn-primary btn-lg">Edit The Test</button></a>
        </div>
      </div>
    </div>
  </div>
  </div>
<?php include "footer.php"?>
        