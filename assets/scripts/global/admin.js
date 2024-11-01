jQuery(document).ready(function(){
	var $ = jQuery;
	$(".swicth").bootstrapSwitch();
	$(".radioswicth").bootstrapSwitch();
	$(".touchspin").TouchSpin({
		min: 1,
		max: 4
	});
	$('#summernote').summernote();
	$('.colorpicker-rgba').colorpicker();

	//upload button
	// favicon upload
	var uploadFavicon;
	var fatarget = $('#favicon');
	var faviewImg = $('#favicon_view');
	$('#upload_favicon').click(function(e){
		e.preventDefault();
		uploadButton(uploadFavicon, fatarget, faviewImg);
	});
	$('#remove_favicon').click(function(){
		removeButton(faviewImg, fatarget);
	});
	//upload header background image
	var uploadHeaderbg;
	var hbgtarget = $('#headerbg');
	var hbgviewImg = $('#headerbg_view');
	$('#upload_headerbg').click(function(e){
		e.preventDefault();
		uploadButton(uploadHeaderbg, hbgtarget, hbgviewImg);
	});
	$('#remove_headerbg').click(function(){
		removeButton(hbgviewImg, hbgtarget);
	});
	//upload title bar background image
	var uploadTitlebg;
	var titletarget = $('#title_bgimg');
	var titleviewImg = $('#titlebg_view');
	$('#upload_titlebg').click(function(e){
		e.preventDefault();
		uploadButton(uploadTitlebg, titletarget, titleviewImg);
	});
	$('#remove_titlebg').click(function(){
		removeButton(titleviewImg, titletarget);
	});

	//custom css editor
    $('.editor').each(function(e){
        var editor_id = $(this).attr('id');
        var mode = $(this).attr('data-mode');
        var forAttr = $(this).attr('for');

        var input_hidden_id = '#hidden_input_'+forAttr;
        var data = $(input_hidden_id).text();

        var editor = ace.edit(editor_id);
        editor.setValue(data, 1);
        editor.setTheme("ace/theme/chrome");
        editor.getSession().setMode("ace/mode/"+mode);
        editor.setOptions({
            fontSize: 13,
        });
    });

    $(document).on('keyup', '.ace_text-input', function(){
        var id = $(this).parent().attr('for');
        var editor_id = $(this).parent().attr('id');

        var editor = ace.edit(editor_id);
        var data = editor.getValue();
        var input_hidden_id = '#hidden_input_'+id;
        $(input_hidden_id).text(data);
    });
	
	// upload button
	function uploadButton(uploadVar, target1 = '', target2 = '')
	{
	    //If the uploader object has already been created, reopen the dialog
	    if (uploadVar) {
	        uploadVar.open();
	        return;
	    }
	    //Extend the wp.media object
	    uploadVar = wp.media.frames.file_frame = wp.media({
	        title: 'Choose Image',
	        button: {
	            text: 'Choose Image'
	        },
	        multiple: false
	    });
	    //When a file is selected, grab the URL and set it as the text field's value
	    uploadVar.on('select', function() {
	        attachment = uploadVar.state().get('selection').first().toJSON();
	        target2.attr('src', attachment.url).show();
	        target1.attr('value', attachment.url);
	    });
	    //Open the uploader dialog
	    uploadVar.open();
	}

	// remove button
	function removeButton(target1 = '', target2 = '')
	{
        target1.attr('src', '#').hide();
        target2.attr('value', '');
	}
});