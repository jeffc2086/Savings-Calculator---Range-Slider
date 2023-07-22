<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://modernwp.net
 * @since             1.0.0
 * @package           Savings_calculator
 *
 * @wordpress-plugin
 * Plugin Name:       Savings Calculator
 * Plugin URI:        https://modernwp.net
 * Description:       Calculate home sale savings
 * Version:           1.0.5
 * Author:            Jeff Clark
 * Author URI:        https://modernwp.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       savings_calculator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    echo 'We see you!';
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SAVINGS_CALCULATOR_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-savings_calculator-activator.php
 */
function activate_savings_calculator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-savings_calculator-activator.php';
	Savings_calculator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-savings_calculator-deactivator.php
 */
function deactivate_savings_calculator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-savings_calculator-deactivator.php';
	Savings_calculator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_savings_calculator' );
register_deactivation_hook( __FILE__, 'deactivate_savings_calculator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-savings_calculator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_savings_calculator() {

	$plugin = new Savings_calculator();
	$plugin->run();

}
run_savings_calculator();







// register menu item and page
function sc_add_settings_page() {
    add_options_page( 'Savings Calculator Options1', 'Savings Calculator', 'manage_options', 'sc-plugin', 'sc_render_plugin_settings_page' );
}
add_action( 'admin_menu', 'sc_add_settings_page' );


// render options page
function sc_render_plugin_settings_page() {
    ?>
    <!-- <h2>Savings Calculator Options</h2> -->
    <form action="options.php" method="post">
        <?php 
        settings_fields( 'sc_plugin_options' );
        do_settings_sections( 'sc_plugin' ); ?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
    </form>
    <?php
}


// create settings page
function createPluginSettings() {
    register_setting( 'sc_plugin_options', 'sc_plugin_options' );
    add_settings_section( 'sc_settings', 'Savings Calculator Options', 'sc_plugin_section_text', 'sc_plugin' );

	//	text fields
	// add_settings_field( 'sc_plugin_setting_heading', 'Heading Text', 'sc_plugin_setting_heading', 'sc_plugin', 'sc_settings' );
    // add_settings_field( 'sc_plugin_setting_sub_text', 'Sub Text', 'sc_plugin_setting_sub_text', 'sc_plugin', 'sc_settings' );

	// labels
	add_settings_field( 'sc_plugin_setting_amount_label', 'Amount Label', 'sc_plugin_setting_amount_label', 'sc_plugin', 'sc_settings' );

    // number values
    add_settings_field( 'sc_plugin_setting_min_price', 'Slider Min Price', 'sc_plugin_setting_min_price', 'sc_plugin', 'sc_settings' );
    add_settings_field( 'sc_plugin_setting_max_price', 'Slider Max Price', 'sc_plugin_setting_max_price', 'sc_plugin', 'sc_settings' );

    // Flat rates
    add_settings_field( 'sc_plugin_setting_rate1', 'Flat Rate Amount 1', 'sc_plugin_setting_rate1', 'sc_plugin', 'sc_settings' );
    add_settings_field( 'sc_plugin_setting_rate1_max', 'Flat Rate 1 Range Max', 'sc_plugin_setting_rate1_max', 'sc_plugin', 'sc_settings' );


	add_settings_field( 'sc_plugin_setting_rate2', 'Flat Rate Amount 2', 'sc_plugin_setting_rate2', 'sc_plugin', 'sc_settings' );
    add_settings_field( 'sc_plugin_setting_rate2_max', 'Flat Rate 2 Range Max', 'sc_plugin_setting_rate2_max', 'sc_plugin', 'sc_settings' );


    add_settings_field( 'sc_plugin_setting_rate3', 'Flat Rate Amount 3', 'sc_plugin_setting_rate3', 'sc_plugin', 'sc_settings' );
    add_settings_field( 'sc_plugin_setting_rate3_max', 'Flat Rate 3 Range Max', 'sc_plugin_setting_rate3_max', 'sc_plugin', 'sc_settings' );

    add_settings_field( 'sc_plugin_setting_font_size', 'Font Size', 'sc_plugin_setting_font_size', 'sc_plugin', 'sc_settings' );

	

	// color pickers
	add_settings_field( 'sc_plugin_setting_color_picker1', 'Slider Thumb', 'sc_plugin_setting_color_picker1', 'sc_plugin', 'sc_settings' );
	add_settings_field( 'sc_plugin_setting_color_picker2', 'Slider Background', 'sc_plugin_setting_color_picker2', 'sc_plugin', 'sc_settings' );
	add_settings_field( 'sc_plugin_setting_color_picker3', 'Text Labels', 'sc_plugin_setting_color_picker3', 'sc_plugin', 'sc_settings' );
    add_settings_field( 'sc_plugin_setting_color_picker4', 'Sale Price', 'sc_plugin_setting_color_picker4', 'sc_plugin', 'sc_settings' );
    add_settings_field( 'sc_plugin_setting_color_picker5', 'Savings', 'sc_plugin_setting_color_picker5', 'sc_plugin', 'sc_settings' );
}
add_action( 'admin_init', 'createPluginSettings' );


