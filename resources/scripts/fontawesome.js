// import then needed Font Awesome functionality
import { library, dom } from '@fortawesome/fontawesome-svg-core';

// import the Facebook and Twitter icons
import { faCartPlus } from "@fortawesome/free-solid-svg-icons";

// add the imported icons to the library
library.add(faCartPlus);

// tell FontAwesome to watch the DOM and add the SVGs when it detects icon markup
dom.watch();