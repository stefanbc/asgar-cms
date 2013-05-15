<?php
    require('../asg_start.php');
    
    $action = $con->escape_string(htmlspecialchars($_POST['action'],ENT_QUOTES));

    switch($action):
        
        case 'request':
            // Get the posted values
            $user_email  = $con->escape_string(htmlspecialchars($_POST['email'],ENT_QUOTES));
            
            // Check the email
            $check = asg_db_query("select email from " . INVITES . " where email = '" . $user_email . "' ");
            $second_check = asg_db_query("select email from " . USERS . " where email = '" . $user_email . "' ");
            
            if(empty($user_email)){
                
                echo 'No email';
                
            } elseif(!empty($check)) {
                
                echo 'Exists';
                
            } elseif (!empty($second_check)) {
                
                echo 'Already a user';
                
            } else {
                if( asg_valid_email($user_email) == true) {

                    // Get the name from the email used on Gravatar
                    $email_hash = md5( strtolower(trim($user_email)));
                    $str = file_get_contents( 'http://www.gravatar.com/' . $email_hash . '.php' );
                    $profile = unserialize( $str );
                    if ( is_array( $profile ) && isset( $profile['entry'] ) ) {
                        $name = $profile['entry'][0]['displayName'];
                    } else {
                        $name = 'Unknown name!';
                    }
                    
                    $user_email = strtolower($user_email);

                    $add_query = asg_db_update("insert into " . INVITES . " (name, email, date) values ('" . $name . "', '" . $user_email . "', NOW())");
                            
                    if($add_query == false){
                        
                        // Get the email
                        $email_query = asg_db_query("select email from " . USERS . " where notification = '1' ");
                        
                        if(empty($email_query)) {
                            
                            echo 'Problem getting emails! Try again!';
                            
                        } else {
            
                            foreach ($email_query as $email) {
                                $header = 'MIME-Version: 1.0' . "\r\n"
                                         .'X-Mailer: PHP/' . phpversion() . "\r\n"
                                		 .'Content-type: text/html; charset=iso-8859-1' . "\r\n"
                            			 .'From: Koding Community Invite <request@community.koding.com>' . "\r\n"
                            			 .'Reply-To: request@community.koding.com' . "\r\n";
                            	
                                $the_email = $email['email'];
                                
                            	$mail_subject = 'New Invite Request';
                            		
                            	$body = '
                            	<html>
                            		<head>
                            			<title>New Invite Request</title>
                            		</head>
                            		<body>
                            		  <table style="height: 220px; background: #272727; color: #fff; width: 450px;margin: 0 auto;" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th style="background: #fcb738; padding: 10px; color: #fff; font-size:16px;font-weight: normal;text-align: left;"><img src="http://koding.com/images/favicon.ico" alt="ico" style="vertical-align: text-bottom;padding-right: 10px;">New Invite Request</th>
                                        </tr>
                            		  	<tr>
                            		  		<td style="padding: 10px;text-align:center;">The following person made a new community invite request.</td>
                            		  	</tr>
                                        <tr>
                                	  		<td style="padding: 10px;text-align:center;">Name: <b>' . $name .'</b></td>
                            		  	</tr>
                            		  	<tr>
                            		  		<td style="padding: 10px;text-align:center;">E-mail: <a style="color: #fcb738; text-decoration: none;" href="mailto:' . $user_email .'">' . $user_email . '</a></td>
                            		  	</tr>
                                        <tr>
                                	  		<td style="padding: 30px;text-align:center;"><a style="color: #fff;text-decoration: none;background: #fcb738;padding: 10px;text-transform: uppercase;font-weight: bold;" href="' . HTTP . '?inviteList">View Invite</a></td>
                            		  	</tr>
                            		  </table>
                            		</body>
                            	</html>';
                            	
                                mail($the_email, $mail_subject, $body, $header);
                            }   
                        }
                        
                        echo "Yes";
                    
                    } else {
                        
                        echo "No";
                        
                    }

                } else {
                    echo "Bad Email";
                }
            }
        break;

        case 'get':

            $id = $con->escape_string(htmlspecialchars($_POST['id'],ENT_QUOTES));

            // Get the email
            $get_query = asg_db_query("select email from " . INVITES . " where id = '" . $id . "' ");
            
            if(empty($get_query)) {
                
                echo 'Problem loading email! Try again!';
                
            } else {

                foreach ($get_query as $email) {
                    echo '<div>
                            <span class="the_email">' . strrev($email['email']) . '</span>
                            <button class="button" id="copy-button">COPY TO CLIPBOARD</button>
                        </div>
                        <div class="small"><i>This email is protected against spam bots.</i></div>';
                }
    
            }

        break;

        case 'remove';
            
            $id = $con->escape_string(htmlspecialchars($_POST['id'],ENT_QUOTES));

            $remove_query = asg_db_update("update " . INVITES . " set status = '1', invite_date = NOW(), invited_by = '" . $_SESSION['username'] . "' where id = '" . $id . "'");

            if (empty($remove_query)) {
                echo 'Yes';
            } else {
                echo 'No';
            }

        break;
        
        case 'delete';
            
            $id = $con->escape_string(htmlspecialchars($_POST['id'],ENT_QUOTES));

            $remove_query = asg_db_update("delete from " . INVITES . " where id = '" . $id . "'");

            if (empty($remove_query)) {
                echo 'Yes';
            } else {
                echo 'No';
            }

        break;
        
        case 'get_numbers':
            
            $invites_query = asg_db_num_rows("select * from " . INVITES . " where status = '1' order by date asc");
            
            $queue_query = asg_db_num_rows("select * from " . INVITES . " where status = '0' order by date asc");
            
            if(!empty($invites_query) || !empty($queue_query)) {
            
                echo $invites_query . ',' . $queue_query;
                
            } else {
                
                echo 'No,0';
                
            }
            
        break;
        
        case 'paginate-invites':
            
            // Sanitize post value
            $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
            
            //validate page number is really numaric
            if(!is_numeric($page_number)){
                die('Invalid page number!');
            }
            
            //get current starting point of records
            $position = ($page_number * INVITES_PAGINATE_NUMBER);
            
            // Invites query
            $main_query = asg_db_query("select * from " . INVITES . " where status = '0' order by date asc limit $position, " . INVITES_PAGINATE_NUMBER . "");
    
            if (!empty($main_query)) {
                
                echo '<ul id="items">';
                
                foreach($main_query as $item){
                
                    echo '<li id="request_'. $item['id'] .'">';
                    
                    if(asg_user_info('user_type') == 1) {
                        echo '<span class="remove_request tooltip" data-id="' . $item['id'] . '" original-title="Delete request!"></span>';
                    }
                    
                    echo '<div class="item_wrapper">
					        <div class="item_left">' . asg_get_avatar($item['email']) . '</div>
					        <div class="item_right">' . $item['name'] . '</div>  	       
					    </div>
					    <div class="item_date">Requested on <br> ' . date("h:i a / M j, Y ", strtotime($item['date'])) . '</div>
					    <div class="bottom">';
                        
                    if(isset($_SESSION['username'])) {
                        echo '<button class="button" id="invite" onclick="get(' . $item['id'] . ')">INVITE</button>';
                    } else {
                        echo '<i>You need to be logged in to invite!</i>';    
                    }
						
                    echo '</div>';
                    echo '</li>';
                    
                }
                
                echo '<ul>';
                
            } else {
            	echo 'There are no invite requests at the moment! If you need one, submit your email using the <span class="link">Request an Invite form</span>.';
            }
        break;
            
        case 'paginate-users':
            
            // Sanitize post value
            $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
            
            //validate page number is really numaric
            if(!is_numeric($page_number)){
                die('Invalid page number!');
            }
            
            //get current starting point of records
            $position = ($page_number * PAGINATE_NUMBER);
            
            // Invite Leaderboard query
            $user_query = asg_db_query("select @rank := @rank + 1 as rank, query.* from (select @rank := $position) r, (select u.username, u.email, count(i.invited_by) as invites_number from " . USERS . " u left join " . INVITES . " i on u.username = i.invited_by group by u.username order by invites_number desc, username asc limit $position, " . PAGINATE_NUMBER . ") as query");
            
            if (!empty($user_query)) {
                
                echo '<ul id="leaderboard_items">';
                
                foreach($user_query as $user){
                    
                    if($user['rank'] == 1){
                        $style = 'class="first"';
                    } elseif ($user['rank'] == 2 || $user['rank'] == 3) {
                        $style = 'class="second_third"';
                    } else {
                        $style = '';
                    }
                    
                    echo '<li ' . $style . '>';
                    
                        echo '<span class="user_rank">' . $user['rank'] . '.</span>' . asg_get_avatar($user['email'],20,true,'style="height:20px;vertical-align: bottom;margin:0 5px;"') .' <a href="http://koding.com/' . $user['username'] . '" target="_blank" title="' . $user['username'] . '">' . $user['username'] . '</a> invited ' . $user['invites_number'] . ' people! <span class="leaderboard_title">' . asg_user_title($user['invites_number']) . '</span>';
                        
                    echo '</li>';
                }
                
                echo '</ul>';
                
            } else {
                echo 'The invite leaderboard. <i>Nobody here right now, just us ducks!</i>';
            }
        
        break;
        
        case 'login-create':
                        
            // Get the posted values
            $username  = $con->escape_string(htmlspecialchars($_POST['username'],ENT_QUOTES));
            $password  = $con->escape_string(sha256($_POST['password'] . AUTH_SALT));
            
            if(empty($username) || $username == 'You forgot to enter the username!'){
                echo 'No 1';  
            } else {
                // Check the username and password
                $sql = asg_db_query("select * from " . USERS . " where username = '" . $username . "'");
                
                if(empty($sql)) {
                    $register_query = asg_db_update("insert into " . USERS . " (username, password, create_date) values('" . $username . "', '" . $password . "', NOW())");
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
                        setcookie('_kdcp_user', $username, time() + (86400 * 7)); // 86400 = 1 day
                        
                        asg_db_update("update " . USERS . " set last_login = NOW() where username = '" . $username . "' ");
                        
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
                            setcookie('_kdcp_user', $username, time() + (86400 * 7)); // 86400 = 1 day
                            
                            asg_db_update("update " . USERS . " set last_login = NOW() where username = '" . $username . "' ");
                            
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
            
            session_unset();
    
            session_destroy();
            
            setcookie('KDInviteUser', '', time() - 60000);
            
            echo 'Yes';
            
        break;
        
        // If the user forgot his password
        case 'forgot_pass':
            
            $email = $con->escape_string(htmlspecialchars($_POST['email'],ENT_QUOTES));
            
            if(empty($email)){
                
                echo 'No 1';
                
            } else {
                // Check the email
                $sql = asg_db_query("select * from " . USERS . " where email = '" . $email . "'");
                
                if(!empty($sql)){
                    
                    $new_pass = random_gen(12,false);
                    $encrypted_pass = sha256($new_pass . AUTH_SALT);
                    
                    $reset_query = asg_db_update("update " . USERS . " set password = '" . $encrypted_pass . "' where email = '" . $email . "' ");
                    
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
            
            $update_query = asg_db_update("update " . USERS . " set " . $type . " = '" . $data . "' where username = '" . $_SESSION['username'] . "'");

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
            
            $remove_query = asg_db_update("delete from " . USERS . " where username = '" . $username . "'");
            
            if (empty($remove_query)) {
                echo 'Yes';
            } else {
                echo 'No';
            }
                
        break;
        
        case 'badges':
            
            $invites_number = asg_db_num_rows("select * from " . INVITES . " where status = '1' and invited_by = '" . asg_user_info('username') . "'");
                
            echo '<div class="box_inner"><h2>Badges</h2>You can see your rank and the badges you earned here!<br>';
                echo '<div class="spacer2">Number of people invited: ' . $invites_number . '</div>';
                echo '<div class="spacer2">Rank: ' . asg_user_title($invites_number) . '</div>';
                echo '<div class="spacer2"></div>';
            echo '</div>';
            
        break;
        
        case 'submit_app_entry':

            // Get the posted values
            $email  = $con->escape_string(htmlspecialchars($_POST['email'],ENT_QUOTES));
            $username  = $con->escape_string(htmlspecialchars($_POST['username'],ENT_QUOTES));
            $app_name  = $con->escape_string(htmlspecialchars($_POST['app_name'],ENT_QUOTES));
            $image_url  = $con->escape_string(htmlspecialchars($_POST['image_url'],ENT_QUOTES));
            $description  = $con->escape_string(htmlspecialchars($_POST['description'],ENT_QUOTES));

            if( asg_valid_email($email) ) {
                
                if( asg_check_image($image_url) ) {
                    
                    $add_query = ap_db_update("insert into " . CONTEST_ENTRIES . " (name, description, image, user, date_added) values ('" . $app_name . "', '" . $description . "', '" . $image_url . "', '" . $username . "', NOW())");
                        
                    if($add_query == false){
                        echo "Yes";
                    } else {
                        echo "No";  
                    } 
                    
                } else {
                    echo "Bad Image";
                }
                
            } else {
                echo "Bad Email";
            }
        break;
            
        endswitch;
    
    asg_db_disconnect($con);
?>