# Social Likes

[![Bower version](https://badge.fury.io/bo/social-likes.png)](http://badge.fury.io/bo/social-likes)
[![Built with Grunt](https://cdn.gruntjs.com/builtwith.png)](http://gruntjs.com/)

Beautiful “like” buttons with counters for popular social networks: Facebook, Twitter, LiveJournal, etc. Uses jQuery.


## Features

- Easy to install.
- Beautiful and all in one style.
- Won’t explode your page’s layout.


## Installation and configuration

Use [interactive builder](http://sapegin.github.io/social-likes/) to generate the code.

Or install via [Bower](http://bower.io/): `$ bower install social-likes`.


## Advanced configuration

### Layout

#### Default

All buttons in a row.

```
<ul class="social-likes">
	<li class="facebook" title="Share link on Facebook">Facebook</li>
	...
</ul>
```

#### Vertical

All buttons in a column.

```
<ul class="social-likes social-likes_vertical">
	<li class="facebook" title="Share link on Facebook">Facebook</li>
	...
</ul>
```

#### Single button

One button with a counter (summ of all the networks). Opens popup with like buttons in vertical layout. Use `data-single-title` attribute to change button title.

```
<ul class="social-likes social-likes_single" data-single-title="Share me!">
	<li class="facebook" title="Share link on Facebook">Facebook</li>
	...
</ul>
```

#### Icons only

If you want to remove button titles add `social-likes_notext` class to make it looks better.

```
<ul class="social-likes social-likes_notext">
	<li class="facebook" title="Share link on Facebook"></li>
	...
</ul>
```


### Options

Options define via HTML data attributes or JavaScript parameters object.

`url`

URL of shareable page. Current page by default.

`title`

Title for Twitter, Vkontakte and LiveJournal. Current page’s title by default.

`html`

HTML code for LiveJournal button. By default <A> tag with link to current page.

`counters`

Disables “likes” counters when “no”. Default: “yes”.

`zeroes`

Show counters even when number is `0`. Default: “no”.

`single-title`

Share button title for “single button” mode. Default: “Share”.

Examples:

```html
<ul class="social-likes" data-url="http://landscapists.info/" data-title="Landscapists of Russia">
	…
</ul>
```

```html
<ul class="social-likes social-likes_single" data-single-title="This is Sharing!">
	…
</ul>
```

```js
$('.social-likes').socialLikes({
	url: 'https://github.com/sapegin/social-likes/',
	title: 'Beautiful “like” buttons with counters for popular social networks',
	counters: true,
	singleTitle: 'Share it!'
});
```

### Services specific options

#### Twitter

You can specify `via` (site’s Twitter) and `related` (any other Twitter you want to advertise) values for `<li class="twitter">`:

```html
<li class="twitter" data-via="sapegin" data-related="Landscapists">Twitter</li>
```

#### Pinterest

You should specify an image URL via data-media attribute on `<li class="pinterest">`:

```html
<li class="pinterest" data-media="http://example.com/image/url.jpg">Pinterest</li>
```

### Manual initialization

Could be useful on dynamic (AJAX) websites.

```html
<ul id="share">
	<li class="facebook">Facebook</li>
	...
</ul>
```

```javascript
$('#share').socialLikes();
```

### Dynamic URL changing

You can dynamically replace URL, title and Pinterest image without reinitialization.

```html
<ul id="share2" class="social-likes" data-url="http://example.com/" data-title="My example">
	<li class="facebook">Facebook</li>
	...
</ul>
```

```javascript
$('#share2').socialLikes({
	url: 'http://github.com/',
	title: 'GitHub',
	data: {
		media: 'http://birdwatcher.ru/i/userpic.jpg'  // Image for Pinterest button
	}
});
```

### Refreshing counters

By default counters for any uniqe URL requested only once. You can force new request with `forceUpdate` option:

```javascript
$('#share2').socialLikes({
	forceUpdate: true
});
```


### Events

#### `counter.social-likes`

Triggers for every counter.

```javascript
$('.social-likes').on('counter.social-likes', function(event, service, number) {
	// service: facebook, twitter, etc.
});
```

#### `ready.social-likes`

Triggers after all counters loaded.

```javascript
$('.social-likes').on('ready.social-likes', function(event, number) {
	// number is total number of shares
});
```

#### `popup_opened.social-likes`

Triggers after popup window opened.

```javascript
$('.social-likes').on('popup_opened.social-likes', function(event, service, win) {
	// win is popup window handler (window.open())
});
```

#### `popup_closed.social-likes`

Triggers after popup window closed.

```javascript
$('.social-likes').on('popup_closed.social-likes', function(event, service) {
	$(event.currentTarget).socialLikes({forceUpdate: true});  // Update counters
});
```

### Adding your own button

You can find some custom buttons in `contrib` folder.

Define `socialLikesButtons` hash:

```javascript
var socialLikesButtons = {
	surfingbird: {
		popupUrl: 'http://surfingbird.ru/share?url={url}',
		pupupWidth: 650,
		popupHeight: 500
	}
};
```

If you know the social network search page's url, you can make a link to results of searching in this network. There are search urls for Twitter and VKontakte by default.

```javascript
var socialLikesButtons = {
	twitter: {
		...
		searchUrl: 'https://twitter.com/search?src=typd&q={url}'
	}
};
``` 

Add some CSS:

```css
.social-likes__button_surfingbird {
	background: #f2f3f5;
	color: #596e7e;
	border-color: #ced5e2;
	}
.social-likes__icon_surfingbird {
	background: url(http://surfingbird.ru/img/share-icon.png) no-repeat 2px 3px;
	}
```

And use in like any other button:

```html
<li class="surfingbird">Surf</li>
```

See sources (`src` folder) for available options and class names and `contrib` folder for custom buttons examples.


### How to change title, description and image

You can use [Open Graph](http://ogp.me/). It works for [Facebook](http://davidwalsh.name/facebook-meta-tags), Twitter, [Google+](https://developers.google.com/+/web/snippet/), [Pinterest](http://developers.pinterest.com/rich_pins/) and [Vkontakte](http://vk.com/dev/widget_like)). 

You can add additional Twitter data using [Twitter Card](https://dev.twitter.com/docs/cards).

```html
<meta property="og:type" content="article">
<meta property="og:url" content="{page_url}">
<meta property="og:title" content="{title}">
<meta property="og:description" content="{description}">
<meta property="og:image" content="{image_url}">
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@SiteTwitter">
<meta name="twitter:creator" content="@sapegin">
```

If you’re experincing any problems with meta data try [Open Graph Debugger](https://developers.facebook.com/tools/debug/) and [Twitter Card Validator](https://dev.twitter.com/docs/cards/validation/validator).


### How to use Social Likes with Wordpress, etc.

See [wiki](https://github.com/sapegin/social-likes/wiki/How-to-use-Social-Likes-with-Wordpress,-etc.).


## Release History

The changelog can be found in the `Changelog.md` file.


---

## License

The MIT License, see the included `License.md` file.
