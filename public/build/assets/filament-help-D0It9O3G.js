let j={},ee;function O(e={}){j={animate:!0,allowClose:!0,overlayClickBehavior:"close",overlayOpacity:.7,smoothScroll:!1,disableActiveInteraction:!1,showProgress:!1,stagePadding:10,stageRadius:5,popoverOffset:10,showButtons:["next","previous","close"],disableButtons:[],overlayColor:"#000",...e}}function a(e){return e?j[e]:j}function be(e){ee=e}function B(){return ee}let R={};function W(e,t){R[e]=t}function P(e){var t;(t=R[e])==null||t.call(R)}function ye(){R={}}function N(e,t,o,i){return(e/=i/2)<1?o/2*e*e+t:-o/2*(--e*(e-2)-1)+t}function te(e){const t='a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])';return e.flatMap(o=>{const i=o.matches(t),r=Array.from(o.querySelectorAll(t));return[...i?[o]:[],...r]}).filter(o=>getComputedStyle(o).pointerEvents!=="none"&&ke(o))}function oe(e){if(!e||Ce(e))return;const t=a("smoothScroll"),o=e.offsetHeight>window.innerHeight;e.scrollIntoView({behavior:!t||xe(e)?"auto":"smooth",inline:"center",block:o?"start":"center"})}function xe(e){if(!e||!e.parentElement)return;const t=e.parentElement;return t.scrollHeight>t.clientHeight}function Ce(e){const t=e.getBoundingClientRect();return t.top>=0&&t.left>=0&&t.bottom<=(window.innerHeight||document.documentElement.clientHeight)&&t.right<=(window.innerWidth||document.documentElement.clientWidth)}function ke(e){return!!(e.offsetWidth||e.offsetHeight||e.getClientRects().length)}let z={};function E(e,t){z[e]=t}function l(e){return e?z[e]:z}function X(){z={}}function Ee(e,t,o,i){let r=l("__activeStagePosition");const n=r||o.getBoundingClientRect(),u=i.getBoundingClientRect(),w=N(e,n.x,u.x-n.x,t),d=N(e,n.y,u.y-n.y,t),g=N(e,n.width,u.width-n.width,t),m=N(e,n.height,u.height-n.height,t);r={x:w,y:d,width:g,height:m},ie(r),E("__activeStagePosition",r)}function re(e){if(!e)return;const t=e.getBoundingClientRect(),o={x:t.x,y:t.y,width:t.width,height:t.height};E("__activeStagePosition",o),ie(o)}function Le(){const e=l("__activeStagePosition"),t=l("__overlaySvg");if(!e)return;if(!t){console.warn("No stage svg found.");return}const o=window.innerWidth,i=window.innerHeight;t.setAttribute("viewBox",`0 0 ${o} ${i}`)}function Be(e){const t=_e(e);document.body.appendChild(t),se(t,o=>{o.target.tagName==="path"&&P("overlayClick")}),E("__overlaySvg",t)}function ie(e){const t=l("__overlaySvg");if(!t){Be(e);return}const o=t.firstElementChild;if((o==null?void 0:o.tagName)!=="path")throw new Error("no path element found in stage svg");o.setAttribute("d",ne(e))}function _e(e){const t=window.innerWidth,o=window.innerHeight,i=document.createElementNS("http://www.w3.org/2000/svg","svg");i.classList.add("driver-overlay","driver-overlay-animated"),i.setAttribute("viewBox",`0 0 ${t} ${o}`),i.setAttribute("xmlSpace","preserve"),i.setAttribute("xmlnsXlink","http://www.w3.org/1999/xlink"),i.setAttribute("version","1.1"),i.setAttribute("preserveAspectRatio","xMinYMin slice"),i.style.fillRule="evenodd",i.style.clipRule="evenodd",i.style.strokeLinejoin="round",i.style.strokeMiterlimit="2",i.style.zIndex="10000",i.style.position="fixed",i.style.top="0",i.style.left="0",i.style.width="100%",i.style.height="100%";const r=document.createElementNS("http://www.w3.org/2000/svg","path");return r.setAttribute("d",ne(e)),r.style.fill=a("overlayColor")||"rgb(0,0,0)",r.style.opacity=`${a("overlayOpacity")}`,r.style.pointerEvents="auto",r.style.cursor="auto",i.appendChild(r),i}function ne(e){const t=window.innerWidth,o=window.innerHeight,i=a("stagePadding")||0,r=a("stageRadius")||0,n=e.width+i*2,u=e.height+i*2,w=Math.min(r,n/2,u/2),d=Math.floor(Math.max(w,0)),g=e.x-i+d,m=e.y-i,k=n-d*2,s=u-d*2;return`M${t},0L0,0L0,${o}L${t},${o}L${t},0Z
    M${g},${m} h${k} a${d},${d} 0 0 1 ${d},${d} v${s} a${d},${d} 0 0 1 -${d},${d} h-${k} a${d},${d} 0 0 1 -${d},-${d} v-${s} a${d},${d} 0 0 1 ${d},-${d} z`}function Pe(){const e=l("__overlaySvg");e&&e.remove()}function Ae(){const e=document.getElementById("driver-dummy-element");if(e)return e;let t=document.createElement("div");return t.id="driver-dummy-element",t.style.width="0",t.style.height="0",t.style.pointerEvents="none",t.style.opacity="0",t.style.position="fixed",t.style.top="50%",t.style.left="50%",document.body.appendChild(t),t}function K(e){const{element:t}=e;let o=typeof t=="function"?t():typeof t=="string"?document.querySelector(t):t;o||(o=Ae()),Te(o,e)}function Se(){const e=l("__activeElement"),t=l("__activeStep");e&&(re(e),Le(),de(e,t))}function Te(e,t){var o;const i=Date.now(),r=l("__activeStep"),n=l("__activeElement")||e,u=!n||n===e,w=e.id==="driver-dummy-element",d=n.id==="driver-dummy-element",g=a("animate"),m=t.onHighlightStarted||a("onHighlightStarted"),k=(t==null?void 0:t.onHighlighted)||a("onHighlighted"),s=(r==null?void 0:r.onDeselected)||a("onDeselected"),p=a(),v=l();!u&&s&&s(d?void 0:n,r,{config:p,state:v,driver:B()}),m&&m(w?void 0:e,t,{config:p,state:v,driver:B()});const h=!u&&g;let c=!1;Ie(),E("previousStep",r),E("previousElement",n),E("activeStep",t),E("activeElement",e);const f=()=>{if(l("__transitionCallback")!==f)return;const y=Date.now()-i,x=400-y<=400/2;t.popover&&x&&!c&&h&&(V(e,t),c=!0),a("animate")&&y<400?Ee(y,400,n,e):(re(e),k&&k(w?void 0:e,t,{config:a(),state:l(),driver:B()}),E("__transitionCallback",void 0),E("__previousStep",r),E("__previousElement",n),E("__activeStep",t),E("__activeElement",e)),window.requestAnimationFrame(f)};E("__transitionCallback",f),window.requestAnimationFrame(f),oe(e),!h&&t.popover&&V(e,t),n.classList.remove("driver-active-element","driver-no-interaction"),n.removeAttribute("aria-haspopup"),n.removeAttribute("aria-expanded"),n.removeAttribute("aria-controls"),((o=t.disableActiveInteraction)!=null?o:a("disableActiveInteraction"))&&e.classList.add("driver-no-interaction"),e.classList.add("driver-active-element"),e.setAttribute("aria-haspopup","dialog"),e.setAttribute("aria-expanded","true"),e.setAttribute("aria-controls","driver-popover-content")}function $e(){var e;(e=document.getElementById("driver-dummy-element"))==null||e.remove(),document.querySelectorAll(".driver-active-element").forEach(t=>{t.classList.remove("driver-active-element","driver-no-interaction"),t.removeAttribute("aria-haspopup"),t.removeAttribute("aria-expanded"),t.removeAttribute("aria-controls")})}function T(){const e=l("__resizeTimeout");e&&window.cancelAnimationFrame(e),E("__resizeTimeout",window.requestAnimationFrame(Se))}function He(e){var t;if(!l("isInitialized")||!(e.key==="Tab"||e.keyCode===9))return;const o=l("__activeElement"),i=(t=l("popover"))==null?void 0:t.wrapper,r=te([...i?[i]:[],...o?[o]:[]]),n=r[0],u=r[r.length-1];if(e.preventDefault(),e.shiftKey){const w=r[r.indexOf(document.activeElement)-1]||u;w==null||w.focus()}else{const w=r[r.indexOf(document.activeElement)+1]||n;w==null||w.focus()}}function ae(e){var t;((t=a("allowKeyboardControl"))==null||t)&&(e.key==="Escape"?P("escapePress"):e.key==="ArrowRight"?P("arrowRightPress"):e.key==="ArrowLeft"&&P("arrowLeftPress"))}function se(e,t,o){const i=(r,n)=>{const u=r.target;e.contains(u)&&((!o||o(u))&&(r.preventDefault(),r.stopPropagation(),r.stopImmediatePropagation()),n==null||n(r))};document.addEventListener("pointerdown",i,!0),document.addEventListener("mousedown",i,!0),document.addEventListener("pointerup",i,!0),document.addEventListener("mouseup",i,!0),document.addEventListener("click",r=>{i(r,t)},!0)}function Me(){window.addEventListener("keyup",ae,!1),window.addEventListener("keydown",He,!1),window.addEventListener("resize",T),window.addEventListener("scroll",T)}function De(){window.removeEventListener("keyup",ae),window.removeEventListener("resize",T),window.removeEventListener("scroll",T)}function Ie(){const e=l("popover");e&&(e.wrapper.style.display="none")}function V(e,t){var o,i;let r=l("popover");r&&document.body.removeChild(r.wrapper),r=We(),document.body.appendChild(r.wrapper);const{title:n,description:u,showButtons:w,disableButtons:d,showProgress:g,nextBtnText:m=a("nextBtnText")||"Next &rarr;",prevBtnText:k=a("prevBtnText")||"&larr; Previous",progressText:s=a("progressText")||"{current} of {total}"}=t.popover||{};r.nextButton.innerHTML=m,r.previousButton.innerHTML=k,r.progress.innerHTML=s,n?(r.title.innerHTML=n,r.title.style.display="block"):r.title.style.display="none",u?(r.description.innerHTML=u,r.description.style.display="block"):r.description.style.display="none";const p=w||a("showButtons"),v=g||a("showProgress")||!1,h=(p==null?void 0:p.includes("next"))||(p==null?void 0:p.includes("previous"))||v;r.closeButton.style.display=p.includes("close")?"block":"none",h?(r.footer.style.display="flex",r.progress.style.display=v?"block":"none",r.nextButton.style.display=p.includes("next")?"block":"none",r.previousButton.style.display=p.includes("previous")?"block":"none"):r.footer.style.display="none";const c=d||a("disableButtons")||[];c!=null&&c.includes("next")&&(r.nextButton.disabled=!0,r.nextButton.classList.add("driver-popover-btn-disabled")),c!=null&&c.includes("previous")&&(r.previousButton.disabled=!0,r.previousButton.classList.add("driver-popover-btn-disabled")),c!=null&&c.includes("close")&&(r.closeButton.disabled=!0,r.closeButton.classList.add("driver-popover-btn-disabled"));const f=r.wrapper;f.style.display="block",f.style.left="",f.style.top="",f.style.bottom="",f.style.right="",f.id="driver-popover-content",f.setAttribute("role","dialog"),f.setAttribute("aria-labelledby","driver-popover-title"),f.setAttribute("aria-describedby","driver-popover-description");const y=r.arrow;y.className="driver-popover-arrow";const x=((o=t.popover)==null?void 0:o.popoverClass)||a("popoverClass")||"";f.className=`driver-popover ${x}`.trim(),se(r.wrapper,_=>{var H,M,D;const S=_.target,I=((H=t.popover)==null?void 0:H.onNextClick)||a("onNextClick"),A=((M=t.popover)==null?void 0:M.onPrevClick)||a("onPrevClick"),q=((D=t.popover)==null?void 0:D.onCloseClick)||a("onCloseClick");if(S.closest(".driver-popover-next-btn"))return I?I(e,t,{config:a(),state:l(),driver:B()}):P("nextClick");if(S.closest(".driver-popover-prev-btn"))return A?A(e,t,{config:a(),state:l(),driver:B()}):P("prevClick");if(S.closest(".driver-popover-close-btn"))return q?q(e,t,{config:a(),state:l(),driver:B()}):P("closeClick")},_=>!(r!=null&&r.description.contains(_))&&!(r!=null&&r.title.contains(_))&&typeof _.className=="string"&&_.className.includes("driver-popover")),E("popover",r);const L=((i=t.popover)==null?void 0:i.onPopoverRender)||a("onPopoverRender");L&&L(r,{config:a(),state:l(),driver:B()}),de(e,t),oe(f);const C=e.classList.contains("driver-dummy-element"),b=te([f,...C?[]:[e]]);b.length>0&&b[0].focus()}function le(){const e=l("popover");if(!(e!=null&&e.wrapper))return;const t=e.wrapper.getBoundingClientRect(),o=a("stagePadding")||0,i=a("popoverOffset")||0;return{width:t.width+o+i,height:t.height+o+i,realWidth:t.width,realHeight:t.height}}function U(e,t){const{elementDimensions:o,popoverDimensions:i,popoverPadding:r,popoverArrowDimensions:n}=t;return e==="start"?Math.max(Math.min(o.top-r,window.innerHeight-i.realHeight-n.width),n.width):e==="end"?Math.max(Math.min(o.top-(i==null?void 0:i.realHeight)+o.height+r,window.innerHeight-(i==null?void 0:i.realHeight)-n.width),n.width):e==="center"?Math.max(Math.min(o.top+o.height/2-(i==null?void 0:i.realHeight)/2,window.innerHeight-(i==null?void 0:i.realHeight)-n.width),n.width):0}function Z(e,t){const{elementDimensions:o,popoverDimensions:i,popoverPadding:r,popoverArrowDimensions:n}=t;return e==="start"?Math.max(Math.min(o.left-r,window.innerWidth-i.realWidth-n.width),n.width):e==="end"?Math.max(Math.min(o.left-(i==null?void 0:i.realWidth)+o.width+r,window.innerWidth-(i==null?void 0:i.realWidth)-n.width),n.width):e==="center"?Math.max(Math.min(o.left+o.width/2-(i==null?void 0:i.realWidth)/2,window.innerWidth-(i==null?void 0:i.realWidth)-n.width),n.width):0}function de(e,t){const o=l("popover");if(!o)return;const{align:i="start",side:r="left"}=(t==null?void 0:t.popover)||{},n=i,u=e.id==="driver-dummy-element"?"over":r,w=a("stagePadding")||0,d=le(),g=o.arrow.getBoundingClientRect(),m=e.getBoundingClientRect(),k=m.top-d.height;let s=k>=0;const p=window.innerHeight-(m.bottom+d.height);let v=p>=0;const h=m.left-d.width;let c=h>=0;const f=window.innerWidth-(m.right+d.width);let y=f>=0;const x=!s&&!v&&!c&&!y;let L=u;if(u==="top"&&s?y=c=v=!1:u==="bottom"&&v?y=c=s=!1:u==="left"&&c?y=s=v=!1:u==="right"&&y&&(c=s=v=!1),u==="over"){const C=window.innerWidth/2-d.realWidth/2,b=window.innerHeight/2-d.realHeight/2;o.wrapper.style.left=`${C}px`,o.wrapper.style.right="auto",o.wrapper.style.top=`${b}px`,o.wrapper.style.bottom="auto"}else if(x){const C=window.innerWidth/2-(d==null?void 0:d.realWidth)/2,b=10;o.wrapper.style.left=`${C}px`,o.wrapper.style.right="auto",o.wrapper.style.bottom=`${b}px`,o.wrapper.style.top="auto"}else if(c){const C=Math.min(h,window.innerWidth-(d==null?void 0:d.realWidth)-g.width),b=U(n,{elementDimensions:m,popoverDimensions:d,popoverPadding:w,popoverArrowDimensions:g});o.wrapper.style.left=`${C}px`,o.wrapper.style.top=`${b}px`,o.wrapper.style.bottom="auto",o.wrapper.style.right="auto",L="left"}else if(y){const C=Math.min(f,window.innerWidth-(d==null?void 0:d.realWidth)-g.width),b=U(n,{elementDimensions:m,popoverDimensions:d,popoverPadding:w,popoverArrowDimensions:g});o.wrapper.style.right=`${C}px`,o.wrapper.style.top=`${b}px`,o.wrapper.style.bottom="auto",o.wrapper.style.left="auto",L="right"}else if(s){const C=Math.min(k,window.innerHeight-d.realHeight-g.width);let b=Z(n,{elementDimensions:m,popoverDimensions:d,popoverPadding:w,popoverArrowDimensions:g});o.wrapper.style.top=`${C}px`,o.wrapper.style.left=`${b}px`,o.wrapper.style.bottom="auto",o.wrapper.style.right="auto",L="top"}else if(v){const C=Math.min(p,window.innerHeight-(d==null?void 0:d.realHeight)-g.width);let b=Z(n,{elementDimensions:m,popoverDimensions:d,popoverPadding:w,popoverArrowDimensions:g});o.wrapper.style.left=`${b}px`,o.wrapper.style.bottom=`${C}px`,o.wrapper.style.top="auto",o.wrapper.style.right="auto",L="bottom"}x?o.arrow.classList.add("driver-popover-arrow-none"):qe(n,L,e)}function qe(e,t,o){const i=l("popover");if(!i)return;const r=o.getBoundingClientRect(),n=le(),u=i.arrow,w=n.width,d=window.innerWidth,g=r.width,m=r.left,k=n.height,s=window.innerHeight,p=r.top,v=r.height;u.className="driver-popover-arrow";let h=t,c=e;if(t==="top"?(m+g<=0?(h="right",c="end"):m+g-w<=0&&(h="top",c="start"),m>=d?(h="left",c="end"):m+w>=d&&(h="top",c="end")):t==="bottom"?(m+g<=0?(h="right",c="start"):m+g-w<=0&&(h="bottom",c="start"),m>=d?(h="left",c="start"):m+w>=d&&(h="bottom",c="end")):t==="left"?(p+v<=0?(h="bottom",c="end"):p+v-k<=0&&(h="left",c="start"),p>=s?(h="top",c="end"):p+k>=s&&(h="left",c="end")):t==="right"&&(p+v<=0?(h="bottom",c="start"):p+v-k<=0&&(h="right",c="start"),p>=s?(h="top",c="start"):p+k>=s&&(h="right",c="end")),!h)u.classList.add("driver-popover-arrow-none");else{u.classList.add(`driver-popover-arrow-side-${h}`),u.classList.add(`driver-popover-arrow-align-${c}`);const f=o.getBoundingClientRect(),y=u.getBoundingClientRect(),x=a("stagePadding")||0,L=f.left-x<window.innerWidth&&f.right+x>0&&f.top-x<window.innerHeight&&f.bottom+x>0;t==="bottom"&&L&&(y.x>f.x&&y.x+y.width<f.x+f.width?i.wrapper.style.transform="translateY(0)":(u.classList.remove(`driver-popover-arrow-align-${c}`),u.classList.add("driver-popover-arrow-none"),i.wrapper.style.transform=`translateY(-${x/2}px)`))}}function We(){const e=document.createElement("div");e.classList.add("driver-popover");const t=document.createElement("div");t.classList.add("driver-popover-arrow");const o=document.createElement("header");o.id="driver-popover-title",o.classList.add("driver-popover-title"),o.style.display="none",o.innerText="Popover Title";const i=document.createElement("div");i.id="driver-popover-description",i.classList.add("driver-popover-description"),i.style.display="none",i.innerText="Popover description is here";const r=document.createElement("button");r.type="button",r.classList.add("driver-popover-close-btn"),r.setAttribute("aria-label","Close"),r.innerHTML="&times;";const n=document.createElement("footer");n.classList.add("driver-popover-footer");const u=document.createElement("span");u.classList.add("driver-popover-progress-text"),u.innerText="";const w=document.createElement("span");w.classList.add("driver-popover-navigation-btns");const d=document.createElement("button");d.type="button",d.classList.add("driver-popover-prev-btn"),d.innerHTML="&larr; Previous";const g=document.createElement("button");return g.type="button",g.classList.add("driver-popover-next-btn"),g.innerHTML="Next &rarr;",w.appendChild(d),w.appendChild(g),n.appendChild(u),n.appendChild(w),e.appendChild(r),e.appendChild(t),e.appendChild(o),e.appendChild(i),e.appendChild(n),{wrapper:e,arrow:t,title:o,description:i,footer:n,previousButton:d,nextButton:g,closeButton:r,footerButtons:w,progress:u}}function Ne(){var e;const t=l("popover");t&&((e=t.wrapper.parentElement)==null||e.removeChild(t.wrapper))}function Re(e={}){O(e);function t(){a("allowClose")&&m()}function o(){const s=a("overlayClickBehavior");if(a("allowClose")&&s==="close"){m();return}if(typeof s=="function"){const p=l("__activeStep"),v=l("__activeElement");s(v,p,{config:a(),state:l(),driver:B()});return}s==="nextStep"&&i()}function i(){const s=l("activeIndex"),p=a("steps")||[];if(typeof s>"u")return;const v=s+1;p[v]?g(v):m()}function r(){const s=l("activeIndex"),p=a("steps")||[];if(typeof s>"u")return;const v=s-1;p[v]?g(v):m()}function n(s){(a("steps")||[])[s]?g(s):m()}function u(){var s;if(l("__transitionCallback"))return;const p=l("activeIndex"),v=l("__activeStep"),h=l("__activeElement");if(typeof p>"u"||typeof v>"u"||typeof l("activeIndex")>"u")return;const c=((s=v.popover)==null?void 0:s.onPrevClick)||a("onPrevClick");if(c)return c(h,v,{config:a(),state:l(),driver:B()});r()}function w(){var s;if(l("__transitionCallback"))return;const p=l("activeIndex"),v=l("__activeStep"),h=l("__activeElement");if(typeof p>"u"||typeof v>"u")return;const c=((s=v.popover)==null?void 0:s.onNextClick)||a("onNextClick");if(c)return c(h,v,{config:a(),state:l(),driver:B()});i()}function d(){l("isInitialized")||(E("isInitialized",!0),document.body.classList.add("driver-active",a("animate")?"driver-fade":"driver-simple"),Me(),W("overlayClick",o),W("escapePress",t),W("arrowLeftPress",u),W("arrowRightPress",w))}function g(s=0){var p,v,h,c,f,y,x,L;const C=a("steps");if(!C){console.error("No steps to drive through"),m();return}if(!C[s]){m();return}E("__activeOnDestroyed",document.activeElement),E("activeIndex",s);const b=C[s],_=C[s+1],H=C[s-1],M=((p=b.popover)==null?void 0:p.doneBtnText)||a("doneBtnText")||"Done",D=a("allowClose"),S=typeof((v=b.popover)==null?void 0:v.showProgress)<"u"?(h=b.popover)==null?void 0:h.showProgress:a("showProgress"),I=(((c=b.popover)==null?void 0:c.progressText)||a("progressText")||"{{current}} of {{total}}").replace("{{current}}",`${s+1}`).replace("{{total}}",`${C.length}`),A=((f=b.popover)==null?void 0:f.showButtons)||a("showButtons"),q=["next","previous",...D?["close"]:[]].filter(we=>!(A!=null&&A.length)||A.includes(we)),he=((y=b.popover)==null?void 0:y.onNextClick)||a("onNextClick"),ge=((x=b.popover)==null?void 0:x.onPrevClick)||a("onPrevClick"),fe=((L=b.popover)==null?void 0:L.onCloseClick)||a("onCloseClick");K({...b,popover:{showButtons:q,nextBtnText:_?void 0:M,disableButtons:[...H?[]:["previous"]],showProgress:S,progressText:I,onNextClick:he||(()=>{_?g(s+1):m()}),onPrevClick:ge||(()=>{g(s-1)}),onCloseClick:fe||(()=>{m()}),...(b==null?void 0:b.popover)||{}}})}function m(s=!0){const p=l("__activeElement"),v=l("__activeStep"),h=l("__activeOnDestroyed"),c=a("onDestroyStarted");if(s&&c){const x=!p||(p==null?void 0:p.id)==="driver-dummy-element";c(x?void 0:p,v,{config:a(),state:l(),driver:B()});return}const f=(v==null?void 0:v.onDeselected)||a("onDeselected"),y=a("onDestroyed");if(document.body.classList.remove("driver-active","driver-fade","driver-simple"),De(),Ne(),$e(),Pe(),ye(),X(),p&&v){const x=p.id==="driver-dummy-element";f&&f(x?void 0:p,v,{config:a(),state:l(),driver:B()}),y&&y(x?void 0:p,v,{config:a(),state:l(),driver:B()})}h&&h.focus()}const k={isActive:()=>l("isInitialized")||!1,refresh:T,drive:(s=0)=>{d(),g(s)},setConfig:O,setSteps:s=>{X(),O({...a(),steps:s})},getConfig:a,getState:l,getActiveIndex:()=>l("activeIndex"),isFirstStep:()=>l("activeIndex")===0,isLastStep:()=>{const s=a("steps")||[],p=l("activeIndex");return p!==void 0&&p===s.length-1},getActiveStep:()=>l("activeStep"),getActiveElement:()=>l("activeElement"),getPreviousElement:()=>l("previousElement"),getPreviousStep:()=>l("previousStep"),moveNext:i,movePrevious:r,moveTo:n,hasNextStep:()=>{const s=a("steps")||[],p=l("activeIndex");return p!==void 0&&!!s[p+1]},hasPreviousStep:()=>{const s=a("steps")||[],p=l("activeIndex");return p!==void 0&&!!s[p-1]},highlight:s=>{d(),K({...s,popover:s.popover?{showButtons:[],showProgress:!1,progressText:"",...s.popover}:void 0})},destroy:()=>{m(!1)}};return be(k),k}const J={dashboard:[{element:'[href*="/admin"]',popover:{title:"Panel de Administración",description:"Bienvenido al panel de Trama Educativa. Desde aquí puedes gestionar todo el contenido del sitio.",side:"bottom"}},{element:'nav[aria-label="Sidebar"]',popover:{title:"Menú Principal",description:"Este es el menú de navegación. Aquí encontrarás todas las secciones: Artículos, Categorías, Autores y Etiquetas.",side:"right"}},{element:'[href*="articles"]',popover:{title:"Artículos",description:"Gestiona los artículos del portal. Puedes crear, editar, publicar y eliminar notas.",side:"right"}},{element:'[href*="categories"]',popover:{title:"Categorías",description:"Organiza los artículos en categorías temáticas.",side:"right"}},{element:'[href*="authors"]',popover:{title:"Autores",description:"Administra los autores y colaboradores del portal.",side:"right"}},{element:'[href*="tags"]',popover:{title:"Etiquetas",description:"Crea y gestiona etiquetas para clasificar el contenido.",side:"right"}}],articles:[{element:"h1",popover:{title:"Listado de Artículos",description:"Aquí ves todos los artículos del portal. Puedes ordenarlos, filtrarlos y buscar.",side:"bottom"}},{element:'[wire\\:click*="create"], a[href*="create"]',popover:{title:"Crear Artículo",description:"Haz clic aquí para crear un nuevo artículo.",side:"left"}},{element:'input[type="search"], input[placeholder*="Buscar"]',popover:{title:"Buscar",description:"Escribe aquí para buscar artículos por título o contenido.",side:"bottom"}},{element:"table, .fi-ta-table",popover:{title:"Tabla de Artículos",description:"Haz clic en cualquier fila para editar el artículo. Las columnas se pueden ordenar haciendo clic en el encabezado.",side:"top"}}],"articles-form":[{element:'input[name*="title"], [wire\\:model*="title"]',popover:{title:"Título",description:"El título principal del artículo. Será visible en el listado y en la página del artículo.",side:"bottom"}},{element:'[wire\\:model*="category"], select[name*="category"]',popover:{title:"Categoría",description:"Selecciona la categoría principal del artículo.",side:"bottom"}},{element:'[wire\\:model*="author"], select[name*="author"]',popover:{title:"Autor",description:"Selecciona quién escribió este artículo.",side:"bottom"}},{element:'[wire\\:model*="content"], .trix-editor, .ql-editor, textarea',popover:{title:"Contenido",description:"Escribe aquí el cuerpo del artículo. Puedes usar formato, agregar imágenes y enlaces.",side:"top"}},{element:'button[type="submit"], button[wire\\:click*="save"]',popover:{title:"Guardar",description:"Cuando termines, haz clic aquí para guardar los cambios.",side:"left"}}],categories:[{element:"h1",popover:{title:"Categorías",description:"Las categorías organizan los artículos por temas. Cada artículo debe tener una categoría.",side:"bottom"}},{element:'[wire\\:click*="create"], a[href*="create"]',popover:{title:"Nueva Categoría",description:"Crea una nueva categoría para organizar los artículos.",side:"left"}}],authors:[{element:"h1",popover:{title:"Autores",description:"Gestiona los autores del portal. Cada autor puede tener múltiples artículos.",side:"bottom"}}],tags:[{element:"h1",popover:{title:"Etiquetas",description:"Las etiquetas permiten clasificar artículos con palabras clave. Un artículo puede tener múltiples etiquetas.",side:"bottom"}}]},ze={dashboard:[{selector:'nav[aria-label="Sidebar"]',text:"Menú principal de navegación",type:"info"},{selector:'[href*="articles"]',text:"Gestión de artículos",type:"info"}],articles:[{selector:'[wire\\:click*="create"], a[href*="create"]',text:"Crear nuevo artículo",type:"action"},{selector:'input[type="search"], input[placeholder*="Buscar"]',text:"Buscar por título o contenido",type:"tip"},{selector:"th",text:"Clic para ordenar",type:"tip"}],categories:[{selector:'[wire\\:click*="create"], a[href*="create"]',text:"Crear nueva categoría",type:"action"}],authors:[{selector:'[wire\\:click*="create"], a[href*="create"]',text:"Agregar nuevo autor",type:"action"}],tags:[{selector:'[wire\\:click*="create"], a[href*="create"]',text:"Crear nueva etiqueta",type:"action"}]};function pe(){const e=window.location.pathname;return e.includes("/articles/create")||e.includes("/articles/")&&e.includes("/edit")?"articles-form":e.includes("/articles")?"articles":e.includes("/categories")?"categories":e.includes("/authors")?"authors":e.includes("/tags")?"tags":(e.includes("/admin"),"dashboard")}function ce(){const e=pe(),o=(J[e]||J.dashboard).filter(r=>r.element?document.querySelector(r.element):!0);if(o.length===0){alert("No hay guía disponible para esta página.");return}Re({showProgress:!0,animate:!0,smoothScroll:!0,allowClose:!0,stagePadding:5,stageRadius:5,popoverClass:"trama-tour-popover",progressText:"Paso {{current}} de {{total}}",nextBtnText:"Siguiente",prevBtnText:"Anterior",doneBtnText:"Finalizar",steps:o}).drive()}let $=!1,G=[];function ue(){$?Y():ve()}function ve(){const e=pe();(ze[e]||[]).forEach((o,i)=>{const r=document.querySelector(o.selector);if(!r)return;const n=document.createElement("div");n.className=`trama-tip trama-tip-${o.type}`,n.innerHTML=`
            <span class="trama-tip-icon">${o.type==="action"?"!":o.type==="tip"?"?":"i"}</span>
            <span class="trama-tip-text">${o.text}</span>
        `,n.style.cssText=`
            position: absolute;
            z-index: 9999;
            animation: tramaTipFadeIn 0.3s ease-out;
            animation-delay: ${i*.1}s;
            animation-fill-mode: both;
        `;const u=r.getBoundingClientRect();n.style.top=`${u.top+window.scrollY-10}px`,n.style.left=`${u.right+window.scrollX+10}px`,document.body.appendChild(n),G.push(n),r.classList.add("trama-highlighted")}),$=!0,me()}function Y(){G.forEach(e=>e.remove()),G=[],document.querySelectorAll(".trama-highlighted").forEach(e=>{e.classList.remove("trama-highlighted")}),$=!1,me()}function me(){const e=document.getElementById("trama-tips-btn");e&&e.classList.toggle("active",$)}function F(){if(document.getElementById("trama-help-buttons"))return;const e=document.createElement("div");e.id="trama-help-buttons",e.innerHTML=`
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
