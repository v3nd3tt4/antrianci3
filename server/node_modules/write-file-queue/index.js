var fs = require('fs')
    , doWhile = require('dank-do-while')
    ;

module.exports = function (options) {
    var wq =  new WriteQueue(options);

    return wq.write.bind(wq);
};

function WriteQueue(options) {
    var self = this;
    
    self.options = options || {};
    self.queue = [];
    self.running = false;
    self.index = 0;

    self.options.retries = self.options.retries || 1000;
    self.options.waitTime = self.options.waitTime || 1000;
    self.options.debug = self.options.debug || false;
}

WriteQueue.prototype.write = function (path, str, callback) {
    var self = this;
    
    self.queue.push([path, str, callback, 0, self.index++]);
    self.process();
};

WriteQueue.prototype.process = function () {
    var self = this;
    
    //if the queue is empty or we are already in a running state, then
    //don't continue to process
    if (!self.queue.length || self.running) {
        return;
    }
    
    self.running = true;
    
    doWhile(function (next) {
        var writeReq = self.queue[0]
            , path = writeReq[0]
            , string = writeReq[1]
            , callback = writeReq[2]
            , index = writeReq[4]
            ;
        
        self.options.debug && self.options.debug('Attempting to write to file #%s @ %s'
            , index, (new Date()).getTime());
    
        fs.writeFile(path, string, function (err) {
            self.options.debug && self.options.debug('Callback from writeFile for file #%s @ %s'
                , index, (new Date()).getTime());

            if (err) {
                self.options.debug && self.options.debug('Error occurred for writeFile for file #%s @ %s'
                    , index, (new Date()).getTime());

                self.options.debug && self.options.debug(err);
                
                writeReq[3] += 1;
                
                //we have tried more times than allowed, so bail
                if (writeReq[3] > self.options.retries) {
                    //drop this write request out of the queue
                    self.queue.shift();
                    
                    //call the callback for the original write request
                    callback(err, writeReq);
                    
                    //return to the top of doWhile if self.queue.length is truthy
                    setTimeout(function () {
                        next(self.queue.length);
                    }, self.options.waitTime);

                    return;
                }
                
                //try again in 1000ms
                setTimeout(function () {
                    //return to the top of doWhile if self.queue.length is truthy
                    next(self.queue.length);
                }, self.options.waitTime);
            }
            else {
                //remove this request from the queue since we successfully
                //wrote it.
                self.queue.shift();
                
                //call the callback for the original write request
                callback(null, true);
                
                //return to the top of doWhile if self.queue.length is truthy
                setTimeout(function () {
                    next(self.queue.length);
                }, self.options.waitTime);

                return;
            }
        });
    }, function () {
        //done processing
        
        self.running = false;
    });
}
