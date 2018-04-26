@if( is_active_sidebar('alert') )
  <div id="top-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
    @php(dynamic_sidebar('alert'))
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
