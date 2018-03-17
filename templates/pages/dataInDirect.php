<?php 
include '../configs/db.inc.php';
include 'createAccountHeader.php';
?>

<div class="container center">
	<a class="waves-effect waves-light btn modal-trigger blue white-text flow-text" href="#fileModal" style="top: 10px">Add File</a>
	<div class="collection" style="border: none;">
        <!--<a href="#!" class="collection-item blue lighten-3 black-text flow-text ">Alvin</a>
        <a href="#!" class="collection-item blue lighten-3 black-text flow-text ">Alvin</a>
        <a href="#!" class="collection-item blue lighten-3 black-text flow-text ">Alvin</a>
        <a href="#!" class="collection-item blue lighten-3 black-text flow-text ">Alvin</a>-->
      </div>          
</div>
<div id="fileModal" class="modal">
        <div class="modal-content">
            <form action="" method="post">
                <div class="file-field input-field">
                    <div class="btn blue white-text flow-text" id="musicButton">
                        <span>File</span>
                        <input type="file" name="filePathMusic">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload file" id="fileName">
                    </div>
                </div>
                <input type="text" placeholder="Text displayed as link" id="displayLink">
                <div class="modal-footer">
                    <button type="submit" class=" blue white-text btn flow-text" id="ImportButton">Import</button>
                </div>
            </form>
        </div>
    </div>
<?php
include 'footer.php';
?>

