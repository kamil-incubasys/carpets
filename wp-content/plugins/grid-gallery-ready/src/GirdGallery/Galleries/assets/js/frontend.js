(function ($, undefined) {

    /*!
     * imagesLoaded PACKAGED v3.1.6
     * JavaScript is all like "You images are done yet or what?"
     * MIT License
     */

    (function(){function e(){}function t(e,t){for(var n=e.length;n--;)if(e[n].listener===t)return n;return-1}function n(e){return function(){return this[e].apply(this,arguments)}}var i=e.prototype,r=this,o=r.EventEmitter;i.getListeners=function(e){var t,n,i=this._getEvents();if("object"==typeof e){t={};for(n in i)i.hasOwnProperty(n)&&e.test(n)&&(t[n]=i[n])}else t=i[e]||(i[e]=[]);return t},i.flattenListeners=function(e){var t,n=[];for(t=0;e.length>t;t+=1)n.push(e[t].listener);return n},i.getListenersAsObject=function(e){var t,n=this.getListeners(e);return n instanceof Array&&(t={},t[e]=n),t||n},i.addListener=function(e,n){var i,r=this.getListenersAsObject(e),o="object"==typeof n;for(i in r)r.hasOwnProperty(i)&&-1===t(r[i],n)&&r[i].push(o?n:{listener:n,once:!1});return this},i.on=n("addListener"),i.addOnceListener=function(e,t){return this.addListener(e,{listener:t,once:!0})},i.once=n("addOnceListener"),i.defineEvent=function(e){return this.getListeners(e),this},i.defineEvents=function(e){for(var t=0;e.length>t;t+=1)this.defineEvent(e[t]);return this},i.removeListener=function(e,n){var i,r,o=this.getListenersAsObject(e);for(r in o)o.hasOwnProperty(r)&&(i=t(o[r],n),-1!==i&&o[r].splice(i,1));return this},i.off=n("removeListener"),i.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},i.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},i.manipulateListeners=function(e,t,n){var i,r,o=e?this.removeListener:this.addListener,s=e?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp)for(i=n.length;i--;)o.call(this,t,n[i]);else for(i in t)t.hasOwnProperty(i)&&(r=t[i])&&("function"==typeof r?o.call(this,i,r):s.call(this,i,r));return this},i.removeEvent=function(e){var t,n=typeof e,i=this._getEvents();if("string"===n)delete i[e];else if("object"===n)for(t in i)i.hasOwnProperty(t)&&e.test(t)&&delete i[t];else delete this._events;return this},i.removeAllListeners=n("removeEvent"),i.emitEvent=function(e,t){var n,i,r,o,s=this.getListenersAsObject(e);for(r in s)if(s.hasOwnProperty(r))for(i=s[r].length;i--;)n=s[r][i],n.once===!0&&this.removeListener(e,n.listener),o=n.listener.apply(this,t||[]),o===this._getOnceReturnValue()&&this.removeListener(e,n.listener);return this},i.trigger=n("emitEvent"),i.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},i.setOnceReturnValue=function(e){return this._onceReturnValue=e,this},i._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},i._getEvents=function(){return this._events||(this._events={})},e.noConflict=function(){return r.EventEmitter=o,e},"function"==typeof define&&define.amd?define("eventEmitter/EventEmitter",[],function(){return e}):"object"==typeof module&&module.exports?module.exports=e:this.EventEmitter=e}).call(this),function(e){function t(t){var n=e.event;return n.target=n.target||n.srcElement||t,n}var n=document.documentElement,i=function(){};n.addEventListener?i=function(e,t,n){e.addEventListener(t,n,!1)}:n.attachEvent&&(i=function(e,n,i){e[n+i]=i.handleEvent?function(){var n=t(e);i.handleEvent.call(i,n)}:function(){var n=t(e);i.call(e,n)},e.attachEvent("on"+n,e[n+i])});var r=function(){};n.removeEventListener?r=function(e,t,n){e.removeEventListener(t,n,!1)}:n.detachEvent&&(r=function(e,t,n){e.detachEvent("on"+t,e[t+n]);try{delete e[t+n]}catch(i){e[t+n]=void 0}});var o={bind:i,unbind:r};"function"==typeof define&&define.amd?define("eventie/eventie",o):e.eventie=o}(this),function(e,t){"function"==typeof define&&define.amd?define(["eventEmitter/EventEmitter","eventie/eventie"],function(n,i){return t(e,n,i)}):"object"==typeof exports?module.exports=t(e,require("eventEmitter"),require("eventie")):e.imagesLoaded=t(e,e.EventEmitter,e.eventie)}(this,function(e,t,n){function i(e,t){for(var n in t)e[n]=t[n];return e}function r(e){return"[object Array]"===d.call(e)}function o(e){var t=[];if(r(e))t=e;else if("number"==typeof e.length)for(var n=0,i=e.length;i>n;n++)t.push(e[n]);else t.push(e);return t}function s(e,t,n){if(!(this instanceof s))return new s(e,t);"string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=o(e),this.options=i({},this.options),"function"==typeof t?n=t:i(this.options,t),n&&this.on("always",n),this.getImages(),a&&(this.jqDeferred=new a.Deferred);var r=this;setTimeout(function(){r.check()})}function c(e){this.img=e}function f(e){this.src=e,v[e]=this}var a=e.jQuery,u=e.console,h=u!==void 0,d=Object.prototype.toString;s.prototype=new t,s.prototype.options={},s.prototype.getImages=function(){this.images=[];for(var e=0,t=this.elements.length;t>e;e++){var n=this.elements[e];"IMG"===n.nodeName&&this.addImage(n);var i=n.nodeType;if(i&&(1===i||9===i||11===i))for(var r=n.querySelectorAll("img"),o=0,s=r.length;s>o;o++){var c=r[o];this.addImage(c)}}},s.prototype.addImage=function(e){var t=new c(e);this.images.push(t)},s.prototype.check=function(){function e(e,r){return t.options.debug&&h&&u.log("confirm",e,r),t.progress(e),n++,n===i&&t.complete(),!0}var t=this,n=0,i=this.images.length;if(this.hasAnyBroken=!1,!i)return this.complete(),void 0;for(var r=0;i>r;r++){var o=this.images[r];o.on("confirm",e),o.check()}},s.prototype.progress=function(e){this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded;var t=this;setTimeout(function(){t.emit("progress",t,e),t.jqDeferred&&t.jqDeferred.notify&&t.jqDeferred.notify(t,e)})},s.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";this.isComplete=!0;var t=this;setTimeout(function(){if(t.emit(e,t),t.emit("always",t),t.jqDeferred){var n=t.hasAnyBroken?"reject":"resolve";t.jqDeferred[n](t)}})},a&&(a.fn.imagesLoaded=function(e,t){var n=new s(this,e,t);return n.jqDeferred.promise(a(this))}),c.prototype=new t,c.prototype.check=function(){var e=v[this.img.src]||new f(this.img.src);if(e.isConfirmed)return this.confirm(e.isLoaded,"cached was confirmed"),void 0;if(this.img.complete&&void 0!==this.img.naturalWidth)return this.confirm(0!==this.img.naturalWidth,"naturalWidth"),void 0;var t=this;e.on("confirm",function(e,n){return t.confirm(e.isLoaded,n),!0}),e.check()},c.prototype.confirm=function(e,t){this.isLoaded=e,this.emit("confirm",this,t)};var v={};return f.prototype=new t,f.prototype.check=function(){if(!this.isChecked){var e=new Image;n.bind(e,"load",this),n.bind(e,"error",this),e.src=this.src,this.isChecked=!0}},f.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},f.prototype.onload=function(e){this.confirm(!0,"onload"),this.unbindProxyEvents(e)},f.prototype.onerror=function(e){this.confirm(!1,"onerror"),this.unbindProxyEvents(e)},f.prototype.confirm=function(e,t){this.isConfirmed=!0,this.isLoaded=e,this.emit("confirm",this,t)},f.prototype.unbindProxyEvents=function(e){n.unbind(e.target,"load",this),n.unbind(e.target,"error",this)},s});

    /*!
     * Masonry PACKAGED v3.1.5
     * Cascading grid layout library
     * http://masonry.desandro.com
     * MIT License
     * by David DeSandro
     */

    !function(a){function b(){}function c(a){function c(b){b.prototype.option||(b.prototype.option=function(b){a.isPlainObject(b)&&(this.options=a.extend(!0,this.options,b))})}function e(b,c){a.fn[b]=function(e){if("string"==typeof e){for(var g=d.call(arguments,1),h=0,i=this.length;i>h;h++){var j=this[h],k=a.data(j,b);if(k)if(a.isFunction(k[e])&&"_"!==e.charAt(0)){var l=k[e].apply(k,g);if(void 0!==l)return l}else f("no such method '"+e+"' for "+b+" instance");else f("cannot call methods on "+b+" prior to initialization; attempted to call '"+e+"'")}return this}return this.each(function(){var d=a.data(this,b);d?(d.option(e),d._init()):(d=new c(this,e),a.data(this,b,d))})}}if(a){var f="undefined"==typeof console?b:function(a){console.error(a)};return a.bridget=function(a,b){c(b),e(a,b)},a.bridget}}var d=Array.prototype.slice;"function"==typeof define&&define.amd?define("jquery-bridget/jquery.bridget",["jquery"],c):c(a.jQuery)}(window),function(a){function b(b){var c=a.event;return c.target=c.target||c.srcElement||b,c}var c=document.documentElement,d=function(){};c.addEventListener?d=function(a,b,c){a.addEventListener(b,c,!1)}:c.attachEvent&&(d=function(a,c,d){a[c+d]=d.handleEvent?function(){var c=b(a);d.handleEvent.call(d,c)}:function(){var c=b(a);d.call(a,c)},a.attachEvent("on"+c,a[c+d])});var e=function(){};c.removeEventListener?e=function(a,b,c){a.removeEventListener(b,c,!1)}:c.detachEvent&&(e=function(a,b,c){a.detachEvent("on"+b,a[b+c]);try{delete a[b+c]}catch(d){a[b+c]=void 0}});var f={bind:d,unbind:e};"function"==typeof define&&define.amd?define("eventie/eventie",f):"object"==typeof exports?module.exports=f:a.eventie=f}(this),function(a){function b(a){"function"==typeof a&&(b.isReady?a():f.push(a))}function c(a){var c="readystatechange"===a.type&&"complete"!==e.readyState;if(!b.isReady&&!c){b.isReady=!0;for(var d=0,g=f.length;g>d;d++){var h=f[d];h()}}}function d(d){return d.bind(e,"DOMContentLoaded",c),d.bind(e,"readystatechange",c),d.bind(a,"load",c),b}var e=a.document,f=[];b.isReady=!1,"function"==typeof define&&define.amd?(b.isReady="function"==typeof requirejs,define("doc-ready/doc-ready",["eventie/eventie"],d)):a.docReady=d(a.eventie)}(this),function(){function a(){}function b(a,b){for(var c=a.length;c--;)if(a[c].listener===b)return c;return-1}function c(a){return function(){return this[a].apply(this,arguments)}}var d=a.prototype,e=this,f=e.EventEmitter;d.getListeners=function(a){var b,c,d=this._getEvents();if(a instanceof RegExp){b={};for(c in d)d.hasOwnProperty(c)&&a.test(c)&&(b[c]=d[c])}else b=d[a]||(d[a]=[]);return b},d.flattenListeners=function(a){var b,c=[];for(b=0;b<a.length;b+=1)c.push(a[b].listener);return c},d.getListenersAsObject=function(a){var b,c=this.getListeners(a);return c instanceof Array&&(b={},b[a]=c),b||c},d.addListener=function(a,c){var d,e=this.getListenersAsObject(a),f="object"==typeof c;for(d in e)e.hasOwnProperty(d)&&-1===b(e[d],c)&&e[d].push(f?c:{listener:c,once:!1});return this},d.on=c("addListener"),d.addOnceListener=function(a,b){return this.addListener(a,{listener:b,once:!0})},d.once=c("addOnceListener"),d.defineEvent=function(a){return this.getListeners(a),this},d.defineEvents=function(a){for(var b=0;b<a.length;b+=1)this.defineEvent(a[b]);return this},d.removeListener=function(a,c){var d,e,f=this.getListenersAsObject(a);for(e in f)f.hasOwnProperty(e)&&(d=b(f[e],c),-1!==d&&f[e].splice(d,1));return this},d.off=c("removeListener"),d.addListeners=function(a,b){return this.manipulateListeners(!1,a,b)},d.removeListeners=function(a,b){return this.manipulateListeners(!0,a,b)},d.manipulateListeners=function(a,b,c){var d,e,f=a?this.removeListener:this.addListener,g=a?this.removeListeners:this.addListeners;if("object"!=typeof b||b instanceof RegExp)for(d=c.length;d--;)f.call(this,b,c[d]);else for(d in b)b.hasOwnProperty(d)&&(e=b[d])&&("function"==typeof e?f.call(this,d,e):g.call(this,d,e));return this},d.removeEvent=function(a){var b,c=typeof a,d=this._getEvents();if("string"===c)delete d[a];else if(a instanceof RegExp)for(b in d)d.hasOwnProperty(b)&&a.test(b)&&delete d[b];else delete this._events;return this},d.removeAllListeners=c("removeEvent"),d.emitEvent=function(a,b){var c,d,e,f,g=this.getListenersAsObject(a);for(e in g)if(g.hasOwnProperty(e))for(d=g[e].length;d--;)c=g[e][d],c.once===!0&&this.removeListener(a,c.listener),f=c.listener.apply(this,b||[]),f===this._getOnceReturnValue()&&this.removeListener(a,c.listener);return this},d.trigger=c("emitEvent"),d.emit=function(a){var b=Array.prototype.slice.call(arguments,1);return this.emitEvent(a,b)},d.setOnceReturnValue=function(a){return this._onceReturnValue=a,this},d._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},d._getEvents=function(){return this._events||(this._events={})},a.noConflict=function(){return e.EventEmitter=f,a},"function"==typeof define&&define.amd?define("eventEmitter/EventEmitter",[],function(){return a}):"object"==typeof module&&module.exports?module.exports=a:this.EventEmitter=a}.call(this),function(a){function b(a){if(a){if("string"==typeof d[a])return a;a=a.charAt(0).toUpperCase()+a.slice(1);for(var b,e=0,f=c.length;f>e;e++)if(b=c[e]+a,"string"==typeof d[b])return b}}var c="Webkit Moz ms Ms O".split(" "),d=document.documentElement.style;"function"==typeof define&&define.amd?define("get-style-property/get-style-property",[],function(){return b}):"object"==typeof exports?module.exports=b:a.getStyleProperty=b}(window),function(a){function b(a){var b=parseFloat(a),c=-1===a.indexOf("%")&&!isNaN(b);return c&&b}function c(){for(var a={width:0,height:0,innerWidth:0,innerHeight:0,outerWidth:0,outerHeight:0},b=0,c=g.length;c>b;b++){var d=g[b];a[d]=0}return a}function d(a){function d(a){if("string"==typeof a&&(a=document.querySelector(a)),a&&"object"==typeof a&&a.nodeType){var d=f(a);if("none"===d.display)return c();var e={};e.width=a.offsetWidth,e.height=a.offsetHeight;for(var k=e.isBorderBox=!(!j||!d[j]||"border-box"!==d[j]),l=0,m=g.length;m>l;l++){var n=g[l],o=d[n];o=h(a,o);var p=parseFloat(o);e[n]=isNaN(p)?0:p}var q=e.paddingLeft+e.paddingRight,r=e.paddingTop+e.paddingBottom,s=e.marginLeft+e.marginRight,t=e.marginTop+e.marginBottom,u=e.borderLeftWidth+e.borderRightWidth,v=e.borderTopWidth+e.borderBottomWidth,w=k&&i,x=b(d.width);x!==!1&&(e.width=x+(w?0:q+u));var y=b(d.height);return y!==!1&&(e.height=y+(w?0:r+v)),e.innerWidth=e.width-(q+u),e.innerHeight=e.height-(r+v),e.outerWidth=e.width+s,e.outerHeight=e.height+t,e}}function h(a,b){if(e||-1===b.indexOf("%"))return b;var c=a.style,d=c.left,f=a.runtimeStyle,g=f&&f.left;return g&&(f.left=a.currentStyle.left),c.left=b,b=c.pixelLeft,c.left=d,g&&(f.left=g),b}var i,j=a("boxSizing");return function(){if(j){var a=document.createElement("div");a.style.width="200px",a.style.padding="1px 2px 3px 4px",a.style.borderStyle="solid",a.style.borderWidth="1px 2px 3px 4px",a.style[j]="border-box";var c=document.body||document.documentElement;c.appendChild(a);var d=f(a);i=200===b(d.width),c.removeChild(a)}}(),d}var e=a.getComputedStyle,f=e?function(a){return e(a,null)}:function(a){return a.currentStyle},g=["paddingLeft","paddingRight","paddingTop","paddingBottom","marginLeft","marginRight","marginTop","marginBottom","borderLeftWidth","borderRightWidth","borderTopWidth","borderBottomWidth"];"function"==typeof define&&define.amd?define("get-size/get-size",["get-style-property/get-style-property"],d):"object"==typeof exports?module.exports=d(require("get-style-property")):a.getSize=d(a.getStyleProperty)}(window),function(a,b){function c(a,b){return a[h](b)}function d(a){if(!a.parentNode){var b=document.createDocumentFragment();b.appendChild(a)}}function e(a,b){d(a);for(var c=a.parentNode.querySelectorAll(b),e=0,f=c.length;f>e;e++)if(c[e]===a)return!0;return!1}function f(a,b){return d(a),c(a,b)}var g,h=function(){if(b.matchesSelector)return"matchesSelector";for(var a=["webkit","moz","ms","o"],c=0,d=a.length;d>c;c++){var e=a[c],f=e+"MatchesSelector";if(b[f])return f}}();if(h){var i=document.createElement("div"),j=c(i,"div");g=j?c:f}else g=e;"function"==typeof define&&define.amd?define("matches-selector/matches-selector",[],function(){return g}):window.matchesSelector=g}(this,Element.prototype),function(a){function b(a,b){for(var c in b)a[c]=b[c];return a}function c(a){for(var b in a)return!1;return b=null,!0}function d(a){return a.replace(/([A-Z])/g,function(a){return"-"+a.toLowerCase()})}function e(a,e,f){function h(a,b){a&&(this.element=a,this.layout=b,this.position={x:0,y:0},this._create())}var i=f("transition"),j=f("transform"),k=i&&j,l=!!f("perspective"),m={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"otransitionend",transition:"transitionend"}[i],n=["transform","transition","transitionDuration","transitionProperty"],o=function(){for(var a={},b=0,c=n.length;c>b;b++){var d=n[b],e=f(d);e&&e!==d&&(a[d]=e)}return a}();b(h.prototype,a.prototype),h.prototype._create=function(){this._transn={ingProperties:{},clean:{},onEnd:{}},this.css({position:"absolute"})},h.prototype.handleEvent=function(a){var b="on"+a.type;this[b]&&this[b](a)},h.prototype.getSize=function(){this.size=e(this.element)},h.prototype.css=function(a){var b=this.element.style;for(var c in a){var d=o[c]||c;b[d]=a[c]}},h.prototype.getPosition=function(){var a=g(this.element),b=this.layout.options,c=b.isOriginLeft,d=b.isOriginTop,e=parseInt(a[c?"left":"right"],10),f=parseInt(a[d?"top":"bottom"],10);e=isNaN(e)?0:e,f=isNaN(f)?0:f;var h=this.layout.size;e-=c?h.paddingLeft:h.paddingRight,f-=d?h.paddingTop:h.paddingBottom,this.position.x=e,this.position.y=f},h.prototype.layoutPosition=function(){var a=this.layout.size,b=this.layout.options,c={};b.isOriginLeft?(c.left=this.position.x+a.paddingLeft+"px",c.right=""):(c.right=this.position.x+a.paddingRight+"px",c.left=""),b.isOriginTop?(c.top=this.position.y+a.paddingTop+"px",c.bottom=""):(c.bottom=this.position.y+a.paddingBottom+"px",c.top=""),this.css(c),this.emitEvent("layout",[this])};var p=l?function(a,b){return"translate3d("+a+"px, "+b+"px, 0)"}:function(a,b){return"translate("+a+"px, "+b+"px)"};h.prototype._transitionTo=function(a,b){this.getPosition();var c=this.position.x,d=this.position.y,e=parseInt(a,10),f=parseInt(b,10),g=e===this.position.x&&f===this.position.y;if(this.setPosition(a,b),g&&!this.isTransitioning)return void this.layoutPosition();var h=a-c,i=b-d,j={},k=this.layout.options;h=k.isOriginLeft?h:-h,i=k.isOriginTop?i:-i,j.transform=p(h,i),this.transition({to:j,onTransitionEnd:{transform:this.layoutPosition},isCleaning:!0})},h.prototype.goTo=function(a,b){this.setPosition(a,b),this.layoutPosition()},h.prototype.moveTo=k?h.prototype._transitionTo:h.prototype.goTo,h.prototype.setPosition=function(a,b){this.position.x=parseInt(a,10),this.position.y=parseInt(b,10)},h.prototype._nonTransition=function(a){this.css(a.to),a.isCleaning&&this._removeStyles(a.to);for(var b in a.onTransitionEnd)a.onTransitionEnd[b].call(this)},h.prototype._transition=function(a){if(!parseFloat(this.layout.options.transitionDuration))return void this._nonTransition(a);var b=this._transn;for(var c in a.onTransitionEnd)b.onEnd[c]=a.onTransitionEnd[c];for(c in a.to)b.ingProperties[c]=!0,a.isCleaning&&(b.clean[c]=!0);if(a.from){this.css(a.from);var d=this.element.offsetHeight;d=null}this.enableTransition(a.to),this.css(a.to),this.isTransitioning=!0};var q=j&&d(j)+",opacity";h.prototype.enableTransition=function(){this.isTransitioning||(this.css({transitionProperty:q,transitionDuration:this.layout.options.transitionDuration}),this.element.addEventListener(m,this,!1))},h.prototype.transition=h.prototype[i?"_transition":"_nonTransition"],h.prototype.onwebkitTransitionEnd=function(a){this.ontransitionend(a)},h.prototype.onotransitionend=function(a){this.ontransitionend(a)};var r={"-webkit-transform":"transform","-moz-transform":"transform","-o-transform":"transform"};h.prototype.ontransitionend=function(a){if(a.target===this.element){var b=this._transn,d=r[a.propertyName]||a.propertyName;if(delete b.ingProperties[d],c(b.ingProperties)&&this.disableTransition(),d in b.clean&&(this.element.style[a.propertyName]="",delete b.clean[d]),d in b.onEnd){var e=b.onEnd[d];e.call(this),delete b.onEnd[d]}this.emitEvent("transitionEnd",[this])}},h.prototype.disableTransition=function(){this.removeTransitionStyles(),this.element.removeEventListener(m,this,!1),this.isTransitioning=!1},h.prototype._removeStyles=function(a){var b={};for(var c in a)b[c]="";this.css(b)};var s={transitionProperty:"",transitionDuration:""};return h.prototype.removeTransitionStyles=function(){this.css(s)},h.prototype.removeElem=function(){this.element.parentNode.removeChild(this.element),this.emitEvent("remove",[this])},h.prototype.remove=function(){if(!i||!parseFloat(this.layout.options.transitionDuration))return void this.removeElem();var a=this;this.on("transitionEnd",function(){return a.removeElem(),!0}),this.hide()},h.prototype.reveal=function(){delete this.isHidden,this.css({display:""});var a=this.layout.options;this.transition({from:a.hiddenStyle,to:a.visibleStyle,isCleaning:!0})},h.prototype.hide=function(){this.isHidden=!0,this.css({display:""});var a=this.layout.options;this.transition({from:a.visibleStyle,to:a.hiddenStyle,isCleaning:!0,onTransitionEnd:{opacity:function(){this.isHidden&&this.css({display:"none"})}}})},h.prototype.destroy=function(){this.css({position:"",left:"",right:"",top:"",bottom:"",transition:"",transform:""})},h}var f=a.getComputedStyle,g=f?function(a){return f(a,null)}:function(a){return a.currentStyle};"function"==typeof define&&define.amd?define("outlayer/item",["eventEmitter/EventEmitter","get-size/get-size","get-style-property/get-style-property"],e):(a.Outlayer={},a.Outlayer.Item=e(a.EventEmitter,a.getSize,a.getStyleProperty))}(window),function(a){function b(a,b){for(var c in b)a[c]=b[c];return a}function c(a){return"[object Array]"===l.call(a)}function d(a){var b=[];if(c(a))b=a;else if(a&&"number"==typeof a.length)for(var d=0,e=a.length;e>d;d++)b.push(a[d]);else b.push(a);return b}function e(a,b){var c=n(b,a);-1!==c&&b.splice(c,1)}function f(a){return a.replace(/(.)([A-Z])/g,function(a,b,c){return b+"-"+c}).toLowerCase()}function g(c,g,l,n,o,p){function q(a,c){if("string"==typeof a&&(a=h.querySelector(a)),!a||!m(a))return void(i&&i.error("Bad "+this.constructor.namespace+" element: "+a));this.element=a,this.options=b({},this.constructor.defaults),this.option(c);var d=++r;this.element.outlayerGUID=d,s[d]=this,this._create(),this.options.isInitLayout&&this.layout()}var r=0,s={};return q.namespace="outlayer",q.Item=p,q.defaults={containerStyle:{position:"relative"},isInitLayout:!0,isOriginLeft:!0,isOriginTop:!0,isResizeBound:!0,isResizingContainer:!0,transitionDuration:"0.4s",hiddenStyle:{opacity:0,transform:"scale(0.001)"},visibleStyle:{opacity:1,transform:"scale(1)"}},b(q.prototype,l.prototype),q.prototype.option=function(a){b(this.options,a)},q.prototype._create=function(){this.reloadItems(),this.stamps=[],this.stamp(this.options.stamp),b(this.element.style,this.options.containerStyle),this.options.isResizeBound&&this.bindResize()},q.prototype.reloadItems=function(){this.items=this._itemize(this.element.children)},q.prototype._itemize=function(a){for(var b=this._filterFindItemElements(a),c=this.constructor.Item,d=[],e=0,f=b.length;f>e;e++){var g=b[e],h=new c(g,this);d.push(h)}return d},q.prototype._filterFindItemElements=function(a){a=d(a);for(var b=this.options.itemSelector,c=[],e=0,f=a.length;f>e;e++){var g=a[e];if(m(g))if(b){o(g,b)&&c.push(g);for(var h=g.querySelectorAll(b),i=0,j=h.length;j>i;i++)c.push(h[i])}else c.push(g)}return c},q.prototype.getItemElements=function(){for(var a=[],b=0,c=this.items.length;c>b;b++)a.push(this.items[b].element);return a},q.prototype.layout=function(){this._resetLayout(),this._manageStamps();var a=void 0!==this.options.isLayoutInstant?this.options.isLayoutInstant:!this._isLayoutInited;this.layoutItems(this.items,a),this._isLayoutInited=!0},q.prototype._init=q.prototype.layout,q.prototype._resetLayout=function(){this.getSize()},q.prototype.getSize=function(){this.size=n(this.element)},q.prototype._getMeasurement=function(a,b){var c,d=this.options[a];d?("string"==typeof d?c=this.element.querySelector(d):m(d)&&(c=d),this[a]=c?n(c)[b]:d):this[a]=0},q.prototype.layoutItems=function(a,b){a=this._getItemsForLayout(a),this._layoutItems(a,b),this._postLayout()},q.prototype._getItemsForLayout=function(a){for(var b=[],c=0,d=a.length;d>c;c++){var e=a[c];e.isIgnored||b.push(e)}return b},q.prototype._layoutItems=function(a,b){function c(){d.emitEvent("layoutComplete",[d,a])}var d=this;if(!a||!a.length)return void c();this._itemsOn(a,"layout",c);for(var e=[],f=0,g=a.length;g>f;f++){var h=a[f],i=this._getItemLayoutPosition(h);i.item=h,i.isInstant=b||h.isLayoutInstant,e.push(i)}this._processLayoutQueue(e)},q.prototype._getItemLayoutPosition=function(){return{x:0,y:0}},q.prototype._processLayoutQueue=function(a){for(var b=0,c=a.length;c>b;b++){var d=a[b];this._positionItem(d.item,d.x,d.y,d.isInstant)}},q.prototype._positionItem=function(a,b,c,d){d?a.goTo(b,c):a.moveTo(b,c)},q.prototype._postLayout=function(){this.resizeContainer()},q.prototype.resizeContainer=function(){if(this.options.isResizingContainer){var a=this._getContainerSize();a&&(this._setContainerMeasure(a.width,!0),this._setContainerMeasure(a.height,!1))}},q.prototype._getContainerSize=k,q.prototype._setContainerMeasure=function(a,b){if(void 0!==a){var c=this.size;c.isBorderBox&&(a+=b?c.paddingLeft+c.paddingRight+c.borderLeftWidth+c.borderRightWidth:c.paddingBottom+c.paddingTop+c.borderTopWidth+c.borderBottomWidth),a=Math.max(a,0),this.element.style[b?"width":"height"]=a+"px"}},q.prototype._itemsOn=function(a,b,c){function d(){return e++,e===f&&c.call(g),!0}for(var e=0,f=a.length,g=this,h=0,i=a.length;i>h;h++){var j=a[h];j.on(b,d)}},q.prototype.ignore=function(a){var b=this.getItem(a);b&&(b.isIgnored=!0)},q.prototype.unignore=function(a){var b=this.getItem(a);b&&delete b.isIgnored},q.prototype.stamp=function(a){if(a=this._find(a)){this.stamps=this.stamps.concat(a);for(var b=0,c=a.length;c>b;b++){var d=a[b];this.ignore(d)}}},q.prototype.unstamp=function(a){if(a=this._find(a))for(var b=0,c=a.length;c>b;b++){var d=a[b];e(d,this.stamps),this.unignore(d)}},q.prototype._find=function(a){return a?("string"==typeof a&&(a=this.element.querySelectorAll(a)),a=d(a)):void 0},q.prototype._manageStamps=function(){if(this.stamps&&this.stamps.length){this._getBoundingRect();for(var a=0,b=this.stamps.length;b>a;a++){var c=this.stamps[a];this._manageStamp(c)}}},q.prototype._getBoundingRect=function(){var a=this.element.getBoundingClientRect(),b=this.size;this._boundingRect={left:a.left+b.paddingLeft+b.borderLeftWidth,top:a.top+b.paddingTop+b.borderTopWidth,right:a.right-(b.paddingRight+b.borderRightWidth),bottom:a.bottom-(b.paddingBottom+b.borderBottomWidth)}},q.prototype._manageStamp=k,q.prototype._getElementOffset=function(a){var b=a.getBoundingClientRect(),c=this._boundingRect,d=n(a),e={left:b.left-c.left-d.marginLeft,top:b.top-c.top-d.marginTop,right:c.right-b.right-d.marginRight,bottom:c.bottom-b.bottom-d.marginBottom};return e},q.prototype.handleEvent=function(a){var b="on"+a.type;this[b]&&this[b](a)},q.prototype.bindResize=function(){this.isResizeBound||(c.bind(a,"resize",this),this.isResizeBound=!0)},q.prototype.unbindResize=function(){this.isResizeBound&&c.unbind(a,"resize",this),this.isResizeBound=!1},q.prototype.onresize=function(){function a(){b.resize(),delete b.resizeTimeout}this.resizeTimeout&&clearTimeout(this.resizeTimeout);var b=this;this.resizeTimeout=setTimeout(a,100)},q.prototype.resize=function(){this.isResizeBound&&this.needsResizeLayout()&&this.layout()},q.prototype.needsResizeLayout=function(){var a=n(this.element),b=this.size&&a;return b&&a.innerWidth!==this.size.innerWidth},q.prototype.addItems=function(a){var b=this._itemize(a);return b.length&&(this.items=this.items.concat(b)),b},q.prototype.appended=function(a){var b=this.addItems(a);b.length&&(this.layoutItems(b,!0),this.reveal(b))},q.prototype.prepended=function(a){var b=this._itemize(a);if(b.length){var c=this.items.slice(0);this.items=b.concat(c),this._resetLayout(),this._manageStamps(),this.layoutItems(b,!0),this.reveal(b),this.layoutItems(c)}},q.prototype.reveal=function(a){var b=a&&a.length;if(b)for(var c=0;b>c;c++){var d=a[c];d.reveal()}},q.prototype.hide=function(a){var b=a&&a.length;if(b)for(var c=0;b>c;c++){var d=a[c];d.hide()}},q.prototype.getItem=function(a){for(var b=0,c=this.items.length;c>b;b++){var d=this.items[b];if(d.element===a)return d}},q.prototype.getItems=function(a){if(a&&a.length){for(var b=[],c=0,d=a.length;d>c;c++){var e=a[c],f=this.getItem(e);f&&b.push(f)}return b}},q.prototype.remove=function(a){a=d(a);var b=this.getItems(a);if(b&&b.length){this._itemsOn(b,"remove",function(){this.emitEvent("removeComplete",[this,b])});for(var c=0,f=b.length;f>c;c++){var g=b[c];g.remove(),e(g,this.items)}}},q.prototype.destroy=function(){var a=this.element.style;a.height="",a.position="",a.width="";for(var b=0,c=this.items.length;c>b;b++){var d=this.items[b];d.destroy()}this.unbindResize(),delete this.element.outlayerGUID,j&&j.removeData(this.element,this.constructor.namespace)},q.data=function(a){var b=a&&a.outlayerGUID;return b&&s[b]},q.create=function(a,c){function d(){q.apply(this,arguments)}return Object.create?d.prototype=Object.create(q.prototype):b(d.prototype,q.prototype),d.prototype.constructor=d,d.defaults=b({},q.defaults),b(d.defaults,c),d.prototype.settings={},d.namespace=a,d.data=q.data,d.Item=function(){p.apply(this,arguments)},d.Item.prototype=new p,g(function(){for(var b=f(a),c=h.querySelectorAll(".js-"+b),e="data-"+b+"-options",g=0,k=c.length;k>g;g++){var l,m=c[g],n=m.getAttribute(e);try{l=n&&JSON.parse(n)}catch(o){i&&i.error("Error parsing "+e+" on "+m.nodeName.toLowerCase()+(m.id?"#"+m.id:"")+": "+o);continue}var p=new d(m,l);j&&j.data(m,a,p)}}),j&&j.bridget&&j.bridget(a,d),d},q.Item=p,q}var h=a.document,i=a.console,j=a.jQuery,k=function(){},l=Object.prototype.toString,m="object"==typeof HTMLElement?function(a){return a instanceof HTMLElement}:function(a){return a&&"object"==typeof a&&1===a.nodeType&&"string"==typeof a.nodeName},n=Array.prototype.indexOf?function(a,b){return a.indexOf(b)}:function(a,b){for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1};"function"==typeof define&&define.amd?define("outlayer/outlayer",["eventie/eventie","doc-ready/doc-ready","eventEmitter/EventEmitter","get-size/get-size","matches-selector/matches-selector","./item"],g):a.Outlayer=g(a.eventie,a.docReady,a.EventEmitter,a.getSize,a.matchesSelector,a.Outlayer.Item)}(window),function(a){function b(a,b){var d=a.create("masonry");return d.prototype._resetLayout=function(){this.getSize(),this._getMeasurement("columnWidth","outerWidth"),this._getMeasurement("gutter","outerWidth"),this.measureColumns();var a=this.cols;for(this.colYs=[];a--;)this.colYs.push(0);this.maxY=0},d.prototype.measureColumns=function(){if(this.getContainerWidth(),!this.columnWidth){var a=this.items[0],c=a&&a.element;this.columnWidth=c&&b(c).outerWidth||this.containerWidth}this.columnWidth+=this.gutter,this.cols=Math.floor((this.containerWidth+this.gutter)/this.columnWidth),this.cols=Math.max(this.cols,1)},d.prototype.getContainerWidth=function(){var a=this.options.isFitWidth?this.element.parentNode:this.element,c=b(a);this.containerWidth=c&&c.innerWidth},d.prototype._getItemLayoutPosition=function(a){a.getSize();var b=a.size.outerWidth%this.columnWidth,d=b&&1>b?"round":"ceil",e=Math[d](a.size.outerWidth/this.columnWidth);e=Math.min(e,this.cols);for(var f=this._getColGroup(e),g=Math.min.apply(Math,f),h=c(f,g),i={x:this.columnWidth*h,y:g},j=g+a.size.outerHeight,k=this.cols+1-f.length,l=0;k>l;l++)this.colYs[h+l]=j;return i},d.prototype._getColGroup=function(a){if(2>a)return this.colYs;for(var b=[],c=this.cols+1-a,d=0;c>d;d++){var e=this.colYs.slice(d,d+a);b[d]=Math.max.apply(Math,e)}return b},d.prototype._manageStamp=function(a){var c=b(a),d=this._getElementOffset(a),e=this.options.isOriginLeft?d.left:d.right,f=e+c.outerWidth,g=Math.floor(e/this.columnWidth);g=Math.max(0,g);var h=Math.floor(f/this.columnWidth);h-=f%this.columnWidth?0:1,h=Math.min(this.cols-1,h);for(var i=(this.options.isOriginTop?d.top:d.bottom)+c.outerHeight,j=g;h>=j;j++)this.colYs[j]=Math.max(i,this.colYs[j])},d.prototype._getContainerSize=function(){this.maxY=Math.max.apply(Math,this.colYs);var a={height:this.maxY};return this.options.isFitWidth&&(a.width=this._getContainerFitWidth()),a},d.prototype._getContainerFitWidth=function(){for(var a=0,b=this.cols;--b&&0===this.colYs[b];)a++;return(this.cols-a)*this.columnWidth-this.gutter},d.prototype.needsResizeLayout=function(){var a=this.containerWidth;return this.getContainerWidth(),a!==this.containerWidth},d}var c=Array.prototype.indexOf?function(a,b){return a.indexOf(b)}:function(a,b){for(var c=0,d=a.length;d>c;c++){var e=a[c];if(e===b)return c}return-1};"function"==typeof define&&define.amd?define(["outlayer/outlayer","get-size/get-size"],b):a.Masonry=b(a.Outlayer,a.getSize)}(window);

    /*!
     jQuery wookmark plugin
     @name jquery.wookmark.js
     @author Christoph Ono (chri@sto.ph or @gbks)
     @author Sebastian Helzle (sebastian@helzle.net or @sebobo)
     @version 1.4.7
     @date 05/18/2014
     @category jQuery plugin
     @copyright (c) 2009-2014 Christoph Ono (www.wookmark.com)
     @license Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) license.
     */
    (function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)})(function(t){function i(t){n(function(){var i,e;for(i=0;t.length>i;i++)e=t[i],e.obj.css(e.css)})}function e(i){return t.trim(i).toLowerCase()}var s,h,o;o=function(t,i){return function(){return t.apply(i,arguments)}},h={align:"center",autoResize:!1,comparator:null,container:t("body"),direction:void 0,ignoreInactiveItems:!0,itemWidth:0,fillEmptySpace:!1,flexibleWidth:0,offset:2,outerOffset:0,onLayoutChanged:void 0,possibleFilters:[],resizeDelay:50,verticalOffset:void 0};var n=window.requestAnimationFrame||function(t){t()},r=t(window);s=function(){function s(i,e){this.handler=i,this.columns=this.containerWidth=this.resizeTimer=null,this.activeItemCount=0,this.itemHeightsDirty=!0,this.placeholders=[],t.extend(!0,this,h,e),this.verticalOffset=this.verticalOffset||this.offset,this.update=o(this.update,this),this.onResize=o(this.onResize,this),this.onRefresh=o(this.onRefresh,this),this.getItemWidth=o(this.getItemWidth,this),this.layout=o(this.layout,this),this.layoutFull=o(this.layoutFull,this),this.layoutColumns=o(this.layoutColumns,this),this.filter=o(this.filter,this),this.clear=o(this.clear,this),this.getActiveItems=o(this.getActiveItems,this),this.refreshPlaceholders=o(this.refreshPlaceholders,this),this.sortElements=o(this.sortElements,this),this.updateFilterClasses=o(this.updateFilterClasses,this),this.updateFilterClasses(),this.autoResize&&r.bind("resize.wookmark",this.onResize),this.container.bind("refreshWookmark",this.onRefresh)}return s.prototype.updateFilterClasses=function(){for(var t,i,s,h,o=0,n=0,r=0,a={},l=this.possibleFilters;this.handler.length>o;o++)if(i=this.handler.eq(o),t=i.data("filterClass"),"object"==typeof t&&t.length>0)for(n=0;t.length>n;n++)s=e(t[n]),a[s]===void 0&&(a[s]=[]),a[s].push(i[0]);for(;l.length>r;r++)h=e(l[r]),h in a||(a[h]=[]);this.filterClasses=a},s.prototype.update=function(i){this.itemHeightsDirty=!0,t.extend(!0,this,i)},s.prototype.onResize=function(){clearTimeout(this.resizeTimer),this.itemHeightsDirty=0!==this.flexibleWidth,this.resizeTimer=setTimeout(this.layout,this.resizeDelay)},s.prototype.onRefresh=function(){this.itemHeightsDirty=!0,this.layout()},s.prototype.filter=function(i,s,h){var o,n,r,a,l,f=[],u=t();if(i=i||[],s=s||"or",h=h||!1,i.length){for(n=0;i.length>n;n++)l=e(i[n]),l in this.filterClasses&&f.push(this.filterClasses[l]);if(o=f.length,"or"==s||1==o)for(n=0;o>n;n++)u=u.add(f[n]);else if("and"==s){var c,d,m,p=f[0],g=!0;for(n=1;o>n;n++)f[n].length<p.length&&(p=f[n]);for(p=p||[],n=0;p.length>n;n++){for(d=p[n],g=!0,r=0;f.length>r&&g;r++)if(m=f[r],p!=m){for(a=0,c=!1;m.length>a&&!c;a++)c=m[a]==d;g&=c}g&&u.push(p[n])}}h||this.handler.not(u).addClass("inactive")}else u=this.handler;return h||(u.removeClass("inactive"),this.columns=null,this.layout()),u},s.prototype.refreshPlaceholders=function(i,e){for(var s,h,o,n,r,a,l=this.placeholders.length,f=this.columns.length,u=this.container.innerHeight();f>l;l++)s=t('<div class="wookmark-placeholder"/>').appendTo(this.container),this.placeholders.push(s);for(a=this.offset+2*parseInt(this.placeholders[0].css("borderLeftWidth"),10),l=0;this.placeholders.length>l;l++)if(s=this.placeholders[l],o=this.columns[l],l>=f||!o[o.length-1])s.css("display","none");else{if(h=o[o.length-1],!h)continue;r=h.data("wookmark-top")+h.data("wookmark-height")+this.verticalOffset,n=u-r-a,s.css({position:"absolute",display:n>0?"block":"none",left:l*i+e,top:r,width:i-a,height:n})}},s.prototype.getActiveItems=function(){return this.ignoreInactiveItems?this.handler.not(".inactive"):this.handler},s.prototype.getItemWidth=function(){var t=this.itemWidth,i=this.container.width()-2*this.outerOffset,e=this.handler.eq(0),s=this.flexibleWidth;if(void 0===this.itemWidth||0===this.itemWidth&&!this.flexibleWidth?t=e.outerWidth():"string"==typeof this.itemWidth&&this.itemWidth.indexOf("%")>=0&&(t=parseFloat(this.itemWidth)/100*i),s){"string"==typeof s&&s.indexOf("%")>=0&&(s=parseFloat(s)/100*i);var h=i+this.offset,o=~~(.5+h/(s+this.offset)),n=~~(h/(t+this.offset)),r=Math.max(o,n),a=Math.min(s,~~((i-(r-1)*this.offset)/r));t=Math.max(t,a),this.handler.css("width",t)}return t},s.prototype.layout=function(t){if(this.container.is(":visible")){var i,e=this.getItemWidth()+this.offset,s=this.container.width(),h=s-2*this.outerOffset,o=~~((h+this.offset)/e),n=0,r=0,a=0,l=this.getActiveItems(),f=l.length;if(this.itemHeightsDirty||!this.container.data("itemHeightsInitialized")){for(;f>a;a++)i=l.eq(a),i.data("wookmark-height",i.outerHeight());this.itemHeightsDirty=!1,this.container.data("itemHeightsInitialized",!0)}o=Math.max(1,Math.min(o,f)),n=this.outerOffset,"center"==this.align&&(n+=~~(.5+(h-(o*e-this.offset))>>1)),this.direction=this.direction||("right"==this.align?"right":"left"),r=t||null===this.columns||this.columns.length!=o||this.activeItemCount!=f?this.layoutFull(e,o,n):this.layoutColumns(e,n),this.activeItemCount=f,this.container.css("height",r),this.fillEmptySpace&&this.refreshPlaceholders(e,n),void 0!==this.onLayoutChanged&&"function"==typeof this.onLayoutChanged&&this.onLayoutChanged()}},s.prototype.sortElements=function(t){return"function"==typeof this.comparator?t.sort(this.comparator):t},s.prototype.layoutFull=function(e,s,h){var o,n,r=0,a=0,l=t.makeArray(this.getActiveItems()),f=l.length,u=null,c=null,d=[],m=[],p="left"==this.align?!0:!1;for(this.columns=[],l=this.sortElements(l);s>d.length;)d.push(this.outerOffset),this.columns.push([]);for(;f>r;r++){for(o=t(l[r]),u=d[0],c=0,a=0;s>a;a++)u>d[a]&&(u=d[a],c=a);o.data("wookmark-top",u),n=h,(c>0||!p)&&(n+=c*e),(m[r]={obj:o,css:{position:"absolute",top:u}}).css[this.direction]=n,d[c]+=o.data("wookmark-height")+this.verticalOffset,this.columns[c].push(o)}return i(m),Math.max.apply(Math,d)},s.prototype.layoutColumns=function(t,e){for(var s,h,o,n,r=[],a=[],l=0,f=0,u=0;this.columns.length>l;l++){for(r.push(this.outerOffset),h=this.columns[l],n=l*t+e,s=r[l],f=0;h.length>f;f++,u++)o=h[f].data("wookmark-top",s),(a[u]={obj:o,css:{top:s}}).css[this.direction]=n,s+=o.data("wookmark-height")+this.verticalOffset;r[l]=s}return i(a),Math.max.apply(Math,r)},s.prototype.clear=function(){clearTimeout(this.resizeTimer),r.unbind("resize.wookmark",this.onResize),this.container.unbind("refreshWookmark",this.onRefresh),this.handler.wookmarkInstance=null},s}(),t.fn.wookmark=function(t){return this.wookmarkInstance?this.wookmarkInstance.update(t||{}):this.wookmarkInstance=new s(this,t||{}),this.wookmarkInstance.layout(!0),this.show()}});

    /*

     Quicksand 1.4

     Reorder and filter items with a nice shuffling animation.

     Copyright (c) 2010 Jacek Galanciak (razorjack.net) and agilope.com
     Big thanks for Piotr Petrus (riddle.pl) for deep code review and wonderful docs & demos.

     Dual licensed under the MIT and GPL version 2 licenses.
     http://github.com/jquery/jquery/blob/master/MIT-LICENSE.txt
     http://github.com/jquery/jquery/blob/master/GPL-LICENSE.txt

     Project site: http://razorjack.net/quicksand
     Github site: http://github.com/razorjack/quicksand

     */

    (function(e){var t=function(e){var t=e.clone();var n=e.find("canvas");if(n.length){var r=t.find("canvas");r.each(function(e){var t=this.getContext("2d");t.drawImage(n.get(e),0,0)})}return t};e.fn.quicksand=function(n,r){var i={duration:750,easing:"swing",attribute:"data-id",adjustHeight:"auto",adjustWidth:"auto",useScaling:false,enhancement:function(e){},selector:"> *",atomic:false,dx:0,dy:0,maxWidth:0,retainExisting:true},s=function(){var e="transform WebkitTransform MozTransform OTransform msTransform".split(" "),t=document.createElement("div");for(var n=0;n<e.length;n++){if(typeof t.style[e[n]]!="undefined"){return true}}return false}();e.extend(i,r);if(!s||typeof e.fn.scale=="undefined"){i.useScaling=false}var o;if(typeof arguments[1]=="function"){o=arguments[1]}else if(typeof (arguments[2]=="function")){o=arguments[2]}return this.each(function(r){var s;var u=[];var a;if(typeof i.attribute=="function"){a=e(n)}else{a=t(e(n).filter("["+i.attribute+"]"))}var f=e(this);var l=e(this).css("height");var c=e(this).css("width");var h,p;var d=false;var v=false;var m=e(f).offset();var g=[];var y=e(this).find(i.selector);var b=e(y).innerWidth();if(navigator.userAgent.match(/msie [6]/i)){f.html("").append(a);return}var w=0;var E=function(){e(this).css("margin","").css("position","").css("top","").css("left","").css("opacity","");if(!w){w=1;if(!i.atomic){var t=f.find(i.selector);if(!i.retainExisting){f.prepend(C.find(i.selector));t.remove()}else{var n=e([]);C.find(i.selector).each(function(r){var s=e([]);if(typeof i.attribute=="function"){var o=i.attribute(e(this));t.each(function(){if(i.attribute(this)==o){s=e(this);return false}})}else{s=t.filter("["+i.attribute+'="'+e(this).attr(i.attribute)+'"]')}if(s.length>0){n=n.add(s);if(r===0){f.prepend(s)}else{s.insertAfter(f.find(i.selector).get(r-1))}}});t.not(n).remove()}if(d){f.css("height",h)}if(v){f.css("width",c)}}i.enhancement(f);if(typeof o=="function"){o.call(this)}}if(false===i.adjustHeight){f.css("height","auto")}if(false===i.adjustWidth){f.css("width","auto")}};var S=f.offsetParent();var x=S.offset();if(S.css("position")=="relative"){if(S.get(0).nodeName.toLowerCase()!="body"){x.top+=parseFloat(S.css("border-top-width"))||0;x.left+=parseFloat(S.css("border-left-width"))||0}}else{x.top-=parseFloat(S.css("border-top-width"))||0;x.left-=parseFloat(S.css("border-left-width"))||0;x.top-=parseFloat(S.css("margin-top"))||0;x.left-=parseFloat(S.css("margin-left"))||0}if(isNaN(x.left)){x.left=0}if(isNaN(x.top)){x.top=0}x.left-=i.dx;x.top-=i.dy;f.css("height",e(this).height());f.css("width",e(this).width());y.each(function(t){g[t]=e(this).offset()});e(this).stop();var T=0;var N=0;y.each(function(t){e(this).stop();var n=e(this).get(0);if(n.style.position=="absolute"){T=-i.dx;N=-i.dy}else{T=i.dx;N=i.dy}n.style.position="absolute";n.style.margin="0";if(!i.adjustWidth){n.style.width=b+"px"}n.style.top=g[t].top-parseFloat(n.style.marginTop)-x.top+N+"px";n.style.left=g[t].left-parseFloat(n.style.marginLeft)-x.left+T+"px";if(i.maxWidth>0&&g[t].left>i.maxWidth){n.style.display="none"}});var C=t(e(f));var k=C.get(0);k.innerHTML="";k.setAttribute("id","");k.style.height="auto";k.style.width=f.width()+"px";C.append(a);C.insertBefore(f);C.css("opacity",0);k.style.zIndex=-1;k.style.margin="0";k.style.position="absolute";k.style.top=m.top-x.top+"px";k.style.left=m.left-x.left+"px";if(i.adjustHeight==="dynamic"){f.animate({height:C.height()},i.duration,i.easing)}else if(i.adjustHeight==="auto"){h=C.height();if(parseFloat(l)<parseFloat(h)){f.css("height",h)}else{d=true}}if(i.adjustWidth==="dynamic"){f.animate({width:C.width()},i.duration,i.easing)}else if(i.adjustWidth==="auto"){p=C.width();if(parseFloat(c)<parseFloat(p)){f.css("width",p)}else{v=true}}y.each(function(t){var n=[];if(typeof i.attribute=="function"){s=i.attribute(e(this));a.each(function(){if(i.attribute(this)==s){n=e(this);return false}})}else{n=a.filter("["+i.attribute+'="'+e(this).attr(i.attribute)+'"]')}if(n.length){if(!i.useScaling){u.push({element:e(this),dest:n,style:{top:e(this).offset().top,left:e(this).offset().left,opacity:""},animation:{top:n.offset().top-x.top,left:n.offset().left-x.left,opacity:1}})}else{u.push({element:e(this),dest:n,style:{top:e(this).offset().top,left:e(this).offset().left,opacity:""},animation:{top:n.offset().top-x.top,left:n.offset().left-x.left,opacity:1,scale:"1.0"}})}}else{if(!i.useScaling){u.push({element:e(this),style:{top:e(this).offset().top,left:e(this).offset().left,opacity:""},animation:{opacity:"0.0"}})}else{u.push({element:e(this),animation:{opacity:"0.0",style:{top:e(this).offset().top,left:e(this).offset().left,opacity:""},scale:"0.0"}})}}});a.each(function(n){var r=[];var o=[];if(typeof i.attribute=="function"){s=i.attribute(e(this));y.each(function(){if(i.attribute(this)==s){r=e(this);return false}});a.each(function(){if(i.attribute(this)==s){o=e(this);return false}})}else{r=y.filter("["+i.attribute+'="'+e(this).attr(i.attribute)+'"]');o=a.filter("["+i.attribute+'="'+e(this).attr(i.attribute)+'"]')}var l;if(r.length===0&&o.length>0){if(!i.useScaling){l={opacity:"1.0"}}else{l={opacity:"1.0",scale:"1.0"}}var c=t(o);var h=c.get(0);h.style.position="absolute";h.style.margin="0";if(!i.adjustWidth){h.style.width=b+"px"}h.style.top=o.offset().top-x.top+"px";h.style.left=o.offset().left-x.left+"px";c.css("opacity",0);if(i.useScaling){c.scale(0)}c.appendTo(f);if(i.maxWidth===0||o.offset().left<i.maxWidth){u.push({element:e(c),dest:o,animation:l})}}});C.remove();if(!i.atomic){i.enhancement(f);for(r=0;r<u.length;r++){u[r].element.animate(u[r].animation,i.duration,i.easing,E)}}else{$toDelete=f.find(i.selector);f.prepend(C.find(i.selector));for(r=0;r<u.length;r++){if(u[r].dest&&u[r].style){var L=u[r].dest;var A=L.offset();L.css({position:"relative",top:u[r].style.top-A.top,left:u[r].style.left-A.left});L.animate({top:"0",left:"0"},i.duration,i.easing,E)}else{u[r].element.animate(u[r].animation,i.duration,i.easing,E)}}$toDelete.remove()}})}})(jQuery)


    /*
     * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
     *
     * Uses the built in easing capabilities added In jQuery 1.1
     * to offer multiple easing options
     *
     * TERMS OF USE - jQuery Easing
     *
     * Open source under the BSD License.
     *
     * Copyright © 2008 George McGinley Smith
     * All rights reserved.
     *
     * Redistribution and use in source and binary forms, with or without modification,
     * are permitted provided that the following conditions are met:
     *
     * Redistributions of source code must retain the above copyright notice, this list of
     * conditions and the following disclaimer.
     * Redistributions in binary form must reproduce the above copyright notice, this list
     * of conditions and the following disclaimer in the documentation and/or other materials
     * provided with the distribution.
     *
     * Neither the name of the author nor the names of contributors may be used to endorse
     * or promote products derived from this software without specific prior written permission.
     *
     * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
     * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
     * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
     *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
     *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
     *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
     * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
     *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
     * OF THE POSSIBILITY OF SUCH DAMAGE.
     *
     */

