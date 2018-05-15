<div class="search">
  <form role="search" method="get" class="search--form" action="{{ home_url('/') }}">
  		<input class="search--field" placeholder="Search &hellip;" aria-label="Search" value="{{ sanitize_text_field( get_search_query() ) }}" name="s" type="search">
      <div class="search--input-group">
      	<button class="search--submit" value="Search" type="submit" aria-label="Submit">
          <i class="fa fa-search"></i>
        </button>
      </div>
  </form>
</div>
