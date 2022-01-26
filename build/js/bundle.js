document.addEventListener("DOMContentLoaded",()=>{dark_mode(),add_task(),edit_task(),cancel_edit_task(),pomodoro(),validate_inputs()});const dark_mode=()=>{const e=window.matchMedia("(prefers-color-scheme: dark)");e.matches?document.body.classList.add("dark-mode"):document.body.classList.remove("dark-mode"),e.addEventListener("change",(function(){e.matches?document.body.classList.add("dark-mode"):document.body.classList.remove("dark-mode")}))},create_alert=(e,t,n)=>{const o=document.createElement("DIV");o.classList.add("alert"),o.classList.add(""+e);const a=document.createElement("P");a.textContent=t,o.appendChild(a),document.querySelector(".alert")||(n.appendChild(o),setTimeout(()=>{n.removeChild(o)},2e3))},validate_inputs=()=>{const e=document.querySelectorAll(".input-title"),t=document.querySelectorAll(".input-file"),n=document.querySelectorAll(".save");n.forEach(e=>{e.classList.add("btn-disabled"),e.disabled=!0}),e.forEach(e=>{e.addEventListener("input",t=>{const o=e.parentNode.parentNode;t.target.value.length<4||t.target.value.length>45?(create_alert("error","Minimo 4 caracteres, Maximo 45.",o),n.forEach(e=>{e.classList.add("btn-disabled"),e.disabled=!0})):n.forEach(e=>{e.classList.remove("btn-disabled"),e.disabled=!1})})}),t.forEach(e=>{e.addEventListener("input",t=>{const n=e.parentNode.parentNode;t.target.files[0].size>4e6&&(create_alert("error","La imagen debe pesar menos de 5mb",n),t.target.value="")})})},notification=e=>{if(Notification)if("granted"!==Notification.permission)Notification.requestPermission();else{new Notification(e,{body:"Productivity +"})}else alert("Notificaciones no soportadas. Para una mejor experiencia actualiza tu navegador.")};function getRandomNumber(e,t){let n=t-e+1,o=Math.random()*n;return Math.floor(o)+e}const pomodoro=()=>{const e=document.querySelector(".tasks"),t=document.createElement("DIV");e.appendChild(t),pomodoro_state=document.querySelector(".pomodoro-state"),pomodoro_message=document.createElement("SPAN"),pomodoro_state.appendChild(pomodoro_message);const n=document.getElementById("start-pomodoro"),o=document.getElementById("timer"),a=document.querySelector(".pomodoro-start"),s=document.createElement("H3");s.classList.add("title"),s.textContent="Parar";const i=document.createElement("H3");i.classList.add("title"),i.textContent="Pomodoro.";const d=document.createElement("SPAN");d.textContent="25:5",n.addEventListener("click",()=>{e.classList.add("position-relative"),t.classList.add("position-absolute"),t.classList.add("disabled"),pomodoro_message.innerHTML="¡Concentrate!",n.classList.add("hidden"),a.innerHTML="",a.classList.add("btn-red-block"),a.appendChild(s);let r=0,c=0,l=!1;const A=setInterval(()=>{o.innerHTML=c<10?`0${c}:`:c+":",o.innerHTML+=r<10?"0"+r:""+r,r+=1,r>59&&(c+=1,r=0),c>24&&!l&&(c=0,r=0,l=!0,notification("¡Descanso!"),pomodoro_message.innerHTML="¡Descanso!"),c>4&&l&&(c=0,r=0,l=!1,notification("A trabajar!"),pomodoro_message.innerHTML="¡Concentrate!")},1e3);a.addEventListener("click",()=>{e.classList.remove("position-relative"),t.classList.remove("position-absolute"),t.classList.remove("disabled"),pomodoro_message.innerHTML="",clearInterval(A),o.innerHTML="00:00",a.innerHTML="",a.classList.remove("btn-red-block"),a.appendChild(i),a.appendChild(d),n.classList.remove("hidden")})})},cancel_edit_task=()=>{btn_cancel=document.querySelectorAll(".cancel-edit"),btn_cancel.forEach(e=>{e.addEventListener("click",e=>{e.preventDefault();const t=document.getElementById(e.target.id),n=document.getElementById(e.target.id+"-edit");t.classList.remove("hidden"),n.classList.add("hidden")})})},edit_task=()=>{btn_edit=document.querySelectorAll(".edit"),btn_edit.forEach(e=>{e.addEventListener("click",e=>{const t=document.getElementById(e.target.id),n=document.getElementById(e.target.id+"-edit");t.classList.add("hidden"),n.classList.remove("hidden")})})},add_task=()=>{document.querySelector("#btn-add").addEventListener("click",create_popup)},create_popup=()=>{const e=document.querySelector("body");e.classList.add("fixed");const t=document.querySelector(".overlay");t.classList.remove("hidden");document.querySelector(".cancel").addEventListener("click",n=>{n.preventDefault(),t.classList.add("hidden"),e.classList.remove("fixed")})}
/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-webp-setclasses !*/;!function(e,t,n){function o(e,t){return typeof e===t}function a(e){var t=A.className,n=c._config.classPrefix||"";if(m&&(t=t.baseVal),c._config.enableJSClass){var o=new RegExp("(^|\\s)"+n+"no-js(\\s|$)");t=t.replace(o,"$1"+n+"js$2")}c._config.enableClasses&&(t+=" "+n+e.join(" "+n),m?A.className.baseVal=t:A.className=t)}function s(e,t){if("object"==typeof e)for(var n in e)l(e,n)&&s(n,e[n]);else{var o=(e=e.toLowerCase()).split("."),i=c[o[0]];if(2==o.length&&(i=i[o[1]]),void 0!==i)return c;t="function"==typeof t?t():t,1==o.length?c[o[0]]=t:(!c[o[0]]||c[o[0]]instanceof Boolean||(c[o[0]]=new Boolean(c[o[0]])),c[o[0]][o[1]]=t),a([(t&&0!=t?"":"no-")+o.join("-")]),c._trigger(e,t)}return c}var i=[],d=[],r={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,t){var n=this;setTimeout((function(){t(n[e])}),0)},addTest:function(e,t,n){d.push({name:e,fn:t,options:n})},addAsyncTest:function(e){d.push({name:null,fn:e})}},c=function(){};c.prototype=r,c=new c;var l,A=t.documentElement,m="svg"===A.nodeName.toLowerCase();!function(){var e={}.hasOwnProperty;l=o(e,"undefined")||o(e.call,"undefined")?function(e,t){return t in e&&o(e.constructor.prototype[t],"undefined")}:function(t,n){return e.call(t,n)}}(),r._l={},r.on=function(e,t){this._l[e]||(this._l[e]=[]),this._l[e].push(t),c.hasOwnProperty(e)&&setTimeout((function(){c._trigger(e,c[e])}),0)},r._trigger=function(e,t){if(this._l[e]){var n=this._l[e];setTimeout((function(){var e;for(e=0;e<n.length;e++)(0,n[e])(t)}),0),delete this._l[e]}},c._q.push((function(){r.addTest=s})),c.addAsyncTest((function(){function e(e,t,n){function o(t){var o=!(!t||"load"!==t.type)&&1==a.width;s(e,"webp"===e&&o?new Boolean(o):o),n&&n(t)}var a=new Image;a.onerror=o,a.onload=o,a.src=t}var t=[{uri:"data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA=",name:"webp"},{uri:"data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAABBxAR/Q9ERP8DAABWUDggGAAAADABAJ0BKgEAAQADADQlpAADcAD++/1QAA==",name:"webp.alpha"},{uri:"data:image/webp;base64,UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA",name:"webp.animation"},{uri:"data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA=",name:"webp.lossless"}],n=t.shift();e(n.name,n.uri,(function(n){if(n&&"load"===n.type)for(var o=0;o<t.length;o++)e(t[o].name,t[o].uri)}))})),function(){var e,t,n,a,s,r;for(var l in d)if(d.hasOwnProperty(l)){if(e=[],(t=d[l]).name&&(e.push(t.name.toLowerCase()),t.options&&t.options.aliases&&t.options.aliases.length))for(n=0;n<t.options.aliases.length;n++)e.push(t.options.aliases[n].toLowerCase());for(a=o(t.fn,"function")?t.fn():t.fn,s=0;s<e.length;s++)1===(r=e[s].split(".")).length?c[r[0]]=a:(!c[r[0]]||c[r[0]]instanceof Boolean||(c[r[0]]=new Boolean(c[r[0]])),c[r[0]][r[1]]=a),i.push((a?"":"no-")+r.join("-"))}}(),a(i),delete r.addTest,delete r.addAsyncTest;for(var u=0;u<c._q.length;u++)c._q[u]();e.Modernizr=c}(window,document);
//# sourceMappingURL=bundle.js.map
