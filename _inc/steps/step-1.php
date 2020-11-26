
<?php 
global $options;
    if (get_option('name') !== FALSE) {
        $value = get_option('name');
    }
    else {
        $value = '';
    }
    print_r($value);
?>

<div class="zeeba-lhg-find-vehicle-form step-1-container zeeba_form step">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="zeeba-lhg-single-input-group">
          <label><?php echo get_option('step1_pick-up_location_placeholder'); ?></label>
          <select id="pickupStation" name="pick-up-location-search" class="form-control">
            <option style="display:none" value="" disabled="" selected=""></option>

            <? $prev = '';
            $pick_loc = '';
            if(isset($_REQUEST['pickup_location']))
              $pick_loc = zeeba_get('step_1.pickup_location_select');//$_REQUEST['pickup_location'];
              
              foreach ( $locations as $location ):
                      $post = $location;
                      $pic_id = $location->ID; 
                if ( $prev != gf( 'sys_state_code', $location->ID ) ): ?><? if ( $prev != '' ): ?></optgroup><? endif; ?>
                  <optgroup label="<? tf( 'sys_state', $location->ID ); ?>"><? $prev = gf( 'sys_state_code', $location->ID );
                      endif; ?>
                      <option <?php if(zeeba_get('step_1.pickup_location_select')==$pic_id){ echo 'selected'; } ?>
                              value="<? echo $location->ID; ?>" data-code="<? tf( 'sys_trn_id', $location->ID ); ?>"
                              data-group="<? tf( 'sys_state', $location->ID ); ?>" <? if ( 1 == gf( 'location_disabled', $location->ID ) ): ?>disabled <? endif; ?>><? echo $location->post_title; ?></option> 
                          <? endforeach;
                      wp_reset_query(); ?>
                  </optgroup>
            </select>
            <input type="hidden" id="location" name="pick-up-location-id" value="<?php echo zeeba_get('step_1.pickup_location_select'); ?>" />
            <input type="hidden" id="location-code" name="pick-up-location-code" value="<?php echo zeeba_get('step_1.pickup_location'); ?>" />
        </div><!-- #End Single input group (Pick up location) -->


        <div class="zeeba-lhg-return-location-wrapper">
          <div class="zeeba-lhg-return-location-checkbox">
              <input id="zeeba-lhg-return-location" type="checkbox" id="return-loc" name="returnToPickupStation" value=1 <?php echo zeeba_get('step_1.different_location')=='yes' ?'checked="true"' : ''; ?>>
              <label for="zeeba-lhg-return-location"><?php echo get_option('step1_different_location'); ?></label>
          </div>

          <div class="zeeba-lhg-single-input-group zeeba-lhg-single-return-location-group">
            <label><?php echo get_option('step1_drop-off_location_placeholder'); ?></label>
            <button class="zeeba-lhg-close-button">
                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="red" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
                  </svg>
            </button>
            <select class="form-control" id="returnStation" name="drop-off-location-search">
              <option style="display:none" value="" disabled="" selected=""></option>

              <? $prev = '';
                foreach ( $locations as $location ):
                      $post = $location;
                      $drop_id = $location->ID; 
                  if ( $prev != gf( 'sys_state_code', $location->ID ) ): ?><? if ( $prev != '' ): ?></optgroup><? endif; ?>
                  <optgroup label="<? tf( 'sys_state', $location->ID ); ?>"><? $prev = gf( 'sys_state_code', $location->ID );
                      endif; ?>
                      <option <?php if(zeeba_get('step_1.dropoff_location_select')==$drop_id){ echo 'selected'; } ?> value="<? echo $location->ID; ?>" data-code="<? tf( 'sys_trn_id', $location->ID ); ?>"
                              data-group="<? tf( 'sys_state', $location->ID ); ?>" <? if ( 1 == gf( 'location_disabled', $location->ID ) ): ?>disabled <? endif; ?>><? echo $location->post_title; ?></option> 
                          <? endforeach;
                      wp_reset_query(); ?>
                  </optgroup>
            </select>
            <input type="hidden" name="drop-off-location-id" disabled value="<?php echo zeeba_get('step_1.dropoff_location_select'); ?>" id="return-location" />
            <input type="hidden" name="drop-off-location-code" disabled value="<?php echo zeeba_get('step_1.dropoff_location'); ?>" id="return-location-code" />
          </div>

        </div><!-- #End Single input group (Return Location) -->

      </div><!-- #End column 4 -->

      <div class="col-md-4">
          <div class="zeeba-lhg-single-input-group">
              <label><?php echo get_option('step1_pick-up_date_placeholder'); ?></label>
              <input class="form-control" type="text" id="pickup-datetimepicker" value="<?php echo zeeba_get('step_1.pickup_date'); ?>">
          </div>
          <div class="zeeba-lhg-single-input-group">
              <label><?php echo get_option('step1_drop-off_date_placeholder'); ?></label>
              <input class="form-control" type="text" id="dropoff-datetimepicker" value="<?php echo zeeba_get('step_1.dropoff_date'); ?>">
          </div>
      </div><!-- #End column 4 -->

      <div class="col-md-4">
          <div class="zeeba-lhg-single-input-group">
              <label><?php echo get_option('step1_select_van_placeholder'); ?></label>
              <select class="form-control" id="vehicle">
                <option style="display:none" value="" disabled="" selected=""></option>

                <? foreach ( $vehicles as $vehicle ): ?>
                  <option <? echo ( $vehicle->ID == $selected_id ) ? 'selected' : ''; ?>
                        value="<? echo $vehicle->ID; ?>"><? echo $vehicle->post_title; ?></option>
                <? endforeach; ?>
              </select>
          </div><!-- #End Single input group (Select a van) -->

          <div class="zeeba-lhg-single-input-group">
              <label><?php echo get_option('step1_discount_placeholder'); ?></label>
              <input class="form-control" type="text" id="promotion" value="<?php echo zeeba_get('step_1.discount'); ?>" name="promotion">
          </div>
      </div><!-- #End column 4 -->

      <div class="col-md-12 d-flex .justify-content-start justify-content-md-end">
          <button type="submit" class="btn btn-success px-4 step_1_submit">Find Vehicle</button>
      </div><!-- End Column 12 -->
    </div><!-- #End Row -->
  </div>
