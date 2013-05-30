<h1>Apperence</h1>

<div class="spacer2 block_wrapper">
    <div class="settings_title left">Theme</div>
    <div class="settings_value left">
        <label>
            <select name="blog_page" id="blog_page">
                <option selected> --- </option>
                <option value="<?=asg_get_themeinfo('slug')?>"><?=asg_get_themeinfo('name')?></option>
                <option value="second_theme">Second Theme</option>
            </select>
        </label>
    </div>
</div>