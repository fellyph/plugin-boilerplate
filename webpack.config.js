const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const config = {
	module: {
		rules: [
			{
				test: /\.m?js$/,
				exclude: /(node_modules|bower_components)/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env']
					}
				}
			},
			{
				test: /\.(sa|sc|c)ss$/,
				use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
			}
		]
	},
	plugins: [new MiniCssExtractPlugin({
		filename: '../../css/[name]/[name].css',
	})],
};

const adminConfig =  Object.assign({}, config, {
	entry: {
		admin: [
			__dirname + "/assets/source/js/admin/fellyph-test-admin.js",
			__dirname + "/assets/source/sass/admin/fellyph-test-admin.scss"
		]
	},
	output: {
    path: __dirname + '/assets/js/admin',
    filename: '[name].js',
    publicPath: '/'
	},
});

const frontConfig =  Object.assign({}, config, {
	entry: {
		front: [
			__dirname + "/assets/source/js/frontend/fellyph-test.js",
			__dirname + "/assets/source/sass/frontend/fellyph-test.scss"
		]
	},
	output: {
    path: __dirname + '/assets/js/front',
    filename: '[name].js',
    publicPath: '/'
	},
});

module.exports = [
	adminConfig,
	frontConfig
]
