<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Updates varios
		</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--SCRIPTS-->

<script>


$.urlParam = function(name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	if (results==null){
	   return null;
	}
	else{
	   return decodeURI(results[1]) || 0;
	}
};





// Created by STRd6
// MIT License
// jquery.paste_image_reader.js
function exportBLOB(blob,nombre) {
      //var url = (window.URL || window.webkitURL).createObjectURL(blob);
      //console.log(url);
      var formData = new FormData(); // puedo crear un formulario dinamico !!!!
      formData.append('file', blob,nombre);

//parametros, algunos nuevos: para los BLOBS
//	cache: false,
//	contentType: false,
//	processData: false


$.ajax({
    type: 'POST',
      url :  "recibeimagenes.php",
     data: formData,
    cache: false,
    contentType: false,
    processData: false
	}).done(function(data) {
    		console.log(data);
}).success(function(data, status)
         {
          if(data.status != 'error')
            {
				document.write("<img src='"+data+"'></img>");			
          		alert("llego ok !!!!");
	    	}
	    else	
            alert("llego caca!");
 		 });

}
 
function guardaenFS(){

//https://stackoverflow.com/questions/17332071/trying-to-save-canvas-png-data-url-to-disk-with-html5-filesystem-but-when-i-ret	
   var t = document.getElementById("base64");
	var imagenBase64 = t.value;	
	var nombreArchivo = document.getElementById("nombreEscudo");
	//alert(nombreArchivo.value);
//Remove the beginning identifier and use Chrome/Firefox?safari built int base64Decoder
	var data = atob( imagenBase64.replace(/^.*?base64,/, '') );	

	asArray = new Uint8Array(data.length);

	for( var i = 0, len = data.length; i < len; ++i ) 
	{
	    asArray[i] = data.charCodeAt(i);    
	}

	var blob = new Blob( [ asArray.buffer ], {type: "image/png"} );

 	exportBLOB(blob,nombreArchivo.value) ;



}

(function($) {
	var defaults;
	$.event.fix = (function(originalFix) {
		return function(event) {
			event = originalFix.apply(this, arguments);
			if (event.type.indexOf("copy") === 0 || event.type.indexOf("paste") === 0) {
				event.clipboardData = event.originalEvent.clipboardData;
			}
			return event;
		};
	})($.event.fix);
	defaults = {
		callback: $.noop,
		matchType: /image.*/
	};
	return ($.fn.pasteImageReader = function(options) {
		if (typeof options === "function") {
			options = {
				callback: options
			};
		}
		options = $.extend({}, defaults, options);
		return this.each(function() {
			var $this, element;
			element = this;
			$this = $(this);
			return $this.bind("paste", function(event) {
				var clipboardData, found;
				found = false;
				clipboardData = event.clipboardData;
				return Array.prototype.forEach.call(clipboardData.types, function(type, i) {
					var file, reader;
					if (found) {
						return;
					}
					if (
						type.match(options.matchType) ||
						clipboardData.items[i].type.match(options.matchType)
					) {
						file = clipboardData.items[i].getAsFile();
						reader = new FileReader();
						reader.onload = function(evt) {
							return options.callback.call(element, {
								dataURL: evt.target.result,
								event: evt,
								file: file,
								name: file.name
							});
						};
						reader.readAsDataURL(file);
						setTimeout(() => {
						var nom = document.getElementById('nombreEscudo');
						nom.value = $.urlParam('nombre');							
						var t = document.getElementById("base64");
							
							guardaenFS();
	
						var md = document.getElementById('base64MD');
						md.value = `![image](${t.value})`;	
					
						}, 1000)
						//snapshoot();
						return (found = true);
					}
				});
			});
		});
	});
})(jQuery);

var dataURL, filename;
$("html").pasteImageReader(function(results) {
	filename = results.filename, dataURL = results.dataURL;
	$nombre.val('12oct.png');
	$data.text(dataURL);
	$size.val(results.file.size);
	$type.val(results.file.type);
	var img = document.createElement("img");
	img.src = dataURL;
	var w = img.width;
	var h = img.height;
	$width.val(w);
	$height.val(h);
	return $(".active")
		.css({
			backgroundImage: "url(" + dataURL + ")"
		})
		.data({ width: w, height: h });
});

