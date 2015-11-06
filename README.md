# randomizer
Use a text file to list items to be displayed in random order.

1) Edit items.txt with the text you would like randomized. Links may be added in the following format: [anchor text URL_HERE]. To open in a new tab: [anchor text URL_HERE _blank]

2) Upload ajax.php, items.txt, random.js, and style.css to a web server. They should all reside in the same directory except for items.txt. It can be anywhere as we will use curl to retrieve the contents.

3) Add the code from index.html to the page on which you would like to see the widget. Be sure to update data-num and data-text-file attributes.
```html
<div id="random-container" data-num="3" data-text-file="http://url/to/items.txt">
	<h2>Did you know?</h2>
</div>
```
4) Include jQuery and random.js before your closing body tag (or below the widget code above). Be sure to edit the random.js script to point to its actual location on the web server.
```html
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="random.js"></script>
```
5) Enjoy!
