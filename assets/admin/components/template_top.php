<?php 
$today = date('d M') ;

$adminUsername = '';
$adminFullName = '';

if ( isset($_SESSION[$global_key . "__User"]) ) {
    $thisAdminId = $_SESSION[$global_key . "__User"]['id'] ;
    $thisAdmin = $database->prepare('SELECT * FROM admins WHERE special_id = :special_id') ;
    $thisAdmin->bindParam( 'special_id', $thisAdminId );
    $thisAdmin->execute();
    $thisAdmin = $thisAdmin->fetchObject() ;

    $adminUsername = $thisAdmin->username ;
    $adminFullName = $thisAdmin->full_name ;
    $adminImage = $thisAdmin->image ;
    $adminRole = strtoupper($thisAdmin->role) ;
    $adminEmail = $thisAdmin->email ;



}

?>

<div class="top template_top">
    <div class="left">
        <h1>Hi, <?php echo $adminUsername ?></h1>
        <p>Welcome to your dashboard on <span class="specialText__"><?php echo $global_key ; ?></span> store </p>
    </div>
    <div class="right">
        <div class="profile-details" id="profile-details">

            <div class="img" id="__show---name-more-info">
                <?php 
                if ( !empty($adminImage) ) { ?>
                    <img src="<?php echo $hostName; ?>/assets/admin/imgs/admins/<?php echo $adminImage ?>" alt="<?php echo $adminFullName ?> ">
                <?php }else{ ?>
                    <p class="as-img"><?php echo $adminFullName[0] ; ?></p>
                <?php } ?>
            </div>

            <div class="name-more-info" id="name-more-info">
                <p>
                    <span class="role"><?php echo $adminRole ?></span>
                    <span class="full_name"><?php echo $adminFullName ?></span>
                </p>
            </div>
            <i class="ri-arrow-down-s-line" id="profile-details-icon"></i>
        </div>

        <div class="profile-and-logout" id="profile-and-logout">
            <div class="btn email_username">
                <i class="ri-user-star-line"></i>
                <div class="details">
                    <p class="email"><?php echo $adminEmail ; ?></p>
                    <p class="username">@<?php echo $adminUsername ; ?></p>
                </div>
            </div>
            <a href="<?php echo $hostName ; ?>/admin/profileSettings" class="btn">
                <i class="ri-user-settings-line"></i>
                <p>Profile</p>
            </a>
            <button class="btn" id="logout-btn" title='Double click to logout'>
                <i class="fi fi-rr-portal-enter"></i>
                <p>Log out</p>
            </button>
        </div>

    </div>
</div>
<div id="insertingDataLoader"><i class="fi fi-rr-spinner"></i> Loading...</div>

<div id="backend-response-container">
    <i class=""></i>
    <p></p>
</div>
<script type="module" src="<?php echo $hostName; ?>/assets/admin/js/template_top.js"></script>
