<?php
  $recCat = get_the_term_list( $post->ID, 'employee_recognition_category', '<li>', ', ', '</li>' );
?>

@if( $recCat )
  <ul class="post--taxonomy taxonomy--recognition-category">
    {!! $recCat !!}
  </ul>
@endif

<?php
  $recDept = get_the_term_list( $post->ID, 'department', '<li>', ', ', '</li>' );
?>

@if( $recDept )
  <ul class="post--taxonomy taxonomy--department">
    {!! $recDept !!}
  </ul>
@endif
