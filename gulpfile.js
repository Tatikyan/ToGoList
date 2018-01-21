var elixir = require('laravel-elixir');

require('laravel-elixir-webpack');
elixir(function(mix) {
    mix.webpack.sass([
        'app.scss',
        'ToGoList.scss'
    ]);
});
