module.exports = {
  entry: __dirname + "/assets/source/js/admin/fellyph-test-admin.js",
  output: {
    path: __dirname + '/assets/js/admin',
    filename: 'fellyph-test-admin.js',
    publicPath: '/'
  },
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
				test: /\.(sass|scss)$/,
				use: [{
						loader: "style-loader"
				}, {
						loader: "css-loader"
				}, {
						loader: "sass-loader"
				}]
			}
		]
  }
};
