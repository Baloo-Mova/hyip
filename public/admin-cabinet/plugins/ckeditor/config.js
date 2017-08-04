/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    
    // Configure your file manager integration. This example uses CKFinder 3 for PHP.
//    config.filebrowserBrowseUrl      = '/ckfinder/ckfinder.html';
//    config.filebrowserImageBrowseUrl = '/ckfinder/ckfinder.html?type=Images';
//    config.filebrowserUploadUrl      = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = ( typeof(tops_base_url) != 'undefined' ) ? tops_base_url + '/admin/api/uploads' : '/admin/api/uploads';

    config.extraPlugins   = 'youtube,imagebrowser,uploadimage,image2';
    config.youtube_width  = '640';
    config.youtube_height = '480';
//    config.contentsCss    = '480';
    
    config.uploadUrl            = ( typeof(tops_base_url) != 'undefined' ) ? tops_base_url + '/admin/api/uploads' : '/admin/api/uploads';
    config.imageBrowser_listUrl = ( typeof(tops_base_url) != 'undefined' ) ? tops_base_url + '/admin/api/uploads' : '/admin/api/uploads';
};
