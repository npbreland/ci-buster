# ci-buster
"Extension" of CodeIgniter's HTML Helper that allows cache busting of script and link tags.

Do you use the CodeIgniter framework? Do you want your users to automatically get the most recent versions of your JS and CSS files? Then you should check out this extension!

To use, just drop the html_helper.php file in the app/Helpers/ directory. The two custom functions in the file will override the default behavior of the **script_tag** and **link_tag** HTML helper functions.

For each function, this extension adds the parameter $updateOnFileMod, which defaults to false so as not to disrupt existing implementations. If you pass this parameter as true, the function will add the last file modification time (using PHP's filemtime) as a version number to the end of your script/link filename. This will tell your users' browsers to retrieve a new version of the file any time that file is modified.
