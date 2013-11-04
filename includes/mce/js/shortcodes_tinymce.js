(function() {	
	tinymce.create('tinymce.plugins.wcShortcodeMce', {
		init : function(ed, url){
			tinymce.plugins.wcShortcodeMce.theurl = url;
		},
		createControl : function(btn, e) {
			if ( btn == "wc_shortcodes_button" ) {
				var a = this;	
				var btn = e.createSplitButton('wc_shortcodes_button', {
	                title: "Insert Shortcode",
					image: tinymce.plugins.wcShortcodeMce.theurl +"/images/shortcodes.png",
					icons: false,
	            });
	            btn.onRenderMenu.add(function (c, b) {
					
					b.add({title : 'WC Shortcodes', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
					
					
					// Columns
					c = b.addMenu({title:"Columns"});
					
						a.render( c, "1/2 + 1/2", "half-half" );
						a.render( c, "1/3 + 1/3 + 1/3", "third-third-third" );
						a.render( c, "1/3 + 2/3", "third-twothird" );
						a.render( c, "2/3 + 1/3", "twothird-third" );
						a.render( c, "1/4 + 1/4 + 1/4 + 1/4", "fourth-fourth-fourth-fourth" );
						a.render( c, "1/4 + 1/2 + 1/4", "fourth-half-fourth" );
						a.render( c, "1/2 + 1/4 + 1/4", "half-fourth-fourth" );
						a.render( c, "1/4 + 1/4 + 1/2", "fourth-fourth-half" );
						a.render( c, "1/4 + 3/4", "fourth-three-fourth" );
						a.render( c, "3/4 + 1/4", "three-fourth-fourth" );
					
					b.addSeparator();
					
					
					// Elements
					c = b.addMenu({title:"Elements"});
									
						a.render( c, "Button", "button" );
						a.render( c, "Google Map", "googlemap" );
						a.render( c, "Heading", "heading" );
						a.render( c, "Pricing Table", "pricing" );
						a.render( c, "Skillbar", "skillbar" );
						a.render( c, "Social Icon", "social" );	
						a.render( c, "Testimonial", "testimonial" );
						a.render( c, "HTML", "html" );
					
					b.addSeparator();
					
					// Boxes
					c = b.addMenu({title:"Boxes"});
					
						a.render( c, "Primary", "primaryBox" );
						a.render( c, "Secondary", "secondaryBox" );
						a.render( c, "Inverse", "inverseBox" );
						a.render( c, "Success", "successBox" );
						a.render( c, "Warning", "warningBox" );
						a.render( c, "Danger", "dangerBox" );
						a.render( c, "Info", "infoBox" );
						
					b.addSeparator();
					
					// Highlights
					c = b.addMenu({title:"Highlights"});
					
						a.render( c, "Blue", "blueHighlight" );
						a.render( c, "Gray", "grayHighlight" );
						a.render( c, "Green", "greenHighlight" );
						a.render( c, "Red", "redHighlight" );
						a.render( c, "Yellow", "yellowHighlight" );
						
					b.addSeparator();
					
					
					// Dividers
					c = b.addMenu({title:"Dividers"});
					
						a.render( c, "Solid", "solidDivider" );
						a.render( c, "Dashed", "dashedDivider" );
						a.render( c, "Dotted", "dottedDivider" );
						a.render( c, "Double", "doubleDivider" );
						a.render( c, "Triple", "tripleDivider" );
						a.render( c, "Image", "imageDivider" );
						
					b.addSeparator();
					
					
					// jQuery
					c = b.addMenu({title:"jQuery"});
					
						a.render( c, "Accordion", "accordion" );
						a.render( c, "Tabs", "tabs" );
						a.render( c, "Toggle", "toggle" );
					
					b.addSeparator();
					
					
					// Helpers
					c = b.addMenu({title:"Other"});
					
						a.render( c, "Spacing", "spacing" );
						a.render( c, "Clear Floats", "clear" );
						a.render( c, "Center Content", "center" );
						a.render( c, "Full Width", "fullwidth" );
						a.render( c, "Code", "code" );
						a.render( c, "Pre", "pre" );
						
					
					
				});
	            
	          return btn;
			}
			return null;               
		},
		render : function(ed, title, id) {
			ed.add({
				title: title,
				onclick: function () {
					
					// Selected content
					var mceSelected = tinyMCE.activeEditor.selection.getContent();
					
					// Add highlighted content inside the shortcode when possible - yay!
					if ( mceSelected ) {
						var wcDummyContent = mceSelected;
					} else {
						var wcDummyContent = 'Sample Content';
					}
					var wcParagraphContent = '<p>Sample Content</p>';
					
					// Accordion
					if(id == "accordion") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_accordion collapse="0"][wc_accordion_section title="Section 1"]</p>' + wcParagraphContent + '<p>[/wc_accordion_section][wc_accordion_section title="Section 2"]</p>' + wcParagraphContent + '<p>[/wc_accordion_section][/wc_accordion]</p>');
					}
					
					
					
					
					// Boxes
					if(id == "primaryBox") {
						tinyMCE.activeEditor.selection.setContent('[wc_box color="primary" text_align="left"]' + wcDummyContent + '[/wc_box]');
					}
					if(id == "secondaryBox") {
						tinyMCE.activeEditor.selection.setContent('[wc_box color="secondary" text_align="left"]' + wcDummyContent + '[/wc_box]');
					}
					if(id == "inverseBox") {
						tinyMCE.activeEditor.selection.setContent('[wc_box color="inverse" text_align="left"]' + wcDummyContent + '[/wc_box]');
					}
					if(id == "successBox") {
						tinyMCE.activeEditor.selection.setContent('[wc_box color="success" text_align="left"]' + wcDummyContent + '[/wc_box]');
					}
					if(id == "warningBox") {
						tinyMCE.activeEditor.selection.setContent('[wc_box color="warning" text_align="left"]' + wcDummyContent + '[/wc_box]');
					}
					if(id == "dangerBox") {
						tinyMCE.activeEditor.selection.setContent('[wc_box color="danger" text_align="left"]' + wcDummyContent + '[/wc_box]');
					}
					if(id == "infoBox") {
						tinyMCE.activeEditor.selection.setContent('[wc_box color="info" text_align="left"]' + wcDummyContent + '[/wc_box]');
					}
					
					
					
					
					// Button
					if(id == "button") {
						tinyMCE.activeEditor.selection.setContent('[wc_button type="primary" url="http://www.wordpresscanvas.com" title="Visit Site" target="self"]' + wcDummyContent + '[/wc_button]');
					}
					
					
					
					
					// Clear Floats
					if(id == "clear") {
						tinyMCE.activeEditor.selection.setContent('[wc_clear_floats]');
					}
					
					
					
					
					// Columns
					if(id == "half-half") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_row][wc_column size="one-half" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-half" position="last"]</p>' + wcParagraphContent + '<p>[/wc_column][/wc_row]</p>');
					}
					if(id == "third-third-third") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_row][wc_column size="one-third" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-third"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-third" position="last"]</p>' + wcParagraphContent + '<p>[/wc_column][/wc_row]</p>');
					}
					if(id == "third-twothird") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_row][wc_column size="one-third" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="two-third" position="last"]</p>' + wcParagraphContent + '<p>[/wc_column][/wc_row]</p>');
					}
					if(id == "twothird-third") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_row][wc_column size="two-third" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-third" position="last"]</p>' + wcParagraphContent + '<p>[/wc_column][/wc_row]</p>');
					}
					if(id == "fourth-fourth-fourth-fourth") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_row][wc_column size="one-fourth" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth" position="last"]</p>' + wcParagraphContent + '<p>[/wc_column][/wc_row]</p>');
					}
					if(id == "fourth-half-fourth") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_row][wc_column size="one-fourth" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-half"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth" position="last"]</p>' + wcParagraphContent + '<p>[/wc_column][/wc_row]</p>');
					}
					if(id == "half-fourth-fourth") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_row][wc_column size="one-half" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth" position="last"]</p>' + wcParagraphContent + '<p>[/wc_column][/wc_row]</p>');
					}
					if(id == "fourth-fourth-half") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_row][wc_column size="one-fourth" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-half" position="last"]</p>' + wcParagraphContent + '<p>[/wc_column][/wc_row]</p>');
					}
					if(id == "fourth-three-fourth") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_row][wc_column size="one-fourth" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="three-fourth" position="last"]</p>' + wcParagraphContent + '<p>[/wc_column][/wc_row]</p>');
					}
					if(id == "three-fourth-fourth") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_row][wc_column size="three-fourth" position="first"]</p>' + wcParagraphContent + '<p>[/wc_column][wc_column size="one-fourth" position="last"]</p>' + wcParagraphContent + '<p>[/wc_column][/wc_row]</p>');
					}
					
									
				
					// Divider
					if(id == "solidDivider") {
						tinyMCE.activeEditor.selection.setContent('[wc_divider style="solid" line="single" margin_top="" margin_bottom=""]');
					}
					if(id == "dashedDivider") {
						tinyMCE.activeEditor.selection.setContent('[wc_divider style="dashed" line="single" margin_top="" margin_bottom=""]');
					}
					if(id == "dottedDivider") {
						tinyMCE.activeEditor.selection.setContent('[wc_divider style="dotted" line="single" margin_top="" margin_bottom=""]');
					}
					if(id == "doubleDivider") {
						tinyMCE.activeEditor.selection.setContent('[wc_divider style="solid" line="double" margin_top="" margin_bottom=""]');
					}
					if(id == "tripleDivider") {
						tinyMCE.activeEditor.selection.setContent('[wc_divider style="solid" line="triple" margin_top="" margin_bottom=""]');
					}
					if(id == "imageDivider") {
						tinyMCE.activeEditor.selection.setContent('[wc_divider style="image" margin_top="" margin_bottom=""]');
					}
					
					
					
					
					// Google Map
					if(id == "googlemap") {
						tinyMCE.activeEditor.selection.setContent('[wc_googlemap title="St. Paul\'s Chapel" location="209 Broadway, New York, NY 10007" zoom="10" height="250"]');
					}
					
					
					
					
					// Heading
					if(id == "heading") {
						tinyMCE.activeEditor.selection.setContent('[wc_heading type="h1" title="' + wcDummyContent + '" text_align="left"]');
					}
					
					
					
					
					// Highlight
					if(id == "blueHighlight") {
						tinyMCE.activeEditor.selection.setContent('[wc_highlight color="blue"]' + wcDummyContent + '[/wc_highlight]');
					}
					if(id == "grayHighlight") {
						tinyMCE.activeEditor.selection.setContent('[wc_highlight color="gray"]' + wcDummyContent + '[/wc_highlight]');
					}
					if(id == "greenHighlight") {
						tinyMCE.activeEditor.selection.setContent('[wc_highlight color="green"]' + wcDummyContent + '[/wc_highlight]');
					}
					if(id == "redHighlight") {
						tinyMCE.activeEditor.selection.setContent('[wc_highlight color="red"]' + wcDummyContent + '[/wc_highlight]');
					}
					if(id == "yellowHighlight") {
						tinyMCE.activeEditor.selection.setContent('[wc_highlight color="yellow"]' + wcDummyContent + '[/wc_highlight]');
					}					
					
					
					
					// Pricing
					if(id == "pricing") {
						tinyMCE.activeEditor.selection.setContent('[wc_pricing featured="yes" plan="Basic" cost="$19.99" per="per month" button_url="#" button_text="Sign Up" button_target="self" button_rel="nofollow"]<ul><li>30GB Storage</li><li>512MB Ram</li><li>10 databases</li><li>1,000 Emails</li><li>25GB Bandwidth</li></ul>[/wc_pricing]');
					}
					
					
					
					
					//Spacing
					if(id == "spacing") {
						tinyMCE.activeEditor.selection.setContent('[wc_spacing size="40px"]');
					}
					
					
					
					
					//Social
					if(id == "social") {
						tinyMCE.activeEditor.selection.setContent('[wc_social_icons align="left" size="large" display="facebook,google,twitter,pinterest,instagram,bloglovin,flickr,rss,email,custom1,custom2,custom3,custom4,custom5"]');
					}
					
					
					
					
					//Skillbar
					if(id == "skillbar") {
						tinyMCE.activeEditor.selection.setContent('[wc_skillbar title="' + wcDummyContent + '" percentage="100" color="#6adcfa"]');
					}
					
					
					
					
					//Tabs
					if(id == "tabs") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_tabgroup][wc_tab title="First Tab"]</p>'+wcParagraphContent+'<p>[/wc_tab][wc_tab title="Second Tab"]</p>'+wcParagraphContent+'<p>[/wc_tab][/wc_tabgroup]</p>');
					}
					
					
					
					//Testimonial
					if(id == "testimonial") {
						tinyMCE.activeEditor.selection.setContent('[wc_testimonial by="Wordpress Canvas" position="left"]' + wcDummyContent + '[/wc_testimonial]');
					}
					
					
					
					//Toggle
					if(id == "toggle") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_toggle title="This Is Your Toggle Title" padding="" border_width=""]</p>' + wcParagraphContent + '<p>[/wc_toggle]</p>');
					}

					if(id == "center") {
						tinyMCE.activeEditor.selection.setContent('<p>[wc_center max_width="500px" text_align="left"]</p>' + wcParagraphContent + '<p>[/wc_center]</p>');
					}
					
					
					if(id == "fullwidth") {
						tinyMCE.activeEditor.selection.setContent('[wc_fullwidth selector="#main"]' + wcDummyContent + '[/wc_fullwidth]');
					}
					
					
					if(id == "html") {
						tinyMCE.activeEditor.selection.setContent('[wc_html name="Custom Field Name"]');
					}


					if(id == "code") {
						tinyMCE.activeEditor.selection.setContent('[wc_code]' + wcDummyContent + '[/wc_code]');
					}
					

					if(id == "pre") {
						tinyMCE.activeEditor.selection.setContent('[wc_pre color="1" wrap="0" scrollable="1" linenums="0" name="Custom Field Name"]');
					}


					return false;
				}
			})
		}
	
	});
	tinymce.PluginManager.add("wc_shortcodes", tinymce.plugins.wcShortcodeMce);
})();
