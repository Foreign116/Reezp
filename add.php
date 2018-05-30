<?php


include 'templates/configs/db.inc.php';

if(!isset($_SESSION['login'])){
  header('Location: login.php'); 
}
elseif ($_GET['fileType']!='pdf' && $_GET['fileType']!='movie'&&$_GET['fileType']!='music'&&$_GET['fileType']!='photo' && !isset($_GET['fileType'])) {
 header('Location: Directory.php'); 
}
else{
  if(isset($_POST['DeleteFile'])){
    switch ($_GET['fileType']) {
      case 'photo':
      $group = $_POST['deleteGroup'];
      $email = $_SESSION['email'];
      $query = "SELECT id FROM users WHERE email='$email';";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];
      $serverRoot = $_SERVER['DOCUMENT_ROOT'];
      foreach ($group as $file) {
        $file = "/images/".$email.$file;
        $query = "SELECT picToUser FROM photos WHERE fileName ='$file';";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        if($row['picToUser']===$id){
          unlink($serverRoot.$file);
         $query = "DELETE FROM photos WHERE fileName = '$file';";
          mysqli_query($conn,$query);
          
        }
      }
      break;
      
      case 'pdf':
      $group = $_POST['deleteGroup'];
      $email = $_SESSION['email'];
      $query = "SELECT id FROM users WHERE email='$email';";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];
      $serverRoot = $_SERVER['DOCUMENT_ROOT'];
      foreach ($group as $file) {
        $file = "/pdfs/".$email.$file;
        $query = "SELECT IDtoPDF FROM pdfs WHERE fileName ='$file';";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        if($row['IDtoPDF']===$id){
          unlink($serverRoot.$file);
         $query = "DELETE FROM pdfs WHERE fileName = '$file';";
          mysqli_query($conn,$query);
          
        }
      }
      break;
      case 'movie':
      $group = $_POST['deleteGroup'];
      $email = $_SESSION['email'];
      $query = "SELECT id FROM users WHERE email='$email';";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];
      $serverRoot = $_SERVER['DOCUMENT_ROOT'];
      foreach ($group as $file) {
        $file = "/movies/".$email.$file;
        $query = "SELECT IDtoMovie FROM movies WHERE fileName ='$file';";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        if($row['IDtoMovie']===$id){
          unlink($serverRoot.$file);
         $query = "DELETE FROM movies WHERE fileName = '$file';";
          mysqli_query($conn,$query);
          
        }
      }
      case 'music':
      $group = $_POST['deleteGroup'];
      $email = $_SESSION['email'];
      $query = "SELECT id FROM users WHERE email='$email';";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];
      $serverRoot = $_SERVER['DOCUMENT_ROOT'];
      foreach ($group as $file) {
        $file = "/music/".$email.$file;
        $query = "SELECT IDtoMusic FROM music WHERE fileName ='$file';";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        if($row['IDtoMusic']===$id){
          unlink($serverRoot.$file);
         $query = "DELETE FROM music WHERE fileName = '$file';";
          mysqli_query($conn,$query);
          
        }
      }
      break;

    }

  }
  elseif ( isset($_POST['importFile'])) {
    switch ($_GET['fileType']) {

      case 'pdf':
      $allowed =  array('pdf');
      $filename = $_FILES['filePath']['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if(!in_array($ext,$allowed) ) {
        echo "<p class='red-text'>File type not allowed<p>";


      }
      else if ($_FILES['filePath']['size'] > 524288000) {
        echo "<p class='red-text'>File size too large<p>";
      }
      else{
        $email = $_SESSION['email'];
        $picName = $_FILES["filePath"]["name"];
        $picName = str_replace(' ', '', $picName);
        $picName = str_replace('#', '', $picName);
        $picName = str_replace('$', '', $picName);
        $picName = str_replace('%', '', $picName);
        $picName = str_replace('!', '', $picName);
        $picName = str_replace('@', '', $picName);
        $picName = str_replace('^', '', $picName);
        $picName = str_replace('&', '', $picName);
        $picName = str_replace('*', '', $picName);
        $picName = str_replace('(', '', $picName);
        $picName = str_replace(')', '', $picName);
        $image_to_upload = "/pdfs/".$email.$picName;
        $folder=$_SERVER['DOCUMENT_ROOT']."/pdfs/";
        $query = "SELECT id FROM users WHERE email='$email';";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        move_uploaded_file($_FILES["filePath"]["tmp_name"], "$folder".$email.$picName);
        $query="INSERT INTO pdfs(IDtoPDF,fileName,displayName) VALUES('$id','$image_to_upload','$picName');";
        mysqli_query($conn,$query);
        header('Location: add.php?fileType=pdf');  
      }
      break;

      case 'movie':
      $allowed =  array('mp4');
      $filename = $_FILES['filePath']['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if(!in_array($ext,$allowed) ) {
        echo "<p class='red-text'>File type not allowed<p>";  
      }
      else if ($_FILES['filePath']['size'] > 524288000) {
        echo "<p class='red-text'>File size too large<p>";
      }
      else{
        $email = $_SESSION['email'];
        $picName = $_FILES["filePath"]["name"];
        $picName = str_replace(' ', '', $picName);
        $picName = str_replace('#', '', $picName);
        $picName = str_replace('$', '', $picName);
        $picName = str_replace('%', '', $picName);
        $picName = str_replace('!', '', $picName);
        $picName = str_replace('@', '', $picName);
        $picName = str_replace('^', '', $picName);
        $picName = str_replace('&', '', $picName);
        $picName = str_replace('*', '', $picName);
        $picName = str_replace('(', '', $picName);
        $picName = str_replace(')', '', $picName);
        $image_to_upload = "/movies/".$email.$picName;
        $folder=$_SERVER['DOCUMENT_ROOT']."/movies/";
        $query = "SELECT id FROM users WHERE email='$email';";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        move_uploaded_file($_FILES["filePath"]["tmp_name"], "$folder".$email.$picName);
        $query="INSERT INTO movies(IDtoMovie,fileName,displayName) VALUES('$id','$image_to_upload','$picName');";
        mysqli_query($conn,$query);
        header('Location: add.php?fileType=movie');  
      }
      break;


      case 'music':
      $allowed =  array('mp3');
      $filename = $_FILES['filePath']['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if(!in_array($ext,$allowed) ) {
        echo "<p class='red-text'>File type not allowed<p>";  
      }
      else if ($_FILES['filePath']['size'] > 524288000) {
        echo "<p class='red-text'>File size too large<p>";            }
        else{
         $email = $_SESSION['email'];
         $picName = $_FILES["filePath"]["name"];
         $picName = str_replace(' ', '', $picName);
         $picName = str_replace('#', '', $picName);
         $picName = str_replace('$', '', $picName);
         $picName = str_replace('%', '', $picName);
         $picName = str_replace('!', '', $picName);
         $picName = str_replace('@', '', $picName);
         $picName = str_replace('^', '', $picName);
         $picName = str_replace('&', '', $picName);
         $picName = str_replace('*', '', $picName);
         $picName = str_replace('(', '', $picName);
         $picName = str_replace(')', '', $picName);
         $image_to_upload = "/music/".$email.$picName;
         $folder=$_SERVER['DOCUMENT_ROOT']."/music/";
         $query = "SELECT id FROM users WHERE email='$email';";
         $result = mysqli_query($conn,$query);
         $row = mysqli_fetch_assoc($result);
         $id = $row['id'];
         move_uploaded_file($_FILES["filePath"]["tmp_name"], "$folder".$email.$picName);
         $query="INSERT INTO music(IDtoMusic,fileName,displayName) VALUES('$id','$image_to_upload','$picName');";
         mysqli_query($conn,$query);
         header('Location: add.php?fileType=music');   
       }
       break;
       case 'photo':
       $allowed =  array('gif','png' ,'jpg','jpeg');
       $filename = $_FILES['filePath']['name'];
       $ext = pathinfo($filename, PATHINFO_EXTENSION);
       if(!in_array($ext,$allowed) ) {
        echo "<p class='red-text'>File type not allowed<p>";            
      }
      else if ($_FILES['filePath']['size'] > 524288000) {
        echo "<p class='red-text'>File size too large<p>";
      }
      else{
       $email = $_SESSION['email'];
       $picName = $_FILES["filePath"]["name"];
       $picName = str_replace(' ', '', $picName);
       $picName = str_replace('#', '', $picName);
       $picName = str_replace('$', '', $picName);
       $picName = str_replace('%', '', $picName);
       $picName = str_replace('!', '', $picName);
       $picName = str_replace('@', '', $picName);
       $picName = str_replace('^', '', $picName);
       $picName = str_replace('&', '', $picName);
       $picName = str_replace('*', '', $picName);
       $picName = str_replace('(', '', $picName);
       $picName = str_replace(')', '', $picName);
       $image_to_upload = "/images/".$email.$picName;
       $folder=$_SERVER['DOCUMENT_ROOT']."/images/";
       $query = "SELECT id FROM users WHERE email='$email';";
       $result = mysqli_query($conn,$query);
       $row = mysqli_fetch_assoc($result);
       $id = $row['id'];
       move_uploaded_file($_FILES["filePath"]["tmp_name"], "$folder".$email.$picName);
       $query="INSERT INTO photos(fileName,picToUser,nameGiven) VALUES('$image_to_upload','$id','$picName');";
       mysqli_query($conn,$query);
       header('Location: add.php?fileType=photo');   
     }
     break;
   }
 }

}
include 'templates/pages/createAccountHeader.php';
include 'templates/pages/logout.php';
?>




