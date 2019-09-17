'use strict'
const path = require('path')
const utils = require('./utils')
const webpack = require('webpack')
const config = require('./config')
const merge = require('webpack-merge')
const baseWebpackConfig = require('./webpack.base.conf')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const ScriptExtHtmlWebpackPlugin = require('script-ext-html-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')

function resolve(dir) {
    console.log(__dirname + '/../' + dir);
    return path.join(__dirname, '..', dir)
}

const env = require('./config/env')

// For NamedChunksPlugin
const seen = new Set()
const nameLength = 4

const webpackConfig = merge(baseWebpackConfig, {
    mode: 'production',
    module: {
        rules: utils.styleLoaders({
            sourceMap: config.build.productionSourceMap,
            extract: true,
            usePostCSS: true
        })
    },
    devtool: config.build.productionSourceMap ? config.build.devtool : false,
    output: {
        path: config.build.assetsRoot,
        filename: utils.assetsPath('js/[name].[chunkhash:8].js'),
        chunkFilename: utils.assetsPath('js/[name].[chunkhash:8].js')
    },
    plugins: [
        // http://vuejs.github.io/vue-loader/en/workflow/production.html
        new webpack.DefinePlugin({
            'process.env': env
        }),
        // extract css into its own file
        new MiniCssExtractPlugin({
            filename: utils.assetsPath('css/[name].[contenthash:8].css'),
            chunkFilename: utils.assetsPath('css/[name].[contenthash:8].css')
        }),
        new HtmlWebpackPlugin({
            filename: config.build.index,
            template: 'frontend/index.html',
            inject: true,
            favicon: resolve('web/favicon.ico'),
            title: 'vue-element-admin-design-bot',
            templateParameters: {
                BASE_URL: config.assetsPublicPath + config.assetsSubDirectory,
            },
            minify: {
                removeComments: true,
                collapseWhitespace: true,
                removeAttributeQuotes: true
            }
        }),
        new ScriptExtHtmlWebpackPlugin({
            //`runtime` must same as runtimeChunk name. default is `runtime`
            inline: /runtime\..*\.js$/
        }),
        // keep chunk.id stable when chunk has no name
        new webpack.NamedChunksPlugin(chunk => {
            if (chunk.name) {
                return chunk.name
            }
            const modules = Array.from(chunk.modulesIterable)
            if (modules.length > 1) {
                const hash = require('hash-sum')
                const joinedHash = hash(modules.map(m => m.id).join('_'))
                let len = nameLength
                while (seen.has(joinedHash.substr(0, len))) len++
                seen.add(joinedHash.substr(0, len))
                return `chunk-${joinedHash.substr(0, len)}`
            } else {
                return modules[0].id
            }
        }),
        // keep module.id stable when vender modules does not change
        new webpack.HashedModuleIdsPlugin(),
    ],
    optimization: {
        splitChunks: {
            chunks: 'all',
            cacheGroups: {
                libs: {
                    name: 'chunk-libs',
                    test: /[\\/]node_modules[\\/]/,
                    priority: 10,
                    chunks: 'initial'
                },
                elementUI: {
                    name: 'chunk-elementUI',
                    priority: 20,
                    test: /[\\/]node_modules[\\/]element-ui[\\/]/
                },
                commons: {
                    name: 'chunk-commons',
                    test: resolve('frontend/components'),
                    minChunks: 3,
                    priority: 5,
                    reuseExistingChunk: true
                }
            }
        },
        runtimeChunk: 'single',
        minimizer: [
            new UglifyJsPlugin({
                uglifyOptions: {
                    mangle: {
                        safari10: true
                    }
                },
                sourceMap: config.build.productionSourceMap,
                cache: true,
                parallel: true
            }),
            // Compress extracted CSS. We are using this plugin so that possible
            // duplicated CSS from different components can be deduped.
            new OptimizeCSSAssetsPlugin()
        ]
    }
})
if (config.build.productionGzip) {
    const CompressionWebpackPlugin = require('compression-webpack-plugin')

    webpackConfig.plugins.push(
        new CompressionWebpackPlugin({
            asset: '[path].gz[query]',
            algorithm: 'gzip',
            test: new RegExp(
                '\\.(' + config.build.productionGzipExtensions.join('|') + ')$'
            ),
            threshold: 10240,
            minRatio: 0.8
        })
    )
}

if (config.build.generateAnalyzerReport || config.build.bundleAnalyzerReport) {
    const BundleAnalyzerPlugin = require('webpack-bundle-analyzer')
        .BundleAnalyzerPlugin

    if (config.build.bundleAnalyzerReport) {
        webpackConfig.plugins.push(
            new BundleAnalyzerPlugin({
                analyzerPort: 8080,
                generateStatsFile: false
            })
        )
    }

    if (config.build.generateAnalyzerReport) {
        webpackConfig.plugins.push(
            new BundleAnalyzerPlugin({
                analyzerMode: 'static',
                reportFilename: 'bundle-report.html',
                openAnalyzer: false
            })
        )
    }
}

module.exports = webpackConfig
