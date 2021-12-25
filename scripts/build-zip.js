const path = require('path');
const AdmZip = require('adm-zip');
const zip = new AdmZip();

zip.addLocalFolder(
  path.join(__dirname, '../build/wp-frontend-image-resizer'),
  '/wp-frontend-image-resizer'
);

zip.writeZip(path.join(__dirname, '../build/wp-frontend-image-resizer.zip'));