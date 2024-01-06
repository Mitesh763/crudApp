<?php

$insert = false;
$update = false;
$delete = false;

//connecting to the Database
$servername="localhost";
$username="root";
$password="";   
$database="notes";

// create Connection object
$conn = mysqli_connect($servername,$username,$password,$database);

// die if connection was not successfull
if(!$conn){
    die("Error! Failed to Connect Database!! : "  .mysqli_connect_error());
}else{
    // echo "</br>Connection was successfull</br>";
}


if(isset($_GET['delete'])){
  $srno= $_GET['delete'];
  $sql= "DELETE FROM `notes` WHERE `notes`.`srno` = $srno";
  $result = mysqli_query($conn,$sql);
  if ($result) {
    $delete = true;
   } else {
    echo "Error occured!";
   }
}

if ($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['srnoEdit'])){
     //update record
     $srno = $_POST['srnoEdit'];
     $title = $_POST['titleEdit'];
      $description = $_POST['descriptionEdit'];

     // inserting data in table
     $sql= "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`srno` = $srno";
     $result = mysqli_query($conn,$sql);
     if ($result) {
      $update = true;
     } else {
      echo "Error occured!";
     }
     
  }else{
        $title = $_POST['title'];
        $description = $_POST['description'];

      // inserting data in table
      $sql= "INSERT INTO `notes` (`srno`, `title`, `description`, `tstemp`) VALUES (NULL, '$title', '$description', '')";
      $result = mysqli_query($conn,$sql);

      // check data inserted or not
      if($result){
          $insert = true;
          // echo "Record inserted successfully!!</br>";
      }else{
          echo "Record has been not insert because -->" .mysqli_error($conn);
      }
  }
}
?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    
    

  <title>CRUD API</title>
</head>

<body>

  <!--edit modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editmodal">
  Edit Modal
</button> -->

<!-- edit Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/PHP_CWH/crudApp/index.php" method="post">
        <input type="hidden" name="srnoEdit" id="srnoEdit">
      <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp"
          placeholder="Enter Title">
        <small id="emailHelp" class="form-text text-muted"></small>
      </div>
      <div class="form-group">
        <label for="description">Note Description</label>
        <textarea class="form-control" placeholder="descriptionEdit" name="descriptionEdit" id="descriptionEdit" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Update Note</button>
    </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/crudApp/php logo.png"><img src="/PHP_CWH/crudApp/logo php1.jpg" height="60px" width="60px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">contect-Us</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submi  t">Search</button>
      </form>
    </div>
  </nav>


  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success! </strong> Your NOTE has been inserted succesfully!.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  ?>

<?php
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success! </strong> Your NOTE has been updated succesfully!.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  ?>

<?php
  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success! </strong> Your NOTE has been deleted succesfully!.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  ?>


  <div class="container my-3">
    <form action="/PHP_CWH/crudApp/index.php" method="post">
      <h2>Add a Note!</h2>
      <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
          placeholder="Enter Title">
        <small id="emailHelp" class="form-text text-muted"></small>
      </div>
      <div class="form-group">
        <label for="description">Note Description</label>
        <textarea class="form-control" placeholder="description" name="description" id="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>

  <div class="container" my-4>
    <table  id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th scope="col">Sr no</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php

        //INSERT INTO `notes` (`srno`, `title`, `description`, `tstemp`) VALUES ('1', 'cwh', 'this is php backend tutorial.', '');
          $sql = "SELECT * FROM `notes`";
          $result = mysqli_query($conn,$sql);

          $num = mysqli_num_rows($result);

          $srno =1 ;
          while ($row= mysqli_fetch_assoc($result)) {
   
            // echo var_dump($row);
            echo "<tr>
            <th scope='row'> " . $srno. "</th>
            <td>" .$row['title'] . "</td>
            <td>" . $row['description']. "</td>
            <td> <button data-toggle='modal' data-target='#editmodal' class='edit btn btn-sm btn-primary' id= ".$row['srno'] .">Edit</button> <button class='delete btn btn-sm btn-primary' id= d".$row['srno'] .">Delete</button> </td>
          </tr>";
          $srno = $srno + 1;
            } 
        ?>
      </tbody>
    </table>
  </div>
<hr>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#example').DataTable();
      });
    </script>

    <script>
      // edit operation
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("edit ",);
          tr= e.target.parentNode.parentNode;
          title = tr.getElementsByTagName("td")[0].innerText;
          description = tr.getElementsByTagName("td")[1].innerText;
          console.log(title,description);

          titleEdit.value = title;
          descriptionEdit.value = description;
          srnoEdit.value = e.target.id;
          console.log(e.target.id);

          // set toggle
          // $('#editmodal').modal('toggle');
        });
      }); 

      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("delete ",);
          srno = e.target.id.substr(1,);

          if(confirm("Are you sure! Delete it?")){
            console.log("yes");
            window.location = `/PHP_CWH/crudApp/index.php?delete= ${srno}`;
            // create a form and use post request to submit a form 
          }
          else{
            console.log("no");

            // if we refresh this page we show deleted successfull msg  
          }
        });
      });
    </script>
</body>
</html>