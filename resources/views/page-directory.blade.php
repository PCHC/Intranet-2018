@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <article @php(post_class())>
      @include('partials.page-header')
      @include('partials.content-page')
      <?php
      $EEDB = new PageDirectory;
      $locations = $EEDB->getLocations();
      $allLocations = $EEDB->getAllLocations();

      if($EEDB->search || $EEDB->locationFilter) {
        $results[] = $EEDB->getEmployees();
      } else {
        foreach($locations as $location) {
          if($location == null) continue;
          $results[] = $EEDB->getEmployees($location);
        }
      }
      ?>
      <div class="card-group">
        <div class="card">
          <div class="card-header">Search by first or last name</div>
          <div class="card-body">
            <form method="get">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" name="search" value="<?php echo $EEDB->search; ?>">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">Search <i class="fas fa-search"></i></button>
                  <?php if( $EEDB->search ) { ?>
                  <a class="btn btn-outline-secondary" href="{{ the_permalink() }}">Clear <i class="fas fa-times"></i></a>
                  <?php } ?>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">Filter by location/department</div>
          <div class="card-body">
            <form method="get">
              <div class="input-group">
                <select class="custom-select" name="BranchName">
                  <option>Select:</option>
                  <?php foreach($allLocations as $location) { if($location == null) continue; ?>
                  <option value="<?php echo $location; ?>" <?php echo ($location == $EEDB->locationFilter) ? 'selected' : null; ?>><?php echo $location; ?></option>
                  <?php } ?>
                </select>
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">Filter <i class="fas fa-filter"></i></button>
                  <?php if( $EEDB->locationFilter ) { ?>
                  <a class="btn btn-outline-secondary" href="{{ the_permalink() }}">Clear <i class="fas fa-times"></i></a>
                  <?php } ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <table class="table">
        <?php
        foreach($results as $result) {
          ?>
          <thead>
            <tr class="thead-dark">
              <th colspan="7" class="text-center"><?php echo $result['header']; ?></th>
            </tr>
            <tr>
              <th>Last Name</th>
              <th>First Name</th>
              <th>Extension</th>
              <th>Alt. Extension</th>
              <th>Email</th>
              <th>Location/Department</th>
              <th>Position</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach($result['employees'] as $employee) { ?>
            <tr>
              <td><?php echo $employee['LN']; ?></td>
              <td><?php echo $employee['FN']; ?></td>
              <td><?php echo $employee['Ext1']; ?></td>
              <td><?php echo $employee['Ext2']; ?></td>
              <td><?php echo $employee['EmailAddress']; ?></td>
              <td><?php echo $employee['BranchName']; ?></td>
              <td><?php echo $employee['Position']; ?></td>
            </tr>
          <?php }
        }
        ?>
        </tbody>
      </table>
    </article>
  @endwhile
@endsection
