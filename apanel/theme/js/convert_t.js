var charmaps = {
    utf : "აბგდევზთიკლმნოპჟრსტუფქღყშჩცძწჭხჯჰ",
    lat : "abgdevzTiklmnopJrstufqRySCcZwWxjh"
}

var convertTinyEncoding = function(subject, fromChars, toChars) {
    var re = "";
    for(var i=0; i<fromChars.length; i++ ) {

        re  = new RegExp("(" + fromChars[i]+ ")(?!([^<]+)?>)", "gm");

        subject = subject.replace(re, toChars[i] );

    }

    subject = subject.replace(new RegExp('&ნბსპ;', 'g'), '&nbsp;' );
    subject = subject.replace(new RegExp('&ოსლასჰ;', 'g'), '&Oslash;' );
    subject = subject.replace(new RegExp('&სლასჰ;', 'g'), '&slash;' );
    subject = subject.replace(new RegExp('&ნდასჰ;', 'g'), '&ndash;' );
    subject = subject.replace(new RegExp('&ლდქუო;', 'g'), '&ldquo;' );
    subject = subject.replace(new RegExp('&ბდქუო;', 'g'), '&bdquo;' );
    subject = subject.replace(new RegExp('&რდქუო;', 'g'), '&rdquo;' );
    subject = subject.replace(new RegExp('&რსქუო;', 'g'), '&rsquo;' );
    subject = subject.replace(new RegExp('&ლსქუო;', 'g'), '&lsquo;' );
    subject = subject.replace(new RegExp('&რაქუო;', 'g'), '&raquo;' );
    subject = subject.replace(new RegExp('&ლაქუო;', 'g'), '&laquo;' );
    subject = subject.replace(new RegExp('&ამპ;', 'g'), '&amp;' );
    subject = subject.replace(new RegExp('&გტ;', 'g'), '&gt;' );
    subject = subject.replace(new RegExp('&ლტ;', 'g'), '&lt;' );
    return subject;
}

var convertTinyText = function(txt){

    var to = 'lat';
    var from   = 'utf';

    //$('#textarea1').val( convertEncoding(txt, charmaps[from], charmaps[to]) );

    return convertTinyEncoding(txt, charmaps[from], charmaps[to]);
}
tinymce.PluginManager.add('Convert', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('Convert', {
        text: 'Sylfaen to AcadNusx',
        icon: false,
        onclick: function() {
            // Open window
            var con = editor.getContent();
            var txt = convertTinyText(con);
            editor.setContent(txt, {format : 'raw'});
        }
    });
});