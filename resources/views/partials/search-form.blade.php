<div class="search">
  <form role="search" method="get" class="search--form" action="{{ home_url('/') }}">
  	<label class="search--label">
  		<span class="screen-reader-text">Search for:</span>
  		<input class="search--field" placeholder="Search &hellip;" aria-label="Search" value="{{ sanitize_text_field( get_search_query() ) }}" name="s" type="search">
  	</label>
  	<button class="search--submit" value="Search" type="submit" aria-label="Submit">
      <i class="fa fa-search"></i>
    </button>
  </form>
</div>
