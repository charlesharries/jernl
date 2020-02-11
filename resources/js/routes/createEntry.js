export default {
  init() {
    let observe;

    if (window.attachEvent) {
      observe = function(element, event, handler) {
        element.attachEvent(`on${event}`, handler);
      };
    } else {
      observe = function(element, event, handler) {
        element.addEventListener(event, handler, false);
      };
    }

    function initTextarea() {
      const texts = document.querySelectorAll('[data-autoresize]');

      function resize(e) {
        e.target.style.height = `${e.target.scrollHeight}px`;
      }

      texts.forEach(text => {
        observe(text, 'input', resize);

        resize({ target: text });
      });
    }

    initTextarea();
  },

  finally() {
    console.log('createEntry/finally');
  },
};
