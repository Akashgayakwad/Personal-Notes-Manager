<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
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
    tr{
        cursor: pointer;
    }
    td{
        color: #3CCA65;
        font-size: 25px;
        font-style: oblique;
    }
    #tableheading{
        color: yellow;
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
                    <li class="active"><a href="#">Profile</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact us</a></li>
                      <li><a href="mainpageloggedin.php">My Notes</a></li>
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
                <h2 id="tableheading">General Account Settings:</h2>
                <div class="table-responsive">
                    <table id="settingstable" class="table table-bordered table-hover table-condensed">
                        <tr data-target="#updateusername" data-toggle="modal">
                            <td>Username</td>
                            <td>value</td>
                        </tr>
                        <tr data-target="#updateemail" data-toggle="modal">
                            <td>Email</td>
                            <td>value</td>
                        </tr>
                        <tr data-target="#updateuserpassword" data-toggle="modal">
                            <td>Password</td>
                            <td>hidden</td>
                        </tr>
                    </table>
                </div>     
            </div>
        </div>
    </div>
    
    <div class="footer">
        <div class="container">
        <p>akashgayakwad123@gmail.com Copyright &copy; 2017-<?php $today = date("Y"); echo $today; ?>.</p>
        </div>
    </div>
    
    <form method="post" id="updateusernameform">
         <div class="modal" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 id="myModalLabel">
                Edit Username: 
              </h4>
          </div>
          <div class="modal-body">
              <div id="signupmessage">
              
              </div>
            <div class="form-group">
                <label for="#username">Username:</label>
                <input id="username" class="form-control" type="text" name="username" placeholder="value" maxlength="30">
            </div>
          </div>
          <div class="modal-footer">
              <input class="btn green" name="updateusername" type="submit" value="Update">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
          </div>
      </div>
  </div>
  </div>
    
    </form>
    
    
    
    <form method="post" id="updateemailform">
         <div class="modal" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 id="myModalLabel">
                Edit Email: 
              </h4>
          </div>
          <div class="modal-body">
              <div id="signupmessage">
              
              </div>
            <div class="form-group">
                <label for="#email">Email:</label>
                <input id="email" class="form-control" type="text" name="email" placeholder="value" maxlength="50">
            </div>
          </div>
          <div class="modal-footer">
              <input class="btn green" name="updateemial" type="submit" value="Update">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
          </div>
      </div>
  </div>
  </div>
    
    </form>
    
    
    
    <form method="post" id="updateuserpasswordform">
         <div class="modal" id="updateuserpassword" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 id="myModalLabel">
                Edit Password: 
              </h4>
          </div>
          <div class="modal-body">
              <div id="signupmessage">
              
              </div>
            <div class="form-group">
                <label class="sr-only" for="#currentpassword">Your Current Password:</label>
                <input id="currentpassword" class="form-control" type="password" name="currentpassword" placeholder="Your Current Password" maxlength="30">
                <label for="#password">Choose a Password:</label>
                <input id="password" class="form-control" type="password" name="password" placeholder="Choose a Password" maxlength="30">
                <label for="#password2">Password:</label>
                <input id="password2" class="form-control" type="password" name="password" placeholder="Confirm Password" maxlength="30">
            </div>
          </div>
          <div class="modal-footer">
              <input class="btn green" name="updatepassword" type="submit" value="Update">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
          </div>
      </div>
  </div>
  </div>
    
    </form>
    
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>