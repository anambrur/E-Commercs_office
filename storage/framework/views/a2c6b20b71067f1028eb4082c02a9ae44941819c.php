<?php
$shipping = Session::get("shipping");
$user = Auth::user();

if (!empty($shipping["firstname"])) {
    $firstname = $shipping["firstname"];
} elseif (!empty($user->firstname)) {
    $firstname = $user->firstname;
} else {
    $firstname = '';
}
if (!empty($shipping["lastname"])) {
    $lastname = $shipping["lastname"];
} elseif (!empty($user->lastname)) {
    $lastname = $user->lastname;
} else {
    $lastname = '';
}

if (!empty($shipping["mobile"])) {
    $mobile = $shipping["mobile"];
} elseif (!empty($user->mobile)) {
    $mobile = $user->mobile;
} else {
    $mobile = '';
}
if (!empty($shipping["company"])) {
    $company = $shipping["company"];
} elseif (!empty($user->company)) {
    $company = $user->company;
} else {
    $company = '';
}
if (!empty($shipping["address"])) {
    $address = $shipping["address"];
} elseif (!empty($user->address)) {
    $address = $user->address;
} else {
    $address = '';
}
if (!empty($shipping["country"])) {
    $country_value = $shipping["country"];
} elseif (!empty($user->country)) {
    $country_value = $user->country;
} else {
    $country_value = '';
}
if (!empty($shipping["city"])) {
    $city = $shipping["city"];
} elseif (!empty($user->city)) {
    $city = $user->city;
} else {
    $city = '';
}
if (!empty($shipping["zip"])) {
    $zip = $shipping["zip"];
} elseif (!empty($user->zip)) {
    $zip = $user->zip;
} else {
    $zip = '';
}
?>

<?php echo Form::open(['method'=>'post', 'url'=>'checkout_shipping_address', 'class'=>'form-validate', 'name'=>'signup']); ?>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="firstName">First Name</label>
        <input required type="text" class="form-control field-validate" id="firstname" name="firstname"
               value="<?php echo e($firstname); ?>">
        <span class="help-block error-content" hidden>Please enter your first name')</span>
    </div>
    <div class="form-group col-md-6">
        <label for="lastName">Last Name</label>
        <input required type="text" class="form-control field-validate" id="lastname" name="lastname"
               value="<?php echo e($lastname); ?>">
        <span class="help-block error-content" hidden>Please enter your last name')</span>
    </div>
    <div class="form-group col-md-6">
        <label for="firstName">Mobile</label>
        <input required type="text" class="form-control field-validate" id="mobile" name="mobile"
               value="<?php echo e($mobile); ?>">
        <span class="help-block error-content" hidden>Please enter your mobile number')</span>
    </div>
    <div class="form-group col-md-6">
        <label for="firstName">Company</label>
        <input required type="text" class="form-control field-validate" id="company" name="company"
               value="<?php echo e($company); ?>">
        <span class="help-block error-content" hidden>Please enter your company name')</span>
    </div>
    <div class="form-group col-md-12">
        <label for="firstName">Address</label>
        <input required type="text" class="form-control field-validate" id="address" name="address"
               value="<?php echo e($address); ?>">
        <span class="help-block error-content" hidden>Please enter your address')</span>
    </div>
    <div class="form-group col-md-6">
        <label for="lastName">Country</label>
        <select name="country" id="country"
                class="form-control country p_complete"
                data-state="state"
                required=""
                data-onload="<?php echo isset($country) ? $country : "" ?>">
            <option value="">Select Your Country</option>
            <?php
            $countries = SM::$countries;
            ?>
            <?php if(count($countries)>0): ?>
                <?php
                $i = 1;
                ?>
                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option data-id="<?php echo e($i); ?>" value="<?php echo e($country); ?>"
                            <?php if($country_value == $country): ?> selected <?php endif; ?> ><?php echo e($country); ?></option>
                    <?php
                    $i++;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
        <span class="help-block error-content" hidden>Please select your country</span>
    </div>
    <div class="form-group col-md-6">
        <label for="firstName">State</label>
        <select required="" name="state" id="state"
                class="form-control state p_complete"
                required=""
                data-onload="<?php echo isset($state) ? $state : ""; ?>">
            <option value="#">Select State / Province</option>
        </select>
        <span class="help-block error-content" hidden>Please select your state</span>
    </div>
    <?php
    if(Auth::check()){
    $country = old("country") != "" ? old("country") : Auth::user()->country;
    $state = old("state") != "" ? old("state") : Auth::user()->state;
    ?>
    
    <script>
        $("#country").val('<?php echo $country; ?>');
            <?php if($country != ''): ?>
        var selectedCountryIndex = $("#country").find('option:selected').attr('data-id');
        var state = $("#country").attr('data-state');
        change_state(selectedCountryIndex, state);
        <?php endif; ?>
        $("#state").val('<?php echo $state; ?>');
    </script>
    
    <?php
    }
    ?>
    <div class="form-group col-md-6">
        <label for="lastName">City</label>
        <input required type="text" class="form-control field-validate" id="city" name="city"
               value="<?php echo e($city); ?>">
        <span class="help-block error-content" hidden>Please enter your city</span>
    </div>
    <div class="form-group col-md-6">
        <label for="lastName">Zip/Postal Code</label>
        <input required type="text" class="form-control" id="zip" name="zip"
               value="<?php echo e($zip); ?>">
        <span class="help-block error-content" hidden>Please enter your Zip/Postal Code</span>
    </div>
</div>
<div class="submitButton">
    <button type="submit" class="btn btn-success">Continue</button>
</div>
<?php echo Form::close(); ?>