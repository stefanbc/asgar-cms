<h1>Settings</h1>

<h2 class="subtitle">General</h2>

<div class="spacer2 block_wrapper">
    <div class="settings_title left">Website Name</div>
    <div class="settings_value left"><input type="text" class="input" name="website_name" id="website_name" value="<?=WEBSITE_NAME?>"></div>
</div>
<div class="spacer2 block_wrapper">
    <div class="settings_title left">Admin Email</div>
    <div class="settings_value left"><input type="email" class="input" name="admin_email" id="admin_email" value="<?=ADMIN_MAIL?>"></div>
</div>
<div class="spacer2 block_wrapper">
    <div class="settings_title left">Reply Email</div>
    <div class="settings_value left"><input type="email" class="input" name="reply_email" id="reply_email" value="<?=REPLY_EMAIL?>"></div>
</div>

<h2 class="subtitle">Reading</h2>

<div class="spacer2 block_wrapper">
    <div class="settings_title left">Paginate Number</div>
    <div class="settings_value left"><input type="text" class="input" name="paginate_number" id="paginate_number" value="<?=PAGINATE_NUMBER?>"></div>
</div>
<div class="spacer2 block_wrapper">
    <div class="settings_title left">Invites Paginate Number</div>
    <div class="settings_value left"><input type="text" class="input" name="invites_paginate_number" id="invites_paginate_number" value="<?=INVITES_PAGINATE_NUMBER?>"></div>
</div>
<div class="spacer2 block_wrapper">
    <div class="settings_title left">Excerpt Lenght</div>
    <div class="settings_value left"><input type="text" class="input" name="excerpt_lenght" id="excerpt_lenght" value="<?=EXCERPT_LENGHT?>"></div>
</div>

<h2 class="subtitle">Writing</h2>

<div class="spacer2 block_wrapper">
    <div class="settings_title left">Blog Page</div>
    <div class="settings_value left">
        <label>
            <select name="blog_page" id="blog_page">
                <option selected> --- </option>
                <option>Short Option</option>
                <option>This Is A Longer Option</option>
            </select>
        </label>
    </div>
</div>

<div class="spacer2">
    <button class="button" id="save" type="submit">SAVE SETTINGS</button>
</div>