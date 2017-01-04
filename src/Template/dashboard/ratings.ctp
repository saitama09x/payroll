<?= $this->start('header_adds') ?>
<style>


.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 40px;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
</style>
<?= $this->end() ?>
<?= $this->append('title', 'Ratings') ?>
<?= $this->append('box-title', 'Student Tutorial Ratings') ?>
<?= $this->start('content_with_box') ?>
<div class="form-group">
<h3>Please give us your ratings in learning experience</h3>
</div>
<?= $this->Form->create($rating, ['url' => ['controller' => 'dashboard', 'action' => 'ratings', $id]]) ?>
<div class="form-group">
<div class="row">
<div class="col-md-7">

<fieldset class="rating">

    <?php foreach($ratingval as $key => $row):
    ?>

    <?= $this->Cform->radio_stars_full($check, array('id' => 'starfull'.$key, 'name' => 'rating', 'value' => $key, 'title' => $row)) ?>

    <?= $this->Cform->radio_starts_half($check, array('id' => 'starhalf'.$key, 'name' => 'rating', 'value' => (intval($key) - 5), 'title' => 'Half ' . $row)) ?>

    <?php endforeach; ?>

</fieldset>
</div>
</div>
</div>
<div class="form-group">
<div id="ratingtext"><h3>No Ratings</h3></div>
</div>
<div class="form-group">
<h4>Remarks:  </h4>
<?= $this->Form->textarea('remarks', ['class' => 'form-control']) ?>
</div>
<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-success']) ?>
<?= $this->Form->end() ?>
<?= $this->end() ?>
<?= $this->start('js_footer') ?>
<script>
$(document).ready(function(){
  
  $("[name='rating']").click(function(){
      var val = $(this).next().attr('title');
      $("#ratingtext h3").html(val);
  });

});
</script>
<?= $this->end() ?>



