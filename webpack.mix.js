const MinifyHtmlWebpackPlugin = require('minify-html-webpack-plugin');
    const mix = require('laravel-mix');

    mix.webpackConfig({
        plugins: [
            new MinifyHtmlWebpackPlugin({
                afterBuild: true,
                src: './storage/framework/views',
                dest: './storage/framework/views',
                ignoreFileNameRegex: /\.(gitignore|php)$/,
                ignoreFileContentsRegex: /(<\?xml version)|(mail::message)/,
                rules: {
                    collapseBooleanAttributes: true,
                    collapseWhitespace: true,
                    removeAttributeQuotes: true,
                    removeComments: true,
                    minifyJS: true,
                }
            })
        ]
    });