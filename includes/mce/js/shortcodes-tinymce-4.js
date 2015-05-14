(function () {
	"use strict";

	var wcShortcodeManager = function(editor, url) {
		var wcDummyContent = 'Sample Content';
		var wcParagraphContent = '<p>Sample Content</p>';


		editor.addButton('wpc_shortcodes_button', function() {
			return {
				title: "",
				text: "[ ]",
				image: url + "/images/shortcodes.png",
				type: 'menubutton',
				icons: false,
				menu: [
					{
						text: 'Columns',
						menu: [
							{
								text: "1/2 + 1/2",
								onclick: function(){
									editor.insertContent('[wc_row][wc_column size="one-half" position="first"]' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-half" position="last"]</p>' + wcParagraphContent + '[/wc_column][/wc_row]');
								}
							},
							{
								text: "1/3 + 1/3 + 1/3",
								onclick: function(){
									editor.insertContent('[wc_row][wc_column size="one-third" position="first"]' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-third"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-third" position="last"]</p>' + wcParagraphContent + '[/wc_column][/wc_row]');
								}
							},
							{
								text: "1/3 + 2/3",
								onclick: function(){
									editor.insertContent('[wc_row][wc_column size="one-third" position="first"]' + wcParagraphContent + '<p>[/wc_column][wc_column size="two-third" position="last"]</p>' + wcParagraphContent + '[/wc_column][/wc_row]');
								}
							},
							{
								text: "2/3 + 1/3",
								onclick: function(){
									editor.insertContent('[wc_row][wc_column size="two-third" position="first"]' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-third" position="last"]</p>' + wcParagraphContent + '[/wc_column][/wc_row]');
								}
							},
							{
								text: "1/4 + 1/4 + 1/4 + 1/4",
								onclick: function(){
									editor.insertContent('[wc_row][wc_column size="one-fourth" position="first"]' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth" position="last"]</p>' + wcParagraphContent + '[/wc_column][/wc_row]');
								}
							},
							{
								text: "1/4 + 1/2 + 1/4",
								onclick: function(){
									editor.insertContent('[wc_row][wc_column size="one-fourth" position="first"]' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-half"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth" position="last"]</p>' + wcParagraphContent + '[/wc_column][/wc_row]');
								}
							},
							{
								text: "1/2 + 1/4 + 1/4",
								onclick: function(){
									editor.insertContent('[wc_row][wc_column size="one-half" position="first"]' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth" position="last"]</p>' + wcParagraphContent + '[/wc_column][/wc_row]');
								}
							},
							{
								text: "1/4 + 1/4 + 1/2",
								onclick: function(){
									editor.insertContent('[wc_row][wc_column size="one-fourth" position="first"]' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-half" position="last"]</p>' + wcParagraphContent + '[/wc_column][/wc_row]');
								}
							},
							{
								text: "1/4 + 3/4",
								onclick: function(){
									editor.insertContent('[wc_row][wc_column size="one-fourth" position="first"]' + wcParagraphContent + '<p>[/wc_column][wc_column size="three-fourth" position="last"]</p>' + wcParagraphContent + '[/wc_column][/wc_row]');
								}
							},
							{
								text: "3/4 + 1/4",
								onclick: function(){
									editor.insertContent('[wc_row][wc_column size="three-fourth" position="first"]' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth" position="last"]</p>' + wcParagraphContent + '[/wc_column][/wc_row]');
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
									editor.insertContent('[wc_button type="primary" url="http://webplantmedia.com" title="Visit Site" target="self" position="float"]' + wcDummyContent + '[/wc_button]');
								}
							},
							{
								text: "Google Map",
								onclick: function(){
									editor.insertContent('[wc_googlemap title="St. Paul\'s Chapel" location="209 Broadway, New York, NY 10007" zoom="10" height="250" title_on_load="no" class=""]');
								}
							},
							{
								text: "Heading",
								onclick: function(){
									editor.insertContent('[wc_heading type="h1" title="' + wcDummyContent + '" margin_top="" margin_bottom="" text_align="left" font_size="" color="" class="" icon_left="" icon_right="" icon_spacing=""]');
								}
							},
							{
								text: "Pricing Table",
								onclick: function(){
									editor.insertContent('[wc_pricing type="primary" featured="yes" plan="Basic" cost="$19.99" per="per month" button_url="#" button_text="Sign Up" button_target="self" button_rel="nofollow"]<ul><li>30GB Storage</li><li>512MB Ram</li><li>10 databases</li><li>1,000 Emails</li><li>25GB Bandwidth</li></ul>[/wc_pricing]');
								}
							},
							{
								text: "Skillbar",
								onclick: function(){
									editor.insertContent('[wc_skillbar title="' + wcDummyContent + '" percentage="100" color="#6adcfa"]');
								}
							},
							{
								text: "Social Icon",
								onclick: function(){
									editor.insertContent('[wc_social_icons align="left" size="large" display="facebook,google,twitter,pinterest,instagram,bloglovin,flickr,rss,email,custom1,custom2,custom3,custom4,custom5"]');
								}
							},
							{
								text: "Testimonial",
								onclick: function(){
									editor.insertContent('[wc_testimonial by="Author" url="" position="left"]' + wcDummyContent + '[/wc_testimonial]');
								}
							},
							{
								text: "Image",
								onclick: function(){
									editor.insertContent('[wc_image attachment_id="" size="" title="" alt="" caption="" link_to="post" url="" align="none" flag="For Sale" left="" top="" right="0" bottom="20" text_color="" background_color="" font_size="" text_align="center" flag_width=""][/wc_image]');
								}
							},
							{
								text: "Countdown",
								onclick: function(){
									var d = new Date();
									var year = d.getFullYear() + 1;
									editor.insertContent('[wc_countdown date="July 23, '+year+', 6:00:00 PM" format="wdHMs" message="Your Message Here!" labels="Years,Months,Weeks,Days,Hours,Minutes,Seconds" labels1="Year,Month,Week,Day,Hour,Minute,Second"]');
								}
							},
							{
								text: "RSVP",
								onclick: function(){
									editor.insertContent('[wc_rsvp columns="3" align="left" button_align="center"]');
								}
							},
							{
								text: "HTML",
								onclick: function(){
									editor.insertContent('[wc_html name="Custom Field Name"]');
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
									editor.insertContent('[wc_posts author="" author_name="" p="" post__in="" order="DESC" orderby="date" post_status="publish" post_type="post" posts_per_page="10" taxonomy="" field="slug" terms="" title="yes" meta_all="yes" meta_author="yes" meta_date="yes" date_format="M j, Y" meta_comments="yes" thumbnail="yes" content="yes" paging="yes" size="large" filtering="yes" columns="3" gutter_space="20" heading_type="h2" layout="masonry" template="box" excerpt_length="30"][/wc_posts]');
								}
							},
							{
								text: "Masonry - Borderless",
								onclick: function(){
									editor.insertContent('[wc_posts author="" author_name="" p="" post__in="" order="DESC" orderby="date" post_status="publish" post_type="post" posts_per_page="10" taxonomy="" field="slug" terms="" title="yes" meta_all="yes" meta_author="yes" meta_date="yes" date_format="M j, Y" meta_comments="yes" thumbnail="yes" content="yes" paging="yes" size="large" filtering="yes" columns="3" gutter_space="40" heading_type="h2" layout="masonry" template="borderless" excerpt_length="30"][/wc_posts]');
								}
							},
							{
								text: "Grid - Box",
								onclick: function(){
									editor.insertContent('[wc_posts author="" author_name="" p="" post__in="" order="DESC" orderby="date" post_status="publish" post_type="post" posts_per_page="10" taxonomy="" field="slug" terms="" title="yes" meta_all="yes" meta_author="yes" meta_date="yes" date_format="M j, Y" meta_comments="yes" thumbnail="yes" content="yes" paging="yes" size="wccarousel" filtering="yes" columns="3" gutter_space="20" heading_type="h2" layout="grid" template="box" excerpt_length="15"][/wc_posts]');
								}
							},
							{
								text: "Grid - Borderless",
								onclick: function(){
									editor.insertContent('[wc_posts author="" author_name="" p="" post__in="" order="DESC" orderby="date" post_status="publish" post_type="post" posts_per_page="10" taxonomy="" field="slug" terms="" title="yes" meta_all="yes" meta_author="yes" meta_date="yes" date_format="M j, Y" meta_comments="yes" thumbnail="yes" content="yes" paging="yes" size="wccarousel" filtering="yes" columns="3" gutter_space="40" heading_type="h2" layout="grid" template="borderless" excerpt_length="15"][/wc_posts]');
								}
							}
						]
					},
					{
						text: 'Boxes',
						menu: [
							{
								text: "Primary",
								onclick: function(){
									editor.insertContent('[wc_box color="primary" text_align="left"]' + wcParagraphContent + '[/wc_box]');
								}
							},
							{
								text: "Secondary",
								onclick: function(){
									editor.insertContent('[wc_box color="secondary" text_align="left"]' + wcParagraphContent + '[/wc_box]');
								}
							},
							{
								text: "Inverse",
								onclick: function(){
									editor.insertContent('[wc_box color="inverse" text_align="left"]' + wcParagraphContent + '[/wc_box]');
								}
							},
							{
								text: "Success",
								onclick: function(){
									editor.insertContent('[wc_box color="success" text_align="left"]' + wcParagraphContent + '[/wc_box]');
								}
							},
							{
								text: "Warning",
								onclick: function(){
									editor.insertContent('[wc_box color="warning" text_align="left"]' + wcParagraphContent + '[/wc_box]');
								}
							},
							{
								text: "Danger",
								onclick: function(){
									editor.insertContent('[wc_box color="danger" text_align="left"]' + wcParagraphContent + '[/wc_box]');
								}
							},
							{
								text: "Info",
								onclick: function(){
									editor.insertContent('[wc_box color="info" text_align="left"]' + wcParagraphContent + '[/wc_box]');
								}
							}
						]
					},
					{
						text: 'Highlights',
						menu: [
							{
								text: "Blue",
								onclick: function(){
									editor.insertContent('[wc_highlight color="blue"]' + wcDummyContent + '[/wc_highlight]');
								}
							},
							{
								text: "Gray",
								onclick: function(){
									editor.insertContent('[wc_highlight color="gray"]' + wcDummyContent + '[/wc_highlight]');
								}
							},
							{
								text: "Green",
								onclick: function(){
									editor.insertContent('[wc_highlight color="green"]' + wcDummyContent + '[/wc_highlight]');
								}
							},
							{
								text: "Red",
								onclick: function(){
									editor.insertContent('[wc_highlight color="red"]' + wcDummyContent + '[/wc_highlight]');
								}
							},
							{
								text: "Yellow",
								onclick: function(){
									editor.insertContent('[wc_highlight color="yellow"]' + wcDummyContent + '[/wc_highlight]');
								}
							}
						]
					},
					{
						text: 'Dividers',
						menu: [
							{
								text: "Solid",
								onclick: function(){
									editor.insertContent('[wc_divider style="solid" line="single" margin_top="" margin_bottom=""]');
								}
							},
							{
								text: "Dashed",
								onclick: function(){
									editor.insertContent('[wc_divider style="dashed" line="single" margin_top="" margin_bottom=""]');
								}
							},
							{
								text: "Dotted",
								onclick: function(){
									editor.insertContent('[wc_divider style="dotted" line="single" margin_top="" margin_bottom=""]');
								}
							},
							{
								text: "Double",
								onclick: function(){
									editor.insertContent('[wc_divider style="solid" line="double" margin_top="" margin_bottom=""]');
								}
							},
							{
								text: "Image1",
								onclick: function(){
									editor.insertContent('[wc_divider style="image" margin_top="" margin_bottom=""]');
								}
							},
							{
								text: "Image2",
								onclick: function(){
									editor.insertContent('[wc_divider style="image2" margin_top="" margin_bottom=""]');
								}
							},
							{
								text: "Image3",
								onclick: function(){
									editor.insertContent('[wc_divider style="image3" margin_top="" margin_bottom=""]');
								}
							}
						]
					},
					{
						text: 'jQuery',
						menu: [
							{
								text: "Accordion",
								onclick: function(){
									editor.insertContent('[wc_accordion collapse="0" leaveopen="0" layout="box"]<p>[wc_accordion_section title="Section 1"]</p>' + wcParagraphContent + '<p>[/wc_accordion_section]</p><p>[wc_accordion_section title="Section 2"]</p>' + wcParagraphContent + '<p>[/wc_accordion_section]</p>[/wc_accordion]');
								}
							},
							{
								text: "Tabs",
								onclick: function(){
									editor.insertContent('[wc_tabgroup layout="box"]<p>[wc_tab title="First Tab"]</p>'+wcParagraphContent+'<p>[/wc_tab]</p><p>[wc_tab title="Second Tab"]</p>'+wcParagraphContent+'<p>[/wc_tab]</p>[/wc_tabgroup]');
								}
							},
							{
								text: "Toggle",
								onclick: function(){
									editor.insertContent('[wc_toggle title="This Is Your Toggle Title" layout="box"]' + wcParagraphContent + '[/wc_toggle]');
								}
							}
						]
					},
					{
						text: 'Other',
						menu: [
							{
								text: "Spacing",
								onclick: function(){
									editor.insertContent('[wc_spacing size="40px"]');
								}
							},
							{
								text: "Clear Floats",
								onclick: function(){
									editor.insertContent('[wc_clear_floats]');
								}
							},
							{
								text: "Center Content",
								onclick: function(){
									editor.insertContent('[wc_center max_width="500px" text_align="left"]' + wcParagraphContent + '[/wc_center]');
								}
							},
							{
								text: "Full Width",
								onclick: function(){
									editor.insertContent('[wc_fullwidth selector=""]' + wcDummyContent + '[/wc_fullwidth]');
								}
							},
							{
								text: "Code",
								onclick: function(){
									editor.insertContent('[wc_code]' + wcDummyContent + '[/wc_code]');
								}
							},
							{
								text: "Pre",
								onclick: function(){
									editor.insertContent('[wc_pre color="1" wrap="0" scrollable="1" linenums="0" name="Custom Field Name"]');
								}
							}
						]
					},
				]
			}
		});
	};
	
	tinymce.PluginManager.add( "wpc_shortcodes", wcShortcodeManager );
})();
