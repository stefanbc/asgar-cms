<?php
    $disallow_theme = true;

    $path = explode('asg-assets', $_SERVER['SCRIPT_FILENAME']);
    require($path[0] . '/asg-includes/asg_start.php');
    
    $action = $con->escape_string(htmlspecialchars($_POST['action'],ENT_QUOTES));

    switch($action):
        
        case 'request':
            // Get the posted values
            $user_email  = $con->escape_string(htmlspecialchars($_POST['email'],ENT_QUOTES));
            
            // Check the email
            $check = asg_db_query("select email from " . TABLE_INVITES . " where email = '" . $user_email . "' ");
            $second_check = asg_db_query("select email from " . TABLE_USERS . " where email = '" . $user_email . "' ");
            
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

                    $add_query = asg_db_update("insert into " . TABLE_INVITES . " (name, email, date) values ('" . $name . "', '" . $user_email . "', NOW())");
                            
                    if($add_query == false){
                        
                        // Get the email
                        $email_query = asg_db_query("select email from " . TABLE_USERS . " where notification = '1' ");
                        
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
            $get_query = asg_db_query("select email from " . TABLE_INVITES . " where id = '" . $id . "' ");
            
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

            $remove_query = asg_db_update("update " . TABLE_INVITES . " set status = '1', invite_date = NOW(), invited_by = '" . $_SESSION['username'] . "' where id = '" . $id . "'");

            if (empty($remove_query)) {
                echo 'Yes';
            } else {
                echo 'No';
            }

        break;
        
        case 'delete';
            
            $id = $con->escape_string(htmlspecialchars($_POST['id'],ENT_QUOTES));

            $remove_query = asg_db_update("delete from " . TABLE_INVITES . " where id = '" . $id . "'");

            if (empty($remove_query)) {
                echo 'Yes';
            } else {
                echo 'No';
            }

        break;
        
        case 'get_numbers':
            
            $invites_query = asg_db_num_rows("select * from " . TABLE_INVITES . " where status = '1' order by date asc");
            
            $queue_query = asg_db_num_rows("select * from " . TABLE_INVITES . " where status = '0' order by date asc");
            
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
            $main_query = asg_db_query("select * from " . TABLE_INVITES . " where status = '0' order by date asc limit $position, " . INVITES_PAGINATE_NUMBER . "");
    
            if (!empty($main_query)) {
                
                echo '<ul id="items">';
                
                foreach($main_query as $item){
                
                    echo '<li id="request_'. $item['id'] .'">';
                    
                    if(asg_user_info('user_type') == 1) {
                        echo '<span class="clean tooltip" data-id="' . $item['id'] . '" original-title="Delete request!"></span>';
                    }
                    
                    echo '<div class="item_wrapper">
					        <div class="item_left">' . asg_get_avatar($item['email']) . '</div>
					        <div class="item_right">' . $item['name'] . '</div>  	       
					    </div>
					    <div class="item_date">Requested on <br> ' . date("h:i a / M j, Y ", strtotime($item['date'])) . '</div>
					    <div class="bottom">';
                        
                    if(isset($_SESSION['username'])) {
                        echo '<button class="button" id="invite" onclick="get_email(' . $item['id'] . ')">INVITE</button>';
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
            $user_query = asg_db_query("select @rank := @rank + 1 as rank, query.* from (select @rank := $position) r, (select u.username, u.email, count(i.invited_by) as invites_number from " . TABLE_USERS . " u left join " . TABLE_INVITES . " i on u.username = i.invited_by group by u.username order by invites_number desc, username asc limit $position, " . PAGINATE_NUMBER . ") as query");
            
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
        
        case 'badges':
            
            $invites_number = asg_db_num_rows("select * from " . TABLE_INVITES . " where status = '1' and invited_by = '" . asg_user_info('username') . "'");
                
            echo '<div class="box_inner"><h2>Badges</h2>You can see your rank and the badges you earned here!<br>';
                echo '<div class="spacer2">Number of people invited: ' . $invites_number . '</div>';
                echo '<div class="spacer2">Rank: ' . asg_user_title($invites_number) . '</div>';
                echo '<div class="spacer2"></div>';
            echo '</div>';
            
        break;

        endswitch;
    
    asg_db_disconnect($con);
?>