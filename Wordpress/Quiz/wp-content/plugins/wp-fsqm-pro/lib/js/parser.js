/*
 Based on ndef.parser, by Raphael Graf(r@undefined.ch)
 http://www.undefined.ch/mparser/index.html

 Ported to JavaScript and modified by Matthew Crumley (email@matthewcrumley.com, http://silentmatt.com/)

 You are free to use and modify this code in anyway you find useful. Please leave this comment in the code
 to acknowledge its original source. If you feel like it, I enjoy hearing about projects that use my code,
 but don't feel like you have to let me know or ask permission.
*/

var Parser=function(a){function b(a){function b(){}return b.prototype=a,new b}function h(a,b,h,i){this.type_=a,this.index_=b||0,this.prio_=h||0,this.number_=void 0!==i&&null!==i?i:0,this.toString=function(){switch(this.type_){case c:return this.number_;case d:case e:case f:return this.index_;case g:return"CALL";default:return"Invalid Token"}}}function i(a,b,c,d){this.tokens=a,this.ops1=b,this.ops2=c,this.functions=d}function m(a){return"string"==typeof a?(k.lastIndex=0,k.test(a)?"'"+a.replace(k,function(a){var b=l[a];return"string"==typeof b?b:"\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4)})+"'":"'"+a+"'"):a}function n(a,b){return Number(a)+Number(b)}function o(a,b){return a-b}function p(a,b){return a*b}function q(a,b){return a/b}function r(a,b){return a%b}function s(a,b){return""+a+b}function t(a){return-a}function u(a){return Math.random()*(a||1)}function v(a){a=Math.floor(a);for(var b=a;a>1;)b*=--a;return b}function w(a,b){return Math.sqrt(a*a+b*b)}function x(a,b){return"[object Array]"!=Object.prototype.toString.call(a)?[a,b]:(a=a.slice(),a.push(b),a)}function y(){this.success=!1,this.errormsg="",this.expression="",this.pos=0,this.tokennumber=0,this.tokenprio=0,this.tokenindex=0,this.tmpprio=0,this.ops1={sin:Math.sin,cos:Math.cos,tan:Math.tan,asin:Math.asin,acos:Math.acos,atan:Math.atan,sqrt:Math.sqrt,log:Math.log,abs:Math.abs,ceil:Math.ceil,floor:Math.floor,round:Math.round,"-":t,exp:Math.exp},this.ops2={"+":n,"-":o,"*":p,"/":q,"%":r,"^":Math.pow,",":x,"||":s},this.functions={random:u,fac:v,min:Math.min,max:Math.max,pyt:w,pow:Math.pow,atan2:Math.atan2},this.consts={_E:Math.E,PI:Math.PI}}var c=0,d=1,e=2,f=3,g=4,k=/[\\\'\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,l={"\b":"\\b","	":"\\t","\n":"\\n","\f":"\\f","\r":"\\r","'":"\\'","\\":"\\\\"};i.prototype={simplify:function(a){a=a||{};var k,l,m,o,g=[],j=[],n=this.tokens.length,p=0;for(p=0;n>p;p++){o=this.tokens[p];var q=o.type_;if(q===c)g.push(o);else if(q===f&&o.index_ in a)o=new h(c,0,0,a[o.index_]),g.push(o);else if(q===e&&g.length>1)l=g.pop(),k=g.pop(),m=this.ops2[o.index_],o=new h(c,0,0,m(k.number_,l.number_)),g.push(o);else if(q===d&&g.length>0)k=g.pop(),m=this.ops1[o.index_],o=new h(c,0,0,m(k.number_)),g.push(o);else{for(;g.length>0;)j.push(g.shift());j.push(o)}}for(;g.length>0;)j.push(g.shift());return new i(j,b(this.ops1),b(this.ops2),b(this.functions))},substitute:function(a,c){c instanceof i||(c=(new y).parse(String(c)));var g,d=[],e=this.tokens.length,j=0;for(j=0;e>j;j++){g=this.tokens[j];var k=g.type_;if(k===f&&g.index_===a)for(var l=0;l<c.tokens.length;l++){var m=c.tokens[l],n=new h(m.type_,m.index_,m.prio_,m.number_);d.push(n)}else d.push(g)}var o=new i(d,b(this.ops1),b(this.ops2),b(this.functions));return o},evaluate:function(a){a=a||{};var h,i,j,l,b=[],k=this.tokens.length,m=0;for(m=0;k>m;m++){l=this.tokens[m];var n=l.type_;if(n===c)b.push(l.number_);else if(n===e)i=b.pop(),h=b.pop(),j=this.ops2[l.index_],b.push(j(h,i));else if(n===f)if(l.index_ in a)b.push(a[l.index_]);else{if(!(l.index_ in this.functions))throw new Error("undefined variable: "+l.index_);b.push(this.functions[l.index_])}else if(n===d)h=b.pop(),j=this.ops1[l.index_],b.push(j(h));else{if(n!==g)throw new Error("invalid Expression");if(h=b.pop(),j=b.pop(),!j.apply||!j.call)throw new Error(j+" is not a function");"[object Array]"==Object.prototype.toString.call(h)?b.push(j.apply(void 0,h)):b.push(j.call(void 0,h))}}if(b.length>1)throw new Error("invalid Expression (parity)");return b[0]},toString:function(a){var h,i,j,l,b=[],k=this.tokens.length,n=0;for(n=0;k>n;n++){l=this.tokens[n];var o=l.type_;if(o===c)b.push(m(l.number_));else if(o===e)i=b.pop(),h=b.pop(),j=l.index_,a&&"^"==j?b.push("Math.pow("+h+","+i+")"):b.push("("+h+j+i+")");else if(o===f)b.push(l.index_);else if(o===d)h=b.pop(),j=l.index_,"-"===j?b.push("("+j+h+")"):b.push(j+"("+h+")");else{if(o!==g)throw new Error("invalid Expression");h=b.pop(),j=b.pop(),b.push(j+"("+h+")")}}if(b.length>1)throw new Error("invalid Expression (parity)");return b[0]},variables:function(){for(var a=this.tokens.length,b=["random","fac","min","max","pyt","pow","atan2"],c=[],d=0;a>d;d++){var e=this.tokens[d];e.type_===f&&-1==c.indexOf(e.index_)&&-1==b.indexOf(e.index_)&&c.push(e.index_)}return c},toJSFunction:function(a,b){var c=new Function(a,"with(Parser.values) { return "+this.simplify(b).toString(!0)+"; }");return c}},y.parse=function(a){return(new y).parse(a)},y.evaluate=function(a,b){return y.parse(a).evaluate(b)},y.Expression=i,y.values={sin:Math.sin,cos:Math.cos,tan:Math.tan,asin:Math.asin,acos:Math.acos,atan:Math.atan,sqrt:Math.sqrt,log:Math.log,abs:Math.abs,ceil:Math.ceil,floor:Math.floor,round:Math.round,random:u,fac:v,exp:Math.exp,min:Math.min,max:Math.max,pyt:w,pow:Math.pow,atan2:Math.atan2,E:Math.E,PI:Math.PI};var z=1,A=2,B=4,C=8,D=16,E=32,F=64,G=128,H=256;return y.prototype={parse:function(a){this.errormsg="",this.success=!0;var j=[],k=[];this.tmpprio=0;var l=z|C|B|F,m=0;for(this.expression=a,this.pos=0;this.pos<this.expression.length;)if(this.isOperator())this.isSign()&&l&F?(this.isNegativeSign()&&(this.tokenprio=2,this.tokenindex="-",m++,this.addfunc(k,j,d)),l=z|C|B|F):this.isComment()||(0===(l&A)&&this.error_parsing(this.pos,"unexpected operator"),m+=2,this.addfunc(k,j,e),l=z|C|B|F);else if(this.isNumber()){0===(l&z)&&this.error_parsing(this.pos,"unexpected number");var n=new h(c,0,0,this.tokennumber);k.push(n),l=A|D|E}else if(this.isString()){0===(l&z)&&this.error_parsing(this.pos,"unexpected string");var n=new h(c,0,0,this.tokennumber);k.push(n),l=A|D|E}else if(this.isLeftParenth())0===(l&C)&&this.error_parsing(this.pos,'unexpected "("'),l&G&&(m+=2,this.tokenprio=-2,this.tokenindex=-1,this.addfunc(k,j,g)),l=z|C|B|F|H;else if(this.isRightParenth()){if(l&H){var n=new h(c,0,0,[]);k.push(n)}else 0===(l&D)&&this.error_parsing(this.pos,'unexpected ")"');l=A|D|E|C|G}else if(this.isComma())0===(l&E)&&this.error_parsing(this.pos,'unexpected ","'),this.addfunc(k,j,e),m+=2,l=z|C|B|F;else if(this.isConst()){0===(l&z)&&this.error_parsing(this.pos,"unexpected constant");var o=new h(c,0,0,this.tokennumber);k.push(o),l=A|D|E}else if(this.isOp2())0===(l&B)&&this.error_parsing(this.pos,"unexpected function"),this.addfunc(k,j,e),m+=2,l=C;else if(this.isOp1())0===(l&B)&&this.error_parsing(this.pos,"unexpected function"),this.addfunc(k,j,d),m++,l=C;else if(this.isVar()){0===(l&z)&&this.error_parsing(this.pos,"unexpected variable");var p=new h(f,this.tokenindex,0,0);k.push(p),l=A|D|E|C|G}else this.isWhite()||(""===this.errormsg?this.error_parsing(this.pos,"unknown character"):this.error_parsing(this.pos,this.errormsg));for((this.tmpprio<0||this.tmpprio>=10)&&this.error_parsing(this.pos,'unmatched "()"');j.length>0;){var q=j.pop();k.push(q)}return m+1!==k.length&&this.error_parsing(this.pos,"parity"),new i(k,b(this.ops1),b(this.ops2),b(this.functions))},evaluate:function(a,b){return this.parse(a).evaluate(b)},error_parsing:function(a,b){throw this.success=!1,this.errormsg="parse error [column "+a+"]: "+b,new Error(this.errormsg)},addfunc:function(a,b,c){for(var d=new h(c,this.tokenindex,this.tokenprio+this.tmpprio,0);b.length>0&&d.prio_<=b[b.length-1].prio_;)a.push(b.pop());b.push(d)},isNumber:function(){for(var a=!1,b="";this.pos<this.expression.length;){var c=this.expression.charCodeAt(this.pos);if(!(c>=48&&57>=c||46===c))break;b+=this.expression.charAt(this.pos),this.pos++,this.tokennumber=parseFloat(b),a=!0}return a},unescape:function(a,b){for(var c=[],d=!1,e=0;e<a.length;e++){var f=a.charAt(e);if(d){switch(f){case"'":c.push("'");break;case"\\":c.push("\\");break;case"/":c.push("/");break;case"b":c.push("\b");break;case"f":c.push("\f");break;case"n":c.push("\n");break;case"r":c.push("\r");break;case"t":c.push("	");break;case"u":var g=parseInt(a.substring(e+1,e+5),16);c.push(String.fromCharCode(g)),e+=4;break;default:throw this.error_parsing(b+e,"Illegal escape sequence: '\\"+f+"'")}d=!1}else"\\"==f?d=!0:c.push(f)}return c.join("")},isString:function(){var a=!1,b="",c=this.pos;if(this.pos<this.expression.length&&"'"==this.expression.charAt(this.pos))for(this.pos++;this.pos<this.expression.length;){var d=this.expression.charAt(this.pos);if("'"==d&&"\\"!=b.slice(-1)){this.pos++,this.tokennumber=this.unescape(b,c),a=!0;break}b+=this.expression.charAt(this.pos),this.pos++}return a},isConst:function(){var a;for(var b in this.consts){var c=b.length;if(a=this.expression.substr(this.pos,c),b===a)return this.tokennumber=this.consts[b],this.pos+=c,!0}return!1},isOperator:function(){var a=this.expression.charCodeAt(this.pos);if(43===a)this.tokenprio=0,this.tokenindex="+";else if(45===a)this.tokenprio=0,this.tokenindex="-";else if(124===a){if(124!==this.expression.charCodeAt(this.pos+1))return!1;this.pos++,this.tokenprio=0,this.tokenindex="||"}else if(42===a)this.tokenprio=1,this.tokenindex="*";else if(47===a)this.tokenprio=2,this.tokenindex="/";else if(37===a)this.tokenprio=2,this.tokenindex="%";else{if(94!==a)return!1;this.tokenprio=3,this.tokenindex="^"}return this.pos++,!0},isSign:function(){var a=this.expression.charCodeAt(this.pos-1);return 45===a||43===a?!0:!1},isPositiveSign:function(){var a=this.expression.charCodeAt(this.pos-1);return 43===a?!0:!1},isNegativeSign:function(){var a=this.expression.charCodeAt(this.pos-1);return 45===a?!0:!1},isLeftParenth:function(){var a=this.expression.charCodeAt(this.pos);return 40===a?(this.pos++,this.tmpprio+=10,!0):!1},isRightParenth:function(){var a=this.expression.charCodeAt(this.pos);return 41===a?(this.pos++,this.tmpprio-=10,!0):!1},isComma:function(){var a=this.expression.charCodeAt(this.pos);return 44===a?(this.pos++,this.tokenprio=-1,this.tokenindex=",",!0):!1},isWhite:function(){var a=this.expression.charCodeAt(this.pos);return 32===a||9===a||10===a||13===a?(this.pos++,!0):!1},isOp1:function(){for(var a="",b=this.pos;b<this.expression.length;b++){var c=this.expression.charAt(b);if(c.toUpperCase()===c.toLowerCase()&&(b===this.pos||"_"!=c&&("0">c||c>"9")))break;a+=c}return a.length>0&&a in this.ops1?(this.tokenindex=a,this.tokenprio=5,this.pos+=a.length,!0):!1},isOp2:function(){for(var a="",b=this.pos;b<this.expression.length;b++){var c=this.expression.charAt(b);if(c.toUpperCase()===c.toLowerCase()&&(b===this.pos||"_"!=c&&("0">c||c>"9")))break;a+=c}return a.length>0&&a in this.ops2?(this.tokenindex=a,this.tokenprio=5,this.pos+=a.length,!0):!1},isVar:function(){for(var a="",b=this.pos;b<this.expression.length;b++){var c=this.expression.charAt(b);if(c.toUpperCase()===c.toLowerCase()&&(b===this.pos||"_"!=c&&("0">c||c>"9")))break;a+=c}return a.length>0?(this.tokenindex=a,this.tokenprio=4,this.pos+=a.length,!0):!1},isComment:function(){var a=this.expression.charCodeAt(this.pos-1);return 47===a&&42===this.expression.charCodeAt(this.pos)?(this.pos=this.expression.indexOf("*/",this.pos)+2,1===this.pos&&(this.pos=this.expression.length),!0):!1}},a.Parser=y,y}("undefined"==typeof exports?{}:exports);
