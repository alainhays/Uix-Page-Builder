=== Uix Page Builder ===
Contributors: uiuxlab
Donate link: https://uiux.cc
Author URI: https://uiux.cc
Plugin URL: https://wordpress.org/plugins/uix-page-builder/
Tags: pagebuilder, page builder, builder, website builder, front end, frontend, visual builder, visual composer
Requires at least: 4.2
Tested up to: 4.8
Stable tag: 1.3.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Uix Page Builder is a design system that it is simple content creation interface.

== Description ==

Uix Page Builder is a design system that it is simple content creation interface. Drag & Drop, User-friendly and online Visual Editing.

Here are **6+** One-Page Templates for you to swipe and make your own. Here, you will find free, professional design for Uix Page Builder. We add new, fresh designs regularly in order to provide you with large variety of templates to chose from. More importantly, each module may contain a variety of styles.


You could add a new page with Uix Page Builder to your WordPress site, find the **Pages** menu in the WordPress Dashboard Navigation menu. Click **Add new**. The **"Uix Page Builder Attributes"** section applies page builder templates to your new page. 



**Included Modules**

The currently available default elements:

* Parallax 
* Google Maps 
* Pricing (4 layouts) 
* Features (2 layouts) 
* Testimonials carousel 
* Team (2 layouts) 
* Clients 
* Accordion 
* Tabs 
* Author Card 
* Progress Bar 
* Portfolio 
* Blog (2 layouts) 
* Slider 
* Instagram Feed 
* Sidebar   
* Uix Products (Require the WP plugin "Uix Products") 
* Contact Form (Require the WP plugin "Contact Form 7")



https://www.youtube.com/watch?v=vg3rPxcfZEg



= Displaying on Front-end Pages =

Embed a shortcode <strong>"[uix_pb_sections]"</strong> into the editor of <strong>Pages Add New Screen</strong>.
  
  
= Features =

