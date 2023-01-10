import {domReady} from '@roots/sage/client';
import "bootstrap";
import MobileMenu from './components/mobile-menu';

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  // application code
  const Mobile = new MobileMenu();
  Mobile.init();
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
// const Mobile = new MobileMenu();
//   Mobile.init();
