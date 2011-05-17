# msiehtml5 #

The only way to get older version of Internet Explorer to render html5 tags without any javascript shiv script is to put these tags in their own namespace

This extension sniffes for IE older than 9, post-processes the output markup and replaces all html5 tags with `<html5:tagname></html5:tagname>`.

Don't forget to escape tag declarations in you css stylesheet, e.g. "html\:header"

I have tested this in combination with the html5_doctype Extension (https://github.com/domain7/html5_doctype)  (it's actually just a slight modified version of it), and in my case, it worked quite well, but I think page caching will be a problem.

Note that, depending on the size of the document, it may have noticeable impact on the page performance.
