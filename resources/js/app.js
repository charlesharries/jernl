import Router from './util/Router';
import common from './routes/common';
import createEntry from './routes/createEntry';

/**
 * Add an event listener for when the dom is ready. Basically
 * just copies jQuery's $(document).ready().
 *
 * @link https://stackoverflow.com/questions/9899372/pure-javascript-equivalent-of-jquerys-ready-how-to-call-a-function-when-t
 * @param {function} fn Function you want to run when dom is ready
 */
function domReady(fn) {
  // see if DOM is already available
  if (
    document.readyState === 'complete' ||
    document.readyState === 'interactive'
  ) {
    // call on next available tick
    setTimeout(fn, 1);
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

require('./bootstrap');
require('trix');

const routes = new Router({
  common,
  createEntry,
});

domReady(() => routes.loadEvents());
