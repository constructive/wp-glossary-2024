# WP Glossary

WP Glossary is an interactive glossary for WordPress.
* A glossary content type
* JavaScript for highlighting glossary terms with a hoverable tooltip

&nbsp;
## Installation
```bash
composer require constructive/wp-glossary
```
&nbsp;

If you are using the Constructive WP Theme, add the Glossary Service Provider to the providers config:
```php
return [
    \Constructive\Glossary\GlossaryServiceProvider::class
];
```
&nbsp;
If not, you should just manually copy the code from `GlossaryServiceProvider::register()` into youf `functions.php`. Kind of gross, but it should work for now.

&nbsp;
## Usage
Copy the `wp-glossary.js` and `wp-glossary.css` from the `dist/` folder into your project and enqeue those scripts.

Make a few glossary items, wrap the class of `.wp-glossary-scan` to any elements with text that you want highlighted as a glossary term, and you should be all set.

![example](https://p272.p4.n0.cdn.getcloudapp.com/items/v1uxkRgA/Screen%20Recording%202020-11-06%20at%2001.04%20AM.gif?source=social&amp;v=2afaad115d307ca5f2aa67ad78bddc25)



## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
