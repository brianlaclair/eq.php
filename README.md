# eq.php 🎯
eq is a function library developed to make outputting HTML a breeze in PHP

## the basics
eq has buffered output, meaning that it doesn't actually dump what you've created until you tell it to.

All eq documents start with `eq_start();` and end with `eq_end();`

With eq, we can generate HTML that looks like this ⏬ 

    <!DOCTYPE html>
    <html>
    <head>
    <title>eq.php</title>
    <meta name="description" content="example eq page">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="prism.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
    </body>
    </html>

from a script that looks like this ⏬

    eq_start("eq_title=eq.php",["description", "example eq page"], "style.css", "prism.css", "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js");
    eq_end();

We can add HTML elements after we've called `eq_start()` by using a plethora of functions

## head content
Head information can be added inside of `eq_start()`, or separately from individual function calls as-needed.

### `eq_start()`
accepts a range of arguments - as seen in the example above, **linked items (CSS files, JS files)** will automatically import to the head section if listed in the arguments of this function.

**meta tags** can be included in an `eq_start` call by listing them as an array, ie, 
`eq_start(["description", "example eq page"])` would give you ` <meta name="description" content="example eq page">` 
(it's worth noting that cases are registered not only for standard pattern-breaking meta tags, i.e. `["UTF-8"]` as `<meta charset=UTF-8>`, but also for non-standard meta tags such as `og:`, `fb:`, and `article:` that return `property` rather than `name`)

Some items need to be better defined - specifically **styles and scripts that are not linked** (eg, `eq_start("eq_style=.cssclass { background-color: #000; }")` or `eq_start("eq_script=alert('Hello World!');")`)
the **title** of the page can be defined in `eq_start()` by using `"eq_title=This Is A Website!"`

With **all** of the aforementioned cases, you can instead use one of the functions below and omit it from your `eq_start` arguments.

### Reference
| function | usage |
|--|--|
|eq_start| covered in detail above, accepts an infinite number of arguments |
|eq_title| `eq_title(string)` can be used anywhere within an eq document to set the title of the page. It can only be called once on a document, whether it be with `"eq_title=This Page"` in `eq_start` or standalone below it.|
|eq_meta|`eq_meta(string, [string])` automatically generates a meta tag in the head|

#### context-based head functions
these functions will act differently depending on if you've already added body content or not

| function | usage |
|--|--|
|eq_style| `eq_style(string, [head])` can accept either a URL to link, or CSS to output within tags. You can add an optional boolean argument to define if it's in the head or not (defaults based on context) |
|eq_script| `eq_script(string, [head])`can accept either a URL to link, or script to output within tags. You can add an optional boolean argument to define if it's in the head or not (defaults based on context)|

## body content


### Reference
| function | usage |
|--|--|
|eq_div| `eq_div([class], [id], [attributes])` inserts a `<div>` tag with optional classes, id, and extra attributes (styles can be accepted, etc) |
|eq_div_end| `eq_div_end([ittr])` inserts a `</div>` tag with optional repetitions. Alternatively, passing a string rather than a number of iterations (or nothing) will result in opening and closing an empty div, such as `eq_div_end('class="test"');` would result in `<div class="test"></div>` |
|eq_text| `eq_text(string, [type], [class], [return])` output text matching the first argument. The [type] argument allows you to encompass the text in an element, for example `eq_text("Hello World", "h1");` outputs `<h1>Hello World</h1>`. The class argument allows you to define classes for the element, and setting [return] to true results in the output being returned rather than outputted to the buffer |
|eq_link| `eq_link(urlstring, [text], [class], [return])` creates a link to the first argument. [text] defines the display text (if not set, defaults to the URL string). <br><br>**note:** the return argument for `eq_link` is different than other functions - it is intended to be used in conjunction with `eq_text` such as: `eq_text("Hello world, check out this link: " . eq_link("https://google.com/"));` |
|eq_image|`eq_image(urlstring, [class], [attr], [return])` inserts an image, with optional classes and HTML attributes (ie, `width=200px`)|
|eq_br|`eq_br([ittr], [return])` insert [ittr] of line breaks, defaults to 1 |
|eq_button|`eq_button(string, [action], [class])`|
|eq_table|`eq_table([class], [id])` opens a table|
|eq_caption|`eq_caption(string, [class])` add a caption to the table|
|eq_table_row|`eq_table_row(cell, cell...)` inserts a new row into the open table, with an unlimited number of cell arguments |
|eq_table_end|`eq_table_end()` closes the table|
