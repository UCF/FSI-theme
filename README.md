FSI-theme
=========

Wordpress theme for new Florida Space Institute site. Based off of bootstrap branch of Generic theme.


##Installation
Activate theme, as usual

Settings > Reading > Front page displays option should be set to "Your Latest Posts"

Permalinks should be set to Post Name

Clear out all widgets from sidebar and other areas (Below the Fold sections are not used in this theme).  Sidebar should be completely empty.

Create a page called 'Home' and a page called 'News and Events'.  These must be named exactly to work correctly.

Create a page called 'About'. Each subheader should have an id that corresponds to the site navigation (e.g., < h3 id="History" >History< /h3 >).  See main navigation structure below.

Create four new navigation menus: one for the main site navigation, one for Programs and Projects links, one for Educational Partners links, and one for Corporate Partners.


Main navigation menu should use this structure:
* About (page)
  * History (anchor link, #History)
  * Mission (anchor link, #Mission)
  * Structure (anchor link, #Structure)
  * Partners (anchor link, #Partners)
* Personnel (page)
* News and Events (page)
* Seminars (page)
* Contact (page)

Assign each navigation menu to the four provided menu slots:
  * Main Navigation should be the main site navigation menu, 
  * Programs and Projects should be assigned to Secondary Nav 1,
  * Corporate Partners should be assigned to Secondary Nav 2,
  * Educational Partners should be assigned to Secondary Nav 3.

In Theme Options > Site, add the Organization Name (Florida Space Institute), Street Address (12443 Research Parkway), City/State/ZIP (Orlando, Florida 32333-3333), and Phone number (407-823-0000)

In Theme Options > Social, add the Facebook URL (http://www.facebook.com/pages/Florida-Space-Institute-FSI/353593684667181) and Twitter URL (tbd)


##Notes
This site uses the Person custom post type and Organizational Groups taxonomy.

The Home page will pull its page content, as well as display two posts.  If any posts exist that are tagged as 'featured', they will display there; otherwise it'll pull the two most recent posts.

News and Events has its own page template.  Content on the page will be displayed at the top; the 10 most recent posts will output below.

The sidebar is controlled entirely in sidebar.php, except for the social links/address, which are outputted via the function get_sidebar_extras() in functions-base.php.

Tables on the Personnel page are responsive, but due to Modernizr limitations, you'll need to refresh the page after adjusting your browser size if you're checking responsiveness on a desktop browser.
