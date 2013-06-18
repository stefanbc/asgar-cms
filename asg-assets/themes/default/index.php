<?php
    /**
     * Main theme file.
     *
     * @package default
     */

    // header part
    require('header.php');
?>    
<? 
    if(asg_is_page(HOME_PAGE) || asg_is_page("asgar")) { 

    // Get the average waiting time for invite query
    $average_time = asg_db_query("select (sum(unix_timestamp(invite_date) - unix_timestamp(date)) / count(*)) as average_time from " . TABLE_INVITES . " where status = '1' and date >= '2013-01-17 14:00:00' order by date asc");
    // Count the number of people invited
    $invites_number = asg_db_num_rows("select * from " . TABLE_INVITES . " where status = '1' order by date asc");
    // Count the number of people in queue
    $queue_number = asg_db_num_rows("select * from " . TABLE_INVITES . " where status = '0'");
    // Count the number of people invited by the user
    $user_invite_number = asg_db_num_rows("select * from " . TABLE_INVITES . " where status = '1' and invited_by = '" . $asg_auth . "' order by date asc");
?>
    <div class="sections-wrapper">
        <!-- Request an invite section -->
		<div class="left-section">
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
        <!-- Giveaway an invite section -->
		<div class="right-section">
			<h1>Giveaway Invites!</h1>
			Do you want to help others experience Koding? Giveaway some of your invites!
            <?php
                if(isset($asg_auth)){
                    echo '<span id="user_invited">You invited ' . $user_invite_number . ' people so far!</span>';
                }
            ?>
			<div class="bottom">
				<button class="button" id="giveaway">GIVEAWAY</button>
			</div>
		</div>
        <!-- Stats section -->
        <div class="bottom-section">
            <!-- The average waiting time for invite -->
            <div id="average_time">
                <?php
                    foreach($average_time as $time){
                        echo '<span class="number">' . asg_human_time($time['average_time']) . '</span>';
                    }
                ?>
                <span class="number-text">average waiting time for an invite!</span>
            </div> 
            
            <div id="number_wrapper">
                <!-- The number of people invited so far -->
                <div id="invites_number">
                    <span class="number"><?=$invites_number?></span>
                    <span class="number-text">people invited so far!</span>
                </div>
                <!-- The number of people in queue -->
                <div id="queue_number">
                    <span class="number"><?=$queue_number?></span>
                    <span class="number-text">people in queue!</span>
                </div>
            </div>
        </div>
    </div>
<?
    } else {
        // Load the page title
        echo '<h1>' . asg_the_title() . '</h1>';
        // Load the page content
        echo asg_the_content();
    }  
?>
<?php
    // footer part
    require('footer.php');
?>