![Fancy Fundraising - Wordpress Plugin](http://mediarealm.com.au/wp-content/uploads/2016/06/Fancy-Fundraising-LogoFull.jpg)

# [WP Fancy Fundraising](http://mediarealm.com.au/wordpress-plugins/fancy-fundraising/)
A Wordpress Plugin that allows you to easily create a good-looking donation experience on your website. This plugin creates a page template purpose-built for donation forms, and provides a series of styles and options to configure your experience. [Visit our official website](http://mediarealm.com.au/wordpress-plugins/fancy-fundraising/).

You can also create a simple Tally Bar to remind donors of your current tally, the remaining need, and prompt them to give.

In the future, this plugin will also provide more site-wide elements such as more complex live tallies, buttons, and more!

## How to setup a donation form

To apply the Fancy Fundraising style to a donation form:

1. **Select the Fancy Fundraising template from a page's template drop-down**
 * This template will completly overwrite your page's style with our own.
 * We provide a highly-configurable donation page, which is free from all distracting elements.
 * This is the perfect responsive canvas on which to build your donation form.
 * ![Template Selector Screenshot](http://mediarealm.com.au/wp-content/uploads/2016/06/Fancy-Fundraising-Screenshot-TemplateDropdown.png)

2. **Configure the page's design via the Wordpress Customiser** (found in the top Admin Bar or under the "Appearence" menu).
 * Confugure donation page elements such as colours and images
 * Force SSL on the page
 * Apply some common fixes to get the magic padlock to appear in your browser's address bar
 * ![Wordpress Customiser Screenshot](http://mediarealm.com.au/wp-content/uploads/2016/06/Fancy-Fundraising-Screenshot-Customiser.png)

You can also set a featured image on each specific page and have it appear at the top of the donation page.

## How to setup a Tally Bar

![Tally Bar - Style 1 - Screenshot](http://mediarealm.com.au/wp-content/uploads/2016/06/FancyFundraising-TallyBar1-Screenshot1.png)

To create a Tally Bar like the one above (using your own graphics, text and colours), embed the following shortcode in a page, post or HTML widget and customise the settings.

> [fancyfundraising_tallybar1 min-height="150px" logo="/path/to/logo.png" bgimg="/path/to/background.jpg" bgcol="#694CC4" color="#AF0000" line1="Current Tally: {pftally_dollarscurrent} / {pftally_dollarsgoal}" line2="We Still Need Your Support! {pftally_dollarsremaining} to go!"]

You can embed other shortcodes within the attributes by replacing square brackets with curly brackets (e.g. replace [ with { within the attributes).

This Tally Bar is fully responsive, and embeds portions of the Zurb Foundation 6 framework in a special low-conflict mode.

## Gravity Form Styling

We provide some commonly needed Gravity Form styling. These are applied by inserting classes into the form's editor.

### Columns

You can set the form to display in either one, two or three column modes. To enable this

1. Go to Form Settings > Form Settings
2. Find the field "CSS Class Name"
3. Add the class "two-column" or "three-column"
4. Save your settings

![Form Column Class - Setup Screenshot](http://mediarealm.com.au/wp-content/uploads/2016/06/Fancy-Fundraising-Screenshot-FormColsClass.png)

To break the form into each column:

1. Go to the Form Field Editor
2. Add a 'Section Break' where you want each column to end
3. Open the "Appearence" tab for the Section Break
4. Add the column "gform_column"

![Form Column Class - Setup Screenshot](http://mediarealm.com.au/wp-content/uploads/2016/06/Fancy-Fundraising-Screenshot-SectionBreakColClass.png)

### Blocky Headings

Add the class "field-heading" to any form element to have it's label transformed into a nice big heading with a coloured background. You can also add a HTML Section with the same class and your text wrapped in a 'h3' tag.

![Heading Class - Setup Screenshot](http://mediarealm.com.au/wp-content/uploads/2016/06/Fancy-Fundraising-Screenshot-HeadingHTMLClass.png)

### Big Option Buttons

If you want to turn radio buttons into big buttons, add the class "radio-button-buttons" to the radio button field.

![Radio Button Buttons Class - Setup Screenshot](http://mediarealm.com.au/wp-content/uploads/2016/06/Fancy-Fundraising-Screenshot-RadioButtonButtonsClass.png)