function sc_plugin_section_text() {
    echo '<p>Set up how the Savings Calculator works.</p>';
}


// --------------------
// 		Fields
// --------------------
// // heading
// function sc_plugin_setting_heading() {
//     $options = get_option( 'sc_plugin_options' );
//     echo "<input id='sc_plugin_setting_heading' name='sc_plugin_options[heading]' type='text' value='" . esc_attr( $options['heading'] ) . "' size='50' />";
// }
// // sub text
// function sc_plugin_setting_sub_text() {
//     $options = get_option( 'sc_plugin_options' );
//     echo "<textarea id='sc_plugin_setting_sub_text' name='sc_plugin_options[sub_text]' rows='5' cols='80' type='textarea'>{$options['sub_text']}</textarea>";
//     // echo "<textarea id='sc_plugin_setting_sub_text' name='sc_plugin_options[sub_text]' rows='3' cols='50' type='textarea'> . esc_attr( $options['sub_text']) . </textarea>";
// }
// Amount Label
function sc_plugin_setting_amount_label() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_amount_label' name='sc_plugin_options[amount_label]' type='text' value='" . esc_attr( $options['amount_label'] ) . "' size='30' />";
}

// flat rate1
function sc_plugin_setting_rate1() {
    $options = get_option( 'sc_plugin_options' );
    // $rate1 = $options['rate1'];
    echo "<input id='sc_plugin_setting_rate1' name='sc_plugin_options[rate1]' type='number' value='" . esc_attr( $options['rate1'] ) . "' size='30' />";
}
function sc_plugin_setting_rate1_max() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_rate1_max' name='sc_plugin_options[rate1_max]' type='number' value='" . esc_attr( $options['rate1_max'] ) . "' size='30' />";
}
// flat rate2
function sc_plugin_setting_rate2() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_rate2' name='sc_plugin_options[rate2]' type='number' value='" . esc_attr( $options['rate2'] ) . "' size='30' />";
}
function sc_plugin_setting_rate2_max() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_rate2_max' name='sc_plugin_options[rate2_max]' type='number' value='" . esc_attr( $options['rate2_max'] ) . "' size='30' />";
}
// flat rate3
function sc_plugin_setting_rate3() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_rate3' name='sc_plugin_options[rate3]' type='number' value='" . esc_attr( $options['rate3'] ) . "' size='30' />";
}
function sc_plugin_setting_rate3_max() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_rate3_max' name='sc_plugin_options[rate3_max]' type='number' value='" . esc_attr( $options['rate3_max'] ) . "' size='30' />";
}


// slider min
function sc_plugin_setting_min_price() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_min_price' name='sc_plugin_options[min_price]' type='number' value='" . esc_attr( $options['min_price'] ) . "' />";
}
// slider max
function sc_plugin_setting_max_price() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_max_price' name='sc_plugin_options[max_price]' type='number' value='" . esc_attr( $options['max_price'] ) . "' />";
}

// Font Size
function sc_plugin_setting_font_size() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_font_size' class='' name='sc_plugin_options[font_size]' type='number' value='" . esc_attr( $options['font_size'] ) . "'  />";
}

