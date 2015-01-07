# Embed plugin for Kirby

## What is it
Adds dynamic embedding for YouTube, Vimeo, MixCloud, SoundCloud and Spotify. Custom tag creates a container with an anchor instead of an embed code. After the page is loaded a javascript parses all these tags and fetches the embed codes by calling an oEmbed PHP class that makes a curl request.

## How to install
Contents of the tags and plugins folder should go in `site/tags` and `site/plugins`. Add the contents of config.php to you `site/config/config.php` file and add the contents of `embed.js`, `functions.js` and `embed.css` to your assets.

## How to use
As it extends kirbytext you can use it by just typing something like:

```
(embed: http://vimeo.com/35302484)

(embed: http://vimeo.com/35302484 autoplay: true)
```
