const path = require('path');
module.exports = {
  mode: 'production',
  entry: './src/image-resizer.js',
  output: {
    path: path.resolve(__dirname, 'build', 'wp-frontend-image-resizer'),
    filename: 'image-resizer.min.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        include: path.resolve(__dirname, 'src'),
        exclude: /(node_modules|bower_components|build)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ["@babel/preset-env", "@babel/preset-react"]
          }
        }
      }
    ]
  },
  externals: {
    'react': 'commonjs react' 
  }
};