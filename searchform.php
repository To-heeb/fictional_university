<form action="<?= esc_url(site_url('/')) ?>" method='get' class='search-form'>
    <label for="s" class="headline headline--medium">Perform a New Search:</label>
    <div class="search-form-row">
        <input type="search" name="s" id="s" class="s" placeholder="What are you looking for?">
        <input type="submit" value="Search" class='search-submit'>
    </div>
</form>