let j={},ee;function O(e={}){j={animate:!0,allowClose:!0,overlayClickBehavior:"close",overlayOpacity:.7,smoothScroll:!1,disableActiveInteraction:!1,showProgress:!1,stagePadding:10,stageRadius:5,popoverOffset:10,showButtons:["next","previous","close"],disableButtons:[],overlayColor:"#000",...e}}function s(e){return e?j[e]:j}function be(e){ee=e}function B(){return ee}let R={};function q(e,t){R[e]=t}function P(e){var t;(t=R[e])==null||t.call(R)}function ye(){R={}}function N(e,t,o,n){return(e/=n/2)<1?o/2*e*e+t:-o/2*(--e*(e-2)-1)+t}function te(e){const t='a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])';return e.flatMap(o=>{const n=o.matches(t),i=Array.from(o.querySelectorAll(t));return[...n?[o]:[],...i]}).filter(o=>getComputedStyle(o).pointerEvents!=="none"&&ke(o))}function oe(e){if(!e||Ce(e))return;const t=s("smoothScroll"),o=e.offsetHeight>window.innerHeight;e.scrollIntoView({behavior:!t||xe(e)?"auto":"smooth",inline:"center",block:o?"start":"center"})}function xe(e){if(!e||!e.parentElement)return;const t=e.parentElement;return t.scrollHeight>t.clientHeight}function Ce(e){const t=e.getBoundingClientRect();return t.top>=0&&t.left>=0&&t.bottom<=(window.innerHeight||document.documentElement.clientHeight)&&t.right<=(window.innerWidth||document.documentElement.clientWidth)}function ke(e){return!!(e.offsetWidth||e.offsetHeight||e.getClientRects().length)}let z={};function E(e,t){z[e]=t}function d(e){return e?z[e]:z}function X(){z={}}function Ee(e,t,o,n){let i=d("__activeStagePosition");const r=i||o.getBoundingClientRect(),c=n.getBoundingClientRect(),m=N(e,r.x,c.x-r.x,t),l=N(e,r.y,c.y-r.y,t),g=N(e,r.width,c.width-r.width,t),u=N(e,r.height,c.height-r.height,t);i={x:m,y:l,width:g,height:u},ne(i),E("__activeStagePosition",i)}function ie(e){if(!e)return;const t=e.getBoundingClientRect(),o={x:t.x,y:t.y,width:t.width,height:t.height};E("__activeStagePosition",o),ne(o)}function Le(){const e=d("__activeStagePosition"),t=d("__overlaySvg");if(!e)return;if(!t){console.warn("No stage svg found.");return}const o=window.innerWidth,n=window.innerHeight;t.setAttribute("viewBox",`0 0 ${o} ${n}`)}function Be(e){const t=_e(e);document.body.appendChild(t),se(t,o=>{o.target.tagName==="path"&&P("overlayClick")}),E("__overlaySvg",t)}function ne(e){const t=d("__overlaySvg");if(!t){Be(e);return}const o=t.firstElementChild;if((o==null?void 0:o.tagName)!=="path")throw new Error("no path element found in stage svg");o.setAttribute("d",re(e))}function _e(e){const t=window.innerWidth,o=window.innerHeight,n=document.createElementNS("http://www.w3.org/2000/svg","svg");n.classList.add("driver-overlay","driver-overlay-animated"),n.setAttribute("viewBox",`0 0 ${t} ${o}`),n.setAttribute("xmlSpace","preserve"),n.setAttribute("xmlnsXlink","http://www.w3.org/1999/xlink"),n.setAttribute("version","1.1"),n.setAttribute("preserveAspectRatio","xMinYMin slice"),n.style.fillRule="evenodd",n.style.clipRule="evenodd",n.style.strokeLinejoin="round",n.style.strokeMiterlimit="2",n.style.zIndex="10000",n.style.position="fixed",n.style.top="0",n.style.left="0",n.style.width="100%",n.style.height="100%";const i=document.createElementNS("http://www.w3.org/2000/svg","path");return i.setAttribute("d",re(e)),i.style.fill=s("overlayColor")||"rgb(0,0,0)",i.style.opacity=`${s("overlayOpacity")}`,i.style.pointerEvents="auto",i.style.cursor="auto",n.appendChild(i),n}function re(e){const t=window.innerWidth,o=window.innerHeight,n=s("stagePadding")||0,i=s("stageRadius")||0,r=e.width+n*2,c=e.height+n*2,m=Math.min(i,r/2,c/2),l=Math.floor(Math.max(m,0)),g=e.x-n+l,u=e.y-n,b=r-l*2,a=c-l*2;return`M${t},0L0,0L0,${o}L${t},${o}L${t},0Z
    M${g},${u} h${b} a${l},${l} 0 0 1 ${l},${l} v${a} a${l},${l} 0 0 1 -${l},${l} h-${b} a${l},${l} 0 0 1 -${l},-${l} v-${a} a${l},${l} 0 0 1 ${l},-${l} z`}function Pe(){const e=d("__overlaySvg");e&&e.remove()}function Ae(){const e=document.getElementById("driver-dummy-element");if(e)return e;let t=document.createElement("div");return t.id="driver-dummy-element",t.style.width="0",t.style.height="0",t.style.pointerEvents="none",t.style.opacity="0",t.style.position="fixed",t.style.top="50%",t.style.left="50%",document.body.appendChild(t),t}function K(e){const{element:t}=e;let o=typeof t=="function"?t():typeof t=="string"?document.querySelector(t):t;o||(o=Ae()),Te(o,e)}function Se(){const e=d("__activeElement"),t=d("__activeStep");e&&(ie(e),Le(),de(e,t))}function Te(e,t){var o;const n=Date.now(),i=d("__activeStep"),r=d("__activeElement")||e,c=!r||r===e,m=e.id==="driver-dummy-element",l=r.id==="driver-dummy-element",g=s("animate"),u=t.onHighlightStarted||s("onHighlightStarted"),b=(t==null?void 0:t.onHighlighted)||s("onHighlighted"),a=(i==null?void 0:i.onDeselected)||s("onDeselected"),p=s(),h=d();!c&&a&&a(l?void 0:r,i,{config:p,state:h,driver:B()}),u&&u(m?void 0:e,t,{config:p,state:h,driver:B()});const f=!c&&g;let v=!1;Ie(),E("previousStep",i),E("previousElement",r),E("activeStep",t),E("activeElement",e);const w=()=>{if(d("__transitionCallback")!==w)return;const x=Date.now()-n,C=400-x<=400/2;t.popover&&C&&!v&&f&&(V(e,t),v=!0),s("animate")&&x<400?Ee(x,400,r,e):(ie(e),b&&b(m?void 0:e,t,{config:s(),state:d(),driver:B()}),E("__transitionCallback",void 0),E("__previousStep",i),E("__previousElement",r),E("__activeStep",t),E("__activeElement",e)),window.requestAnimationFrame(w)};E("__transitionCallback",w),window.requestAnimationFrame(w),oe(e),!f&&t.popover&&V(e,t),r.classList.remove("driver-active-element","driver-no-interaction"),r.removeAttribute("aria-haspopup"),r.removeAttribute("aria-expanded"),r.removeAttribute("aria-controls"),((o=t.disableActiveInteraction)!=null?o:s("disableActiveInteraction"))&&e.classList.add("driver-no-interaction"),e.classList.add("driver-active-element"),e.setAttribute("aria-haspopup","dialog"),e.setAttribute("aria-expanded","true"),e.setAttribute("aria-controls","driver-popover-content")}function $e(){var e;(e=document.getElementById("driver-dummy-element"))==null||e.remove(),document.querySelectorAll(".driver-active-element").forEach(t=>{t.classList.remove("driver-active-element","driver-no-interaction"),t.removeAttribute("aria-haspopup"),t.removeAttribute("aria-expanded"),t.removeAttribute("aria-controls")})}function T(){const e=d("__resizeTimeout");e&&window.cancelAnimationFrame(e),E("__resizeTimeout",window.requestAnimationFrame(Se))}function He(e){var t;if(!d("isInitialized")||!(e.key==="Tab"||e.keyCode===9))return;const o=d("__activeElement"),n=(t=d("popover"))==null?void 0:t.wrapper,i=te([...n?[n]:[],...o?[o]:[]]),r=i[0],c=i[i.length-1];if(e.preventDefault(),e.shiftKey){const m=i[i.indexOf(document.activeElement)-1]||c;m==null||m.focus()}else{const m=i[i.indexOf(document.activeElement)+1]||r;m==null||m.focus()}}function ae(e){var t;((t=s("allowKeyboardControl"))==null||t)&&(e.key==="Escape"?P("escapePress"):e.key==="ArrowRight"?P("arrowRightPress"):e.key==="ArrowLeft"&&P("arrowLeftPress"))}function se(e,t,o){const n=(i,r)=>{const c=i.target;e.contains(c)&&((!o||o(c))&&(i.preventDefault(),i.stopPropagation(),i.stopImmediatePropagation()),r==null||r(i))};document.addEventListener("pointerdown",n,!0),document.addEventListener("mousedown",n,!0),document.addEventListener("pointerup",n,!0),document.addEventListener("mouseup",n,!0),document.addEventListener("click",i=>{n(i,t)},!0)}function Me(){window.addEventListener("keyup",ae,!1),window.addEventListener("keydown",He,!1),window.addEventListener("resize",T),window.addEventListener("scroll",T)}function De(){window.removeEventListener("keyup",ae),window.removeEventListener("resize",T),window.removeEventListener("scroll",T)}function Ie(){const e=d("popover");e&&(e.wrapper.style.display="none")}function V(e,t){var o,n;let i=d("popover");i&&document.body.removeChild(i.wrapper),i=qe(),document.body.appendChild(i.wrapper);const{title:r,description:c,showButtons:m,disableButtons:l,showProgress:g,nextBtnText:u=s("nextBtnText")||"Next &rarr;",prevBtnText:b=s("prevBtnText")||"&larr; Previous",progressText:a=s("progressText")||"{current} of {total}"}=t.popover||{};i.nextButton.innerHTML=u,i.previousButton.innerHTML=b,i.progress.innerHTML=a,r?(i.title.innerHTML=r,i.title.style.display="block"):i.title.style.display="none",c?(i.description.innerHTML=c,i.description.style.display="block"):i.description.style.display="none";const p=m||s("showButtons"),h=g||s("showProgress")||!1,f=(p==null?void 0:p.includes("next"))||(p==null?void 0:p.includes("previous"))||h;i.closeButton.style.display=p.includes("close")?"block":"none",f?(i.footer.style.display="flex",i.progress.style.display=h?"block":"none",i.nextButton.style.display=p.includes("next")?"block":"none",i.previousButton.style.display=p.includes("previous")?"block":"none"):i.footer.style.display="none";const v=l||s("disableButtons")||[];v!=null&&v.includes("next")&&(i.nextButton.disabled=!0,i.nextButton.classList.add("driver-popover-btn-disabled")),v!=null&&v.includes("previous")&&(i.previousButton.disabled=!0,i.previousButton.classList.add("driver-popover-btn-disabled")),v!=null&&v.includes("close")&&(i.closeButton.disabled=!0,i.closeButton.classList.add("driver-popover-btn-disabled"));const w=i.wrapper;w.style.display="block",w.style.left="",w.style.top="",w.style.bottom="",w.style.right="",w.id="driver-popover-content",w.setAttribute("role","dialog"),w.setAttribute("aria-labelledby","driver-popover-title"),w.setAttribute("aria-describedby","driver-popover-description");const x=i.arrow;x.className="driver-popover-arrow";const C=((o=t.popover)==null?void 0:o.popoverClass)||s("popoverClass")||"";w.className=`driver-popover ${C}`.trim(),se(i.wrapper,_=>{var H,M,D;const S=_.target,I=((H=t.popover)==null?void 0:H.onNextClick)||s("onNextClick"),A=((M=t.popover)==null?void 0:M.onPrevClick)||s("onPrevClick"),W=((D=t.popover)==null?void 0:D.onCloseClick)||s("onCloseClick");if(S.closest(".driver-popover-next-btn"))return I?I(e,t,{config:s(),state:d(),driver:B()}):P("nextClick");if(S.closest(".driver-popover-prev-btn"))return A?A(e,t,{config:s(),state:d(),driver:B()}):P("prevClick");if(S.closest(".driver-popover-close-btn"))return W?W(e,t,{config:s(),state:d(),driver:B()}):P("closeClick")},_=>!(i!=null&&i.description.contains(_))&&!(i!=null&&i.title.contains(_))&&typeof _.className=="string"&&_.className.includes("driver-popover")),E("popover",i);const L=((n=t.popover)==null?void 0:n.onPopoverRender)||s("onPopoverRender");L&&L(i,{config:s(),state:d(),driver:B()}),de(e,t),oe(w);const k=e.classList.contains("driver-dummy-element"),y=te([w,...k?[]:[e]]);y.length>0&&y[0].focus()}function le(){const e=d("popover");if(!(e!=null&&e.wrapper))return;const t=e.wrapper.getBoundingClientRect(),o=s("stagePadding")||0,n=s("popoverOffset")||0;return{width:t.width+o+n,height:t.height+o+n,realWidth:t.width,realHeight:t.height}}function U(e,t){const{elementDimensions:o,popoverDimensions:n,popoverPadding:i,popoverArrowDimensions:r}=t;return e==="start"?Math.max(Math.min(o.top-i,window.innerHeight-n.realHeight-r.width),r.width):e==="end"?Math.max(Math.min(o.top-(n==null?void 0:n.realHeight)+o.height+i,window.innerHeight-(n==null?void 0:n.realHeight)-r.width),r.width):e==="center"?Math.max(Math.min(o.top+o.height/2-(n==null?void 0:n.realHeight)/2,window.innerHeight-(n==null?void 0:n.realHeight)-r.width),r.width):0}function Z(e,t){const{elementDimensions:o,popoverDimensions:n,popoverPadding:i,popoverArrowDimensions:r}=t;return e==="start"?Math.max(Math.min(o.left-i,window.innerWidth-n.realWidth-r.width),r.width):e==="end"?Math.max(Math.min(o.left-(n==null?void 0:n.realWidth)+o.width+i,window.innerWidth-(n==null?void 0:n.realWidth)-r.width),r.width):e==="center"?Math.max(Math.min(o.left+o.width/2-(n==null?void 0:n.realWidth)/2,window.innerWidth-(n==null?void 0:n.realWidth)-r.width),r.width):0}function de(e,t){const o=d("popover");if(!o)return;const{align:n="start",side:i="left"}=(t==null?void 0:t.popover)||{},r=n,c=e.id==="driver-dummy-element"?"over":i,m=s("stagePadding")||0,l=le(),g=o.arrow.getBoundingClientRect(),u=e.getBoundingClientRect(),b=u.top-l.height;let a=b>=0;const p=window.innerHeight-(u.bottom+l.height);let h=p>=0;const f=u.left-l.width;let v=f>=0;const w=window.innerWidth-(u.right+l.width);let x=w>=0;const C=!a&&!h&&!v&&!x;let L=c;if(c==="top"&&a?x=v=h=!1:c==="bottom"&&h?x=v=a=!1:c==="left"&&v?x=a=h=!1:c==="right"&&x&&(v=a=h=!1),c==="over"){const k=window.innerWidth/2-l.realWidth/2,y=window.innerHeight/2-l.realHeight/2;o.wrapper.style.left=`${k}px`,o.wrapper.style.right="auto",o.wrapper.style.top=`${y}px`,o.wrapper.style.bottom="auto"}else if(C){const k=window.innerWidth/2-(l==null?void 0:l.realWidth)/2,y=10;o.wrapper.style.left=`${k}px`,o.wrapper.style.right="auto",o.wrapper.style.bottom=`${y}px`,o.wrapper.style.top="auto"}else if(v){const k=Math.min(f,window.innerWidth-(l==null?void 0:l.realWidth)-g.width),y=U(r,{elementDimensions:u,popoverDimensions:l,popoverPadding:m,popoverArrowDimensions:g});o.wrapper.style.left=`${k}px`,o.wrapper.style.top=`${y}px`,o.wrapper.style.bottom="auto",o.wrapper.style.right="auto",L="left"}else if(x){const k=Math.min(w,window.innerWidth-(l==null?void 0:l.realWidth)-g.width),y=U(r,{elementDimensions:u,popoverDimensions:l,popoverPadding:m,popoverArrowDimensions:g});o.wrapper.style.right=`${k}px`,o.wrapper.style.top=`${y}px`,o.wrapper.style.bottom="auto",o.wrapper.style.left="auto",L="right"}else if(a){const k=Math.min(b,window.innerHeight-l.realHeight-g.width);let y=Z(r,{elementDimensions:u,popoverDimensions:l,popoverPadding:m,popoverArrowDimensions:g});o.wrapper.style.top=`${k}px`,o.wrapper.style.left=`${y}px`,o.wrapper.style.bottom="auto",o.wrapper.style.right="auto",L="top"}else if(h){const k=Math.min(p,window.innerHeight-(l==null?void 0:l.realHeight)-g.width);let y=Z(r,{elementDimensions:u,popoverDimensions:l,popoverPadding:m,popoverArrowDimensions:g});o.wrapper.style.left=`${y}px`,o.wrapper.style.bottom=`${k}px`,o.wrapper.style.top="auto",o.wrapper.style.right="auto",L="bottom"}C?o.arrow.classList.add("driver-popover-arrow-none"):We(r,L,e)}function We(e,t,o){const n=d("popover");if(!n)return;const i=o.getBoundingClientRect(),r=le(),c=n.arrow,m=r.width,l=window.innerWidth,g=i.width,u=i.left,b=r.height,a=window.innerHeight,p=i.top,h=i.height;c.className="driver-popover-arrow";let f=t,v=e;if(t==="top"?(u+g<=0?(f="right",v="end"):u+g-m<=0&&(f="top",v="start"),u>=l?(f="left",v="end"):u+m>=l&&(f="top",v="end")):t==="bottom"?(u+g<=0?(f="right",v="start"):u+g-m<=0&&(f="bottom",v="start"),u>=l?(f="left",v="start"):u+m>=l&&(f="bottom",v="end")):t==="left"?(p+h<=0?(f="bottom",v="end"):p+h-b<=0&&(f="left",v="start"),p>=a?(f="top",v="end"):p+b>=a&&(f="left",v="end")):t==="right"&&(p+h<=0?(f="bottom",v="start"):p+h-b<=0&&(f="right",v="start"),p>=a?(f="top",v="start"):p+b>=a&&(f="right",v="end")),!f)c.classList.add("driver-popover-arrow-none");else{c.classList.add(`driver-popover-arrow-side-${f}`),c.classList.add(`driver-popover-arrow-align-${v}`);const w=o.getBoundingClientRect(),x=c.getBoundingClientRect(),C=s("stagePadding")||0,L=w.left-C<window.innerWidth&&w.right+C>0&&w.top-C<window.innerHeight&&w.bottom+C>0;t==="bottom"&&L&&(x.x>w.x&&x.x+x.width<w.x+w.width?n.wrapper.style.transform="translateY(0)":(c.classList.remove(`driver-popover-arrow-align-${v}`),c.classList.add("driver-popover-arrow-none"),n.wrapper.style.transform=`translateY(-${C/2}px)`))}}function qe(){const e=document.createElement("div");e.classList.add("driver-popover");const t=document.createElement("div");t.classList.add("driver-popover-arrow");const o=document.createElement("header");o.id="driver-popover-title",o.classList.add("driver-popover-title"),o.style.display="none",o.innerText="Popover Title";const n=document.createElement("div");n.id="driver-popover-description",n.classList.add("driver-popover-description"),n.style.display="none",n.innerText="Popover description is here";const i=document.createElement("button");i.type="button",i.classList.add("driver-popover-close-btn"),i.setAttribute("aria-label","Close"),i.innerHTML="&times;";const r=document.createElement("footer");r.classList.add("driver-popover-footer");const c=document.createElement("span");c.classList.add("driver-popover-progress-text"),c.innerText="";const m=document.createElement("span");m.classList.add("driver-popover-navigation-btns");const l=document.createElement("button");l.type="button",l.classList.add("driver-popover-prev-btn"),l.innerHTML="&larr; Previous";const g=document.createElement("button");return g.type="button",g.classList.add("driver-popover-next-btn"),g.innerHTML="Next &rarr;",m.appendChild(l),m.appendChild(g),r.appendChild(c),r.appendChild(m),e.appendChild(i),e.appendChild(t),e.appendChild(o),e.appendChild(n),e.appendChild(r),{wrapper:e,arrow:t,title:o,description:n,footer:r,previousButton:l,nextButton:g,closeButton:i,footerButtons:m,progress:c}}function Ne(){var e;const t=d("popover");t&&((e=t.wrapper.parentElement)==null||e.removeChild(t.wrapper))}function Re(e={}){O(e);function t(){s("allowClose")&&u()}function o(){const a=s("overlayClickBehavior");if(s("allowClose")&&a==="close"){u();return}if(typeof a=="function"){const p=d("__activeStep"),h=d("__activeElement");a(h,p,{config:s(),state:d(),driver:B()});return}a==="nextStep"&&n()}function n(){const a=d("activeIndex"),p=s("steps")||[];if(typeof a>"u")return;const h=a+1;p[h]?g(h):u()}function i(){const a=d("activeIndex"),p=s("steps")||[];if(typeof a>"u")return;const h=a-1;p[h]?g(h):u()}function r(a){(s("steps")||[])[a]?g(a):u()}function c(){var a;if(d("__transitionCallback"))return;const p=d("activeIndex"),h=d("__activeStep"),f=d("__activeElement");if(typeof p>"u"||typeof h>"u"||typeof d("activeIndex")>"u")return;const v=((a=h.popover)==null?void 0:a.onPrevClick)||s("onPrevClick");if(v)return v(f,h,{config:s(),state:d(),driver:B()});i()}function m(){var a;if(d("__transitionCallback"))return;const p=d("activeIndex"),h=d("__activeStep"),f=d("__activeElement");if(typeof p>"u"||typeof h>"u")return;const v=((a=h.popover)==null?void 0:a.onNextClick)||s("onNextClick");if(v)return v(f,h,{config:s(),state:d(),driver:B()});n()}function l(){d("isInitialized")||(E("isInitialized",!0),document.body.classList.add("driver-active",s("animate")?"driver-fade":"driver-simple"),Me(),q("overlayClick",o),q("escapePress",t),q("arrowLeftPress",c),q("arrowRightPress",m))}function g(a=0){var p,h,f,v,w,x,C,L;const k=s("steps");if(!k){console.error("No steps to drive through"),u();return}if(!k[a]){u();return}E("__activeOnDestroyed",document.activeElement),E("activeIndex",a);const y=k[a],_=k[a+1],H=k[a-1],M=((p=y.popover)==null?void 0:p.doneBtnText)||s("doneBtnText")||"Done",D=s("allowClose"),S=typeof((h=y.popover)==null?void 0:h.showProgress)<"u"?(f=y.popover)==null?void 0:f.showProgress:s("showProgress"),I=(((v=y.popover)==null?void 0:v.progressText)||s("progressText")||"{{current}} of {{total}}").replace("{{current}}",`${a+1}`).replace("{{total}}",`${k.length}`),A=((w=y.popover)==null?void 0:w.showButtons)||s("showButtons"),W=["next","previous",...D?["close"]:[]].filter(we=>!(A!=null&&A.length)||A.includes(we)),he=((x=y.popover)==null?void 0:x.onNextClick)||s("onNextClick"),ge=((C=y.popover)==null?void 0:C.onPrevClick)||s("onPrevClick"),fe=((L=y.popover)==null?void 0:L.onCloseClick)||s("onCloseClick");K({...y,popover:{showButtons:W,nextBtnText:_?void 0:M,disableButtons:[...H?[]:["previous"]],showProgress:S,progressText:I,onNextClick:he||(()=>{_?g(a+1):u()}),onPrevClick:ge||(()=>{g(a-1)}),onCloseClick:fe||(()=>{u()}),...(y==null?void 0:y.popover)||{}}})}function u(a=!0){const p=d("__activeElement"),h=d("__activeStep"),f=d("__activeOnDestroyed"),v=s("onDestroyStarted");if(a&&v){const C=!p||(p==null?void 0:p.id)==="driver-dummy-element";v(C?void 0:p,h,{config:s(),state:d(),driver:B()});return}const w=(h==null?void 0:h.onDeselected)||s("onDeselected"),x=s("onDestroyed");if(document.body.classList.remove("driver-active","driver-fade","driver-simple"),De(),Ne(),$e(),Pe(),ye(),X(),p&&h){const C=p.id==="driver-dummy-element";w&&w(C?void 0:p,h,{config:s(),state:d(),driver:B()}),x&&x(C?void 0:p,h,{config:s(),state:d(),driver:B()})}f&&f.focus()}const b={isActive:()=>d("isInitialized")||!1,refresh:T,drive:(a=0)=>{l(),g(a)},setConfig:O,setSteps:a=>{X(),O({...s(),steps:a})},getConfig:s,getState:d,getActiveIndex:()=>d("activeIndex"),isFirstStep:()=>d("activeIndex")===0,isLastStep:()=>{const a=s("steps")||[],p=d("activeIndex");return p!==void 0&&p===a.length-1},getActiveStep:()=>d("activeStep"),getActiveElement:()=>d("activeElement"),getPreviousElement:()=>d("previousElement"),getPreviousStep:()=>d("previousStep"),moveNext:n,movePrevious:i,moveTo:r,hasNextStep:()=>{const a=s("steps")||[],p=d("activeIndex");return p!==void 0&&!!a[p+1]},hasPreviousStep:()=>{const a=s("steps")||[],p=d("activeIndex");return p!==void 0&&!!a[p-1]},highlight:a=>{l(),K({...a,popover:a.popover?{showButtons:[],showProgress:!1,progressText:"",...a.popover}:void 0})},destroy:()=>{u(!1)}};return be(b),b}const J={dashboard:[{element:'[href*="/admin"]',popover:{title:"Panel de Administración",description:"Bienvenido al panel de Trama Educativa. Desde aquí puedes gestionar todo el contenido del sitio.",side:"bottom"}},{element:'nav[aria-label="Sidebar"]',popover:{title:"Menú Principal",description:"Este es el menú de navegación. Aquí encontrarás todas las secciones: Artículos, Categorías, Autores y Etiquetas.",side:"right"}},{element:'[href*="articles"]',popover:{title:"Artículos",description:"Gestiona los artículos del portal. Puedes crear, editar, publicar y eliminar notas.",side:"right"}},{element:'[href*="categories"]',popover:{title:"Categorías",description:"Organiza los artículos en categorías temáticas.",side:"right"}},{element:'[href*="authors"]',popover:{title:"Autores",description:"Administra los autores y colaboradores del portal.",side:"right"}},{element:'[href*="tags"]',popover:{title:"Etiquetas",description:"Crea y gestiona etiquetas para clasificar el contenido.",side:"right"}}],articles:[{element:"h1",popover:{title:"Listado de Artículos",description:"Aquí ves todos los artículos del portal. Puedes ordenarlos, filtrarlos y buscar.",side:"bottom"}},{element:'[wire\\:click*="create"], a[href*="create"]',popover:{title:"Crear Artículo",description:"Haz clic aquí para crear un nuevo artículo.",side:"left"}},{element:'input[type="search"], input[placeholder*="Buscar"]',popover:{title:"Buscar",description:"Escribe aquí para buscar artículos por título o contenido.",side:"bottom"}},{element:"table, .fi-ta-table",popover:{title:"Tabla de Artículos",description:"Haz clic en cualquier fila para editar el artículo. Las columnas se pueden ordenar haciendo clic en el encabezado.",side:"top"}}],"articles-form":[{element:'input[name*="title"], [wire\\:model*="title"]',popover:{title:"Título",description:"El título principal del artículo. Será visible en el listado y en la página del artículo.",side:"bottom"}},{element:'[wire\\:model*="category"], select[name*="category"]',popover:{title:"Categoría",description:"Selecciona la categoría principal del artículo.",side:"bottom"}},{element:'[wire\\:model*="author"], select[name*="author"]',popover:{title:"Autor",description:"Selecciona quién escribió este artículo.",side:"bottom"}},{element:'[wire\\:model*="content"], .trix-editor, .ql-editor, textarea',popover:{title:"Contenido",description:"Escribe aquí el cuerpo del artículo. Puedes usar formato, agregar imágenes y enlaces.",side:"top"}},{element:'button[type="submit"], button[wire\\:click*="save"]',popover:{title:"Guardar",description:"Cuando termines, haz clic aquí para guardar los cambios.",side:"left"}}],categories:[{element:"h1",popover:{title:"Categorías",description:"Las categorías organizan los artículos por temas. Cada artículo debe tener una categoría.",side:"bottom"}},{element:'[wire\\:click*="create"], a[href*="create"]',popover:{title:"Nueva Categoría",description:"Crea una nueva categoría para organizar los artículos.",side:"left"}}],authors:[{element:"h1",popover:{title:"Autores",description:"Gestiona los autores del portal. Cada autor puede tener múltiples artículos.",side:"bottom"}}],tags:[{element:"h1",popover:{title:"Etiquetas",description:"Las etiquetas permiten clasificar artículos con palabras clave. Un artículo puede tener múltiples etiquetas.",side:"bottom"}}]},ze={dashboard:[{selector:".fi-sidebar-nav",text:"Menú de navegación",type:"info",position:"right"},{selector:".fi-avatar",text:"Tu perfil de usuario",type:"info",position:"bottom"}],articles:[{selector:'.fi-btn-create, a[href*="create"], .fi-ac-btn-action',text:"Crear nuevo artículo",type:"action",position:"left"},{selector:'.fi-ta-search-field input, input[placeholder*="Buscar"], .fi-input',text:"Buscar por título",type:"tip",position:"bottom"},{selector:".fi-ta-header-cell:first-child",text:"Ordenar columnas",type:"tip",position:"bottom"},{selector:".fi-sidebar-item.fi-active",text:"Sección actual",type:"info",position:"right"}],categories:[{selector:'.fi-btn-create, a[href*="create"], .fi-ac-btn-action',text:"Nueva categoría",type:"action",position:"left"}],authors:[{selector:'.fi-btn-create, a[href*="create"], .fi-ac-btn-action',text:"Nuevo autor",type:"action",position:"left"}],tags:[{selector:'.fi-btn-create, a[href*="create"], .fi-ac-btn-action',text:"Nueva etiqueta",type:"action",position:"left"}]};function pe(){const e=window.location.pathname;return e.includes("/articles/create")||e.includes("/articles/")&&e.includes("/edit")?"articles-form":e.includes("/articles")?"articles":e.includes("/categories")?"categories":e.includes("/authors")?"authors":e.includes("/tags")?"tags":(e.includes("/admin"),"dashboard")}function ce(){const e=pe(),o=(J[e]||J.dashboard).filter(i=>i.element?document.querySelector(i.element):!0);if(o.length===0){alert("No hay guía disponible para esta página.");return}Re({showProgress:!0,animate:!0,smoothScroll:!0,allowClose:!0,stagePadding:5,stageRadius:5,popoverClass:"trama-tour-popover",progressText:"Paso {{current}} de {{total}}",nextBtnText:"Siguiente",prevBtnText:"Anterior",doneBtnText:"Finalizar",steps:o}).drive()}let $=!1,G=[];function ue(){$?Y():ve()}function ve(){const e=pe();(ze[e]||[]).forEach((o,n)=>{const i=document.querySelector(o.selector);if(!i)return;const r=document.createElement("div");r.className=`trama-tip trama-tip-${o.type}`,r.innerHTML=`
            <span class="trama-tip-icon">${o.type==="action"?"!":o.type==="tip"?"?":"i"}</span>
            <span class="trama-tip-text">${o.text}</span>
        `,r.style.cssText=`
            position: fixed;
            z-index: 9999;
            animation: tramaTipFadeIn 0.3s ease-out;
            animation-delay: ${n*.1}s;
            animation-fill-mode: both;
            max-width: 200px;
            white-space: nowrap;
        `,document.body.appendChild(r);const c=i.getBoundingClientRect(),m=r.getBoundingClientRect(),l=o.position||"right",g=8;let u,b;switch(l){case"top":u=c.top-m.height-g,b=c.left+c.width/2-m.width/2;break;case"bottom":u=c.bottom+g,b=c.left+c.width/2-m.width/2;break;case"left":u=c.top+c.height/2-m.height/2,b=c.left-m.width-g;break;case"right":default:u=c.top+c.height/2-m.height/2,b=c.right+g;break}const a=window.innerWidth,p=window.innerHeight;b+m.width>a-10&&(b=c.left-m.width-g),b<10&&(b=10),u+m.height>p-10&&(u=p-m.height-10),u<10&&(u=10),r.style.top=`${u}px`,r.style.left=`${b}px`,G.push(r),i.classList.add("trama-highlighted")}),$=!0,me()}function Y(){G.forEach(e=>e.remove()),G=[],document.querySelectorAll(".trama-highlighted").forEach(e=>{e.classList.remove("trama-highlighted")}),$=!1,me()}function me(){const e=document.getElementById("trama-tips-btn");e&&e.classList.toggle("active",$)}function F(){if(document.getElementById("trama-help-buttons"))return;const e=document.createElement("div");e.id="trama-help-buttons",e.innerHTML=`
        <button id="trama-tour-btn" class="trama-help-btn" title="Iniciar Tour Guiado">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polygon points="10 8 16 12 10 16 10 8"></polygon>
            </svg>
            <span>Tour</span>
        </button>
        <button id="trama-tips-btn" class="trama-help-btn" title="Mostrar/Ocultar Tips">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 18h6"></path>
                <path d="M10 22h4"></path>
                <path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"></path>
            </svg>
            <span>Tips</span>
        </button>
    `;const t=document.querySelector("header nav, .fi-topbar nav, header");t?t.appendChild(e):(e.style.position="fixed",e.style.top="10px",e.style.right="80px",document.body.appendChild(e)),document.getElementById("trama-tour-btn").addEventListener("click",ce),document.getElementById("trama-tips-btn").addEventListener("click",ue)}function Oe(){if(document.getElementById("trama-help-styles"))return;const e=document.createElement("style");e.id="trama-help-styles",e.textContent=`
        /* Contenedor de botones */
        #trama-help-buttons {
            display: flex;
            gap: 8px;
            margin-left: auto;
            margin-right: 16px;
        }

        /* Botones de ayuda */
        .trama-help-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .trama-help-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .trama-help-btn.active {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }

        #trama-tips-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }

        #trama-tips-btn:hover {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        }

        #trama-tips-btn.active {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        /* Tooltips estáticos */
        .trama-tip {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            pointer-events: none;
        }

        .trama-tip-info {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .trama-tip-action {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .trama-tip-tip {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .trama-tip-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            font-size: 12px;
            font-weight: bold;
        }

        /* Elemento resaltado */
        .trama-highlighted {
            position: relative;
            outline: 3px solid #3b82f6 !important;
            outline-offset: 2px;
            border-radius: 4px;
            animation: tramaPulse 2s infinite;
        }

        /* Animaciones */
        @keyframes tramaTipFadeIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes tramaPulse {
            0%, 100% {
                outline-color: #3b82f6;
            }
            50% {
                outline-color: #60a5fa;
            }
        }

        /* Override Driver.js styles */
        .trama-tour-popover {
            background: white !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2) !important;
        }

        .trama-tour-popover .driver-popover-title {
            font-size: 16px !important;
            font-weight: 600 !important;
            color: #1f2937 !important;
        }

        .trama-tour-popover .driver-popover-description {
            color: #6b7280 !important;
        }

        .trama-tour-popover .driver-popover-progress-text {
            color: #9ca3af !important;
        }

        .trama-tour-popover button {
            border-radius: 6px !important;
        }

        /* Dark mode support */
        .dark .trama-help-btn {
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .dark .trama-tip {
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
    `,document.head.appendChild(e)}function Q(){if(!window.location.pathname.includes("/admin"))return;Oe(),new MutationObserver((t,o)=>{document.querySelector("header nav, .fi-topbar nav, header")&&(F(),o.disconnect())}).observe(document.body,{childList:!0,subtree:!0}),setTimeout(()=>{F()},2e3),document.addEventListener("livewire:navigated",()=>{setTimeout(F,500),$&&Y()})}document.readyState==="loading"?document.addEventListener("DOMContentLoaded",Q):Q();window.TramaHelp={startTour:ce,showTips:ve,hideTips:Y,toggleTips:ue};
