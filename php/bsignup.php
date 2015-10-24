<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bsignup.css">
	<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="bsignup.js"></script>
</head>
<body>

	<div class="form">
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form action="/" method="post">
          
	          <div class="top-row">
	            <div class="field-wrap">
	              <label>
	                Your Name<span class="req">*</span>
	              </label>
	              <input type="text" required autocomplete="off" />
	            </div>
	        
	            <div class="field-wrap">
	              <label>
	                Your Phone No<span class="req">*</span>
	              </label>
	              <input type="text"required autocomplete="off"/>
	            </div>
	          </div>

	          <div class="field-wrap">
	            <label>
	              Your Email Id<span class="req">*</span>
	            </label>
	            <input type="email"required autocomplete="off"/>
	          </div>
	          
	          <div class="field-wrap">
	            <label>
	              Your Password<span class="req">*</span>
	            </label>
	            <input type="password"required autocomplete="off"/>
	          </div>
	          
	          <button type="submit" class="button button-block"/>Get Started</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="/" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button class="button button-block"/>Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->

</body>
</html>