<?php

if($_GET['fileType']==='photo'){
  echo "<div class='row'>
  <div class='col s4'><a class='btn blue white-text flow-text left' style='position:relative; top:10px;' href='Directory.php'>Back</a></div>
  <div class='col s4'><h1 class='flow-text center'>Photo</h1></div>
  <div class='col s4'><a target='_blank' style='position:relative; top:10px;' class='btn blue white-text flow-text right' href='Specifications.php'>Specifications</a></div>
  </div>

  <div class='row'>
  <div class='col s6'><a class='left waves-effect waves-light btn modal-trigger blue white-text flow-text' href='#photo' >Add File</a></div>
  <div class='col s6'><a class=' waves-effect modal-trigger waves-light red lighten-1 btn black-text flow-text right z-depth-1' href='#deleteModal' >Select</a></div>
  </div>";
}
else if($_GET['fileType']==='pdf'){
  echo "<div class='row'>
  <div class='col s4'><a class='btn blue white-text flow-text left' style='position:relative; top:10px;' href='Directory.php'>Back</a></div>
  <div class='col s4'><h1 class='flow-text center'>PDF</h1></div>
  <div class='col s4'><a target='_blank' style='position:relative; top:10px;' class='btn blue white-text flow-text right' href='Specifications.php'>Specifications</a></div>
  </div>

  <div class='row'>
  <div class='col s6'><a class='left waves-effect waves-light btn modal-trigger blue white-text flow-text' href='#pdf' >Add File</a></div>
  <div class='col s6'><a class=' waves-effect modal-trigger waves-light red lighten-1 btn black-text flow-text right z-depth-1' href='#deleteModal' >Select</a></div>
  </div>";
}
else if($_GET['fileType']==='movie'){
 echo "<div class='row'>
 <div class='col s4'><a class='btn blue white-text flow-text left' style='position:relative; top:10px;' href='Directory.php'>Back</a></div>
 <div class='col s4'><h1 class='flow-text center'>Video</h1></div>
 <div class='col s4'><a target='_blank' style='position:relative; top:10px;' class='btn blue white-text flow-text right' href='Specifications.php'>Specifications</a></div>
 </div>

 <div class='row'>
 <div class='col s6'><a class='left waves-effect waves-light btn modal-trigger blue white-text flow-text' href='#movie' >Add File</a></div>
 <div class='col s6'><a class=' waves-effect modal-trigger waves-light red lighten-1 btn black-text flow-text right z-depth-1' href='#deleteModal' >Select</a></div>
 </div>";
}
else if($_GET['fileType']==='music'){
  echo "<div class='row'>
  <div class='col s4'><a class='btn blue white-text flow-text left' style='position:relative; top:10px;' href='Directory.php'>Back</a></div>
  <div class='col s4'><h1 class='flow-text center'>Audio</h1></div>
  <div class='col s4'><a target='_blank' style='position:relative; top:10px;' class='btn blue white-text flow-text right' href='Specifications.php'>Specifications</a></div>
  </div>

  <div class='row'>
  <div class='col s6'><a class='left waves-effect waves-light btn modal-trigger blue white-text flow-text' href='#music' >Add File</a></div>
  <div class='col s6'><a class=' waves-effect modal-trigger waves-light red lighten-1 btn black-text flow-text right z-depth-1' href='#deleteModal' >Select</a></div>
  </div>";
}

