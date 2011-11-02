<form method="post" action="<?=base_url()?>user/login/validate_credentials" >

  <div data-role="fieldcontain">                   
    <label for="basic">Username:</label>
    <input type="text" name="username" id="basic" value=""  />
    
     <label for="basic">Password:</label>
    <input type="password" name="password" id="basic" value=""  />
  </div>
    
                    

<input type="submit" name="submit" value="login"/>
	

          </form>