var $data, $size, $type, $width, $height,$nombre;
$(function() {
	$data = $(".data");
	$size = $(".size");
	$type = $(".type");
	$width = $("#width");
	$height = $("#height");
	$nombre = $("#nombreEscudo");
	$(".target").on("click", function() {
		var $this = $(this);
		var bi = $this.css("background-image");
		if (bi != "none") {
			$data.text(bi.substr(4, bi.length - 6));
		}

		$(".active").removeClass("active");
		$this.addClass("active");

		$this.toggleClass("contain");

		$width.val($this.data("width"));
		$height.val($this.data("height"));
		if ($this.hasClass("contain")) {
			$this.css({
				width: $this.data("width"),
				height: $this.data("height"),
				"z-index": "10"
			});
		} else {
			$this.css({ width: "", height: "", "z-index": "" });
		}
	});
});

function copy(text) {
	var t = document.getElementById("base64");
	t.select();
	try {
		var successful = document.execCommand("copy");
		var msg = successful ? "successfully" : "unsuccessfully";
		alert("Base64 data coppied " + msg + " to clipboard");
	} catch (err) {
		alert("Unable to copy text");
	}
}


function copyMDImage() {
	var md = document.getElementById('base64MD');
	md.select();
	try {
		var successful = document.execCommand("copy");
		var msg = successful ? "successfully" : "unsuccessfully";
		alert("Markdown Base64 data coppied " + msg + " to clipboard");
	} catch (err) {
		alert("Unable to copy text");
	}
}	
	
	
</script>

<style>

.containerimtem1{grid-area: containerimtem1;}
.containerimtem2{grid-area: containerimtem2;}
.containerimtem3{grid-area: containerimtem3;}
.containerimtem4{grid-area: containerimtem4;}
.containerimtem5{grid-area: containerimtem5;}
.containerimtem6{grid-area: containerimtem6;}
.containerimtem7{grid-area: containerimtem7;}
.containerimtem8{grid-area: containerimtem8;}
.containerimtem9{grid-area: containerimtem9;}

.containerimgescudo{
	display:grid;
	grid-template-areas: 'containerimtem1 containerimtem1 containerimtem2'
						 'containerimtem1 containerimtem1 containerimtem3'
						 'containerimtem1 containerimtem1 containerimtem4'
						 'containerimtem1 containerimtem1 containerimtem5'
						 'containerimtem1 containerimtem1 containerimtem6'
						 'containerimtem7 containerimtem7 containerimtem7'
						 'containerimtem8 containerimtem8 containerimtem8';
  grid-gap: 1em;

}
.target {
  border: solid 1px #aaa;
  min-height: 200px;

  padding: 1em;
  border-radius: 5px;
  cursor: pointer;
  transition: 300ms all;
  position: relative;
}

#base64{width: 100%;}


.contain {
    background-size: cover;
  position: relative;
  z-index: 10;
  top: 0px;
  left: 0px;
}
textarea {
  background-color: white;
}
.active {
  box-shadow: 0px 0px 10px 10px rgba(0,0,255,.4);
}


.new:after {
	content: "NEW feature";
	color: white;
	letter-spacing: 1px;
	background: hsla(80, 90%, 40%, .9);
	position: absolute;
	margin: -10px 5px 0 0;
	transform: rotate(-25deg);
	padding: 2px 5px;
	border-radius: 4px;
	font-size: 10px;
	line-height: 14px;
	opacity: .85;
}
</style>
</head>

<body>
<header>
</header>


<div class="containerimgescudo fluid">
	<div class="containerimtem1">
		<div class="span4 target"></div>
	</div>
	<div class="containerimtem2">
		<span class="add-on">size</span>
		<input class="span2 size" id="size" type="text" placeholder="size of pasted image">
	</div>

	<div class="containerimtem3">
		<span class="add-on">type</span>
		<input class="span2 type" id="type" type="text" placeholder="Image type pasted">
	</div>

	<div class="containerimtem4">
		<span class="add-on">width</span>
		<input class="span2 type" id="width" type="text" placeholder="Width">
	</div>

	<div class="containerimtem5">
		<span class="add-on">height</span>
		<input class="span2 type" id="height" type="text" placeholder="Height">
	</div>
	<div class="containerimtem6">
		<span class="add-on">nombre</span>
		<input class="span2 type" id="nombreEscudo" type="text" placeholder="nombreEscudo">			
	</div>	
	<div class="containerimtem7">	
			<textarea id="base64" cols="30" rows="10" class="data span12"></textarea>
	</div>
	
	<div class="containerimtem8"><textarea style="position: absolute; top: 10px;z-index: 1000; left: -10000px;" id="base64MD" cols="30" rows="10"></textarea></div>
</div>



</body>
</html>