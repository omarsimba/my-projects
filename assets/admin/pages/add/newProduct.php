<?php
$path = '../../..';
require_once "$path/globals/php/GLOBAL_VARIABLES.php";

require_once "$path/globals/php/conn.php";
require_once '../../php/active_not_active.php';


require_once '../../php/is_logged.php';
require_once '../../php/links_list.php';

// Components 
require_once '../../components/small_components/link.php';
require_once '../../components/small_components/title.php';
require_once "$path/components/smallComponents/btn-with-loader.php";
require_once "$path/components/smallComponents/updateDataFields.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "$path/globals/html/links.php"; ?>

    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/admin/css/global.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/admin/css/template.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/admin/css/newProduct.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/admin/css/header.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new product</title>
</head>

<body  data-admin_id="<?php echo $_SESSION[$global_key . "__User"]['id'] ?>">

    <div class="body_content">
        <?php require_once '../../components/side_header.php'; ?>

        <div class="content">
            <?php require_once '../../components/template_top.php'; ?>
            <!-- ------- -->

            <div class="content_purpos adding_data">
                <div class="row forInputs">
                    <?php echo htmlTitle('Add new product' , '<i class="fi fi-rr-shopping-bag-add"></i>') ; ?>
                    <form id="add_new_product_form" enctype='multipart/form-data'>
                        <div class="inputs">
                            <div class="row">
                                <div class="row-title">
                                    <i class="ri-information-line"></i>
                                    <p>Details</p>
                                </div>
                                <div class="inputs_group">
                                    <!-- Product's name input  -->
                                        <!-- EN -->
                                        <?php
                                        $title = "product's duration <span class='OPTION_TO_SEPARATE'>EN</span>";
                                        ?>
                                    <?php echo basicInput_('ri-shopping-bag-line', $title, 'text', 'product_duration__en', 'product_duration__en', '', 'product\'s name')?>
                                        <?php
                                        $title = "product's duration <span class='OPTION_TO_SEPARATE'>AR</span>";
                                        ?>
                                        <!-- AR -->
                                    <?php echo basicInput_('ri-shopping-bag-line', $title, 'text', 'product_duration__ar', 'product_duration__ar', '', 'product\'s name')?>



                                    <!-- Product's stars  -->
                                    <?php echo basicInput_('ri-star-line', 'product\'s stars', 'text', 'stars', 'stars')?>
                                    
                                    
                                    <!-- Product's is recommended  -->
                                    <?php
                                        $this__other_values = [];
                                        $recommended = [
                                            [
                                                'text' => 'Yes',
                                                'value' => 'true',
                                                'class' => 'success',

                                            ],
                                            [
                                                'text' => 'No',
                                                'value' => 'false',
                                                'class' => 'error',

                                            ],
                                        ];


                                        for ($i=0; $i < count($recommended); $i++) {
                                            $is_recommended_text = $recommended[$i]['text'] ;
                                            $is_recommended_value = $recommended[$i]['value'] ;
                                            $is_recommended_class_name = $recommended[$i]['class'] ;



                                            array_push($this__other_values, ['text' => $is_recommended_text, 'value' => $is_recommended_value, 'class_name' => $is_recommended_class_name]);
                                        }


                                        $default_text = $recommended[1]['text'];
                                        $default_value = $recommended[1]['value'];

                                        $title = "Is recommended <span class='OPTION_TO_SEPARATE'>default</span>";

                                        
                                        echo inputSelectorChanger($default_text, "is_recommended", $this__other_values, 'ri-medal-line', $title, $default_value, 'is_recommended') 
                                    ?>
                                    <!-- product's status input  -->
                                    <?php
                                        $this__other_values = [];
                                        for ($i=0; $i < count($active_notActive); $i++) {
                                            $active_not_active_text = $active_notActive[$i][0] ;
                                            $active_not_active_value = $active_notActive[$i][1] ;
                                            $active_not_active_class_name = $active_notActive[$i][2] ;


                                            array_push($this__other_values, ['text' => $active_not_active_text, 'value' => $active_not_active_value, 'class_name' => $active_not_active_class_name]);
                                        }

                                        $default_text = $this__other_values[0]['text'];
                                        $default_value = $this__other_values[0]['value'];

                                        $title = "Product's status <span class='OPTION_TO_SEPARATE'>default</span>";



                                        
                                        echo inputSelectorChanger($default_text, "status", $this__other_values, 'ri-pulse-line', $title, $default_value, 'status');
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="row-title">
                                    <i class="ri-exchange-dollar-line"></i>
                                    <p>Pricing</p>
                                </div>
                                <div class="inputs_group">
                                    <!-- Product's price  -->
                                    <?php
                                    $title = "product's price <span class='OPTION_IMPORTANT'>$currency_name</span>";
                                    ?>
                                    <?php echo basicInput_('ri-exchange-dollar-line', $title, 'text', 'price', 'price', '', 'product\'s price')?>
                                    <!-- Product's old price  -->
                                    <?php
                                    $title = "product's old price <span class='OPTION_IMPORTANT'>$currency_name</span>";
                                    ?>
                                    <?php echo basicInput_('ri-exchange-dollar-line', $title, 'text', 'old_price', 'old_price', '', 'product\'s old price')?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="row-title">
                                    <i class="ri-list-check-2"></i>
                                    <p>Other details</p>
                                </div>
                                <div class="inputs_group">
                                    <?php
                                    $title = "product's characteristics <span class='OPTION_TO_SEPARATE'>EN</span> (separate using <span class='OPTION_TO_SEPARATE'>=</span>)";

                                    echo addValueIntoAnArray('ri-file-list-2-line', $title, 'characteristics__en', 'characteristics__en', '', 'Write here...');
                                    ?>

                                    <?php
                                    $title = "product's characteristics <span class='OPTION_TO_SEPARATE'>AR</span> (separate using <span class='OPTION_TO_SEPARATE'>=</span>)";

                                    echo addValueIntoAnArray('ri-file-list-2-line', $title, 'characteristics__ar', 'characteristics__ar', '', 'Write here...');
                                    ?>

                                    <!-- Product's ranking  -->

                                    <?php echo basicInput_('ri-sort-asc', 'Products\'s ranking', 'number', 'ranking', 'ranking')?>

                                </div>
                            </div>
                            
                        </div>

                        <p class="error-text-holder" id="general-error-holder"></p>


                        <!-- Add to database button  -->
                        <?php echo btnWithLoader( 'Add new product', 'ri-shopping-bag-line', 'Adding...', 'Added', 'add_new_product_form', 'admin/php/add_new_product_form', 'add-new-product') ?>

                    </form>
                </div>
                <?php require_once '../../components/separator.php'; ?>
            </div>

        </div>

    </div>



    <?php require_once '../../html/scripts.php'; ?>

    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/globals/js/add_data_to_database.js"></script>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/admin/js/add_new_product.js"></script>

    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/globals/js/inputs-selector-changer.js"></script>
</body>

</html>