/*! For license information please see photos-src_mixins_AbortControllerMixin_js-src_views_Faces_vue.js.LICENSE.txt */
"use strict";(self.webpackChunkphotos=self.webpackChunkphotos||[]).push([["src_mixins_AbortControllerMixin_js-src_views_Faces_vue"],{69363:(t,n,e)=>{e.d(n,{Z:()=>o});const o={name:"AbortControllerMixin",data:function(){return{abortController:new AbortController}},beforeDestroy:function(){this.abortController.abort()},beforeRouteLeave:function(t,n,e){this.abortController.abort(),this.abortController=new AbortController,e()}}},517:(t,n,e)=>{e.d(n,{Z:()=>s});var o=e(87537),a=e.n(o),r=e(23645),i=e.n(r)()(a());i.push([t.id,".faces[data-v-f75bc546]{display:flex;flex-direction:column;height:calc(100vh - var(--header-height));padding-left:64px}@media only screen and (max-width: 1020px){.faces[data-v-f75bc546]{padding:0}}.faces__header[data-v-f75bc546]{display:flex;min-height:60px;align-items:center}.faces__header button[data-v-f75bc546]{margin-right:32px}.faces__list[data-v-f75bc546]{padding-top:24px;padding-bottom:32px;flex-grow:1;display:flex;flex-wrap:wrap;gap:32px;align-content:flex-start}.faces__empty[data-v-f75bc546]{display:flex;flex-direction:column;align-items:center}.faces__empty__button[data-v-f75bc546]{margin-top:32px}.empty-content-with-illustration[data-v-f75bc546] .empty-content__icon{width:200px;height:200px}.empty-content-with-illustration[data-v-f75bc546] .empty-content__icon svg{width:200px;height:200px}","",{version:3,sources:["webpack://./src/views/Faces.vue"],names:[],mappings:"AAEA,wBACC,YAAA,CACA,qBAAA,CACA,yCAAA,CACA,iBAAA,CAEA,2CAND,wBAOE,SAAA,CAAA,CAGD,gCACC,YAAA,CACA,eAAA,CACA,kBAAA,CAEA,uCACC,iBAAA,CAIF,8BACC,gBAAA,CACA,mBAAA,CACA,WAAA,CACA,YAAA,CACA,cAAA,CACA,QAAA,CACA,wBAAA,CAGD,+BACC,YAAA,CACA,qBAAA,CACA,kBAAA,CAEA,uCACC,eAAA,CAKH,uEACC,WAAA,CACA,YAAA,CAEA,2EACC,WAAA,CACA,YAAA",sourcesContent:['$sizes: ("400": ("count": 3, "marginTop": 66, "marginW": 8), "700": ("count": 4, "marginTop": 66, "marginW": 8), "1024": ("count": 5, "marginTop": 66, "marginW": 44), "1280": ("count": 4, "marginTop": 66, "marginW": 44), "1440": ("count": 5, "marginTop": 88, "marginW": 66), "1600": ("count": 6, "marginTop": 88, "marginW": 66), "2048": ("count": 7, "marginTop": 88, "marginW": 66), "2560": ("count": 8, "marginTop": 88, "marginW": 88), "3440": ("count": 9, "marginTop": 88, "marginW": 88), "max": ("count": 10, "marginTop": 88, "marginW": 88));\n\n.faces {\n\tdisplay: flex;\n\tflex-direction: column;\n\theight: calc(100vh - var(--header-height));\n\tpadding-left: 64px;\n\n\t@media only screen and (max-width: 1020px) {\n\t\tpadding: 0;\n\t}\n\n\t&__header {\n\t\tdisplay: flex;\n\t\tmin-height: 60px;\n\t\talign-items: center;\n\n\t\tbutton {\n\t\t\tmargin-right: 32px;\n\t\t}\n\t}\n\n\t&__list {\n\t\tpadding-top: 24px;\n\t\tpadding-bottom: 32px;\n\t\tflex-grow: 1;\n\t\tdisplay: flex;\n\t\tflex-wrap: wrap;\n\t\tgap: 32px;\n\t\talign-content: flex-start;\n\t}\n\n\t&__empty {\n\t\tdisplay: flex;\n\t\tflex-direction: column;\n\t\talign-items: center;\n\n\t\t&__button {\n\t\t\tmargin-top: 32px;\n\t\t}\n\t}\n}\n\n.empty-content-with-illustration :deep .empty-content__icon {\n\twidth: 200px;\n\theight: 200px;\n\n\tsvg {\n\t\twidth: 200px;\n\t\theight: 200px;\n\t}\n}\n'],sourceRoot:""}]);const s=i},98475:(t,n,e)=>{e.r(n),e.d(n,{default:()=>F});var o=e(95807),a=e(15961),r=e(99751),i=e(17968),s=e(20629);function c(t,n){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);n&&(o=o.filter((function(n){return Object.getOwnPropertyDescriptor(t,n).enumerable}))),e.push.apply(e,o)}return e}function A(t){for(var n=1;n<arguments.length;n++){var e=null!=arguments[n]?arguments[n]:{};n%2?c(Object(e),!0).forEach((function(n){l(t,n,e[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):c(Object(e)).forEach((function(n){Object.defineProperty(t,n,Object.getOwnPropertyDescriptor(e,n))}))}return t}function l(t,n,e){return n in t?Object.defineProperty(t,n,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[n]=e,t}const p={name:"Faces",components:{FaceCover:i.Z,NcEmptyContent:a.SL,NcLoadingIcon:a.lb,AccountBoxMultipleOutline:o.Z},mixins:[r.Z],computed:A(A({},(0,s.Se)(["facesFiles"])),{},{noFaces:function(){return 0===Object.keys(this.faces).length},orderedFaces:function(){var t=this;return Object.values(this.faces).sort((function(n,e){return n.props.nbItems&&e.props.nbItems?e.props.nbItems-n.props.nbItems:t.facesFiles[e.basename]&&t.facesFiles[n.basename]?t.facesFiles[e.basename].length-t.facesFiles[n.basename].length:0}))}})};var u=e(93379),m=e.n(u),f=e(7795),d=e.n(f),C=e(90569),g=e.n(C),h=e(3565),b=e.n(h),x=e(19216),_=e.n(x),y=e(44589),v=e.n(y),w=e(517),O={};O.styleTagTransform=v(),O.setAttributes=b(),O.insert=g().bind(null,"head"),O.domAPI=d(),O.insertStyleElement=_();m()(w.Z,O);w.Z&&w.Z.locals&&w.Z.locals;const F=(0,e(51900).Z)(p,(function(){var t=this,n=t._self._c;return t.errorFetchingFaces?n("NcEmptyContent",[t._v("\n\t"+t._s(t.t("photos","An error occurred"))+"\n")]):n("div",{staticClass:"faces"},[t.loadingFaces?n("NcLoadingIcon"):t._e(),t._v(" "),t.noFaces&&!t.loadingFaces?n("div",{staticClass:"faces__empty"},[n("NcEmptyContent",{staticClass:"empty-content-with-illustration",scopedSlots:t._u([{key:"icon",fn:function(){return[n("AccountBoxMultipleOutline")]},proxy:!0},{key:"desc",fn:function(){return[t._v("\n\t\t\t\t"+t._s(t.t("photos","This might take some time depending on the size of your photo library."))+"\n\t\t\t")]},proxy:!0}],null,!1,3796275108)},[t._v(" "),t._v("\n\t\t\t"+t._s(t.t("photos","Recognized people will show up here"))+"\n\t\t")])],1):t.noFaces?t._e():n("div",{staticClass:"faces__list"},t._l(t.orderedFaces,(function(t){return n("router-link",{key:t.basename,attrs:{to:"/faces/".concat(t.basename)}},[n("FaceCover",{attrs:{"base-name":t.basename}})],1)})),1)],1)}),[],!1,null,"f75bc546",null).exports}}]);
//# sourceMappingURL=photos-src_mixins_AbortControllerMixin_js-src_views_Faces_vue.js.map?v=3d07daf076716da468fb