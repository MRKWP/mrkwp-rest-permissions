# Fix Disclosure of Users Information via Wordpress API

MRK Rest Permissions Plugin by MRK WP

This plugin is a simple adjustment to make your user end points disappear (serve 404) for non-logged in users.

This is a perceived vulernability in WordPress.

The attacker will generally grab a list of users from the WordPress API, and then attack the login with the list of users and try and brute force the password field.

Alot of audits and Essential 8 security teams will ask this to be closed.

It will be identified as a "medium" security risk.

## FAQ

### Should the plugin serve a 403 - Forbidden?

Yes it should, however we found that updating the permission_callback inside an existing rest path was difficult.

This simple fix adjusts the api so that a user has to be logged in to see the user list.

### Can I just turn off the end point for all users even when logged in?

No. The WordPress admin interface and block editor require the API to be readable. This is why we check for the Logged In user in our code.


## Changelog

### 1.0.1
- Removed PSR-4 SETUP
- Shifted the remove REST users function to the main plugin fuction

### 1.0.0
- Initial setup of plugin
