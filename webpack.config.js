module.exports = {
  entry: __dirname + "/assets/source/js/admin/fellyph-test-admin.js",
  output: {
    path: __dirname + '/assets/js/admin',
    filename: 'fellyph-test-admin.js',
    publicPath: '/'
  },
  module: {
      rules: [
      ]
  }
};
