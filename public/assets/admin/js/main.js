$(document).ready(function () {
    bsCustomFileInput.init();

    
});


/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
(function ($) {
  'use strict'

    $('.select2').select2()

})(jQuery)


ClassicEditor
    .create( document.querySelector( '.content-editor_uk' ), {
        ckfinder: {
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
        },
        image: {
            // You need to configure the image toolbar, too, so it uses the new style buttons.
            toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight' ],

            styles: [
                // This option is equal to a situation where no style is applied.
                'full',

                // This represents an image aligned to the left.
                'alignLeft',

                // This represents an image aligned to the right.
                'alignRight'
            ]
        },
        toolbar: {
            items: [
                'heading',
                '|',
                'fontColor',
                'fontSize',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'indent',
                'outdent',
                'alignment',
                '|',
                'CKFinder',
                'blockQuote',
                'insertTable',
                'mediaEmbed',
                'undo',
                'redo',
                'code',
                'codeBlock',
                'htmlEmbed'
            ]
        },
        language: 'ru',

        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells'
            ]
        },
    } )
    .catch( function( error ) {
        console.error( error );
    } );


ClassicEditor
    .create( document.querySelector( '.content-editor_ru' ), {
        ckfinder: {
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
        },
        image: {
            // You need to configure the image toolbar, too, so it uses the new style buttons.
            toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight' ],

            styles: [
                // This option is equal to a situation where no style is applied.
                'full',

                // This represents an image aligned to the left.
                'alignLeft',

                // This represents an image aligned to the right.
                'alignRight'
            ]
        },
        toolbar: {
            items: [
                'heading',
                '|',
                'fontColor',
                'fontSize',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'indent',
                'outdent',
                'alignment',
                '|',
                'CKFinder',
                'blockQuote',
                'insertTable',
                'mediaEmbed',
                'undo',
                'redo',
                'code',
                'codeBlock',
                'htmlEmbed'
            ]
        },
        language: 'ru',

        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells'
            ]
        },
    } )
    .catch( function( error ) {
        console.error( error );
    } );
// Юзабилити меню
$('.nav-sidebar a').each(function () {
    let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
    let link = this.href;
    if (link == location) {
        $(this).addClass('active');
        $(this).closest('.has-treeview').addClass('menu-open');
    }
});
// загрузка файлов


var ashbutton1 = document.getElementById( 'ckfinder-input-1' );
var ashbutton2 = document.getElementById( 'ckfinder-input-2' );
ashbutton1.onclick = function() {
    selectFileWithCKFinder( 'ckfinder-input-1' );
};
ashbutton2.onclick = function() {
    selectFileWithCKFinder( 'ckfinder-input-2' );
};

function selectFileWithCKFinder( elementId ) {
    CKFinder.modal( {
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                var file = evt.data.files.first();
                var output = document.getElementById( elementId );
                output.value = file.getUrl();
            } );

            finder.on( 'file:choose:resizedImage', function( evt ) {
                var output = document.getElementById( elementId );
                output.value = evt.data.resizedUrl;
            } );
        }
    } );
}
