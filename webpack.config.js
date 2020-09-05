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
				test: /\.js$/,
				use: 'babel-loader',
				exclude: [
					/node_modules/
				]
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
