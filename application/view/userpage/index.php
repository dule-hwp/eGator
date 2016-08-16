<!-- User Account Information Page - Brian Mays-->

<h3>User Account Information</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <img class="img-rounded" src="<?php echo IMG_STATIC_FOLDER_URL . 'eGator.jpg'; ?>" width="250" height="250"
                 alt="User Photo"/>
        </div>
        <div class="col-sm-8 view-profile-description-style">
            <p><b>Name:</b> <?php print_r($user->first_name . " " . $user->last_name); ?></p>
            <p><b>Email:</b> <?php print_r($user->email); ?></p>
        </div>
    </div>
<!--    <h3>User Listings</h3>-->
    <!--		-->
<!--    <div class="container-fluid">-->
<!--        <div class="row">-->
<!--            <div class="col-sm-4">-->
<!--                <img class="img-rounded" src="public/img/items/csharpjava.png"-->
<!--                     width="240" height="240" class="mb-7 hero-image">-->
<!---->
<!--            </div>-->
<!---->
<!--            <div class="col-sm-4">-->
<!--                <h3>C# for Java Developers</h3>-->
<!--                <p>Very good book to learn C#</p>-->
<!--                <p>6.95</p>-->
<!--            </div>-->
<!---->
<!--            <div class="col-sm-4">-->
<!--                <a class="btn btn-success">Edit Listing</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>