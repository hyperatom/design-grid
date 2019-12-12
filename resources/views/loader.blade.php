(function() {

    if (window.localStorage.getItem('grid-overlay.enabled')) {
        document.body.classList.add('grid-overlay--visible');
    }

    document.addEventListener('keydown', event => {
        if (event.ctrlKey && event.key === 'g') {
            if (document.body.classList.contains('grid-overlay--visible')) {
                window.localStorage.removeItem('grid-overlay.enabled');
                document.body.classList.remove('grid-overlay--visible');
            } else {
                window.localStorage.setItem('grid-overlay.enabled', true);
                document.body.classList.add('grid-overlay--visible');
            }
        }
    });

    var css = `
        body.grid-overlay--visible {
            position: relative;
        }

        body.grid-overlay--visible::before,
        body.grid-overlay--visible::after {
            content: "";
            display: block;
            pointer-events: none;
            top: {{$offsetTop}}px;
            left: {{$offsetLeft}}px;
            right: {{$offsetRight}}px;
            bottom: {{$offsetBottom}}px;
            max-width: {{$width}}px;
            width: 100%;
            @if($center)
            margin: 0 auto;
            @endif
            z-index: 9999;
            position: absolute;
        }

        /* Columns (vertical lines) */
        body.grid-overlay--visible::before {
            background: url('data:image/svg+xml;utf8,<svg height="100%" width="{{$unitWidth + $gutterWidth}}" xmlns="http://www.w3.org/2000/svg"><rect width="{{$lineWidth}}" height="100%" fill="{{$lineYHex}}" /><rect width="{{$lineWidth}}" height="100%" fill="{{$lineYHex}}" x="{{$gutterWidth}}" /></svg>') repeat top left;
            background-position: -{{$gutterWidth}}px -{{$gutterWidth}}px;
            overflow: hidden;
        }

        /* Rows (horizontal lines) */
        body.grid-overlay--visible::after {
            background: url('data:image/svg+xml;utf8,<svg height="{{$unitWidth + $gutterWidth}}" width="{{$lineWidth}}" xmlns="http://www.w3.org/2000/svg"><rect width="{{$lineWidth}}" height="{{$lineWidth}}" fill="{{$lineXHex}}" /><rect width="{{$lineWidth}}" height="{{$lineWidth}}" fill="{{$lineXHex}}" y="{{$gutterWidth}}" /></svg>') repeat top left;
            background-position: -{{$gutterWidth}}px -{{$gutterWidth}}px;
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
