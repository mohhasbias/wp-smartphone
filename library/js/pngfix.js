/**
* DD_belatedPNG: Adds IE6 support: PNG images for CSS background-image and HTML <IMG/>.
* Author: Drew Diller
* Email: drew.diller@gmail.com
* URL: http://www.dillerdesign.com/experiment/DD_belatedPNG/
* Version: 0.0.7a
* Licensed under the MIT License: http://dillerdesign.com/experiment/DD_belatedPNG/#license
*
* Example usage:
* DD_belatedPNG.fix('.png_bg'); // argument is a CSS selector
* DD_belatedPNG.fixPng( someNode ); // argument is an HTMLDomElement
**/



/* ADD YOUR CLASSES HERE e.g. #footer .rss, .cuteicon, .etc */

DD_belatedPNG.fix( '#header img' );
DD_belatedPNG.fix( '.sale_img' );
DD_belatedPNG.fix( '.zoom' );
DD_belatedPNG.fix( '.content_block img' );
DD_belatedPNG.fix( '.commentcount ' );
DD_belatedPNG.fix( '#content .fav_link li.print' );
DD_belatedPNG.fix( '.category_list li img' );




/* string argument can be any CSS selector */
/* change it to what suits you! */