# Fix Disclosure of Users Information via Wordpress API

MRK Rest Permissions Plugin by MRK WP

This plugin is a simple adjustment to make your user end points require authentication (serve 401) for non-logged in users without the edit post capability.

This is a perceived vulernability in WordPress.

The attacker will generally grab a list of users from the WordPress API, and then attack the login with the list of users and try and brute force the password field.

This is because this end point is not authenticated by default.

Alot of audits and Essential 8 security teams will ask this to be closed.

It will be identified as a "medium" security risk.

## FAQ

### What does the end point return when it is called?

The rest API for users will return a 401 response - Unauthorised.

### Can I just turn off the end point for all users even when logged in?

No. The WordPress admin interface and block editor require the API to be readable or return a 401.

The user / author selection box inside the Block Editor will disappear when a 401 is returned.

If a 404 is returned it creates errors in the block editor.

See "User Information Disclosure via REST API CVE 2017-5487."

Reference URL for CVE: <https://www.cvedetails.com/cve/CVE-2017-5487/>

## Changelog

### 1.0.2
- Changed to use a permission callback model inside the rest endpoints.
- Now we have an update that does the permission properly with a 401 response.
- Remove some of the custom PHPCS sniffers that were used for PSR-4 autoloader.
- updated readme FAQ and description of post.
- Fix for "User Information Disclosure via REST API CVE 2017-5487".

### 1.0.1
- Removed PSR-4 SETUP
- Shifted the remove REST users function to the main plugin fuction

### 1.0.0
- Initial setup of plugin
