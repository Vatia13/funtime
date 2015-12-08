/**
 * Created by Vati Child on 6/26/15.
 */


tinymce.PluginManager.add('LastNews', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('LastNews', {
        text: 'LastNews',
        icon: false,
        onclick: function() {
            // Open window
            var con = editor.getContent();
            var txt = convertTinyText(con);
            editor.insertContent('<img src="http://funtime.ge:80/img/lastnews.png" id="LastNews" />');
        }
    });
});