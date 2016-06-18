# WP Fancy Fundraising
A Wordpress Plugin that allows you to easily create a good-looking donation experience on your website. This plugin creates a page template purpose-built for donation forms, and provides a series of styles and options to configure your experience.

In the future, this plugin will also provide site-wide elements for live tallies, buttons, and more!

## How to setup a donation form

To apply the Fancy Fundraising style to a donation form:

1. **Select the Fancy Fundraising template from a page's template drop-down**
 * This template will completly overwrite your page's style with our own.
 * We provide a highly-configurable donation page, which is free from all distracting elements.
 * This is the perfect responsive canvas on which to build your donation form.

2. **Configure the page's design via the Wordpress Customiser** (found in the top Admin Bar or under the "Appearence" menu).
 * Confugure donation page elements such as colours and images
 * Force SSL on the page
 * Apply some common fixes to get the magic padlock to appear in your browser's address bar

You can also set a featured image on each specific page.

## Gravity Form Styling

We provide some commonly needed Gravity Form styling. These are applied by inserting classes into the form's editor.

### Columns

You can set the form to display in either one, two or three column modes. To enable this

1. Go to Form Settings > Form Settings
2. Find the field "CSS Class Name"
3. Add the class "two-column" or "three-column"
4. Save your settings

To break the form into each column:

1. Go to the Form Field Editor
2. Add a 'Section Break' where you want each column to end
3. Open the "Appearence" tab for the Section Break
4. Add the column "gform_column"

### Blocky Headings

Add the class "field-heading" to any form element to have it's label transformed into a nice big heading with a coloured background. You can also add a HTML Section with the same class and your text wrapped in a 'h3' tag.

### Big Option Buttons

If you want to turn radio buttons into big buttons, add the class "radio-button-buttons" to the radio button field.
