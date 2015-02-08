# Embed plugin for Kirby

## What is it
Adds dynamic embedding for YouTube, Vimeo, MixCloud, SoundCloud and Spotify. Custom tag creates a container with an anchor instead of an embed code. After the page is loaded a javascript parses all these tags and fetches the embed codes by calling an oEmbed PHP class that makes a curl request.

## How to install
Contents of the plugins folder should go in `site/plugins`. Add the contents of config.php to you `site/config/config.php` file and add the contents of `embed.js`, `functions.js` and `embed.css` to your assets.

## How to use
As it extends kirbytext you can use it by just typing:

```
(embed: http://vimeo.com/35302484)
```

The default placeholder text will be the url without the protocol: ‘vimeo.com/35302484’
You can also add text and image placeholders:

```
(embed: http://vimeo.com/35302484 text: <placeholder_text> image: <placeholder_image>)
```

Or use the custom field method in you templates:

```PHP
<?php echo $page->video()->embed()->html() ?>

<?php echo $page->video()->embed()->html(array(
    'text'  => 'placeholder_text',
    'image' => 'placeholder_image'
)) ?>
```

## Todo
Update the javascript in `embed.js` to be able to choose whether embed should be loaded immediately after pageload or after a tap/click by the user.
