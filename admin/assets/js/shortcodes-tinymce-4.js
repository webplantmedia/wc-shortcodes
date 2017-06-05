(function () {
	"use strict";

	var wcShortcodeManager = function(editor, url) {
		var wcDummyContent = 'Sample Content';
		var wcParagraphContent = '<p>Sample Content</p>';
		var wcDummyParagraphContent = '<p>Sample Content</p>';
		var mceSelected = '';
		var mceSelectedHTML = '';

		editor.addButton('wpc_shortcodes_button', function() {
			
			var dropdown = {
				title: "",
				text: "[ ]",
				image: url + "/images/shortcodes.png",
				type: 'menubutton',
				icon: false,
				onclick: function() {
					mceSelected = editor.selection.getContent({format: 'text'});
					mceSelectedHTML = editor.selection.getContent({format: 'html'});
					if ( mceSelected ) {
						wcDummyContent = mceSelected;
						wcParagraphContent = '<p>' + mceSelectedHTML + '</p>';
					}
					else {
						wcDummyContent = 'Sample Content';
						wcParagraphContent = '<p>Sample Content</p>';
					}
				},
				menu: [
					{
						text: 'Columns',
						menu: [
							{
								text: "1/2 + 1/2",
								onclick: function(){
									var shortcode = '[wc_row]<p>[wc_column size="one-half" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-half" position="last"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p>[/wc_row]';
									editor.insertContent( shortcode );
								}
							},
							{
								text: "1/3 + 1/3 + 1/3",
								onclick: function(){
									var shortcode = '[wc_row]<p>[wc_column size="one-third" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-third"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-third" position="last"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p>[/wc_row]';
									editor.insertContent( shortcode );
								}
							},
							{
								text: "1/3 + 2/3",
								onclick: function(){
									var shortcode = '[wc_row]<p>[wc_column size="one-third" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="two-third" position="last"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p>[/wc_row]';
									editor.insertContent( shortcode );
								}
							},
							{
								text: "2/3 + 1/3",
								onclick: function(){
									var shortcode = '[wc_row]<p>[wc_column size="two-third" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-third" position="last"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p>[/wc_row]';
									editor.insertContent( shortcode );
								}
							},
							{
								text: "1/4 + 1/4 + 1/4 + 1/4",
								onclick: function(){
									editor.insertContent('[wc_row]<p>[wc_column size="one-fourth" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-fourth"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-fourth"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-fourth" position="last"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p>[/wc_row]');
								}
							},
							{
								text: "1/4 + 1/2 + 1/4",
								onclick: function(){
									var shortcode = '[wc_row]<p>[wc_column size="one-fourth" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-half"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-fourth" position="last"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p>[/wc_row]';
									editor.insertContent( shortcode );
								}
							},
							{
								text: "1/2 + 1/4 + 1/4",
								onclick: function(){
									var shortcode = '[wc_row]<p>[wc_column size="one-half" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-fourth"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-fourth" position="last"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p>[/wc_row]';
									editor.insertContent( shortcode );
								}
							},
							{
								text: "1/4 + 1/4 + 1/2",
								onclick: function(){
									var shortcode = '[wc_row]<p>[wc_column size="one-fourth" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-fourth"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-half" position="last"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p>[/wc_row]';
									editor.insertContent( shortcode );
								}
							},
							{
								text: "1/4 + 3/4",
								onclick: function(){
									var shortcode = '[wc_row]<p>[wc_column size="one-fourth" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="three-fourth" position="last"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p>[/wc_row]';
									editor.insertContent( shortcode );
								}
							},
							{
								text: "3/4 + 1/4",
								onclick: function(){
									var shortcode = '[wc_row]<p>[wc_column size="three-fourth" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column]</p><p>[wc_column size="one-fourth" position="last"]</p>' + wcDummyParagraphContent + '<p>[/wc_column]</p>[/wc_row]';
									editor.insertContent( shortcode );
								}
							}
						]
					},
					{
						text: 'Elements',
						menu: [
							{
								text: "Button",
								onclick: function(){
									var shortcode = '[wc_button type="primary" url="" title="Visit Site" target="self" position="float"]' + wcDummyContent + '[/wc_button]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Font Awesome Icon",
								onclick: function(){
									var shortcode = '[wc_fa icon="" margin_left="" margin_right=""][/wc_fa]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Heading",
								onclick: function(){
									var shortcode = '[wc_heading type="h1" title="' + wcDummyContent + '" margin_top="" margin_bottom="" text_align="left" font_size="" color="" class="" icon_left="" icon_right="" icon_spacing=""]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Highlight",
								onclick: function(){
									var shortcode = '[wc_highlight color="yellow"]' + wcDummyContent + '[/wc_highlight]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Spacing",
								onclick: function(){
									var shortcode = '[wc_spacing size="40px" class=""][/wc_spacing]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Clear Floats",
								onclick: function(){
									editor.insertContent('[wc_clear_floats][/wc_clear_floats]');
								}
							},
							{
								text: "Inline Code",
								onclick: function(){
									editor.insertContent('[wc_code]' + wcDummyContent + '[/wc_code]');
								}
							},
							{
								text: "Divider",
								onclick: function(){
									var shortcode = '[wc_divider style="solid" line="single" margin_top="" margin_bottom=""][/wc_divider]';
									wcShortcodes( shortcode, editor );
								}
							}
						]
					},
					{
						text: 'Content',
						menu: [
							{
								text: "Pricing Table",
								onclick: function(){
									var shortcode = '[wc_pricing type="primary" plan="Basic" cost="$19.99" per="per month" button_url="" button_text="Sign Up" button_target="self" button_rel="nofollow"]<ul><li>30GB Storage</li><li>512MB Ram</li><li>10 databases</li><li>1,000 Emails</li><li>25GB Bandwidth</li></ul>[/wc_pricing]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Social Icon",
								onclick: function(){
									var shortcode = '[wc_social_icons format="default" columns="float-center" maxheight="48"][/wc_social_icons]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Share Buttons",
								onclick: function(){
									var shortcode = '[wc_share_buttons][/wc_share_buttons]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Testimonial",
								onclick: function(){
									var shortcode = '[wc_testimonial by="Author" url="" position="left"]' + wcParagraphContent + '[/wc_testimonial]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Countdown",
								onclick: function(){
									var d = new Date();
									var year = d.getFullYear() + 1;
									var shortcode = '[wc_countdown date="July 23, '+year+', 6:00:00 PM" format="wdHMs" message="Your Message Here!" labels="Years,Months,Weeks,Days,Hours,Minutes,Seconds" labels1="Year,Month,Week,Day,Hour,Minute,Second"]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Skillbar",
								onclick: function(){
									var shortcode = '[wc_skillbar title="' + wcDummyContent + '" percentage="100" color="#6adcfa"]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Image",
								onclick: function(){
									var shortcode = '[wc_image attachment_id="" size="medium" title="" alt="" caption="" link_to="post" url="" align="none" flag="For Sale" left="" top="" right="0" bottom="20px" text_color="" background_color="" font_size="" text_align="center" flag_width=""][/wc_image]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Call To Action",
								onclick: function(){
									var shortcode = '[wc_call_to_action]' + wcParagraphContent + '[/wc_call_to_action]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Image Links",
								onclick: function(){
									var shortcode = '[wc_image_links image_1="" text_1="" url_1="" image_2="" text_2="" url_2="" image_3="" text_3="" url_3="" image_4="" text_4="" url_4="" text_position="center" heading_type="h3" height="250px" class=""][/wc_image_links]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Box",
								onclick: function(){
									var shortcode = '[wc_box color="primary" text_align="left"]' + wcParagraphContent + '[/wc_box]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "HTML",
								onclick: function(){
									var shortcode = '[wc_html name="Custom Field Name"][/wc_html]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Preformatted Text",
								onclick: function(){
									var shortcode = '[wc_pre color="1" wrap="0" scrollable="1" linenums="0" name="Custom Field Name"][/wc_pre]';
									wcShortcodes( shortcode, editor );
								}
							}
						]
					},
					{
						text: 'Posts',
						menu: [
							{
								text: "Masonry - Box",
								onclick: function(){
									var shortcode = '[wc_posts pids="" order="DESC" orderby="date" post_type="post" taxonomy="" terms="" posts_per_page="10" ignore_sticky_posts="0" show_title="1" show_meta_all="1" show_meta_author="1" show_meta_date="1" show_meta_comments="1" show_thumbnail="1" show_content="1" show_paging="1" size="large" filtering="1" columns="3" gutter_space="20" heading_type="h2" layout="masonry" template="box" excerpt_length="30" date_format="M j, Y"][/wc_posts]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Masonry - Borderless",
								onclick: function(){
									var shortcode = '[wc_posts pids="" order="DESC" orderby="date" post_type="post" taxonomy="" terms="" posts_per_page="10" ignore_sticky_posts="0" show_title="1" show_meta_all="1" show_meta_author="1" show_meta_date="1" show_meta_comments="1" show_thumbnail="1" show_content="1" show_paging="1" size="large" filtering="1" columns="3" gutter_space="40" heading_type="h2" layout="masonry" template="borderless" excerpt_length="30" date_format="M j, Y"][/wc_posts]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Grid - Box",
								onclick: function(){
									var shortcode = '[wc_posts pids="" order="DESC" orderby="date" post_type="post" taxonomy="" terms="" posts_per_page="10" ignore_sticky_posts="0" show_title="1" show_meta_all="1" show_meta_author="1" show_meta_date="1" show_meta_comments="1" show_thumbnail="1" show_content="1" show_paging="1" size="wccarousel" filtering="1" columns="3" gutter_space="20" heading_type="h2" layout="grid" template="box" excerpt_length="15" date_format="M j, Y"][/wc_posts]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Grid - Borderless",
								onclick: function(){
									var shortcode = '[wc_posts pids="" order="DESC" orderby="date" post_type="post" taxonomy="" terms="" posts_per_page="10" ignore_sticky_posts="0" show_title="1" show_meta_all="1" show_meta_author="1" show_meta_date="1" show_meta_comments="1" show_thumbnail="1" show_content="1" show_paging="1" size="wccarousel" filtering="1" columns="3" gutter_space="40" heading_type="h2" layout="grid" template="borderless" excerpt_length="15" date_format="M j, Y"][/wc_posts]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Post Slider 1",
								onclick: function(){
									var shortcode = '[wc_post_slider pids="" order="DESC" orderby="name" post_type="post" taxonomy="" terms="" posts_per_page="10" ignore_sticky_posts="0" show_meta_category="1" show_title="1" show_content="1" readmore="Continue Reading" button_class="" size="full" heading_type="h2" template="slider1" heading_size="24" mobile_heading_size="24" excerpt_length="30" desktop_height="600" laptop_height="500" mobile_height="350" slider_mode="fade" slider_pause="4000" slider_auto="0"][/wc_post_slider]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Post Slider 2",
								onclick: function(){
									var shortcode = '[wc_post_slider pids="" order="DESC" orderby="name" post_type="post" taxonomy="" terms="" posts_per_page="10" ignore_sticky_posts="0" show_meta_category="0" show_title="1" show_content="1" readmore="Continue Reading" button_class="button secondary-button" size="full" heading_type="h2" template="slider2" heading_size="24" mobile_heading_size="24" excerpt_length="30" desktop_height="600" laptop_height="500" mobile_height="350" slider_mode="fade" slider_pause="4000" slider_auto="0"][/wc_post_slider]';
									wcShortcodes( shortcode, editor );
								}
							}
						]
					},
					{
						text: 'Actions',
						menu: [
							{
								text: "Accordion",
								onclick: function(){
									var shortcode = '[wc_accordion collapse="0" leaveopen="0" layout="box"]<p>[wc_accordion_section title="Section 1"]</p>' + wcParagraphContent + '<p>[/wc_accordion_section]</p><p>[wc_accordion_section title="Section 2"]</p>' + wcDummyParagraphContent + '<p>[/wc_accordion_section]</p>[/wc_accordion]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Accordion Section",
								onclick: function(){
									var shortcode = '[wc_accordion_section title="New Accordion Section"]<p>' + wcParagraphContent + '</p>[/wc_accordion_section]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Tabs",
								onclick: function(){
									var shortcode = '[wc_tabgroup layout="box" class=""]<p>[wc_tab title="First Tab"]</p>'+wcParagraphContent+'<p>[/wc_tab]</p><p>[wc_tab title="Second Tab"]</p>'+wcDummyParagraphContent+'<p>[/wc_tab]</p>[/wc_tabgroup]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Tab Section",
								onclick: function(){
									var shortcode = '[wc_tab title="New Tab Section"]<p>'+wcParagraphContent+'</p>[/wc_tab]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Toggle",
								onclick: function(){
									var shortcode = '[wc_toggle title="This Is Your Toggle Title" layout="box"]' + wcParagraphContent + '[/wc_toggle]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Google Map",
								onclick: function(){
									var shortcode = '[wc_googlemap title="St. Paul\'s Chapel" location="209 Broadway, New York, NY 10007" zoom="10" height="250" title_on_load="0" class=""]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "RSVP",
								onclick: function(){
									var shortcode = '[wc_rsvp columns="3" align="left" button_align="center"]';
									wcShortcodes( shortcode, editor );
								}
							}
						]
					},
					{
						text: 'Wrappers',
						menu: [
							{
								text: "Center Content",
								onclick: function(){
									var shortcode = '[wc_center max_width="500px" text_align="left"]' + wcParagraphContent + '[/wc_center]';
									wcShortcodes( shortcode, editor );
								}
							},
							{
								text: "Full Width",
								onclick: function(){
									var shortcode = '[wc_fullwidth selector=""]' + wcParagraphContent + '[/wc_fullwidth]';
									wcShortcodes( shortcode, editor );
								}
							},
						]
					},
				]
			};

			if ( typeof wpc_shortcodes_template_buttons == "object") {
				var size = dropdown.menu.push(
					{
						text: "Templates",
						menu: [],
					}
				);
				var index = size - 1;
				for ( var property in wpc_shortcodes_template_buttons ) {
					/* http://stackoverflow.com/questions/12718284/javascript-onclick-shows-last-element-of-array-with-for-loop */
					/* http://conceptf1.blogspot.com/2013/11/javascript-closures.html */
					(function(property) {
						if ( wpc_shortcodes_template_buttons.hasOwnProperty( property ) ) {
							if ( 'title' in wpc_shortcodes_template_buttons[property] && 'content' in wpc_shortcodes_template_buttons[property] ) {
								dropdown.menu[index].menu.push(
									{
										text: wpc_shortcodes_template_buttons[property]['title'],
										onclick: function(){
											editor.setContent('');
											editor.insertContent( wpc_shortcodes_template_buttons[property]['content'] );
										}
									}
								); 
							}
						}
					})(property);
				}	
			}

			if ( typeof wpc_shortcodes_collage_enabled == "boolean") {
				if ( true == wpc_shortcodes_collage_enabled ) {
					dropdown.menu[3].menu.push(
						{
							text: "Collage",
							onclick: function(){
								var shortcode = '[wc_collage][/wc_collage]';
								wcShortcodes( shortcode, editor );
							}
						}
					);
				}
			}

			dropdown.menu.push(
				{
					text: "[edit_selection]",
					onclick: function(){
						wcShortcodes( mceSelected, editor );
					}
				}
			);

			return dropdown;
		});
	};
	
	tinymce.PluginManager.add( "wpc_shortcodes", wcShortcodeManager );
})();