</div><!-- #End Find Vehicle Form Section -->


<div class="stepper-container" style="background-color: #ff9dd4;">
  <!-- Horizontal Steppers -->
  <div class="row">
    <div class="col-md-12" style="max-width: 800px; margin: auto;">
      <!-- Stepers Wrapper -->
      <ul class="stepper stepper-horizontal" style="margin-bottom: 0px;">
        <!-- First Step -->
        <li id="stepper1" class="active">
          <a href="#!">
            <span class="circle">1</span>
            <span class="label"><?php echo get_option('step1_intro'); ?></span>
          </a>
        </li>
        <!-- Second Step -->
        <li id="stepper2" class="default">
          <a href="#!">
            <span class="circle">2</span>
            <span class="label"><?php echo get_option('step2_intro'); ?></span>
          </a>
        </li>
        <!-- Third Step -->
        <li id="stepper3" class="default">
          <a href="#!">
            <span class="circle">3</span>
            <span class="label"><?php echo get_option('step3_intro'); ?></span>
          </a>
        </li>
        <!-- Fourth Step -->
        <li id="stepper4" class="default">
          <a href="#!">
            <span class="circle">4</span>
            <span class="label"><?php echo get_option('step4_intro'); ?></span>
          </a>
        </li>
      </ul>
      <!-- /.Stepers Wrapper -->

    </div>
  </div>
  <!-- /.Horizontal Steppers -->
</div>

<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$url = 'https://weblink.tsdasp.net/requests/service.svc/';
$trn_mn  = new trnManager($url, 'ZEB01', get_option('booking_api_username'), get_option('booking_api_password'), get_client_ip(), get_client_ip());


?>

<script type="text/javascript">
jQuery(document).ready(function($) {

    $('#pickup-datetimepicker').datetimepicker({
      format: 'm/d/Y h:i A',
      formatTime: 'h:i A',
      validateOnBlur:false,
     allowTimes:[
      '08:00', '08:30', '09:00', 
      '09:30', '10:00', '10:30', '11:00', '11:30', 
      '12:00', '12:30', '13:00', 
      '13:30', '14:00', '14:30', '15:00', '15:30',
      '16:00', '16:30', '17:00', 
      '17:30', '18:00', '18:30', '19:00', '20:30', '21.00'
     ]
    });
    jQuery('#dropoff-datetimepicker').datetimepicker({
      format: 'm/d/Y h:i A',
      formatTime: 'h:i A',
      validateOnBlur:false,
     allowTimes:[
      '08:00', '08:30', '09:00', 
      '09:30', '10:00', '10:30', '11:00', '11:30', 
      '12:00', '12:30', '13:00', 
      '13:30', '14:00', '14:30', '15:00', '15:30',
      '16:00', '16:30', '17:00', 
      '17:30', '18:00', '18:30', '19:00', '20:30', '21.00', '21.30'
     ]
    });


    jQuery('#pickupStation').on('change', function() {
      jQuery('input[name=pick-up-location-id]').val(jQuery('#pickupStation option:selected').attr('value'));
      jQuery('input[name=pick-up-location-code]').val(jQuery('#pickupStation option:selected').attr('data-code'));
    });

    jQuery('#returnStation').on('change', function() {
      jQuery('input[name=drop-off-location-id]').val(jQuery('#returnStation option:selected').attr('value'));
      jQuery('input[name=drop-off-location-code]').val(jQuery('#returnStation option:selected').attr('data-code'));
    }); 
        
});
</script>