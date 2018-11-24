/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {

    //var ckfinderPath = "/assets/ckfinder"; //ckfinder路径
    //config.filebrowserBrowseUrl = ckfinderPath + '/ckfinder.html';
    //config.filebrowserImageBrowseUrl = ckfinderPath + '/ckfinder.html?type=Images';
    //config.filebrowserFlashBrowseUrl = ckfinderPath + '/ckfinder.html?type=Flash';
    //config.filebrowserUploadUrl = ckfinderPath + '/core/connector/php/connector.php?command=QuickUpload&type=Files';
    //config.filebrowserImageUploadUrl = ckfinderPath + '/core/connector/php/connector.php?command=QuickUpload&type=Images';
    //config.filebrowserFlashUploadUrl = ckfinderPath + '/core/connector/php/connector.php?command=QuickUpload&type=Flash';

    var ckfinderPath = "/assets"; //ckfinder路径
    config.filebrowserBrowseUrl = ckfinderPath + '/ck/ckfinder.html';
    config.filebrowserImageBrowseUrl = ckfinderPath + '/ck/ckfinder.html?type=Images';
    config.filebrowserUploadUrl = ckfinderPath + '/ck/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = ckfinderPath + '/ck/core/connector/php/connector.php?command=QuickUpload&type=Images';


    config.image_previewText = '';
    config.language = 'zh-cn';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'About,SpecialChar,Smiley,PageBreak,Iframe,Flash,Language,Textarea,TextField,Radio,Checkbox,Form,Select,Button,ImageButton,HiddenField';

};