// t: current time, b: begInnIng value, c: change In value, d: duration

    jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,t,n,r,i){return jQuery.easing[jQuery.easing.def](e,t,n,r,i)},easeInQuad:function(e,t,n,r,i){return r*(t/=i)*t+n},easeOutQuad:function(e,t,n,r,i){return-r*(t/=i)*(t-2)+n},easeInOutQuad:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t+n;return-r/2*(--t*(t-2)-1)+n},easeInCubic:function(e,t,n,r,i){return r*(t/=i)*t*t+n},easeOutCubic:function(e,t,n,r,i){return r*((t=t/i-1)*t*t+1)+n},easeInOutCubic:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t+n;return r/2*((t-=2)*t*t+2)+n},easeInQuart:function(e,t,n,r,i){return r*(t/=i)*t*t*t+n},easeOutQuart:function(e,t,n,r,i){return-r*((t=t/i-1)*t*t*t-1)+n},easeInOutQuart:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t+n;return-r/2*((t-=2)*t*t*t-2)+n},easeInQuint:function(e,t,n,r,i){return r*(t/=i)*t*t*t*t+n},easeOutQuint:function(e,t,n,r,i){return r*((t=t/i-1)*t*t*t*t+1)+n},easeInOutQuint:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t*t+n;return r/2*((t-=2)*t*t*t*t+2)+n},easeInSine:function(e,t,n,r,i){return-r*Math.cos(t/i*(Math.PI/2))+r+n},easeOutSine:function(e,t,n,r,i){return r*Math.sin(t/i*(Math.PI/2))+n},easeInOutSine:function(e,t,n,r,i){return-r/2*(Math.cos(Math.PI*t/i)-1)+n},easeInExpo:function(e,t,n,r,i){return t==0?n:r*Math.pow(2,10*(t/i-1))+n},easeOutExpo:function(e,t,n,r,i){return t==i?n+r:r*(-Math.pow(2,-10*t/i)+1)+n},easeInOutExpo:function(e,t,n,r,i){if(t==0)return n;if(t==i)return n+r;if((t/=i/2)<1)return r/2*Math.pow(2,10*(t-1))+n;return r/2*(-Math.pow(2,-10*--t)+2)+n},easeInCirc:function(e,t,n,r,i){return-r*(Math.sqrt(1-(t/=i)*t)-1)+n},easeOutCirc:function(e,t,n,r,i){return r*Math.sqrt(1-(t=t/i-1)*t)+n},easeInOutCirc:function(e,t,n,r,i){if((t/=i/2)<1)return-r/2*(Math.sqrt(1-t*t)-1)+n;return r/2*(Math.sqrt(1-(t-=2)*t)+1)+n},easeInElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return-(u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o))+n},easeOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return u*Math.pow(2,-10*t)*Math.sin((t*i-s)*2*Math.PI/o)+r+n},easeInOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i/2)==2)return n+r;if(!o)o=i*.3*1.5;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);if(t<1)return-.5*u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)+n;return u*Math.pow(2,-10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)*.5+r+n},easeInBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*(t/=i)*t*((s+1)*t-s)+n},easeOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*((t=t/i-1)*t*((s+1)*t+s)+1)+n},easeInOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;if((t/=i/2)<1)return r/2*t*t*(((s*=1.525)+1)*t-s)+n;return r/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+n},easeInBounce:function(e,t,n,r,i){return r-jQuery.easing.easeOutBounce(e,i-t,0,r,i)+n},easeOutBounce:function(e,t,n,r,i){if((t/=i)<1/2.75){return r*7.5625*t*t+n}else if(t<2/2.75){return r*(7.5625*(t-=1.5/2.75)*t+.75)+n}else if(t<2.5/2.75){return r*(7.5625*(t-=2.25/2.75)*t+.9375)+n}else{return r*(7.5625*(t-=2.625/2.75)*t+.984375)+n}},easeInOutBounce:function(e,t,n,r,i){if(t<i/2)return jQuery.easing.easeInBounce(e,t*2,0,r,i)*.5+n;return jQuery.easing.easeOutBounce(e,t*2-i,0,r,i)*.5+r*.5+n}})

    /*
     *
     * TERMS OF USE - EASING EQUATIONS
     *
     * Open source under the BSD License.
     *
     * Copyright © 2001 Robert Penner
     * All rights reserved.
     *
     * Redistribution and use in source and binary forms, with or without modification,
     * are permitted provided that the following conditions are met:
     *
     * Redistributions of source code must retain the above copyright notice, this list of
     * conditions and the following disclaimer.
     * Redistributions in binary form must reproduce the above copyright notice, this list
     * of conditions and the following disclaimer in the documentation and/or other materials
     * provided with the distribution.
     *
     * Neither the name of the author nor the names of contributors may be used to endorse
     * or promote products derived from this software without specific prior written permission.
     *
     * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
     * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
     * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
     *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
     *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
     *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
     * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
     *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
     * OF THE POSSIBILITY OF SUCH DAMAGE.
     *
     */


    function Gallery(selector, autoInit) {

        autoInit = autoInit || false;

        this.$container  = $(selector);
        this.$elements   = this.$container.find('figure.gird-gallery-caption');
        this.$navigation = this.$container.find('nav.grid-gallery-nav');
        this.selectedCategory="";
        this.$holder = this.$container.find('.grid-gallery-photos:first');
		this.$qsData = null;
        this.$qsDuration = '750';
        this.$qsEnable = false;
        
		this.pagination = {
            currentPage: 1,
            limit: 0,
            total: this.$elements.length,
            pages: 1,
            $wrapper: this.$container.find('.grid-gallery-pagination-wrap')
        };

        if (this.isFluid()) {
            this.$elements.addClass('wookmarked');
        }

        if (autoInit) {
            this.init();
        }
    }

    Gallery.prototype.isFluid = (function () {
        return this.$container.is('.gird-gallery-fluid');
    });

    Gallery.prototype.isImageOverlay = (function () {
        return $('.crop').is('.image-overlay');
    });

    Gallery.prototype.isMouseShadow = (function () {
        return $('.gird-gallery-caption').is('.shadow');
    });

    Gallery.prototype.initQuicksand = (function () {
        if($('#qs-settings').is('.enabled') && jQuery('#qs-settings').text() != 'auto')  {
            this.$qsDuration = jQuery('#qs-settings').text();
        }
        this.$qsEnable = $('#qs-settings').is('.enabled');
    });

    Gallery.prototype.showCaption = (function () {
        this.$container.find('.gird-gallery-figcaption-wrap').each(function() {
            if(!$(this).contents()[1]) {
                $(this).parent().remove();
            }
        });
    });

    Gallery.prototype.initWookmark = (function () {
        if(!this.$container.data('offset')) {
            this.$container.data('offset', 0);
        }
        this.$elements.filter('.wookmarked').wookmark({
            autoResize:     true,
            container:      this.$container.find('.grid-gallery-photos'),
            direction:      'left',
            fillEmptySpace: false,
            flexibleWidth:  true,
            itemWidth:      this.$container.data('width'),
            offset:         this.$container.data('offset')
        });

        if(this.isFluid())
            this.$container.find('.grid-gallery-photos')
                .css('position', 'relative');
    });

    Gallery.prototype.setImagesHeight = (function () {
        var $images = this.$container.find('img');

        if ($images != undefined && $images.length > 0) {
            $images.each(function () {
                var $image = $(this),
                    $wrapper = $image.parent();

                if ($image.height() < $wrapper.height()) {
                    $wrapper.css('height', $image.height());
                }
            });
        }
    });

    Gallery.prototype.setOverlayTransparency = (function () {
        this.$elements.find('figcaption').each(function () {
            var $caption = $(this),
                alpha    = (10 - parseInt($caption.data('alpha'), 10)) / 10,
                rgb      = $caption.css('background-color'),
                rgba     = rgb.replace(')', ', ' + alpha + ')').replace('rgb', 'rgba');


            $caption.css('background', rgba);
        });
    });

    Gallery.prototype.setIconsPosition = (function () {
        this.$elements.each(function () {
            var $element = $(this),
                $wrapper = $element.find('div.hi-icon-wrap'),
                $icons   = $element.find('a.hi-icon');

            $icons.each(function () {
                var $icon   = $(this),
                    marginY = ($element.height() / 2) - ($icon.height() / 2) - 10,
                    marginX = $wrapper.data('margin');

                $icon.css({
                    'margin-top':   Math.abs(marginY),
                    'margin-left':  marginX,
                    'margin-right': marginX
                });
            });
        });
    });

    Gallery.prototype.initCategories = (function () {

        var element = this.$navigation.find('a[data-tag="__all__"]');
        if(element.length) {
            element.css('background-color',
                "#" + (parseInt(Gallery.prototype.rgb2hex(element.css('borderTopColor')), 16) + parseInt("2E2E2E",16)).toString(16));
        }
        Gallery.prototype.selectedCategory = element.data('tag');

        this.$navigation.find('a').on('click', $.proxy(function (event) {
            event.preventDefault();

            var element = $(event.currentTarget)
            var galery = Gallery.prototype;
            if(galery.selectedCategory != element.data('tag')) {
                this.$navigation.find('a').each(function() {
                    if(galery.selectedCategory==$(this).data('tag'))
                        $(this).css('background-color','white');
                });
                galery.selectedCategory = element.data('tag');
                element.css('background-color',
                                "#" + (parseInt(galery.rgb2hex(element.css('borderTopColor')), 16) + parseInt("2E2E2E",16)).toString(16));
            }

            var $category   = $(event.currentTarget),
                requested   = String($category.data('tag')),
                _defaultTag = '__all__';

            if ($category.data('tag') == _defaultTag) {
                this.$elements
                    .removeClass('wookmarked')
                    .addClass('wookmarked')
                    .fadeIn($.proxy(function() {
                        if (this.isFluid()) {
                            this.initWookmark();
                        }
                }, this));

                if(!this.isFluid() && this.$qsEnable)
                    this.callQuicksand(this.$holder, this.$qsData.find('a.gg-link'), this.$qsDuration);
                return false;
            }

            var fluid = this.isFluid();
            var qs = this.$qsEnable;

            this.$elements.each(function () {
                var $element = $(this),
                    tags     = $element.data('tags');

                if (typeof tags != 'string') {
                    tags = String(tags);
                }

                if (tags != undefined) {
                    tags = tags.split('|');
                }

                if ($.inArray(requested, tags) > -1) {
                    if(!fluid && qs)
                        $element.addClass('wookmarked');
                    else
                        $element.fadeIn().addClass('wookmarked');
                } else {
                    if(!fluid && qs)
                        $element.removeClass('wookmarked');
                    else
                        $element.hide().removeClass('wookmarked');
                }
            });

            if (this.isFluid()) {
                this.initWookmark();
            }
            if(!this.isFluid() && this.$qsEnable) {
                if(!this.$qsData)
                    this.$qsData = this.$holder.clone();
                var $data = this.$qsData.find('a.gg-link').clone();
                var $filteredData = $data.find('figure[data-tags='+$category.data('tag')+']').parent();
                this.callQuicksand(this.$holder, $filteredData, this.$qsDuration);
            }

        }, this));
    });

    Gallery.prototype.callQuicksand = function($holder, $filteredData, duration) {
        $holder.quicksand($filteredData, {
            duration : Number(duration),
            easing: 'swing',
            attribute : 'href'
        });
    }

    Gallery.prototype.hidePaginationControls = (function () {
        return false;
    });

    Gallery.prototype.setImageOverlay = (function() {
        if(this.isImageOverlay()) {
            jQuery('a.gg-link').each(function () {
                var image = $(this).find('img');
                var crop = $(this).find('.image-overlay');
                image.css('opacity', '0.2');
                crop.css('background-color', '#424242');
                $(this).live({ mouseover : (function () {
                        image.css('opacity', '1.0');
                        crop.css('background-color', 'inherit');
                    }
                )});
                $(this).live({mouseleave: (function () {
                    image.css('opacity', '0.2');
                    crop.css('background-color', '#424242');
                })});
            });
        }
    });

    Gallery.prototype.setMouseShadow = (function() {
        if(this.isMouseShadow()) {
            var prevStyle=$('.crop').css('box-shadow');
            $('.shadow').mouseenter(function() {
                 $(this).css( 'box-shadow' ,'5px 5px 5px #888');
            });
            $('.shadow').mouseleave(function() {
                $(this).css( 'box-shadow', prevStyle);
            });
        }
    });

    Gallery.prototype.initPagination = (function () {
        var perPage = parseInt(this.$container.find('.grid-gallery-photos').data('per-page'), 10),
            buffer  = [],
            page    = 1,
            offset  = 0;

        if (isNaN(perPage)) {
            this.$elements.fadeIn();
            return false;
        }

        var showCurrentPage = (function (gallery) {
            gallery.$elements.removeClass('current-page').hide(350);

            $.each(buffer[gallery.pagination.currentPage], function () {
                $(this).addClass('current-page').show(function () {
                    gallery.setIconsPosition();
                });
            });

            if (!gallery.isFluid()) {
                $('.current-page .crop').css('height', function () {
                    var height = null;
                    $('.crop img').each(function () {
                        if($(this).height() && !height) {
                            height = $(this).height();
                        }
                    });
                    return height;
                });
            }
        });

        this.pagination.limit = perPage;

        this.$elements.each($.proxy(function (index, el) {
            var currentIndex = index + 1;

            if ((currentIndex - offset) <= this.pagination.limit) {
                if (!$.isArray(buffer[page])) {
                    buffer[page] = [];
                }

                buffer[page].push(el);
            } else {
                offset += this.pagination.limit;
                page   += 1;

                buffer[page] = [el];
            }
        }, this)).hide();

        this.pagination.pages = Math.ceil(this.pagination.total / this.pagination.limit);

        var element=this.pagination.$wrapper.find('a.grid-gallery-page[data-page="1"]');
        element.css('font-size','19pt');

        this.pagination.$wrapper.find('a.grid-gallery-page').on('click', $.proxy(function (e) {
            e.preventDefault();

            var element = $(e.currentTarget)
            var galery = Gallery.prototype;
            this.pagination.$wrapper.find('a.grid-gallery-page').each(function() {
                $(this).css('font-size','inherit');
            });
            galery.selectedCategory = element.data('page');
            element.css('font-size','19pt');

            var $anchor       = $(e.currentTarget),
                requestedPage = $anchor.data('page');

            this.pagination.currentPage = requestedPage;

            showCurrentPage(this);

            return false;
        }, this));

        showCurrentPage(this);
    });

    Gallery.prototype.hex=function(x) {
        return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
    }

    Gallery.prototype.rgb2hex = function(rgb) {
        rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
        function hex(x) {
            return ("0" + parseInt(x).toString(16)).slice(-2);
        }
        return hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
    }

    Gallery.prototype.init = (function () {
        this.$container.imagesLoaded($.proxy(function () {

            this.initPagination();
            this.initCategories();

            this.showCaption();
            this.setMouseShadow();
            this.setImageOverlay();
            this.initQuicksand();

            this.setImagesHeight();
            this.setIconsPosition();
            this.setOverlayTransparency();

            this.initWookmark();
        }, this));
    });

    window.initGridGallery = (function (el, autoInit) {
        var makeSelector = (function (el) {
            return '#' + el.id;
        });

        return new Gallery(makeSelector(el), autoInit);
    });

    $(document).ready(function () {
        var $galleries = $('.gird-gallery');

        if ($galleries.length > 0) {
            $.each($galleries, (function () {
                initGridGallery(this, true);
            }));
        }

        $('.crop').css('display', 'inherit');
    });

}(jQuery));
