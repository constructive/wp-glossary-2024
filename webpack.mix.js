let mix = require('laravel-mix');
mix.copy('css/wp-glossary.css', 'dist/wp-glossary.css');
mix.js('js/index.js', 'dist/wp-glossary.js');
