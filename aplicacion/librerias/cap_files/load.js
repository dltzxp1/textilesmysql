/*jslint browser: true, continue: true, eqeq: true, plusplus: true, vars: true, white: true */
var FlattrLoader=function(){
    "use strict";
    var a={
        instance:!1,
        queryString:!1,
        validParams:["mode","https","uid","category","button","language","html5-key-prefix","popout","revsharekey"],
        validButtonParams:["uid","owner","category","button","language","hidden","tags","title","url","description","revsharekey","popout"],
        options:{},
        POPOUT_WIDTH:401,
        POPOUT_HEIGHT:230,
        TIMEOUT:1500,
        createIframe:function(b){
            var c=b.button=="compact",d=document.createElement("iframe");
            return d.setAttribute("src",(this.getParam("https")==1?"https":"http")+"://"+this.getParam("domain","api.flattr.com")+"/button/view/?"+this.encodeData(b)),d.setAttribute("class","FlattrButton"),d.setAttribute("width",c==1?110:55),d.setAttribute("height",c==1?20:62),d.setAttribute("frameBorder",0),d.setAttribute("scrolling","no"),d.setAttribute("title","Flattr"),d.setAttribute("border",0),d.setAttribute("marginHeight",0),d.setAttribute("marginWidth",0),d.setAttribute("allowTransparency","true"),d.data=b,b.popout!=0&&(d.onmouseover=function(){
                this.popoutIframe===undefined&&(a.removeAllOpenPopoutIframes(),a.showPopoutForButton(this),this.popoutIframe.onmouseover=function(){
                    this.timeout&&(clearTimeout(this.timeout),this.timeout=undefined)
                    },this.popoutIframe.onmouseout=function(){
                    this.parentNode&&(this.timeout=setTimeout(function(){
                        d.popoutIframe&&a.removePopoutForButton(d)
                        },a.TIMEOUT))
                    })
                },d.onmouseout=function(){
                this.popoutIframe&&(this.popoutIframe.timeout=setTimeout(function(){
                    d.popoutIframe&&a.removePopoutForButton(d)
                    },a.TIMEOUT))
                }),d
            },
        getAbsolutePositionForElement:function(a){
            var b={
                x:0,
                y:0
            };
            
            if(a.offsetParent)do b.x+=a.offsetLeft,b.y+=a.offsetTop,a=a.offsetParent;while(a);
            return b
            },
        showPopoutForButton:function(a){
            var b,c="s",d="e",e=window.innerWidth!==undefined?window.innerWidth:document.documentElement.clientWidth,f=window.innerHeight!==undefined?window.innerHeight:document.documentElement.clientHeight,g=this.getAbsolutePositionForElement(a);
            g.x>e/2&&(d="w"),g.y+Number(a.height)+this.POPOUT_HEIGHT>f&&(c="n"),b=c+d,a.data.dir=b,a.popoutIframe=this.createPopoutIframe(a.data),d==="w"?a.popoutIframe.style.left=Number(g.x)-Number(this.POPOUT_WIDTH)+Number(a.width)+"px":d==="e"&&(a.popoutIframe.style.left=g.x+"px"),c==="n"?a.popoutIframe.style.top=Number(g.y)-Number(this.POPOUT_HEIGHT)+"px":c==="s"&&(a.popoutIframe.style.top=Number(g.y)+Number(a.height)+"px"),document.querySelector("body").appendChild(a.popoutIframe)
            },
        createPopoutIframe:function(a){
            var b=document.createElement("iframe");
            return b.setAttribute("src",(this.getParam("https")==1?"https":"http")+"://"+this.getParam("domain","api.flattr.com")+"/button/popout/?"+this.encodeData(a)),b.setAttribute("frameBorder",0),b.setAttribute("allowTransparency","true"),b.setAttribute("style","position: absolute; display:block; z-index: 9999;"),b.setAttribute("width",this.POPOUT_WIDTH),b.setAttribute("height",this.POPOUT_HEIGHT),b
            },
        removePopoutForButton:function(a){
            a.popoutIframe.timeout&&clearTimeout(a.popoutIframe.timeout),a.popoutIframe.parentNode.removeChild(a.popoutIframe),a.popoutIframe=undefined
            },
        removeAllOpenPopoutIframes:function(){
            var a=document.querySelectorAll("iframe.FlattrButton"),b,c;
            for(b=0;b<a.length;b+=1)c=a[b],c.popoutIframe&&this.removePopoutForButton(c)
                },
        reshowAllOpenPopoutIframes:function(){
            var a=document.querySelectorAll("iframe.FlattrButton"),b,c;
            for(b=0;b<a.length;b+=1)c=a[b],c.popoutIframe&&(this.removePopoutForButton(c),this.showPopoutForButton(c))
                },
        encodeData:function(a){
            var b,c,d="";
            for(b in a)a.hasOwnProperty(b)&&(c=a[b],b=="description"&&(c=this.stripTags(c,"<br>"),c.length>1e3&&(c=c.substring(0,1e3))),c=c.replace(/^\s+|\s+$/g,"").replace(/\s{2,}|\t+/g," "),d+=b+"="+encodeURIComponent(c)+"&");return d
            },
        getParam:function(a,b){
            return typeof this.options[a]!="undefined"?this.options[a]:b
            },
        init:function(){
            var b,c,d,e,f,g,h,i,j,k,l,m,n=document.getElementsByTagName("script");
            try{
                for(b=n.length-1;b>=0;b--){
                    c=n[b];
                    if(!c.hasAttribute("src"))continue;
                    d=c.src,e=new RegExp("^(http(?:s?))://(api\\.(?:.*\\.?)flattr\\.(?:com|dev))","i"),f=d.match(e);
                    if(f){
                        this.options.domain=f[2].toString(),this.options.https=f[1].toString()=="https"?1:0,g=d.indexOf("?");
                        if(g){
                            h=d.substring(++g),i=h.split("&");
                            for(k=0;k<i.length;k++)j=i[k].split("="),this.validParam(j[0],this.validParams)&&(this.options[j[0]]=j[1])
                                }
                                this.instance=c;
                        break
                    }
                }
                }catch(o){}
    window.addEventListener!==undefined?(l=window.addEventListener,m="message"):(l=window.attachEvent,m="onmessage"),l(m,function(b){
        var c;
        try{
            c=JSON.parse(b.data)
            }catch(d){
            c={}
        }
        c.flattr_button_event==="popout_close_button_clicked"?a.removeAllOpenPopoutIframes():c.flattr_button_event==="click_successful"&&a.reshowAllOpenPopoutIframes()
        },!1);
switch(this.getParam("mode","manual")){
    case"direct":
        this.render();
        break;
    case"auto":case"automatic":
        var p=this;
        this.domReady(function(){
        p.setup()
        });
    break;
    case"manual":default:
}
return this
},
loadButton:function(a){
    var b,c,d,e,f,g={},h=null;
    for(b in this.options)this.options.hasOwnProperty(b)&&this.validParam(b,this.validButtonParams)&&(g[b]=this.options[b]);a.href&&(g.url=a.href),a.getAttribute("title")&&(g.title=a.getAttribute("title")),a.getAttribute("lang")&&(g.language=a.getAttribute("lang")),a.innerHTML&&(g.description=a.innerHTML);
    if((h=a.getAttribute("rev"))!==null&&h.substring(0,6)=="flattr"||(h=a.getAttribute("rel"))!==null&&h.substring(0,6)=="flattr"){
        h=h.substring(7).split(";");
        for(c=0;c<h.length;c++)d=h[c].split(":"),e=d.shift(),this.validParam(e,this.validButtonParams)&&(g[e]=d.join(":"))
            }else for(f in this.validButtonParams)this.validButtonParams.hasOwnProperty(f)&&(h=a.getAttribute(this.getParam("html5-key-prefix","data-flattr")+"-"+this.validButtonParams[f]))!==null&&(g[this.validButtonParams[f]]=h);this.replaceWith(a,this.createIframe(g))
    },
render:function(a,b,c){
    var d,e={};
    
    for(d in this.options)this.options.hasOwnProperty(d)&&this.validParam(d,this.validButtonParams)&&(e[d]=this.options[d]);try{
        if(a)for(d in a)a.hasOwnProperty(d)&&this.validParam(d,this.validButtonParams)&&(e[d]=a[d]);else window.flattr_uid&&(e.uid=window.flattr_uid),window.flattr_url&&(e.url=window.flattr_url),window.flattr_btn&&(e.button=window.flattr_btn),window.flattr_hide&&(e.hidden=window.flattr_hide==1?1:0),window.flattr_cat&&(e.category=window.flattr_cat),window.flattr_tag&&(e.tags=window.flattr_tag),window.flattr_lng&&(e.language=window.flattr_lng),window.flattr_tle&&(e.title=window.flattr_tle),window.flattr_dsc&&(e.description=window.flattr_dsc);
        var f=this.createIframe(e);
        if(b){
            typeof b=="string"&&(b=document.getElementById(b));
            switch(c){
                case"before":
                    b.parentNode.insertBefore(f,b);
                    break;
                case"replace":
                    this.replaceWith(b,f);
                    break;
                case"append":default:
                    b.appendChild(f)
                    }
                }else this.getParam("mode","manual")=="direct"&&this.replaceWith(this.instance,this.createIframe(e))
        }catch(g){}
},
replaceWith:function(a,b){
    if(typeof b=="string")if(typeof document.documentElement.outerHTML!="undefined")a.outerHTML=b;
        else{
        var c=document.createRange();
        c.selectNode(a),b=c.createContextualFragment(b),a.parentNode.replaceChild(b,a)
        }
        var d=a.parentNode;
    d.replaceChild(b,a)
    },
setup:function(){
    var a,b,c;
    if(document.querySelectorAll)try{
        c=document.querySelectorAll("a.FlattrButton")
        }catch(d){}
        if(c==undefined){
        c=[],a=document.getElementsByTagName("a");
        for(b=a.length-1;b>=0;b--)/FlattrButton/.test(a[b].className)&&(c[c.length]=a[b])
            }
            for(b=c.length-1;b>=0;b--)this.loadButton(c[b])
        },
stripTags:function(a,b){
    var c="",d=!1,e=[],f=[],g="",h=0,i="",j="",k=function(a,b,c){
        return c.split(a).join(b)
        };
        
    b&&(f=b.match(/([a-zA-Z0-9]+)/gi)),a+="",e=a.match(/(<\/?[\S][^>]*>)/gi);
    for(c in e)if(e.hasOwnProperty(c)){
        if(isNaN(c))continue;
        j=e[c].toString(),d=!1;
        for(i in f)if(f.hasOwnProperty(i)){
            g=f[i],h=-1,h!=0&&(h=j.toLowerCase().indexOf("<"+g+">")),h!=0&&(h=j.toLowerCase().indexOf("<"+g+" ")),h!=0&&(h=j.toLowerCase().indexOf("</"+g));
            if(h==0){
                d=!0;
                break
            }
        }
        d||(a=k(j,"",a))
        }
        return a
},
validParam:function(a,b){
    var c;
    for(c=0;c<b.length;c++)if(b[c]==a)return!0;return!1
    }
};

return a
}();
!function(a,b){
    function c(a){
        m=1;
        while(a=d.shift())a()
            }
            var d=[],e,f,g=!1,h=b.documentElement,i=h.doScroll,j="DOMContentLoaded",k="addEventListener",l="onreadystatechange",m=/^loade|c/.test(b.readyState);
    b[k]&&b[k](j,f=function(){
        b.removeEventListener(j,f,g),c()
        },g),i&&b.attachEvent(l,e=function(){
        /^c/.test(b.readyState)&&(b.detachEvent(l,e),c())
        }),a.domReady=i?function(b){
        self!=top?m?b():d.push(b):function(){
            try{
                h.doScroll("left")
                }catch(c){
                return setTimeout(function(){
                    a.domReady(b)
                    },50)
                }
                b()
            }()
        }:function(a){
        m?a():d.push(a)
        }
    }(FlattrLoader,document),FlattrLoader.init()