// Slider color
function sc_plugin_setting_color_picker1() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_color_picker1' class='color-pickers' name='sc_plugin_options[color_picker1]' type='text' value='" . esc_attr( $options['color_picker1'] ) . "'  />";
}

// Slider BG color
function sc_plugin_setting_color_picker2() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_color_picker2' class='color-pickers' name='sc_plugin_options[color_picker2]' type='text' value='" . esc_attr( $options['color_picker2'] ) . "'  />";
}

// Text Label Color
function sc_plugin_setting_color_picker3() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_color_picker3' class='color-pickers' name='sc_plugin_options[color_picker3]' type='text' value='" . esc_attr( $options['color_picker3'] ) . "'  />";
}

// Sale Price Color
function sc_plugin_setting_color_picker4() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_color_picker4' class='color-pickers' name='sc_plugin_options[color_picker4]' type='text' value='" . esc_attr( $options['color_picker4'] ) . "'  />";
}

// Savings Color
function sc_plugin_setting_color_picker5() {
    $options = get_option( 'sc_plugin_options' );
    echo "<input id='sc_plugin_setting_color_picker5' class='color-pickers' name='sc_plugin_options[color_picker5]' type='text' value='" . esc_attr( $options['color_picker5'] ) . "'  />";
}




// color pickers
add_action( 'admin_enqueue_scripts', 'sc_enqueue_color_picker' );
function sc_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker');
    wp_enqueue_script( 'sc-admin-scripts', plugins_url('/js/sc-admin-scripts.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

// --------------------
// 	END - Fields
// --------------------


// enqueue JS for shortcode
function sc_enqueue_scripts() {
	
	// Register the script in the normal WordPress way.
	wp_register_script( 'sc-scripts-js', plugins_url('savings_calculator/js/sc-scripts.js') );
	
	// Grab the global $post object.
	global $post;
	
	// See if the post HAS content and, if so, see if it has our shorcode.
	if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'savings_calculator' ) ) {
		wp_enqueue_script( 'sc-scripts-js' );
	}
}
add_action( 'wp_enqueue_scripts', 'sc_enqueue_scripts' );


