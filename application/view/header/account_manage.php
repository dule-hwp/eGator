<!--<ul class="nav nav-pills">-->
<li class="dropdown <?php echo isset($_SESSION['user']) ? "" : "hide"; ?>">
    <a href="<?php echo URL; ?>users" data-toggle="dropdown" class="dropdown-toggle">
        <span class="glyphicon glyphicon-user"></span>
        Hello, <?php echo !isset($_SESSION['user']) ? "" : $_SESSION['user']->username; ?> <br/>
        <b>Your Account</b>
        <b class="caret"></b>
    </a>
    <ul class="dropdown-menu" id="menu1">
        <li>
            <a href="<?php echo URL; ?>users/profile">
                <i class="glyphicon glyphicon-user"></i> Profile
            </a>
        </li>
        
<!--        <li>-->
<!--            <a href="--><?php //echo URL; ?><!--">-->
<!--                <i class="glyphicon glyphicon-inbox"></i>  Mailbox-->
<!--            </a>-->
<!--        </li>-->
        <li>
            <a href="<?php echo URL; ?>items">
                <i class="glyphicon glyphicon-arrow-right"></i> My Items
            </a>
        </li>
        <li>
            <a onclick="logout()" href="#">
                <i class="glyphicon glyphicon-log-out"></i>  Logout
            </a>
        </li>
    </ul>
</li>
<!--</ul>-->
