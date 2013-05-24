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
        <?=asg_the_nav(0,1);?>
        
        <?if(asg_is_page(HOME_PAGE) || asg_is_page("asgar")) {?>
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
    	</div>
        <?
            } else {
                echo '<h1>' . asg_the_title() . '</h1>';
                echo asg_the_content();
            }  
        ?>
    </div>
<?php
    // Footer
    require(INCLUDES . TEMPLATE_BOTTOM);
    
    // Stop platform
    require(INCLUDES . 'asg_stop.php');
?>