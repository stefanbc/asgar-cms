<?php
    $disallow_theme = true;

    require(dirname(__DIR__) . '/asg_start.php');

    $action = $con->escape_string(htmlspecialchars($_POST['action'],ENT_QUOTES));

    switch($action):
                
        case 'login-create':
                        
            // Get the posted values
            $username  = $con->escape_string(htmlspecialchars($_POST['username'],ENT_QUOTES));
            $password  = $con->escape_string(sha256($_POST['password'] . AUTH_SALT));
            
            if(empty($username) || $username == 'You forgot to enter the username!'){
                echo 'No 1';  
            } else {
                // Check the username and password
                $sql = asg_db_query("select * from " . TABLE_USERS . " where username = '" . $username . "'");
                
                if(empty($sql)) {
                    $register_query = asg_db_update("insert into " . TABLE_USERS . " (username, password, create_date) values('" . $username . "', '" . $password . "', NOW())");
                    if($register_query == false){
                        
                        $header = 'MIME-Version: 1.0' . "\r\n"
                                	 .'Content-type: text/html; charset=iso-8859-1' . "\r\n"
                        			 .'From: Koding Community Invite <request@community.koding.com>' . "\r\n"
                        			 .'Reply-To: request@community.koding.com' . "\r\n";
                        	
                    	$my_email = ADMIN_MAIL;
                    	$mail_subject = 'New Registered User';
                    		
                    	$body = '
                    	<html>
                    		<head>
                    			<title>New Registered User</title>
                    		</head>
                    		<body>
                    		  <table style="height: 200px; background: #272727; color: #fff; width: 450px;margin: 0 auto;" cellspacing="0" cellpadding="0">
                                <tr>
                                    <th style="background: #fcb738; padding: 10px; color: #fff; font-size:16px;font-weight: normal;text-align: left;"><img src="http://koding.com/images/favicon.ico" alt="ico" style="vertical-align: text-bottom;padding-right: 10px;">New Registered User</th>
                                </tr>
                    		  	<tr>
                    		  		<td style="padding: 15px;text-align:center;">The following person registered a new account.</td>
                    		  	</tr>
                                <tr>
                        	  		<td style="padding: 15px;text-align:center;">Name: <b>' . $username .'</b></td>
                    		  	</tr>
                                <tr>
                        	  		<td style="padding: 20px;text-align:center;"><a style="color: #fff;text-decoration: none;background: #fcb738;padding: 10px;text-transform: uppercase;font-weight: bold;" href="' . HTTP . '">View Leaderboard</a></td>
                    		  	</tr>
                    		  </table>
                    		</body>
                    	</html>';
                    	
                        mail($my_email, $mail_subject, $body, $header);
                            
                        // Set the session from here
                        $_SESSION['username'] = $username;
                        
                        // Set the cookie from here
                        setcookie('_asg_auth', $username, time() + (86400 * 7)); // 86400 = 1 day
                        
                        asg_db_update("update " . TABLE_USERS . " set last_login = NOW() where username = '" . $username . "' ");
                        
                        echo "Yes";
                    } else {
                        echo "No 2";
                    }
                } else {
                    foreach($sql as $user) {                    
                        // Check the password
                        if(strcmp($user['password'],$password) == 0){
                            
                            // Set the session from here
                        	$_SESSION['username'] = $username;
                            
                            // Set the cookie from here
                            setcookie('_asg_auth', $username, time() + (86400 * 7)); // 86400 = 1 day
                            
                            asg_db_update("update " . TABLE_USERS . " set last_login = NOW() where username = '" . $username . "' ");
                            
                            echo "Yes";
                            
                        } else { 
                            echo "No 3"; 
                        }
                    }
                }
            }
        
        break;
        
        // If the user wants to logout
        case 'logout':
            
            asg_unset_session();
    
            asg_destroy_session();
            
            setcookie('_asg_auth', '', time() - 60000);
            
            echo 'Yes';
            
        break;
        
        // If the user forgot his password
        case 'forgot_pass':
            
            $email = $con->escape_string(htmlspecialchars($_POST['email'],ENT_QUOTES));
            
            if(empty($email)){
                
                echo 'No 1';
                
            } else {
                // Check the email
                $sql = asg_db_query("select * from " . TABLE_USERS . " where email = '" . $email . "'");
                
                if(!empty($sql)){
                    
                    $new_pass = random_gen(12,false);
                    $encrypted_pass = sha256($new_pass . AUTH_SALT);
                    
                    $reset_query = asg_db_update("update " . TABLE_USERS . " set password = '" . $encrypted_pass . "' where email = '" . $email . "' ");
                    
                    if($reset_query == false){
                        
                        $header = 'MIME-Version: 1.0' . "\r\n"
                                     .'Content-type: text/html; charset=iso-8859-1' . "\r\n"
                        			 .'From: Koding Community Invite <request@community.koding.com>' . "\r\n"
                        			 .'Reply-To: request@community.koding.com' . "\r\n";
                        	
                    	$the_email = $email;
                    	$mail_subject = 'Reset Password';
                    		
                    	$body = '
                    	<html>
                    		<head>
                    			<title>Reset Password</title>
                    		</head>
                    		<body>
                    		  <table style="height: 200px; background: #272727; color: #fff; width: 450px;margin: 0 auto;" cellspacing="0" cellpadding="0">
                                <tr>
                                    <th style="background: #fcb738; padding: 10px; color: #fff; font-size:16px;font-weight: normal;text-align: left;"><img src="http://koding.com/images/favicon.ico" alt="ico" style="vertical-align: text-bottom;padding-right: 10px;">Reset Password</th>
                                </tr>
                    		  	<tr>
                    		  		<td style="padding: 15px;text-align:center;">Your new password is:</td>
                    		  	</tr>
                                <tr>
                        	  		<td style="padding: 15px;text-align:center;">Password: <b>' . $new_pass .'</b></td>
                    		  	</tr>
                                <tr>
                        	  		<td style="padding: 20px;text-align:center;"><a style="color: #fff;text-decoration: none;background: #fcb738;padding: 10px;text-transform: uppercase;font-weight: bold;" href="' . HTTP . '">Login</a></td>
                    		  	</tr>
                    		  </table>
                    		</body>
                    	</html>';
                    	
                        mail($the_email, $mail_subject, $body, $header);
                        
                        echo 'Yes';
                    } else {
                        
                        echo 'No 2';
                        
                    }
                } else {
                    echo 'No 3';
                }
            }
            
        break;
        
        // If the user wants to logout
        case 'user-details':
                    
            echo '<div class="box_inner"><h2 id="info">Account details</h2>You can change your account details here!';
                echo '<form id="account_form" name="account_form">';
                    echo '<div class="spacer2">Email<input type="text" class="input" name="account-email" value="' . asg_user_info('email') . '" id="account-email" placeholder="Change your email"></div>';
                    echo '<div class="spacer2">Twitter<input type="text" class="input" name="account-twitter" value="' . asg_user_info('twitter_handler') . '" id="account-twitter" placeholder="Change your Twitter handler"></div>';
                    echo '<div class="spacer2">Password<input type="password" class="input" name="account-password" id="account-password" placeholder="Change your password"></div>';
                    
                    $notification = asg_user_info('notification');
                    $checked = ($notification == 1) ? "checked" : "";
                    
                    echo '<div class="spacer2"><input type="checkbox" name="account-notification" value="' . $notification . '" id="account-notification" ' . $checked . '> Invite Request Email Notification</div>';
                    echo '<div class="spacer2 button_center">Current Session: ' . asg_user_info('last_login') . '</div>';
                    echo '<div class="spacer2 button_center">';
                        echo '<button class="button tooltip" id="delete" type="submit" original-title="This action is irreversible!">DELETE ACCOUNT</button>';
                        echo '<i class="small">This will only delete your Koding Community Platform account, not your real Koding account!</i>';
                    echo '</div>';
                echo '</form>'; 
            echo '</div>';

        break;
        
        // Update user information
        case 'change-info':
                        
            // Get the posted values
            $data  = $con->escape_string(htmlspecialchars($_POST['data'],ENT_QUOTES));
            $type  = $con->escape_string(htmlspecialchars($_POST['type'],ENT_QUOTES));
            
            if($type == 'password'){
                $data = sha256($data . AUTH_SALT);
            }
            
            $update_query = asg_db_update("update " . TABLE_USERS . " set " . $type . " = '" . $data . "' where username = '" . $_SESSION['username'] . "'");

            if (empty($update_query)) {
                echo 'Yes';
            } else {
                echo 'No';
            }                
            
        break;
        
        // Delete user account
        case 'delete-account':
            
            // Get the posted values
            $username = $_SESSION['username'];
            
            $remove_query = asg_db_update("delete from " . TABLE_USERS . " where username = '" . $username . "'");
            
            if (empty($remove_query)) {
                echo 'Yes';
            } else {
                echo 'No';
            }
                
        break;
                    
        endswitch;
    
    asg_db_disconnect($con);
?>