// create shortcode
function SavingsCalculator() {

    // get our options
    $options = get_option( 'sc_plugin_options' );
    // $heading = $options['heading'];
    // $sub_text = $options['sub_text'];
    $amount_label = $options['amount_label'];
    $rate1 = $options['rate1'];
    $rate2 = $options['rate2'];
    $rate3 = isset($options['rate3']) ? $options['rate3']:' ';

    $rate1_max = $options['rate1_max'];
    $rate2_max  = $options['rate2_max'];
    $rate3_max  = $options['rate3_max'];

    $min_price = $options['min_price'];
    $max_price = $options['max_price'];

    $font_size = $options['font_size'];

    $color_picker1 = $options['color_picker1'];
    $color_picker2 = $options['color_picker2'];
    $color_picker3 = $options['color_picker3'];
    $color_picker4 = $options['color_picker4'];
    $color_picker5 = $options['color_picker5'];

    ?>
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                let slider = document.getElementById('savings_range');
                let output = document.getElementById('amount');

                
                const rate = .025;
                const flatfee1 = parseInt(<?php echo $options['rate1'] ?>);
                const flatfee2 = parseInt(<?php echo $options['rate2'] ?>);
                const flatfee3 = parseInt(<?php echo $options['rate3'] ?>);
                // console.log(flatfee3);

                const flatfee1_max = parseInt(<?php echo $options['rate1_max'] ?>);
                const flatfee2_max = parseInt(<?php echo $options['rate2_max'] ?>);
                const flatfee3_max = parseInt(<?php echo $options['rate3_max'] ?>);

              
                // format currency for Sale Price
                const formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    maximumFractionDigits: 0,
                    roundingIncrement: 100,
                });

                // format currency for Savings
                const formatter2 = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    maximumFractionDigits: 0,
                    roundingIncrement: 25,
                });

                console.log(slider.value);
                output.innerHTML = formatter.format(slider.value);
                
                slider.oninput = function() {
                    output.innerHTML = formatter.format(this.value);
                    const sliderValue = this.value;

                    // determine flatFee to use
                    let flatFee = '';
                    if ( sliderValue <= flatfee1_max ) {
                        flatFee = flatfee1;
                    } else if ( sliderValue <= flatfee2_max ) {
                        flatFee = flatfee2;
                    } else {
                        flatFee = flatfee3;
                    }

                    let result = sliderValue * rate - flatFee;
                    result = formatter2.format(result);

                    const savings = document.getElementById('savings');
                    savings.innerHTML = result;

                    // console.log(this.value);
                    // console.log(flatFee);
                    // console.log(result);
                }                

            });

           
        </script>

        <style>
            #sc_wrapper {
                display: flex;
                justify-content: center;
                max-width: 800px
            }
            #sc_container {
                display: flex;
                flex-direction: column;
                justify-content: center;
                text-align: center;
                width: 100%;
                font-size: <?php echo $font_size . 'px'; ?>
            }
            #sc_container #savings {
                font-weight: bold;
            }
            #sc_wrapper #amount_section,
            #sc_wrapper #savings-container {
                color: <?php echo $color_picker3; ?>
            }
            #sc_wrapper #amount_section #amount {
                color: <?php echo $color_picker4; ?>
            }
            #sc_wrapper #sc_container #savings {
                color: <?php echo $color_picker5; ?>
            }
            
            input[type=range]:focus {
                outline: none;
                border: none;
            }
            .slider {
                padding: 0.5em 0 !important;
            }
            #sc_wrapper #slider-container input#savings_range {
                -webkit-appearance: none;
                /* margin: 18px 0; */
                width: 100%;
            }

            /***** Chrome, Safari, Opera, and Edge Chromium *****/
            #sc_wrapper #slider-container input#savings_range::-webkit-slider-runnable-track {
                background: <?php echo $color_picker2; ?> !important;
                height: 0.5rem;
                box-shadow: none;
                outline: none;
                border: 0 !important!;
                height: 20px;
                box-shadow: inset 0 1px 3px rgba(0,0,0,.32);
                border-radius: 500px;
                /* opacity: 0.8;
                -webkit-transition: .2s;
                transition: opacity .2s; */
            }
            #sc_wrapper #slider-container input#savings_range::-webkit-slider-runnable-track:hover {
                /* opacity: 1; */

            }
            #sc_wrapper #slider-container input#savings_range::-webkit-slider-thumb {
                -webkit-appearance: none; /* Override default look */
                appearance: none;
                background-color: #5cd5eb;
                border: 0;
                border-radius: 50%;
                background: <?php echo $color_picker1; ?> !important;
                cursor: pointer;
                margin-top: -7px;
                height: 35px;
                width: 35px;
            }

            /******** Firefox ********/
            #sc_wrapper #slider-container input[type="range"]::-moz-range-track {                
                background: <?php echo $color_picker2; ?> !important;
                height: 20px;
                box-shadow: none;
                outline: none;
                box-shadow: inset 0 1px 3px rgba(0,0,0,.32);
                border-radius: 500px;
            }
            
            #sc_wrapper #slider-container input[type="range"]::-moz-range-thumb {
                -webkit-appearance: none; /* Override default look */
                appearance: none;
                margin-top: -12px; /* Centers thumb on the track */
                background-color: #5cd5eb;
                /* height: 30px;
                width: 30px;     */
                height: 35px;
                width: 35px;
                border: 0;
                border-radius: 50%;
                background: <?php echo $color_picker1; ?> !important;
                cursor: pointer;
                margin-top: -7px;
            }
        </style>
    <?php

    // echo $color_picker2;

    // var_dump($heading);

    // echo $heading;

    $output =   '<div id="sc_wrapper">
                    <div id="sc_container">                        
                        <div id="amount_section">'.$amount_label.': <span id="amount" style="font-weight:bold;"></span></div>
                        <div id="slider-container">
                            <input type="range" min="'.$min_price.'" max="'.$max_price.'" value="100000" class="slider" id="savings_range" step="1000">
                        </div>
                        <div id="savings-container">You would save: <span id="savings">$500</span></div>
                        <!-- <div id="with_agent">YOU SAVE (Buyer w/ Agent):<span id="with_agent"></span></div> -->
                    </div>
                </div>';

    return $output;

}
add_shortcode('savings_calculator', 'SavingsCalculator');