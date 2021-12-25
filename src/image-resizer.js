import Resizer from 'react-image-file-resizer';

const resizeImageBeforeUpload = function (file, maxWidth, maxHeight, quality) {
  const outputFormat = file.type === 'image/jpeg' ? 'JPEG'
    : (file.type === 'image/png' ? 'PNG' : null);
  if (!outputFormat) return Promise.resolve(file); // unsupported format
  return new Promise((resolve) => {
    Resizer.imageFileResizer(
      file,
      maxWidth,
      maxHeight,
      outputFormat,
      quality,
      0, // rotate
      (f) => resolve(f),
      'file'
    );
  });
}

setTimeout(() => {
  console.log('setup image resizer');
  window.wp.apiFetch.use(async function (options, next) {
    if (
      options.path === '/wp/v2/media'
      && options.method && options.method.toLowerCase() === 'post'
      && options.body && options.body.get('file')
    ) {
      const originalFile = options.body.get('file');
      const newFile = await resizeImageBeforeUpload(
        originalFile,
        window.FRONTEND_IMAGE_RESIZE.width,
        window.FRONTEND_IMAGE_RESIZE.height,
        window.FRONTEND_IMAGE_RESIZE.quality
      );
      options.body.set('file', newFile);
    }
    return next(options);
  });
}, 1000);
