/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
 var domain = window.location.protocol +'//'+ window.location.hostname +'/cmart';
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = domain + '/public/packages/ckfinder/ckfinder.html';
 
	config.filebrowserUploadUrl = domain + '/public/packages/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.extraPlugins = 'video';
};
