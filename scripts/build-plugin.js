const path = require('path');
const fs = require('fs');
const package = require('../package.json');

const paths = {
  mainPhpInput: path.join(__dirname, '../src/wp-frontend-image-resizer.php'),
  mainPhpOutput: path.join(__dirname, '../build/wp-frontend-image-resizer/wp-frontend-image-resizer.php'),
};
const mainPhp = fs.readFileSync(paths.mainPhpInput)
  .toString()
  .replace(/\$version/g, package.version)
  .replace(/\$description/g, package.description);

fs.writeFileSync(paths.mainPhpOutput, mainPhp);