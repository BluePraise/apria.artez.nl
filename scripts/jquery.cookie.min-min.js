/*!
 * jQuery Cookie Plugin v1.3.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e(jQuery)}((function(e){var n=/\+/g;function o(e){return e}function i(e){return decodeURIComponent(e.replace(n," "))}function r(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return t.json?JSON.parse(e):e}catch(e){}}var t=e.cookie=function(n,a,c){if(void 0!==a){if("number"==typeof(c=e.extend({},t.defaults,c)).expires){var u=c.expires,f=c.expires=new Date;f.setDate(f.getDate()+u)}return a=t.json?JSON.stringify(a):String(a),document.cookie=[t.raw?n:encodeURIComponent(n),"=",t.raw?a:encodeURIComponent(a),c.expires?"; expires="+c.expires.toUTCString():"",c.path?"; path="+c.path:"",c.domain?"; domain="+c.domain:"",c.secure?"; secure":""].join("")}for(var d=t.raw?o:i,p=document.cookie.split("; "),s=n?void 0:{},m=0,x=p.length;m<x;m++){var l=p[m].split("="),v=d(l.shift()),g=d(l.join("="));if(n&&n===v){s=r(g);break}n||(s[v]=r(g))}return s};t.defaults={},e.removeCookie=function(n,o){return void 0!==e.cookie(n)&&(e.cookie(n,"",e.extend({},o,{expires:-1})),!0)}}));