* Support Custom Post Types to create a portfolio list in WordPress. (Require the WP plugin [Uix Products](https://wordpress.org/plugins/uix-products/))
* You can switch between <strong>"Visual Builder"</strong> and <strong>"Default Editor"</strong> modes at any time on the Pages Add New/Edit Screen.
* Support to choose multiple default templates you want.
* Support to save custom templates and export templates.
* Support a key to add anchor links based Uix Page Builder to your navigation. Visit the Menus page (Appearance &laquo; Menus), choose items like "Uix Page Builder Anchor Links", from the left column to add to the menu.
* Simple operation window, support loop list items.
* Customizable core style sheets.
* Drag and Drop Responsive Website Builder.



= Advanced Customization ( For Theme Developer ) =


1) Plugin allow handles builder controls of backend template usage so that we can use our own templates instead of the plugin. If you want to custom your builder controls of backend for your theme, then just copy them from the directory `/wp-content/plugins/uix-page-builder/uixpb_templates/` to your theme directory `/wp-content/themes/{your-theme}/`.


> Note: You could move the **/wp-content/themes/{your-theme}/uixpb_templates/js/**, **/wp-content/themes/{your-theme}/uixpb_templates/images/** and **/wp-content/themes/{your-theme}/uixpb_templates/css/** folders to your theme assets directory **/wp-content/themes/{your-theme}/assets/**



2) Plugin allow handles plugin scripts of front-end. If you want to custom, rename the **"_uix-page-builder-plugins.js"** to **"uix-page-builder-plugins.js"** from the directory `/wp-content/plugins/uix-page-builder/uixpb_templates/js/` or `/wp-content/themes/{your-theme}/uixpb_templates/js/` or `/wp-content/themes/{your-theme}/assets/js/`, and add the required script to "uix-page-builder-plugins.js". ( If you done, the default Uix Page Builder plugin scripts can't queue. You can use your own scripts instead of the plugin only. )




== Installation ==

1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to "Appearance -> Install Plugins".
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)


2. Create a new WordPress file or edit an existing one. Just make sure to select this new created template file as the "Template" for this page from the "Attributes" section. Enter page title like "Custom One Page". Save the page and hit "Preview" to see how it looks. ( You could specify the template name, in this case I used <strong>"Uix Page Builder Template"</strong>. )


> You could create Uix Page Builder template file (from the directory <strong>"/wp-content/plugins/uix-page-builder/uixpb_templates/tmpl-uix_page_builder.php"</strong> ) in your templates directory.


You will find <strong>"Uix Page Builder Attributes"</strong> settings in a meta box in your WordPress backend when you create a new page or when you are editing an existing one. This box is usually directly above the "Publish" meta box. Click <strong>"Use Visual Builder"</strong> button to enter the visual editing mode.
	


== Frequently Asked Questions ==

= FAQ 1: How To Create a Full Width or Boxed Layout? =

On visual builder page, expand the Settings Icon from Drag & Drop modules of left sidebar. You can easily choose the type of container.


= FAQ 2: How To Create The One-Page Navigation? =

1) On visual builder page, expand the Settings Icon from Drag & Drop modules of left sidebar. You can enter any string in the custom **ID** field on the right. Such as `my-portfolio`.

2) Create a new menu, and add a Custom Link for each menu item you plan on having. For each menu item, enter an id that you will assign later to the corresponding section. For example, for the menu item `My Portfolio`, you would enter `#my-portfolio` in the URL field.


= FAQ 3: How to use a custom page builder template? =

You could create Uix Page Builder template file (from the directory "/wp-content/plugins/uix-page-builder/uixpb_templates/tmpl-uix_page_builder.php" ) in your templates directory. It’s just a custom template file in the theme folder. Of course you doesn’t need to create it, you can use of the default page template or your own custom template file directly.




== Screenshots ==
1. screenshot-1.jpg
2. screenshot-2.jpg
3. screenshot-3.jpg
4. screenshot-4.jpg
5. screenshot-5.jpg
6. screenshot-6.jpg
7. screenshot-7.jpg
8. screenshot-8.jpg
9. screenshot-9.jpg
10. screenshot-10.jpg
11. screenshot-11.jpg
12. screenshot-12.jpg
13. screenshot-13.jpg

== Upgrade Notice ==


* Bug fixes and improvements.


== Changelog ==


= 1.3.2 (September 2, 2017) =

* Added a WP filter "uixpb_templates_filter". Theme template directory name of front-end can use filter "uixpb_templates_filter" to change it.
* Added a new module: Sidebar (new). Subordinate to WP Widgets.
* Added a new module: Instagram Feed (new).
* Added a new module: Blog (new layout).
* Optimized the "Parallax" module.


= 1.3.1 (August 31, 2017) =

* Upgraded core API for theme developer customization.
* Added a new module type: Slider (new).
* Added "Classic" template (new).
* Improved using instructions.
* Optimized template file(.xml) structure.
* Fixed a small bug when the template was exported.
* Fixed an issue for the layout of the html editor & textarea in page builder.



= 1.3.0 (August 30, 2017) =

* Fixed possible compatibility errors.
* Added a new module type: Uix Products (new). Require the WP plugin "Uix Products".
* Simplifies the templates directory for theme developer customization.
* Optimized the responsiveness of the visual editor.
* Optimize class of the excerpt.
* Optimized portfolio styles of front-end.
* Added new feature: Support to delete data of custom Content Template.
* Support Custom Post Types to create a portfolio list in WordPress.
* Removed some functions that is useless.




= 1.2.8 (August 7, 2017) =

* Fixed a display bug for the editor form type.
* Added a new module type: Contact Form (new). Compatible with WP plugin Contact Form 7.
* Added the editor's source code mode.


= 1.2.7 (June 27, 2017) =

* Optimize the embedding method of Google Maps.



= 1.2.6 (June 27, 2017) =

* Rebuild the core scripts for back-end.
* Fixed a little bug of TinyMCE Editor.
* Added default template preview images before you selected.



= 1.2.5 (June 26, 2017) =

* Simplified core API. ( For developers, custom modules are much simpler! )
* Rebuilt WYSIWYG Editor For Inline Web Content.
* Optimized response speed for back-end.
* Fix the display of posts that do not match the error.  ( For blog module )
* Optimized core stylesheets and scripts for front-end.
* Removed "Contact Form" module based on WP comment form.
* Fixed some minor bugs.



= 1.2.1 (June 17, 2017) =

* Upgraded core API. ( For developers, custom modules are much simpler! )
* Upgraded "Uix Page Builder Anchor Links" form the Menus editor page.




= 1.2.0 (June 13, 2017) =

* Added two Pricing styles (new).
* Added a new module type: Blog (new).
* Optimized pricing styles of front-end.
* Fixed a bug of duplicated buttons clone when multiple button IDs are similar in the visual builder screen.
* Fixed a bug of the on/off switch button can not be effective in real time.


= 1.1.9 (April 8, 2017) =

* Optimized admin panel of Custom CSS.


= 1.1.8 (April 5, 2017)  =

* Optimized front-end controller for your theme in admin panel.
* Upgraded core API. ( For developers, custom modules are much simpler! )
* Optimized core custom functions.
* Added function of template parameters.
* Added function of form javascripts output when in ajax or default state.
* Improve the stability of the plug-in.
* Optimized core stylesheets for front-end.


= 1.1.6 (April 2, 2017)  =

* Compatible with low version PHP (5.3+)
* Fixed some minor errors in the low version of PHP.


= 1.1.5 (April 1, 2017) =

* Upgraded core API. ( For developers, custom modules are much simpler! )
* Optimize the page builder form structure.
* Fixed some bugs of TinyMCE editor.
* Fixed some bugs of form elements.


= 1.1.4 (March 28, 2017) =

* Resolved compatibility errors that may occur with the editor.
* Optimized pop windows UI of editor for online preview.


= 1.1.3 (March 25, 2017) =

* Added Draft and Publish buttons in the visual builder screen.
* some minor bugs for enqueue scripts.
* Spy pop windows of editor for online preview.
* Supported select the page template on visual builder screen.


= 1.1.1 (March 1, 2017) =

* Added function of responsive switching preview (new).


= 1.1.0 (February 25, 2017) =

* Upgraded visual builder core UI.



= 1.0.7 (February 22, 2017) =

* Optimized drag and drop controls.
* Upgraded visual builder panel.
* Fixed some bugs that loaded row misalignment.
* Optimized backend scripts.


= 1.0.6 (February 2, 2017) =

* Optimized visual builder panel.
* Fixed a bug that added row misalignment.


= 1.0.5 (January 28, 2017) =

* Added visual builder mode (new).
* You can switch between "Visual Builder" and "Default Editor" modes at any time.
* Optimization of the admin panel structure.


= 1.0.2 (January 25, 2017) =

* Optimized core stylesheets for front-end.
* Added "Glory" template (new).
* Added "Comfortableness" template (new).
* Enhanced "Parallax" module.
* Optimized for the editor.
* Optimized for the color selector.
* Fixed error in default template image path.


= 1.0.1 (January 22, 2017) =

* Optimized enqueue scripts for front-end.
* Enhanced theme compatibility.



= 1.0.0 (January 17, 2017) =

* First release.

