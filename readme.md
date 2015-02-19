# Embed plugin for Kirby

## What is it
Adds dynamic embedding for YouTube, Vimeo, MixCloud, SoundCloud and Spotify. Custom tag creates a container with an anchor instead of an embed code. After the page is loaded a javascript parses all these tags and fetches the embed codes by calling an oEmbed PHP class that makes a curl request.

## How to install
Contents of the plugins folder should go in `site/plugins`. Add the contents of `embed.js`, `functions.js` and `embed.css` to your assets. You can change the class of the embed by adding an option to your `config.php`: `c::set('embed.class', 'embed');`.

## How to use
As it extends kirbytext you can use it by just typing:

```
(embed: http://vimeo.com/35302484)
```

The default alt text will be the url without the protocol: ‘vimeo.com/35302484’

```
(embed: http://vimeo.com/35302484)
```

You can also add your own alt and poster image:

```
(embed: http://vimeo.com/35302484 alt: <alt_text> poster: <poster_image>)
```

Or use the helper method in you templates and snippets:

```PHP
<?php echo embed($page->field(), $alt, $poster) ?>
```

Alternatively you can use the custom field method:

```PHP
<?php echo $page->field()->embed($alt, $poster) ?>
```

## Todo
Update the javascript in `embed.js` to be able to choose whether embed should be loaded immediately after pageload or after a tap/click by the user.
