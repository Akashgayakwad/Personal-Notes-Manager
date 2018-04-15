<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Notes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">
<style>
    #container{
        margin-top: 120px;
    }    
    #allNotes, #notePad, #done{
        display: none;
    }
    .buttons{
        margin-bottom: 20px;
    }
    textarea{
        width: 100%;
        max-width: 100%;
        min-width: 100%;
        font-size: 20px;
        line-height: 1.5em;
        color: #2A8EFF;
        border-left-width: 20px;
        border-color: #A576FF;
        background: #FFFACD;
        padding: 10px;
    }
</style>

</head>
<body>
        
    <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
      
          <div class="container-fluid">
            
              <div class="navbar-header">
              
                  <a class="navbar-brand">Online Notes</a>
                  <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  
                  </button>
              </div>
              <div class="navbar-collapse collapse" id="navbarCollapse">
                  <ul class="nav navbar-nav">
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact us</a></li>
                      <li class="active"><a href="#">My Notes</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    
                      <li><a>Logged in as <b>username</b></a></li>
                      
                      <li><a>Logout</a></li>
                  </ul>
              
              </div>
          </div>
      
      </nav>
    
    <div class="container" id="container">
        <div clss="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="buttons">
                    <button type="button" id="addNote" class=" btn btn-info btn-lg">
                Add Note
                </button>
                  
                    <button type="button" id="edit" class=" btn btn-info btn-lg pull-right">
                Edit
                </button>
                    <button type="button" id="done" class=" btn green btn-lg pull-right">
                Done
                </button>
                    <button type="button" id="allNotes" class=" btn btn-info btn-lg">
                All Notes
                    </button>
                </div>
                <div id="notePad">
                    <textarea rows="10">
                    </textarea>
                </div>
                <div id="notes" class="notes">
                <!-- Ajax call to a php file-->
                </div>
                     
            </div>
        </div>
    </div>
    
    <div class="footer">
        <div class="container">
        <p>akashgayakwad123@gmail.com Copyright &copy; 2017-<?php $today = date("Y"); echo $today; ?>.</p>
        </div>
    </div>
    
    
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>