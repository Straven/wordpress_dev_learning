<form role="search" method="get" id="searchform" action="<?php esc_url( home_url( '/' ) ); ?>">
	<input type="text" value="<?php echo get_search_query() ?>" name="s" id="textfield"/>
	<input type="submit" id="button" name="Search" value=""/>
</form>