?>



<div class="container center">
	<div class="collection" style="border: none;" id="listData" style="top: 10px">
    <?php
    if($_GET['fileType']==='photo'){


      $email = $_SESSION['email'];
      $query = "SELECT id FROM users WHERE email='$email';";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];

      $query = "SELECT fileName,nameGiven FROM photos WHERE picToUser='$id';";
      $results = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_assoc($results)) {
        echo "<a href= http://reezp.com".$row['fileName']." target='_blank' style='top:3px; position:relative' class='collection-item blue lighten-3 black-text flow-text'>".$row['nameGiven']."</a>";
      }
    }
    else if($_GET['fileType']==='pdf'){
      $email = $_SESSION['email'];
      $query = "SELECT id FROM users WHERE email='$email';";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];

      $query = "SELECT fileName,displayName FROM pdfs WHERE IDtoPDF='$id';";
      $results = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_assoc($results)) {
        echo "<a href= http://reezp.com".$row['fileName']." target='_blank' style='top:3px; position:relative' class='collection-item blue lighten-3 black-text flow-text'>".$row['displayName']."</a>";
      }
    }
    else if($_GET['fileType']==='music'){
      $email = $_SESSION['email'];
      $query = "SELECT id FROM users WHERE email='$email';";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];

      $query = "SELECT fileName,displayName FROM music WHERE IDtoMusic='$id';";
      $results = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_assoc($results)) {
        echo "<a href= http://reezp.com".$row['fileName']." target='_blank' style='top:3px; position:relative' class='collection-item blue lighten-3 black-text flow-text'>".$row['displayName']."</a>";
      }
    }
    else if($_GET['fileType']==='movie'){
      $email = $_SESSION['email'];
      $query = "SELECT id FROM users WHERE email='$email';";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];

      $query = "SELECT fileName,displayName FROM movies WHERE IDtoMovie='$id';";
      $results = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_assoc($results)) {
        echo "<a href= http://reezp.com".$row['fileName']." target='_blank' style='top:3px; position:relative' class='collection-item blue lighten-3 black-text flow-text'>".$row['displayName']."</a>";
      }
    }
    ?>


  </div>          
