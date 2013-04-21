<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0; overflow: hidden; }
    </style>
	<link href='http://fonts.googleapis.com/css?family=Marcellus+SC' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="./index.css" />
  </head>
  <body>
    <iframe id="mapFrame" src="./map.php"></iframe>
	<div id="header">
		<div id="leftText" class="titleText">
			Why we explore? <font color="red">Collective</font>
		</div>
		<div id="rightText" class="titleText">
			<div id="searchbox">
				<input id="mainsearch" type="text" value="WhyWeExplore">
				<div id="searchbutton" onclick="window.frames['mapFrame'].searchGlobaly(document.getElementById('mainsearch').value);" title="Search">Search</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<div id="instructions"  class="titleText">
			Publish your video just tagging #whyweexplore and setting your location on youtube video advanced settings.
			<a href="./instructions.png" download="instructions">Download Instructions</a>
		</div>
	</div>
  </body>
</html>