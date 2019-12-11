(function() {

    document.addEventListener('keydown', event => {
        console.log(event);
        if (event.ctrlKey && event.key === 'g') {
            document.body.classList.toggle('grid-overlay--visible');
        }
    });

    var css = `
        body.grid-overlay--visible::before,
        body.grid-overlay--visible::after {
            content: "";
            display: block;
            pointer-events: none;
            top: {{$offsetTop}}px;
            left: {{$offsetLeft}}px;
            right: {{$offsetRight}}px;
            bottom: {{$offsetBottom}}px;
            width: {{$width}}px;
            margin: 0 auto;
            z-index: 9999;
            position: absolute;
        }

        /* Columns (vertical lines) */
        body.grid-overlay--visible::before {
            background: url('data:image/svg+xml;utf8,<svg height="100%" width="78" xmlns="http://www.w3.org/2000/svg"><rect width="1" height="100%" style="fill:rgba(255, 0, 255, 1)" /><rect width="1" height="100%" style="fill:rgba(255, 0, 255, 1)" x="6" /></svg>') repeat top left;
            background-position: -6px -6px;
            overflow: hidden;
        }

        /* Rows (horizontal lines) */
        body.grid-overlay--visible::after {
            background: url('data:image/svg+xml;utf8,<svg height="78" width="1" xmlns="http://www.w3.org/2000/svg"><rect width="1" height="1" style="fill:rgba(0, 255, 255, 1)" /><rect width="1" height="1" style="fill:rgba(0, 255, 255, 1)" y="6" /></svg>') repeat top left;
            background-position: -6px -6px;
            overflow: hidden;
        }
    `;

    var head = document.head || document.getElementsByTagName('head')[0];
    var style = document.createElement('style');

    head.appendChild(style);
    style.type = 'text/css';

    if (style.styleSheet){
        // This is required for IE8 and below.
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }
})();