</div>
<div id=<?php echo '"'.$_GET['fileType'].'"'; ?> class="modal">
  <div class="modal-content">
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="file-field input-field">
        <div class="btn blue white-text flow-text" id="fileButton">
          <span>File</span>
          <input type="file" name="filePath">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text" placeholder="Upload file" id="fileName">
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class=" blue white-text btn flow-text" id="importButton" name="importFile">Import</button>
      </div>
    </form>
  </div>
</div>

<div id='deleteModal' class="modal">
  <div class="modal-content">
    <form method="POST" action="">
     <?php
     if($_GET['fileType']==='photo'){

      $idforLabel = 0;
      $email = $_SESSION['email'];
      $query = "SELECT id FROM users WHERE email='$email';";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];

      $query = "SELECT fileName,nameGiven FROM photos WHERE picToUser='$id';";
      $results = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_assoc($results)) {
        echo "<input id=".$idforLabel." class='filled-in' name='deleteGroup[]' type='checkbox' value =".$row['nameGiven']."><label for=".$idforLabel.">".$row['nameGiven']."</label>";
        $idforLabel = $idforLabel + 1;
        echo "<br>";
      }
    }
    else if($_GET['fileType']==='pdf'){
      $idforLabel = 0;
      $email = $_SESSION['email'];
      $query = "SELECT id FROM users WHERE email='$email';";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];

      $query = "SELECT fileName,displayName FROM pdfs WHERE IDtoPDF='$id';";
      $results = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_assoc($results)) {
        echo "<input id=".$idforLabel." class='filled-in' name='deleteGroup[]' value =".$row['displayName']." type='checkbox'><label for=".$idforLabel.">".$row['displayName']."</label>";
        $idforLabel = $idforLabel + 1;
        echo "<br>";
      }
    }
    else if($_GET['fileType']==='music'){
     $idforLabel = 0;
     $email = $_SESSION['email'];
     $query = "SELECT id FROM users WHERE email='$email';";
     $result = mysqli_query($conn,$query);
     $row = mysqli_fetch_assoc($result);
     $id = $row['id'];

     $query = "SELECT fileName,displayName FROM music WHERE IDtoMusic='$id';";
     $results = mysqli_query($conn,$query);
     while ($row = mysqli_fetch_assoc($results)) {
      echo "<input id=".$idforLabel." class='filled-in' name='deleteGroup[]' value =".$row['displayName']." type='checkbox'><label for=".$idforLabel." value =".$row['displayName'].">".$row['displayName']."</label>";
      $idforLabel = $idforLabel + 1;
      echo "<br>";
    }
  }
  else if($_GET['fileType']==='movie'){
   $idforLabel = 0;
   $email = $_SESSION['email'];
   $query = "SELECT id FROM users WHERE email='$email';";
   $result = mysqli_query($conn,$query);
   $row = mysqli_fetch_assoc($result);
   $id = $row['id'];

   $query = "SELECT fileName,displayName FROM movies WHERE IDtoMovie='$id';";
   $results = mysqli_query($conn,$query);
   while ($row = mysqli_fetch_assoc($results)) {
    echo "<input id=".$idforLabel." class='filled-in' name='deleteGroup[]' value =".$row['displayName']." type='checkbox'><label for=".$idforLabel." value =".$row['displayName'].">".$row['displayName']."</label>";
    $idforLabel = $idforLabel + 1;
    echo "<br>";
  }
}

?>
<div class="modal-footer">
 <button type="submit" class=" blue white-text btn flow-text" id="DeleteModalButton" name="DeleteFile">Delete</button>
</div>
</form>
</div>
</div>


<?php
include 'templates/pages/footer.php';
?>

