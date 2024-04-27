<?php
/*
Plugin Name: GSAP Smooth Scroll
Plugin URI: http://yourwebsite.com/
Description: Implements smooth scrolling using GSAP.
Version: 1.0
Author: Ganesh
Author URI: http://advaitmedia.com/
*/

defined('ABSPATH') or die('No script kiddies please!');

function ss_gsap_enqueue_scripts() {
    // Enqueue GSAP (from CDN for this example, you might want to host your own or manage via npm/yarn)
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js', array(), '3.5.1', true);
    wp_enqueue_script('gsap-scrollTo', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollToPlugin.min.js', array('gsap'), '3.5.1', true);

    // Enqueue your custom JS script
    wp_enqueue_script('gsap-smooth-scroll', plugins_url('smooth-scroll.js', __FILE__), array('gsap', 'gsap-scrollTo'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'ss_gsap_enqueue_scripts');

function ss_gsap_smooth_scroll_script() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        gsap.registerPlugin(ScrollToPlugin);

        // Capture click events on all <a> elements with href attributes
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                var target = document.querySelector(this.getAttribute('href'));
                if(target) {
                    gsap.to(window, {duration: 1.5, scrollTo: target});
                }
            });
        });
    });
    </script>
    <?php
}

add_action('wp_footer', 'ss_gsap_smooth_scroll_script');
