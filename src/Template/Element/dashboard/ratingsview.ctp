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
<div class="form-group">
<div class="row">
<div class="col-md-7">

<fieldset class="rating">

    <?php foreach($ratingval as $key => $row):
    ?>

    <?= $this->Cform->radio_stars_full($check, array('id' => 'starfullview'.$key, 'name' => 'ratingview', 'value' => $key, 'title' => $row)) ?>

    <?= $this->Cform->radio_starts_half($check, array('id' => 'starhalfview'.$key, 'name' => 'ratingview', 'value' => (intval($key) - 5), 'title' => 'Half ' . $row)) ?>

    <?php endforeach; ?>

</fieldset>
</div>
</div>
</div>