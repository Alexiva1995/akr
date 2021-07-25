/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: C:\\laragon\\www\\akr\\resources\\js\\app.js: Support for the experimental syntax 'jsx' isn't currently enabled (4:1):\n\n\u001b[0m \u001b[90m 2 |\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 3 |\u001b[39m\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 4 |\u001b[39m \u001b[33m<\u001b[39m\u001b[33mdiv\u001b[39m \u001b[36mclass\u001b[39m\u001b[33m=\u001b[39m\u001b[32m\"container\"\u001b[39m\u001b[33m>\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m   |\u001b[39m \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 5 |\u001b[39m   \u001b[33m<\u001b[39m\u001b[33mform\u001b[39m\u001b[33m>\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 6 |\u001b[39m   \u001b[33m<\u001b[39m\u001b[33mdiv\u001b[39m \u001b[36mclass\u001b[39m\u001b[33m=\u001b[39m\u001b[32m\"form-group\"\u001b[39m\u001b[33m>\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 7 |\u001b[39m     \u001b[33m<\u001b[39m\u001b[33mtextarea\u001b[39m \u001b[36mclass\u001b[39m\u001b[33m=\u001b[39m\u001b[32m\"status-box\"\u001b[39m rows\u001b[33m=\u001b[39m\u001b[32m\"3\"\u001b[39m placeholder\u001b[33m=\u001b[39m\u001b[32m\"Write your message here...\"\u001b[39m\u001b[33m>\u001b[39m\u001b[33m<\u001b[39m\u001b[33m/\u001b[39m\u001b[33mtextarea\u001b[39m\u001b[33m>\u001b[39m\u001b[0m\n\nAdd @babel/preset-react (https://git.io/JfeDR) to the 'presets' section of your Babel config to enable transformation.\nIf you want to leave it as-is, add @babel/plugin-syntax-jsx (https://git.io/vb4yA) to the 'plugins' section to enable parsing.\n    at Parser._raise (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:816:17)\n    at Parser.raiseWithData (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:809:17)\n    at Parser.expectOnePlugin (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:9911:18)\n    at Parser.parseExprAtom (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:11291:22)\n    at Parser.parseExprSubscripts (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:10869:23)\n    at Parser.parseUpdate (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:10849:21)\n    at Parser.parseMaybeUnary (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:10827:23)\n    at Parser.parseExprOps (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:10684:23)\n    at Parser.parseMaybeConditional (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:10658:23)\n    at Parser.parseMaybeAssign (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:10621:21)\n    at Parser.parseExpressionBase (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:10567:23)\n    at C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:10561:39\n    at Parser.allowInAnd (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:12330:16)\n    at Parser.parseExpression (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:10561:17)\n    at Parser.parseStatementContent (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:12667:23)\n    at Parser.parseStatement (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:12536:17)\n    at Parser.parseBlockOrModuleBlockBody (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:13125:25)\n    at Parser.parseBlockBody (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:13116:10)\n    at Parser.parseProgram (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:12459:10)\n    at Parser.parseTopLevel (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:12450:25)\n    at Parser.parse (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:14177:10)\n    at parse (C:\\laragon\\www\\akr\\node_modules\\@babel\\parser\\lib\\index.js:14229:38)\n    at parser (C:\\laragon\\www\\akr\\node_modules\\@babel\\core\\lib\\parser\\index.js:52:34)\n    at parser.next (<anonymous>)\n    at normalizeFile (C:\\laragon\\www\\akr\\node_modules\\@babel\\core\\lib\\transformation\\normalize-file.js:82:38)\n    at normalizeFile.next (<anonymous>)\n    at run (C:\\laragon\\www\\akr\\node_modules\\@babel\\core\\lib\\transformation\\index.js:29:50)\n    at run.next (<anonymous>)\n    at Function.transform (C:\\laragon\\www\\akr\\node_modules\\@babel\\core\\lib\\transform.js:25:41)\n    at transform.next (<anonymous>)\n    at step (C:\\laragon\\www\\akr\\node_modules\\gensync\\index.js:261:32)\n    at C:\\laragon\\www\\akr\\node_modules\\gensync\\index.js:273:13\n    at async.call.result.err.err (C:\\laragon\\www\\akr\\node_modules\\gensync\\index.js:223:11)\n    at C:\\laragon\\www\\akr\\node_modules\\gensync\\index.js:189:28\n    at C:\\laragon\\www\\akr\\node_modules\\@babel\\core\\lib\\gensync-utils\\async.js:73:7\n    at C:\\laragon\\www\\akr\\node_modules\\gensync\\index.js:113:33");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\laragon\www\akr\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\laragon\www\akr\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });