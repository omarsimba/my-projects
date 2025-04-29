<?php
$path = 'assets';
// ALL GLOBAL VARIABLES
require_once "$path/globals/php/GLOBAL_VARIABLES.php";
// ALL GLOBAL SESSIONS
require_once "$path/globals/php/GLOBAL_SESSIONS.php";

require_once "$path/globals/php/functions.php";

// All global variables should be started with => $GLOBAL_VARIABLES



// SMALL COMPONENTS
require_once "$path/components/smallComponents/currency_switcher.php";
require_once "$path/components/smallComponents/title.php";
require_once "$path/components/smallComponents/product.php";

$all_products = $GLOBAL_VARIABLES['database']->prepare('SELECT * FROM products WHERE status = "active" ORDER BY ranking');
$all_products->execute();


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- General Head Target Items , And General Css Files  -->
    <?php require_once "$path/globals/html/links.php"; ?>
    <!-- Specific Css Files  -->
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/css/front.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/css/products.css">

    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/css/about-us.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/css/why_you_choose_us.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/css/our_clients.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/css/social_media.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/css/reviews.css">
    

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $global_key ?> | <?php echo $TRANSALTION_TEXTS['home_page__page_title'] ?></title>

</head>

<body dir='<?php echo $HTMLDir; ?>' class="direction-<?php echo $HTMLDir; ?> transition-fade">
    <!-- Importing Header Component  --> 
    <?php require_once "$path/components/SHARED_COMPONENTS/developer.php"; ?>

    <div class="page-container-as-body container">

        <?php require_once "$path/components/SHARED_COMPONENTS/header.php"; ?>
        <?php require_once "$path/components/HOME/front.php"; ?>
        <?php require_once "$path/components/HOME/products.php"; ?>
        <?php require_once "$path/components/HOME/about_us.php"; ?>
        <?php require_once "$path/components/HOME/why_you_choose_us.php"; ?>
        <?php require_once "$path/components/HOME/our_clients.php"; ?>
        <?php require_once "$path/components/HOME/social_media.php"; ?>
        <?php require_once "$path/components/HOME/reviews.php"; ?>
        <?php require_once "$path/components/SHARED_COMPONENTS/footer.php"; ?>






    </div>

    <!-- General Scripts   -->
    <?php require_once "$path/globals/html/scripts.php"; ?>

    <script>
        var windowWidth = screen.width;

        // For Reviews 
        if (windowWidth <= 876 && windowWidth > 831) {
            var swiper = new Swiper(".mySwiper4", {
                slidesPerView: 3,
                spaceBetween: 30,
                freeMode: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        } else if (windowWidth <= 831 & windowWidth > 556) {
            var swiper = new Swiper(".mySwiper4", {
                slidesPerView: 2,
                spaceBetween: 30,
                freeMode: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        } else if (windowWidth <= 556) {
            var swiper = new Swiper(".mySwiper4", {
                slidesPerView: 1,
                spaceBetween: 30,
                freeMode: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        }



        // For products
        if (windowWidth > 1000 ) {
            var swiper = new Swiper(".swiper5", {
                slidesPerView: 4,
                spaceBetween: 30,
                freeMode: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });

            var swiper = new Swiper(".mySwiper--reviews-imgs", {
                slidesPerView: 5,
                spaceBetween: 30,
                freeMode: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });

        } else if (windowWidth <= 876 && windowWidth > 831) {
            var swiper = new Swiper(".swiper5", {
                slidesPerView: 3,
                spaceBetween: 30,
                freeMode: true,
                
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });

            var swiper = new Swiper(".mySwiper--reviews-imgs", {
                slidesPerView: 4,
                spaceBetween: 30,
                freeMode: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        } else if (windowWidth <= 831 & windowWidth > 556) {
            var swiper = new Swiper(".swiper5", {
                slidesPerView: 2,
                spaceBetween: 30,
                freeMode: true,
                
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
            var swiper = new Swiper(".mySwiper--reviews-imgs", {
                slidesPerView: 3,
                spaceBetween: 30,
                freeMode: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        } else if (windowWidth <= 556) {
            var swiper = new Swiper(".swiper5", {
                slidesPerView: 1.2,
                spaceBetween: 30,
                freeMode: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });

            var swiper = new Swiper(".mySwiper--reviews-imgs", {
                slidesPerView: 2,
                spaceBetween: 30,
                freeMode: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        }


    </script>

    <script>
        
        const all_odometers = document.querySelectorAll('#number-holder-odometer')
        // console.log(all_odometers)
        for (var i = 0; i < all_odometers.length; i++) {

            const this_odometer = all_odometers[i]
            const this_odometer_value = this_odometer.getAttribute('data-number')

            const observer = new window.IntersectionObserver(([entry]) => {
                if (entry.isIntersecting) {
                    setTimeout(()=>{
                        this_odometer.innerHTML = this_odometer_value
                    }, 100)
                    return
                }
                console.log('LEAVE')
                setTimeout(()=>{
                    this_odometer.innerHTML = 0
                }, 100)
            }, {
              root: null,
              threshold: 0.1, // set offset 0.1 means trigger if atleast 10% of element in viewport
            })

            observer.observe(this_odometer);
             
        }
    </script>

</body>

</html>