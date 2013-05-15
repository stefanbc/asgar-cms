<?php
	/*
	*	Title: Koding Community Platform
	*	Author: Stefan Cosma
	*	Date: 07.12.2012
    *   Available parameters: inviteList
    *
    *   inviteList  - shows directly the invite list
    *
	*/
    
    // Start platform
    require('asg-includes/asg_start.php');
    
    // Header
    require(INCLUDES . TEMPLATE_TOP);
?>
    <div class="content_wrapper">
        <div class="first_wrapper">
            <div class="main_left_wrapper">
        		<div class="left_wrapper">
                    <div class="request-overlay">
                        <span class="entypo-vcard icon">
                            <span class="text">Request an Invite!</span>
                        </span>
                    </div>
        			<h1>Request an Invite!</h1>
        			Do you want a Koding invite? Request an invite from the community!
        			<form id="request_invite_form" name="request_invite_form">
        				<div class="spacer">
        					<input type="email" class="input tooltip" name="email" id="email" placeholder="Enter your email address" original-title="Disposable Email Addresses are not allowed!">
        				</div>
        				<div class="bottom">
        					<button class="button" id="request" type="submit">REQUEST</button>
        				</div>
        			</form>
        		</div>
        		<div class="right_wrapper">
                    <div class="request-overlay">
                        <span class="entypo-user-add icon">
                            <span class="text">Giveaway Invites!</span>
                        </span>
                    </div>
        			<h1>Giveaway Invites!</h1>
        			Do you want to help others experience Koding? Giveaway some of your invites!
                    <?php
                        if(isset($the_user)){
                            echo '<span id="user-invited">You invited ' . $user_invite_number . ' people so far!</span>';
                        }
                    ?>
        			<div class="bottom">
        				<button class="button" id="giveaway">GIVEAWAY</button>
        			</div>
        		</div>
                <?php
                    // Show the average waiting time for invite
                    echo '<div id="average_time">';
                        foreach($average_time as $time){
                            echo '<span class="number">' . asg_human_time($time['average_time']) . '</span>';
                        }
                    echo '<span class="number_text">average waiting time for an invite!</span>
                        </div>'; 
                ?>
                <?php
                    echo '<div id="number_wrapper">';
                        // Show the number of people invited so far
                        echo '<div id="invites_number">
                                <span class="number">' . $invites_number . '</span>
                                <span class="number_text">people invited so far!</span>
                            </div>';
                        
                        // Show the number of people in queue
                        echo '<div id="queue_number">
                                <span class="number">' . $queue_number . '</span>
                                <span class="number_text">people in queue!</span>
                            </div>';
                    echo '</div>';
                ?>
            </div>
            <div class="main_right_wrapper">
                <div class="submit_app_wrapper">
                    <div class="request-overlay">
                        <span class="entypo-popup icon">
                            <span class="text">Submit an app idea!</span>
                        </span>
                    </div>
                    <h1>App contest!</h1>
                	<span class="text_justify">Did you built an awesome app with the KDFramework? Submit it and win awesome prizes from Koding!</span>
        			<form id="app_idea_form" name="app_idea_form">
        				<div class="spacer">
            				<input type="text" class="input" name="app_name" id="app_name" placeholder="Name your awesome app!">
        				</div>
                        <div class="spacer">
        					<input type="email" class="input" name="app_email" id="email" placeholder="Enter your email address" original-title="Disposable Email Addresses are not allowed!">
        				</div>
        				<div class="bottom">
        					<button class="button" id="submit" type="submit">SUBMIT APP IDEA</button>
        				</div>
        			</form>
                    <span id="beta-badge"></span>
                </div>
            </div>
    	</div>
    	
    	<div class="invite_wrapper">
    		<h1 class="invite_back">Giveaway an Invite!</h1>
            <div id="invites"></div>
            <?=asg_paginate($invite_pages,'invites')?>
    	</div>
        
        <div class="second_wrapper">
            <h1>Invite Leaderboard</h1>
            <div id="leaderboard"></div>
            <?=asg_paginate($user_pages,'leaderboard')?>
        </div>        
    </div>
<?php
    // Footer
    require(INCLUDES . TEMPLATE_BOTTOM);
    
    // Stop platform
    require(INCLUDES . 'asg_stop.php');
?>