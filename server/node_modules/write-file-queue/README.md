node-write-file-queue
---------------------

A writeFile queue which will re-attempt to write files after errors occur. The
writes are delayed by the `waitTime` option and will re-occurr up to `retries`
many times.

install
-------

```bash
npm install write-file-queue
```

example/usage
-------------

```js
var writeFile = require('write-file-queue')({
    retries : 1000 /* number of write attempts before failing */
    , waitTime : 1000 /* number of milliseconds to wait between write attempts*/ 
    , debug : console.error /* optionally pass a function to do dump debug information to */
});

writeFile('/dev/usb/lp0', 'data to send to lp0', function (err) {
	if (err) {
		console.log('Write ultimately failed', err);
	}
});
```

license
-------

MIT
