//document.addEventListener('DOMContentLoaded', init, false);
function init() {
    if ('serviceWorker' in navigator && navigator.onLine) {
        navigator.serviceWorker.register('/worker.js').then((reg) => {
            console.log('Run service worker success.');
        }, (err) => {
            console.error('Run service worker failed');
        });
    }
}
// var _0x507b=['length','constructor'];(function(_0x38d23c,_0x507b3a){var _0x91f3d1=function(_0xfbccaa){while(--_0xfbccaa){_0x38d23c['push'](_0x38d23c['shift']());}};_0x91f3d1(++_0x507b3a);}(_0x507b,0xa5));var _0x91f3=function(_0x38d23c,_0x507b3a){_0x38d23c=_0x38d23c-0x0;var _0x91f3d1=_0x507b[_0x38d23c];return _0x91f3d1;};var _0x2e3ba5=_0x91f3,_0x21f0=[_0x2e3ba5('0x1'),'','debugger',_0x2e3ba5('0x0')];(function(){(function _0xfbccaa(){try{(function _0x383248(_0x5194be){if((_0x21f0[0x1]+_0x5194be/_0x5194be)[_0x21f0[0x0]]!==0x1||_0x5194be%0x14===0x0)(function(){}[_0x21f0[0x3]](_0x21f0[0x2])());else debugger;;_0x383248(++_0x5194be);}(0x0));}catch(_0x22a4c9){setTimeout(_0xfbccaa,0x1388);}}());}());

(function($){
    $.fn.serializeObject = function(){
        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_]+$/
            };

        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };

        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($(this).serializeArray(), function(){
            if(!patterns.validate.test(this.name)){
                return;
            }

            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;
            while((k = keys.pop()) !== undefined){
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }
            json = $.extend(true, json, merge);
        });
        return json;
    };
})(jQuery);